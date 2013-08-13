<?php 
include "TestCase.php";

use FaisalArbain\Microformatter\Microformatter;
use Carbon\Carbon;

class AuthorTest extends TestCase
{
	public function testCanCreateMicroformatter()
	{
		$m = new Microformatter();
		$this->assertInstanceOf('FaisalArbain\Microformatter\Microformatter', $m);
	}


	public function testCanCreateAuthor()
	{
		$m = new Microformatter();
		$output = $m->author("Foo");
		$matcher = $this->getMatcher('strong','Foo', array("class" => 'author'));
	    $this->assertHtml($matcher, $output);
	}
}