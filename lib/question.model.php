<?php

class Question
{
	var $collection;
	var $id;
	var $text;
	var $text_a;
	var $text_b;
	var $indicator;
	public function __construct($collection, $attributes=array()) {
		$this->collection = $collection;
		$this->update_attributes($attributes);
	}

	public function save() {
		$attributes = $this->collection->save($this->get_attributes());
		$this->update_attributes($attributes);
	}

	public function update_attributes($attributes) {
		if(array_key_exists("id", $attributes)) $this->id = $attributes["id"];
		if(array_key_exists("text", $attributes)) $this->text = $attributes["text"];
		if(array_key_exists("text_a", $attributes)) $this->text_a = $attributes["text_a"];
		if(array_key_exists("text_b", $attributes)) $this->text_b = $attributes["text_b"];
		if(array_key_exists("indicator", $attributes)) $this->indicator = $attributes["indicator"];
	}

	private function get_attributes() {
		return array(
			"id" => $this->id,
			"text" => $this->text,
			"text_a" => $this->text_a,
			"text_b" => $this->text_b,
			"indicator" => $this->text
			);
	}
}