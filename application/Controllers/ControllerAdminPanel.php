<?php
class ControllerAdminPanel extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->Title = "Панель управления";
        $this->validateVars['edit'] = new ValidateSettings(FILTER_VALIDATE_INT, array());
        $this->validateVars['login'] = new ValidateSettings(FILTER_SANITIZE_STRING, array());
        $this->validateVars['password'] = new ValidateSettings(FILTER_SANITIZE_STRING, array());
    }
    public function ActionDefault()
    {
        if($_SESSION['access'] == false)
        {
            header("location: /AdminPanel/Auth");
            exit();                
        }
        $data = null;
        if (isset($_GET['edit']) && empty($this->Validate($_GET, array("edit"))))
        {
            $data['page'] = 'comment';
            $data['content'] = $this->model->GetComment($_GET['edit']);
        }
        else
        {
            $data['page'] = 'main';
            $data['content'] = $this->model->GetComments();
            array_push($this->view->ScriptsURLs, "/js/bootbox.min.js", "/js/adminpanel.js");
        }
        $this->view->generate('adminpanel_view.php', 'template_view.php', $data);
    }
    public function ActionAuth()
    {
        array_push($this->view->StylesURLs, "/css/signin.css");
        $data = null;
        if(count($_POST) != 0 && empty($this->Validate($_POST, array("login", "password"))))
        {
            if ($this->model->CheckAuthForm())
                $_SESSION['access'] = true;
            else
                $data['error'] = "Имя пользователя или Пароль введены не верно.";
        }
        if($_SESSION['access'])
        {
            header("location: /AdminPanel/");
            exit();                
        }
        $this->view->generate('auth_view.php', 'template_view.php', $data);
    }
    public function ActionLogout()
    {
        $_SESSION['access'] = false;
        header("location: /");
    }
    public function ActionRemove()
    {
        if (isset($_GET['id']) && empty($this->Validate($_GET, array("id"))))
        {
            $this->model->RemoveComment($_GET['id']);
        }
        header("location: /AdminPanel/");
        exit();
    }
    public function ActionSave()
    {
        if (isset($_GET['id']) && empty($this->Validate($_GET, array("id")))
            && empty($this->Validate($_POST, array("name", "message", "email", "status"))))
        {
            $this->model->SaveComment($_GET['id']);
        }
        header("location: /AdminPanel/");
        exit();
    }
} 