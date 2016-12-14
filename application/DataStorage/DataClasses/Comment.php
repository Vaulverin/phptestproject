<?php
class Comment extends Savable
{
    public $Id;
    public $UserName;
    public $Message;
    public $Email;
    public $CommentDate;
    public $Status;
    public $ImageSrc;
    public $Changed;

    public function __construct(
        int $id,
        string $userName,
        string $message,
        string $email,
        string $date,
        int $status, 
        string $imageSrc,
        bool $changed
    )
    {
        $this->Id = $id;
        $this->UserName = $userName;
        $this->Message = $message;
        $this->Email = $email;
        $this->CommentDate = $date;
        $this->Status = $status;
        $this->ImageSrc = $imageSrc;
        $this->Changed = $changed;
    }

    public static function ParseComment($post) : Comment
    {
        return new Comment(
            0,
            $post['name'],
            $post['message'],
            $post['email'],
            $post['date'] ?? date("Y-m-d H:i:s"),
            $post['status'] ?? 0,
            $post['imageSrc'] ?? "",
            false
        );
    }

    public function GetCommentDateView()
    {
        return date("F j, Y, H:i", strtotime($this->CommentDate));
    }

    public function GetPropertiesToSave() : array
    {
        return get_object_vars($this);
    }

    public static function LoadById(int $id) : Comment
    {
        return DataStorageManager::GetManager()->GetStorage()->Load(__CLASS__, ["id" => $id]);;
    }

    public static function LoadAll(array $params = null) : array
    {
        $all = ["all" => 1];
        if ($params != null)
            $all = array_merge($all, $params);
        return DataStorageManager::GetManager()->GetStorage()->Load(__CLASS__, $all);
    }

    public static function Remove($id)
    {
        DataStorageManager::GetManager()->GetStorage()->Remove(__CLASS__, ["id" => $id]);
    } 
}