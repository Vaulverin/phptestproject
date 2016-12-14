<?php
class ControllerDefault extends Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->view->Title = "Обратная связь";
		array_push($this->view->ScriptsURLs,
			"/js/validator.js",
			"/js/contact.js",
			"/js/bootstrap-file-button.js");
    }
	public function ActionDefault()
	{
		$this->view->generate('main_view.php', 'template_view.php', $this->model->GetComments());
	}
	public function ActionSubmit()
	{
		if(count($_POST) != 0 && $this->Validate($_POST, array("name", "message", "email", "status", "imageSrc" )) == 0)
		{
			$data = $this->model->SaveComment($_POST);
			$this->view->JSONView($data);
		}
	}
	public function ActionUploadImage()
	{
		$data = $this->model->UploadImage();
		$this->view->JSONView($data);
	}
	public function ActionPreview()
	{
		if(count($_POST) != 0 && $this->Validate($_POST, array("name", "message", "email", "status", "imageSrc" )) == 0)
		{
			$data = $this->model->GetPreview();
			$this->view->JSONView($data);
		}
	}
}