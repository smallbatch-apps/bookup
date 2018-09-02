<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
        });

        DB::table('movies')->insert([
            ['title' => 'Fight Club'],
            ['title' => 'Star Wars'],
            ['title' => 'The Godfather'],
            ['title' => 'The Avengers'],
            ['title' => 'Wonder Woman'],
            ['title' => 'Justice League'],
            ['title' => 'A Fault in our Stars'],
            ['title' => 'Amelie'],
            ['title' => 'Aliens'],
            ['title' => 'The Notebook'],
            ['title' => 'Interview with the Vampire'],
            ['title' => 'Hot Fuzz'],
            ['title' => 'Zoolander'],
            ['title' => 'Pitch Perfect'],
            ['title' => 'Twilight']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
