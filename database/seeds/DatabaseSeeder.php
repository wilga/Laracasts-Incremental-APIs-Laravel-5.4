<?php

use App\Tag;
use App\Lesson;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::disableForeignKeyConstraints();
        Lesson::truncate();
        Tag::truncate();

        Schema::enableForeignKeyConstraints();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(Lesson::class, 30)->create();

        $this->call(TagsTableSeeder::class);        
    }
}
