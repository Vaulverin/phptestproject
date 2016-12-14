<?php
class View
{	
	public $Title;
	public $ScriptsURLs;
	public $StylesURLs;

	public function __construct()
	{
		$this->ScriptsURLs = [];
		$this->StylesURLs = [];
	}
	public function generate($content_view, $template_view, $data = null)
	{
		include './application/Views/'.$template_view;
	}
	public function JSONView($data)
	{
		$this->generate('', 'json_view.php', $data);
	}
}