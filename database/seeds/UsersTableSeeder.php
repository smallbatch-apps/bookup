<?php

use App\Book;
use App\Musician;
use App\Movie;
use App\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    const GENDER_FEMALE = 1;
    const GENDER_MALE = 2;
    const GENDER_OTHER = 3;
    const BOOK_LIKE = 1;
    const BOOK_HATE = 2;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Profile::class)->create([
            'location' => '-27.4632907,152.9970985',
            'gender_id' => self::GENDER_MALE,
            'user_id' => factory(App\User::class)->create([
                'email' => 'matt@smallbatch.io',
                'name' => 'Matt Burgess'
            ])->id

        ])->each(function (Profile $profile) {
            $profile->seeking()->attach(self::GENDER_FEMALE);
            $profile->likedBooks()->attach(3, ['type' => self::BOOK_LIKE]);
            $profile->likedBooks()->attach(12, ['type' => self::BOOK_LIKE]);
            $profile->likedBooks()->attach(9, ['type' => self::BOOK_LIKE]);
            $profile->hatedBooks()->attach(2, ['type' => self::BOOK_HATE]);
            $profile->hatedBooks()->attach(1, ['type' => self::BOOK_HATE]);
            $profile->movies()->attach(1);
            $profile->movies()->attach(2);
            $profile->movies()->attach(5);
            $profile->musicians()->attach(4);
            $profile->musicians()->attach(2);
            $profile->musicians()->attach(11);
            $profile->musicians()->attach(4);
            $profile->save();
        });

        $books = Book::all();
        $musicians = Musician::all();
        $movies = Movie::all();

        factory(Profile::class, 500)->create()->each(function (Profile $profile) use ($books, $movies, $musicians) {
            foreach ([self::GENDER_FEMALE, self::GENDER_MALE, self::GENDER_OTHER] as $gender) {
                if (mt_rand() % 2) {
                    $profile->seeking()->attach($gender);
                }
            }

            foreach ($books as $book) {
                if (mt_rand(1, 6) == 7) {
                    $profile->likedBooks()->attach($book, ['type' => self::BOOK_LIKE]);
                } else {
                    if (mt_rand(1, 15) == 7) {
                        $profile->hatedBooks()->attach($book, ['type' => self::BOOK_LIKE]);
                    }
                }
            }

            $profile->hatedBooks()->attach(2, ['type' => self::BOOK_HATE]);
            $profile->hatedBooks()->attach(1, ['type' => self::BOOK_HATE]);

            $profile->musicians()->attach($musicians->random(rand(0, 10))->pluck('id'));
            $profile->movies()->attach($movies->random(rand(0, 8))->pluck('id'));
        });
    }
}
