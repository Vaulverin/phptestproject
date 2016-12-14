<div class="header clearfix">
    <h3>Обратная связь</h3>
</div>
<div id="posts" class="row marketing">
    <div class="row">
        <div class="col-md-2">
            <p>Сортировать: </p>
        </div>
        <div class="col-md-2">
            <select id="field-type">
                <option value="data-date">Дата</option>
                <option value="data-email">Email</option>
                <option value="data-name">Имя автора</option>
            </select>
        </div>
        <div class="col-md-2">
            <select id="sort-type">
                <option value="order">По возрастанию</option>
                <option value="desc">По убыванию</option>
            </select>
        </div>
    </div>
    <?foreach($data as $comment)
    include './application/Views/comment_view.php';
    ?>
</div>
<div id="preview-place" class="row marketing" style="display: none;">
    <h4>Предпросмотр</h4>
    <div class="blog-post">
        <div class="row">
            <p id="preview-title" class="col-md-5 blog-post-meta"></p>
            <div id="preview-text" class="col-md-7">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <img id="preview-image" class="post-image" src="" style="display:none" />
            </div>
        </div>
        <hr>
    </div>
</div>
<h3>Отправить отзыв</h3>
<form id="contact-form" method="post" role="form" enctype="multipart/form-data">

    <div class="messages"></div>

    <div class="controls">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">Имя *</label>
                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Введите свое имя *" required="required" data-error="Имя - обязательное поле.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">E-mail *</label>
                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Введите свой e-mail *" required="required" data-error="E-mail введен неверно.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input id="form_image" type="file" name="image" title="Ваша картинка" accept="image/jpeg,image/png,image/gif">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Отзыв *</label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Напишите нам пару добрых слов *" rows="4" required="required" data-error="Пожалуйста, введите сообщение."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" id="submit-button" class="btn btn-success btn-send" value="Отправить">
                <button type="button" id="preview" class="btn btn-primary">Предпросмотр</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted"><strong>*</strong> Обязательные поля.</p>
            </div>
        </div>
    </div>

</form>
<footer class="footer">
        <p><a href="/AdminPanel">Панель управления</a></p>
        
</footer>