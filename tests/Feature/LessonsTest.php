<?php

namespace Tests\Feature;

use App\Lesson;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class LessonsTest extends ApiTester
{
    use DatabaseTransactions;

	/** @test **/
    public function it_fetches_lessons()
    {
    	// arrange
        $this->times(5)->makeLesson();

        // act
        $response = $this->getJson('api/v1/lessons');

        // assert
        $response->assertStatus(200);
    }

    /** @test **/
    public function it_fetches_a_single_lesson()
    {
        // arrange
        $this->makeLesson([
            'title'     => 'pets',
            'body'      => 'Millie, Kitcha, Jo Jo, Bill',
            'some_bool' => true
        ]);

        // act
        $response = $this->json('GET', '/api/v1/lessons/1');

        // assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'body',
                    'title',
                    'active'
                ]
            ]);
    }

    /** @test **/
    public function it_404s_if_a_lesson_is_not_found()
    {
        $response = $this->json('GET', '/apiw/v1/lessons/x');
        $response->assertStatus(404);
    }

    private function makeLesson($lessonFields = []) {

        while($this->times--) {

        	$lesson = array_merge([
        		'title' => $this->fake->sentence,
        		'body' => $this->fake->paragraph,
        		'some_bool' => $this->fake->boolean

    		], $lessonFields);

        	Lesson::create($lesson);
        } 	
    }


}
