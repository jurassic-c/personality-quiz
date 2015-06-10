<?php

class QuestionCollection extends YamlRecordCollection
{
	public function __construct($directory=".") {
		parent::__construct('questions', $directory);
	}

	public function all() {
		$objects = parent::all();
		$result = array();
		foreach ($objects as $obj) {
			$result[] = new Question($this, $obj->get_attributes());
		}
		return $result;
	}

	public function get($id){
		$record = parent::get($id);
		$attributes = $record->get_attributes();
		$result = new Question($this, $attributes);
		return $result;
	}

}