<?php

namespace App\Console\Commands;

use App\Movie;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reindex:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindex movies in Elasticsearch';

    /** @var Client */
    private $search;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $search)
    {
        parent::__construct();
        $this->search = $search;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $index = ['index' => 'movies'];

        if($this->search->indices()->exists($index)){
            $this->info('Deleting current movies index.');
            $this->search->indices()->delete($index);
        }
        $this->info('Indexing.');

        $this->search->indices()->create($index);

        foreach (Movie::cursor() as $model) {
            $this->search->index([
                'index' => 'movies',
                'type' => 'movies',
                'id' => $model->id,
                'body' => [
                    'movie' => $model->title
                ],
            ]);

            $this->output->write('.');
        }
    }
}
