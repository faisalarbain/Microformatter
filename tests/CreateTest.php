<?php 
include "TestCase.php";

use FaisalArbain\Microformatter\Microformatter;
use Carbon\Carbon;

class CreateTest extends TestCase
{
	public function testCanCreateMicroformatter()
	{
		$m = new Microformatter();
		$this->assertInstanceOf('FaisalArbain\Microformatter\Microformatter', $m);
	}


	public function testCanCreateCustomTag()
	{
		$m = new Microformatter();
		$output = $m->create("type", "display value");
		$matcher = $this->getMatcher('span','display value', array("class" => 'type'));
	    $this->assertHtml($matcher, $output);
	}

	public function testCanCreateCustomTagWithRealData()
	{
		$m = new Microformatter();
		$output = $m->create("type", "display value","actual details");
		$this->assertTrue(stripos($output->render(), "actual details") !== false);
	    $this->assertTrue(stripos($output->render(), "value-title") !== false);
	}

	
}