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
			
			default:
				$this->page_content = $this->index();
				break;
		}
	}

	public function index() {

	}

	public function admin() {
		$this->load_template('admin/index');
		return $this->render(array("message"=>"KILL ME IM ADMIN VARIABLE!!!!!"));
	}

	public function render($variables=array()) {
		$m = new Mustache_Engine;
		return $m->render($this->template, $variables);
	}

	private function load_template($template_name) {
		$this->template = file_get_contents(APP_ROOT.'/views/'.$template_name.'.html');
	}
}