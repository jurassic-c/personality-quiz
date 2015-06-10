<?php

class YamlRecordCollection
{
	var $record_directory = "";
	var $collection = "";
	var $file_path ="";
	var $data;

	public function __construct($collection, $directory=".") {
		$this->collection = $collection;
		$this->directory = $directory;
		$this->file_path = APP_ROOT.'/'.$this->directory.'/'.$this->collection.'.yml';
		if(!file_exists(dirname($this->file_path))) throw new YamlRecordCollectionFileException("Containing folder for collection does not exist");
		if(!file_exists($this->file_path)) touch($this->file_path);
		$this->data = yaml::read($this->file_path);
		if(!array_key_exists('last_id', $this->data)) $this->data['last_id'] = 0;
		if(!array_key_exists('records', $this->data)) $this->data['records'] = array();
		$this->serialize();
	}

	public function save($attributes) {
		$id = (array_key_exists("id", $attributes) and $attributes["id"]) ? $attributes["id"] : $this->guid();
		$attributes["id"] = $id;
		$this->data['records'][$id] = $attributes;
		$this->serialize();
	}

	private function serialize() {
		yaml::write($this->file_path, $this->data);
	}

	private function guid() {
		$this->data['last_id']+=1;
		return $this->collection."_".$this->data['last_id'];
	}
}

class YamlRecordCollectionFileException extends InvalidArgumentException {}