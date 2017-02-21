<?php

use App\Tag;
use App\Lesson;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


	    factory(Tag::class, 10)->create();

	    // Also seed lesson tags pivot table
	    DB::table('lesson_tag')->truncate();

	    $lessonIds = Lesson::pluck('id')->toArray();
	    $tagIds = Tag::pluck('id')->toArray();

		foreach(range( 1, count($lessonIds)) as $index) {

			shuffle($tagIds);
			shuffle($lessonIds);

			DB::statement('INSERT OR IGNORE INTO lesson_tag ( lesson_id, tag_id ) VALUES( '. $lessonIds[0] . ', ' . $tagIds[0] . ' )');

		}


    }
}
