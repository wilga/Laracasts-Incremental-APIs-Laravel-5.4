<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Transformers\TagTransformer;

class TagController extends ApiController
{

	protected $tagTransformer;

	function __construct(TagTransformer $tagTransformer) {

		$this->tagTransformer = $tagTransformer;

	}

    public function index($lessonId = null)
    {

        $tags = $this->getTags($lessonId);

    	return $this->respond([
    		'data' => $this->tagTransformer->transformCollection($tags->all())
		]);
    }

    private function getTags($lessonId) {

        return $lessonId ? Lesson::findOrFail($lessonId)->tags : Tag::all();

    }
}
