<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('author');
        });


        DB::table('books')->insert([
            ['title' => 'The Art of the Deal', 'author' => 'Donald Trump'],
            ['title' => 'Mein Kampf', 'author' => 'Adolf Hitler'],
            ['title' => 'Stranger in a Strange Land', 'author' => 'Robert A. Heinlein'],
            ['title' => 'Starship Troopers', 'author' => 'Robert A. Heinlein'],
            ['title' => 'Magician', 'author' => 'Raymond E Feist'],
            ['title' => 'The DaVinci Code', 'author' => 'Dan Brown'],
            ['title' => 'On The Road', 'author' => 'Jack Kerouac'],
            ['title' => 'Catch-22', 'author' => 'Joseph Heller'],
            ['title' => 'Fahrenheit 451', 'author' => 'Ray Bradbury'],
            ['title' => 'The Prophet ', 'author' => 'Kahlil Gibran'],
            ['title' => 'The Alchemist', 'author' => 'Paulo Coelho'],
            ['title' => 'Twilight', 'author' => 'Stephenie Meyer'],
            ['title' => 'Harry Potter', 'author' => 'JK Rowling'],
            ['title' => 'The Lord of the Rings', 'author' => 'JRR Tolkien'],
            ['title' => 'Patriot Games', 'author' => 'Tom Clancy'],
            ['title' => 'Dune', 'author' => 'Frank Herbert'],
            ['title' => 'Sometimes I Lie', 'author' => 'Alice Feeney'],
            ['title' => '12 Rules for Life: An Antidote to Chaos', 'author' => 'Jordan B. Peterson'],
            ['title' => 'Dangerous', 'author' => 'Milo Yiannopoulos'],
            ['title' => 'Brave New World', 'author' => 'Aldous Huxley']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
