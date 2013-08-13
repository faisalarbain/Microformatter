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
			$param = false;
			if(is_array($format)){
				$param = array_values($format)[0];
				$format = array_keys($format)[0];
			}
			
			if(!$param){
				$this->setValue($date->{$format}());
			}else{
				$this->setValue($date->{$format}($param));
			}
			
		}

		return $this;
	}

	public function author($name)
	{
		return $this->class("author")->setValue($name)->setElement("strong");
	}

	public function prepTime($duration, $format = "min")
	{
		$formats = array(
			"min" => "M",
			"jam" => "H",
			"hour" => "H",
			"mins" => "M"
		);
		if(!array_key_exists($format, $formats)){
			throw new \Exception("Invalid prep time format.");
			
		}

		$format_code = $formats[$format];

		$value_title = Element::span()->setAttribute("title", "PT{$duration}{$format_code}")->addClass("value-title");
		$this->class("prepTime")->setValue("$duration $format")
		->nest(array($value_title));
		return $this;
	}

	public function cookTime($duration, $format = "min")
	{
		$formats = array(
			"min" => "M",
			"jam" => "H",
			"hour" => "H",
			"mins" => "M"
		);
		if(!array_key_exists($format, $formats)){
			throw new \Exception("Invalid prep time format.");
			
		}

		$format_code = $formats[$format];

		$value_title = Element::span()->setAttribute("title", "PT{$duration}{$format_code}")->addClass("value-title");
		$this->class("cookTime")->setValue("$duration $format")
		->nest(array($value_title));
		return $this;
	}
}