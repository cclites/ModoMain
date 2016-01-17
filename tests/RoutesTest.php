<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoutesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
	
	public function testAuthenticateFalse(){
		//need to use curl
		$this->assertTrue(true);
	}
	
	public function testAuthenticateTrue(){
		$this->assertTrue(true);
	}
	
}
