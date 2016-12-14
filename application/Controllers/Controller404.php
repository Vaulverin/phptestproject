<?php
class Controller404 extends Controller
{
    function ActionDefault()
    {
        $this->view->generate('404_view.php', 'template_view.php');
    }
}
