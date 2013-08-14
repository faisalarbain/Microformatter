<?php namespace FaisalArbain\Microformatter;
use HtmlObject\Traits\Tag;
use HtmlObject\Element;
use Carbon\Carbon;

class Microformatter extends Tag
{
	protected $element = "span"; 

	public function published(Carbon $date, $format = false)
	{
		$display_value = $this->getDisplayDate($date, $format);
		$this->create("published", $display_value, $date->toISO8601String());

		return $this;
	}

	public function author($name)
	{
		return $this->class("author")->setValue($name)->setElement("strong");
	}

	public function prepTime($duration, $format = "min")
	{
		$format_code = $this->getFormatCode($format);

		$this->create("prepTime","$duration $format", "PT{$duration}{$format_code}");
		
		return $this;
	}

	public function cookTime($duration, $format = "min")
	{
		$format_code = $this->getFormatCode($format);
		$this->create("cookTime","$duration $format", "PT{$duration}{$format_code}");
		return $this;
	}

	public function create($type, $display_value, $actual_value = false)
	{
		$this->class($type)->setValue($display_value);
		if($actual_value){
			$child = Element::span()->setAttribute("title",$actual_value)->addClass("value-title");
			$this->nest(array($child));
		}

		return $this;
	}

	protected function getDisplayDate($date, $format)
	{
		if($format){
			if(is_array($format)){
				$param = array_values($format);
				$format = array_keys($format);

				$date = $date->{$format[0]}($param[0]);
			}else{
				$date = $date->{$format}();
			}	
		}

		return $date;
	}

	protected function getFormatCode($format){
		$formats = array(
			"min" => "M",
			"jam" => "H",
			"hour" => "H",
			"mins" => "M"
		);
		if(!array_key_exists($format, $formats)){
			throw new \Exception("Invalid time format.");
			
		}

		return $formats[$format];
	}
}