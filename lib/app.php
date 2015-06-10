<?php


class App
{

	var $page_content = "";
	var $template = "";

	public function __construct() {

	}

	public function content() {
		return $this->page_content;
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
		return $this->render();
	}

	public function admin_add_question() {
		$this->load_template('admin/add_question');
		return $this->render();
	}

	public function render($variables=array()) {
		$m = new Mustache_Engine;
		return $m->render($this->template, $variables);
	}

	private function load_template($template_name) {
		$this->template = file_get_contents(APP_ROOT.'/views/'.$template_name.'.html');
	}
}