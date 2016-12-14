<?php
class ModelAdminPanel extends Model
{
	private $login = "admin";
	private $password = "123";

	public function CheckAuthForm()
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		if($login == $this->login && $password == $this->password)
			return true;
		return false;
	}

	public function GetComments()
	{
		return Comment::LoadAll();
	}
	public function GetComment($id)
	{
		return Comment::LoadById($id);
	}
	public function RemoveComment($id)
	{
		Comment::Remove($id);
	}
	public function SaveComment($id)
	{
		$comment = Comment::LoadById($id);
		$newComment = Comment::ParseComment($_POST);
		$changed = false;
		foreach(array("UserName", "Message", "Email") as $property)
			if ($comment->$property != $newComment->$property)
			{
				$changed = true;
				$comment->$property = $newComment->$property;
			}
		$comment->Status = $newComment->Status;
		$comment->Changed = $changed;
		$comment->Update();
	}
}