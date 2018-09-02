<?php

namespace App;


use Elasticsearch\Client;

class MatchesRepository
{
    /** @var Client */
    private $search;

    public function __construct(Client $client)
    {
        $this->search = $client;
    }

    public function match()
    {

        $json = [
            'index' => 'profiles',
            'type' => 'profiles',
            'body' => [
                "query" => [
                    "function_score" => [
                        "query" => [
                            "bool" => [
                                "must" => [
                                    [
                                        "terms" => [
                                            "gender_value" => auth()->user()->profile->seeking->pluck('gender')->toArray()
                                        ]
                                    ],
                                    [
                                        "term" => [
                                            "gender_seeking" => auth()->user()->profile->gender->gender
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        "functions" => [
                            [
                                "gauss" => [
                                    "location" => [
                                        "origin" => "-27.4659159,152.9881955",
                                        "offset" => "2km",
                                        "scale" => "30km"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        return $this->search->search($json);
    }
}