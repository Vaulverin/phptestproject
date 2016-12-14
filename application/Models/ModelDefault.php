<?php
class ModelDefault extends Model
{
    public function SaveComment($post)
    {
        $comment = Comment::ParseComment($post);
        if ($comment->Save())
        {
            return array(
                    'type' => 'Успех!',
                    'message' => 'Отзыв успешно отправлен.'
                );
        }
        return array('error' => 'Ошибка при сохранении отзыва!');
    }
    public function GetComments() : array
    {
        return Comment::LoadAll(array("status" => 1));
    }

    public function GetPreview()
    {
        $comment = Comment::ParseComment($_POST);
        return array(
				'type' => 'ok',
				'title' => $comment->GetCommentDateView()."</br>". $comment->UserName."</br>".$comment->Email,
				'text' => $comment->Message,
				'image' => $comment->ImageSrc
			);
    }

    public function UploadImage()
    {
        $data = array();
        if(isset($_FILES['image']))
		{  
			$uploaddir = './images/';
			$file = $_FILES['image'];
			$fn = $_FILES['image']['tmp_name'];
			$maxWidth = 320;
			$maxHeight = 240;
			$size = getimagesize($fn);
			$width = $size[0];
			$height = $size[1];
			$scale = min($maxWidth/$width, $maxHeight/$height);
         
			if ($scale < 1) {
				$width = floor($scale * $width);
				$height = floor($scale * $height);
			}

			$src = imagecreatefromstring(file_get_contents($fn));
			$dst = imagecreatetruecolor($width, $height);
			imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
			imagedestroy($src);
			switch($_FILES["image"]["type"])
			{
				case "jpg":
				case "jpeg":
					imagejpeg($dst, $file['tmp_name']);
					break;
				case "gif":
					imagegif($dst, $file['tmp_name']);
					break;
				default:
					imagepng($dst, $file['tmp_name']);
			}
			$info = getimagesize($file['tmp_name']);
			$extension = image_type_to_extension($info[2]);
			$newname = time().$extension;
			if(move_uploaded_file($file['tmp_name'], $uploaddir.$newname))
			{
				$data['imageSrc'] = trim($uploaddir.$newname, ".");
			}
		}
        return $data;
    }

}