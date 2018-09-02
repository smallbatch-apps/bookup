<?php

namespace App;

use Elasticsearch\Client;

class BooksRepository
{
    /** @var Client */
    private $search;

    public function __construct(Client $client)
    {
        $this->search = $client;
    }

    public function search($search)
    {
        return $this->search->search([
            'index' => 'books',
            'type' => 'books',
            'body' => [
                "query" => [
                    "match_phrase_prefix" => [
                        "book" => $search
                    ]
                ]
            ]
        ]);
    }
}