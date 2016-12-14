<?php
class MySQLStorage implements IDataStorage
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=test1;charset=UTF8", "root", "mysql");
        //$this->pdo = new PDO("mysql:host=localhost;dbname=host1537440;charset=UTF8", "host1537440", "6ec66bc6");
    }
    public function Save(string $className, array $params)
    {
        if($className == "Comment")
        {
            unset($params["Id"]);
            $this->ExecuteQuery("INSERT INTO Comments (username, email, message, commentDate, imageSrc, status, changed)
            VALUES (:UserName, :Email, :Message, :CommentDate, :ImageSrc, :Status, :Changed)", $params);
        }
        return true;
    }
    public function Update(string $className, array $params)
    {
        if($className == "Comment")
        {
            $this->ExecuteQuery("UPDATE Comments SET username = :UserName,
             email = :Email, message = :Message, commentDate = :CommentDate, imageSrc = :ImageSrc,
              status = :Status, changed = :Changed WHERE id = :Id", $params);
        }
    }
    public function Load(string $className, array $params)
    {
        $data = array();
        if ($className == "Comment")
        {
            if (isset($params['all']))
            {
                $condition = "";
                if (count($params) > 1)
                {
                    $condition = " WHERE ";
                    foreach($params as $key => $value)
                        if ($key != "all" && ! empty($value))
                            $condition .= $key.' = '.$value.',';
                    $condition = rtrim($condition, ",");
                }
                $stmt = $this->ExecuteQuery('SELECT * FROM Comments'.$condition, $params);
                foreach ($stmt as $row)
                {
                    $data[] = $this->GetCommentFromDataRow($row);
                }
            }
            else if (isset($params['id']))
            {
                $stmt = $this->ExecuteQuery('SELECT * FROM Comments WHERE id = :id', $params);
                $data = $stmt->fetch();
                return $this->GetCommentFromDataRow($data);
            }
        }
        return $data;
    }
    public function Remove(string $className, array $params)
    {
        if ($className == "Comment" && isset($params['id']))
        {
            $this->ExecuteQuery("DELETE FROM Comments WHERE id = :id", $params);
        }
    }

    private function ExecuteQuery($query, $params)
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
    private function GetCommentFromDataRow($row) : Comment
    {
        return new Comment($row['id'],
                    $row['username'],
                    $row['message'],
                    $row['email'],
                    $row['commentDate'],
                    $row['status'],
                    $row['imageSrc'],
                    $row['changed']);
    }
}