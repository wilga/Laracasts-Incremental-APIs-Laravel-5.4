<?php

namespace App\Http\Transformers;

class TagTransformer extends Transformer {

	public function transform($tag) {
		return [
				'name' => $tag['name']
		];
	}
}