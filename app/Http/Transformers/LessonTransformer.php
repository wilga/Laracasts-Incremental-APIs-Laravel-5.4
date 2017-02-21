<?php

namespace App\Http\Transformers;

class LessonTransformer extends Transformer {

	public function transform($lesson) {

	return [
			'title' => $lesson['title'],
			'body'	=> $lesson['body'],
			'active' => (boolean) $lesson['some_bool']
		];
	}
}