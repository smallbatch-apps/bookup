<?php
namespace App\Services;

use League\Geotools\Geotools;
use League\Geotools\Coordinate\Coordinate;

class GeotoolsService
{
    public function distanceToLocation($location)
    {
        $geotools = new Geotools;
        $coordA = new Coordinate(explode(',', auth()->user()->profile->location));
        $coordB = new Coordinate(explode(',', $location));

        return $geotools->distance()->setFrom($coordA)->setTo($coordB)->in('km')->greatCircle();
    }


    static function create()
    {
        return new static();
    }
}