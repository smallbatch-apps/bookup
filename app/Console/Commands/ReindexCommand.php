<?php

namespace App\Console\Commands;

use App\Profile;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reindex:profiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to elasticsearch';

    protected $search;

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
        $profileIndex = ['index' => 'profiles'];
        $this->info('Indexing all Profiles. Might take a while...');

        if($this->search->indices()->exists($profileIndex)){
            $this->search->indices()->delete($profileIndex);
        }

        $params = [
            'index' => 'profiles',
            'body' => [
                'mappings' => [
                    'profiles' => [
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => [
                            'id' => [
                                'type' => 'text'
                            ],
                            'user_id' => [
                                'type' => 'text'
                            ],
                            'title' => [
                                'type' => 'text'
                            ],
                            'summary' => [
                                'type' => 'text'
                            ],
                            'description' => [
                                'type' => 'text'
                            ],
                            'gender_value' => [
                               'type' => 'keyword'
                            ],
                            'gender_seeking' => [
                                'type' => 'keyword'
                            ],
                            'location' => [
                                'type' => 'geo_point'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->search->indices()->create($params);

        foreach (Profile::cursor() as $model)
        {
            $this->search->index([
                'index' => $model->getSearchIndex(),
                'type' => $model->getSearchType(),
                'id' => $model->id,
                'body' => $model->toSearchArray(),
            ]);

            // PHPUnit-style feedback
            $this->output->write('.');
        }

        $this->info("\nDone!");
    }
}
