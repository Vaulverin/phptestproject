<div class="blog-post" data-date="<?=$comment->CommentDate?>" data-email="<?=$comment->Email?>" data-name="<?=$comment->UserName?>">
    <div class="row">
        <p class="col-md-5 blog-post-meta"><?=$comment->GetCommentDateView()?></br>
        <?='от '.$comment->UserName?></br>
        <?=$comment->Email?>
        </p>
        <div class="col-md-7">
            <p><?=$comment->Message?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?if($comment->ImageSrc != ""):?>
                <img class="post-image" src=<?='"'.$comment->ImageSrc.'"'?> />
            <?endif;?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?
            if (isset($data['page'])):
                $status = "НОВОЕ";
                $labelClass = "primary";
                switch($comment->Status)
                {
                    case 1:
                        $status = "ПРИНЯТ";
                        $labelClass = "success";
                        break;
                    case 2:
                        $status = "ОТКЛОНЁН";
                        $labelClass = "default";
                        break;
                }
            ?>
            <span class="label label-<?=$labelClass?>"><?=$status?></span>
            <a href="/AdminPanel/?edit=<?=$comment->Id?>" class="btn btn-xs btn-primary" role="button" aria-pressed="true">Изменить</a>
            <button data-button="<?=$comment->Id?>" class="btn btn-xs btn-danger" role="button" aria-pressed="true">Удалить</button>
            <?elseif ($comment->Changed == true):?>
                <h3><span class="label label-warning">изменен администратором</span></h3>
            <?endif;?>
        </div>
    </div>
    <hr>
</div>