<?php

namespace App\Http\Controllers;

use App\MatchesRepository;
use App\Services\GeotoolsService;

class MatchesController extends Controller
{
    /** @var MatchesRepository */
    private $matches;

    public function __construct(MatchesRepository $matches)
    {
        $this->matches = $matches;
    }

    public function index()
    {
        $geocode = GeotoolsService::create();
        $matches = $this->matches->match();

        return view('matches', [
            'matches' => collect($matches['hits']['hits'])->map(function($match) use ($geocode){

                $match['_source']['distance'] = number_format($geocode->distanceToLocation($match['_source']['location']), 1);
                return $match;
            })->chunk(2),
            'profile' => auth()->user()->profile
        ]);
    }

    public function edit()
    {
        
    }
}
