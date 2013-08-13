<?php 
include "TestCase.php";

use FaisalArbain\Microformatter\Microformatter;
use Carbon\Carbon;

class PrepTimeTest extends TestCase
{
	public function testCanCreateMicroformatter()
	{
		$m = new Microformatter();
		$this->assertInstanceOf('FaisalArbain\Microformatter\Microformatter', $m);
	}


	public function testCanCreateBasicPrepTimeTag()
	{
		$m = new Microformatter();
		$output = $m->prepTime(10, 'min');
		$matcher = $this->getMatcher('span','10 min', array("class" => 'prepTime'));
	    $this->assertHtml($matcher, $output);
	    $this->assertTrue(stripos($output->render(), "PT10M") !== false);
	}

	public function testCanCreateBasicPrepTimeTagHour()
	{
		$m = new Microformatter();
		$output = $m->prepTime(10, 'jam');
		$matcher = $this->getMatcher('span','10 jam', array("class" => 'prepTime'));
	    $this->assertHtml($matcher, $output);
	    $this->assertTrue(stripos($output->render(), "PT10H") !== false);
	}

	public function testCanCreateBasicCookTimeTag()
	{
		$m = new Microformatter();
		$output = $m->cookTime(10, 'min');
		$matcher = $this->getMatcher('span','10 min', array("class" => 'cookTime'));
	    $this->assertHtml($matcher, $output);
	    $this->assertTrue(stripos($output->render(), "PT10M") !== false);
	}
}