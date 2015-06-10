<?php

require APP_ROOT.'/lib/yaml_record_collection.model.php';
require APP_ROOT.'/lib/question_collection.class.php';
require APP_ROOT.'/lib/yaml_record.class.php';
require APP_ROOT.'/lib/question.model.php';

class App
{

	var $page_content = "";
	var $template = "";
	var $question_collection;

	public function __construct() {
		$this->question_collection = new QuestionCollection('data');
	}

	public function content() {
		$header = file_get_contents(APP_ROOT.'/views/header.html');
		$footer = file_get_contents(APP_ROOT.'/views/footer.html');
		return $header.$this->page_content.$footer;
	}

	public function process($page) {
		switch ($page) {
			case 'admin':
				$this->page_content = $this->admin();
				break;

			case 'admin_add_question':
				$this->page_content = $this->admin_add_question();
				break;
			
			default:
				$this->page_content = $this->index();
				break;
		}
	}

	public function index() {
		$this->load_template('index');
		return $this->render();
	}

	public function admin() {
		$this->load_template('admin/index');
		$questions = $this->question_collection->all();
		return $this->render(array("questions" => $questions));
	}

	public function admin_add_question() {
		$question = null;
		if(array_key_exists('question', $_POST)) {
			$question = new Question($this->question_collection, $_POST['question']);
			$question->save();
			header("Location: /?p=admin");
		}
		$this->load_template('admin/add_question');
		return $this->render($question);
	}

	public function render($variables=array()) {
		$m = new Mustache_Engine;
		return $m->render($this->template, $variables);
	}

	private function load_template($template_name) {
		$this->template = file_get_contents(APP_ROOT.'/views/'.$template_name.'.html');
	}
}