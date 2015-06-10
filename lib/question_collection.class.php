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
}