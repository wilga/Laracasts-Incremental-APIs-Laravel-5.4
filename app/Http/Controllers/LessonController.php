<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Transformers\LessonTransformer;

class LessonController extends ApiController {

	protected $lessonTransformer;

	function __construct(LessonTransformer $lessonTransformer)
	{
		$this->lessonTransformer = $lessonTransformer;

		$this->middleware('auth.basic', ['only' => 'store']);
	}


    public function index()
    {
		$lessons = Lesson::all();
    	return $this->respond([
    		'data' => $this->lessonTransformer->transformCollection($lessons->all())
		]);
    }

    public function show($id)
    {
    	$lesson = Lesson::find($id);

    	if ( ! $lesson ) {

    		return $this->respondNotFound('Lesson does not exist.');

		}

		return $this->respond([
    		'data' => $this->lessonTransformer->transform($lesson)
		]);
     }

     public function store(Request $request)
     {
     	if ( ! $request->title or ! $request->body or ! $request->active )
     	{
     		return $this->respondInvalidRequest('Please provide all required fields.');
     	}
     	try {
	     	Lesson::create([
				'title' => $request->title,
				'body'	=> $request->body,
				'some_bool' => $request->active
			]);
  		} 
		catch(\Exception $e){
		    return $this->respondInternalError($e->getMessage());
		}

     	return $this->setStatusCode(201)->respondWithMessage();
     }

}