<?php


class App
{

	var $page_content = "";

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
				$this->page_content = "KILL ME IM HERE!!!";
				break;
		}
	}

	public function admin() {
		$template = file_get_contents(APP_ROOT.'/views/admin/index.html');
		$m = new Mustache_Engine;
		echo $m->render($template, array("message"=>"KILL ME IM ADMIN!!!"));
	}
}