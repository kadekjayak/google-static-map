<?php

namespace GoogleMapStatic\Elements\Style;

class Style {

	public function __construct($styles = array(), $element = null, $feature = null )
	{

		$this->styles = array();
		$this->feature = 'all';
		$this->element = 'all';
		if ($feature != null) {
			$this->feature = $feature;
		}
		if ($element != null) {
			$this->element = $element;
		}

		foreach($styles as $key => $value) {
			$this->addStyle($key, $value);
		}
	}

	public function setStyles($params) 
	{
		$style = $params;
	}

	public function addStyle($key, $value) 
	{
		$this->styles[$key] = str_replace('#', '0x', $value);
	}
	public function setFeature($feature)
	{
		$this->feature = $feature;
	}
	public function setElement($element)
	{
		$this->element = $element;
	}


	public function getStyles()
	{
		return $this->styles;
	}
	public function getFeature()
	{
		return $this->feature;
	}
	public function getElement()
	{
		return $this->element;
	}

}