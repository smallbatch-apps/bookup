<?php

namespace App\Console\Commands;

use App\Book;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reindex:books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindex books in Elasticsearch';

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
        $booksIndex = ['index' => 'books'];

        if($this->search->indices()->exists($booksIndex)){
            $this->info('Deleting current book index.');
            $this->search->indices()->delete($booksIndex);
        }
        $this->info('Indexing books.');

        $this->search->indices()->create($booksIndex);

        foreach (Book::cursor() as $model) {
            $this->search->index([
                'index' => 'books',
                'type' => 'books',
                'id' => $model->id,
                'body' => [
                    'book' => $model->title . ' - ' . $model->author,
                    'title' => $model->title,
                    'author' => $model->author
                ],
            ]);

            $this->output->write('.');
        }
    }
}
