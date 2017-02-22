<?php

namespace Tests\Feature;

trait Factory {

	protected $times = 1;

    protected function times($count)
    {
        $this->times = $count;

        return $this;
    }

    /** Make a new record in the DB */
    protected function make($type, array $fields = [])
    {

    	while ($this->times--) {

    		$stub = array_merge($this->getStub(), $fields);
	    	$type::create($stub);
    	}
    }

}