<form id="contact-form" method="post" role="form" enctype="multipart/form-data" action="/AdminPanel/Save/?id=<?=$data['content']->Id?>">

    <div class="messages"></div>

    <div class="controls">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">Статус</label>
                    <select name="status" class="form-control">
                        <option value="1"<?if ($data['content']->Status == 1) echo ' selected';?>>Принять</option>
                        <option value="2"<?if ($data['content']->Status == 2) echo ' selected';?>>Отклонить</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">Имя *</label>
                    <input value="<?=$data['content']->UserName?>" id="form_name" type="text" name="name" class="form-control" placeholder="Имя автора *" required="required" data-error="Имя - обязательное поле.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">E-mail *</label>
                    <input value="<?=$data['content']->Email?>" id="form_email" type="email" name="email" class="form-control" placeholder="E-mail автора *" required="required" data-error="E-mail введен неверно.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Отзыв *</label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Сообщение *" rows="4" required="required" data-error="Пожалуйста, введите сообщение."><?=$data['content']->Message?></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" id="submit-button" class="btn btn-success btn-send" value="Сохранить">
                <a class="btn btn-default" href="/AdminPanel">Назад</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted"><strong>*</strong> Обязательные поля.</p>
            </div>
        </div>
    </div>

</form>