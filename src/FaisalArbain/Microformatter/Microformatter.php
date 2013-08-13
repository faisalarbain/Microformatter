<?php namespace FaisalArbain\Microformatter;
use HtmlObject\Traits\Tag;
use HtmlObject\Element;
use Carbon\Carbon;

class Microformatter extends Tag
{
	protected $element = "span";

	public function published(Carbon $date, $format = false)
	{
		// <span class="value-title" title="{{$recipe->created_at}}"></span>
		$value_title = Element::span()->setAttribute("title", $date->toISO8601String())->addClass("value-title");
		
		$this->class("published")
		->setValue($date)
		->nest(array(
			$value_title
			));

		if($format){
			if(method_exists($date, $format)){
				$this->setValue($date->{$format}());
			}else{
				$this->setValue($date->format($format));
			}
		}

		return $this;
	}
}