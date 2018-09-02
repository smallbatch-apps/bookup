<?php

namespace App\Console\Commands;

use App\Musician;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexMusicians extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reindex:musicians';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindex musicians in Elasticsearch';

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
        $index = ['index' => 'musicians'];

        if($this->search->indices()->exists($index)){
            $this->info('Deleting current music index.');
            $this->search->indices()->delete($index);
        }
        $this->info('Indexing.');

        $this->search->indices()->create($index);

        foreach (Musician::cursor() as $model) {
            $this->search->index([
                'index' => 'musicians',
                'type' => 'music',
                'id' => $model->id,
                'body' => [
                    'music' => $model->artist
                ],
            ]);

            $this->output->write('.');
        }
    }
}
