<?php 
include "TestCase.php";

use FaisalArbain\Microformatter\Microformatter;
use Carbon\Carbon;

class PublishedTest extends TestCase
{
	public function testCanCreateMicroformatter()
	{
		$m = new Microformatter();
		$this->assertInstanceOf('FaisalArbain\Microformatter\Microformatter', $m);
	}


	public function testCanCreateBasicPublisedTag()
	{
		$m = new Microformatter();
		$output = $m->published(Carbon::create(1985,5,25));
		$matcher = $this->getMatcher('span','1985-05-25', array("class" => 'published'));
	    $this->assertHtml($matcher, $output);
	}

	public function testCanFormatPublisedTag()
	{
		$m = new Microformatter();
		$output = $m->published(Carbon::now()->subDays(2),"diffForHumans");
		$matcher = $this->getMatcher('span','2 days ago', array("class" => 'published'));
	    $this->assertHtml($matcher, $output);

	}

	public function testCanCustomFormatPublisedTag()
	{
		$m = new Microformatter();
		$output = $m->published(Carbon::create(1985,5,25),array("format" => "d m Y"));
		$matcher = $this->getMatcher('span','25 05 1985', array("class" => 'published'));
	    $this->assertHtml($matcher, $output);
	}
}