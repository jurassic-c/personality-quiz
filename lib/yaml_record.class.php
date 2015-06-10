<?php

class YamlRecord
{
	var $collection;
	var $id;
	private $attributes;

	public function __construct($collection, $attributes=array()) {
		$this->attributes = $attributes;
		$this->collection = $collection;
		$this->update_attributes($attributes);
	}

	public function save() {
		$attributes = $this->collection->save($this->get_attributes());
		$this->update_attributes($attributes);
	}

	public function update_attributes($attributes) {
		$this->attributes = $attributes;
	}

	public function get_attributes() {
		return $this->attributes;
	}

	public function delete(){
		$this->collection->delete($this->id);
	}

}