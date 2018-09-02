<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusiciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musicians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('artist');
        });

        DB::table('musicians')->insert([
            ['artist' => 'The Arctic Monkeys'],
            ['artist' => 'Wolfmother'],
            ['artist' => 'Ilona Harker'],
            ['artist' => 'Babymetal'],
            ['artist' => 'Anais Mitchell'],
            ['artist' => 'Purity Ring'],
            ['artist' => 'The White Stripes'],
            ['artist' => 'Skott'],
            ['artist' => 'The National'],
            ['artist' => 'Skott'],
            ['artist' => 'Paul Simon'],
            ['artist' => 'Avril Lavigne'],
            ['artist' => 'Pink'],
            ['artist' => 'Björk'],
            ['artist' => 'The Misfits'],
            ['artist' => 'Crowded House'],
            ['artist' => 'Nightwish'],
            ['artist' => 'Tori Amos'],
            ['artist' => 'Hilltop Hoods'],
            ['artist' => 'Janelle Monae']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('musicians');
    }
}
