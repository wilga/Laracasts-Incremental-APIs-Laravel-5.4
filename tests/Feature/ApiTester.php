<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class ApiTester extends TestCase
{

	protected $fake;
	protected $times = 1;

	function __construct()
	{
		$this->fake = Faker::create();

	}

    protected function times($count)
    {
        $this->times = $count;

        return $this;
    }

}
