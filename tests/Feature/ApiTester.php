<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory as Faker;
use BadMethodCallException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;


abstract class ApiTester extends TestCase
{
	protected $fake;

	function __construct()
	{
		$this->fake = Faker::create();

	}

	public function setUp()
	{
		parent::setUp();

		Artisan::call('migrate');
	}

	public function getJson($uri, $method = 'GET', $parameters = [])
	{
		return $this->call($method, $uri, $parameters);
	}

	protected function getStub()
    {
    	throw new BadMethodCallException('Create your own getStub method to declare your fields.');
    }

}
