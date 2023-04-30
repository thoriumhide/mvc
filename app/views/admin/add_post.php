<div class="admin-card-header shadow rounded"><span class="admin-card-header-el"><?php echo $title; ?></span></div>
<div class="admin-card-content shadow rounded">
    <form class="row admin-form" action="/admin/add_post" method="post" >
        <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
            <div class="form-group col-12">
                <label>Назва</label>
                <textarea class="form-control" type="text" name="name" placeholder="Додати заголовок"></textarea>
            </div>
            <div class="form-group col-12">
                <label>Короткий опис</label>
                <textarea class="form-control" type="text" name="description" placeholder="Додати короткий опис"></textarea>
            </div>            
        </div>

        <div class="form-group col-xl-3 col-lg-4 col-md-5 col-sm-12">
            <label>Головне зображення</label>
            <img class="image-post" src="/public/img/error-image.jpg" alt="Не знайдено зображення">
            <input class="form-control" type="file" name="img">
        </div>   

        <div class="form-group col-12" style="overflow: hidden;">
            <label>Контент</label>
            <?php include 'app/views/elements/control-btn.php'; ?>
            <textarea id="html-editor" class="form-control html-textarea" name="text" style="padding: 10px; min-height: 250px; height: auto; overflow-y: hidden;"></textarea>
            <div id="visual-editor" contenteditable="true" class="editor form-control" style=" padding: 10px; min-height: 250px; height: auto; overflow-y: hidden;"></div>
        </div>
        <div class="form-group col-2 col-md-4" style="width: 140px;">
            <label>Відображати в меню</label><br>
            <input type="radio" class="btn-check" name="menu" id="success-outlined" value="enabled">
            <label class="btn btn-outline-success" for="success-outlined"><i class="fa fa-check-square" aria-hidden="true"></i></label>
            <input type="radio" class="btn-check" name="menu" id="danger-outlined" value="disabled" checked>
            <label class="btn btn-outline-danger" for="danger-outlined"><i class="fa fa-times-circle" aria-hidden="true"></i></label>
        </div>
        <div class="form-group col-2 col-md-4" style="width: 100px;">
            <label>Предок</label>
            <input class="form-control" type="text" name="parent" value="<?php echo$_SESSION['post_id']; ?>">
        </div>
        <div class="form-group col-2 col-md-4" style="width: 100px;">
            <label>Порядок</label>
            <input class="form-control" type="text" name="order" value="1">
        </div>
        <div class="form-group col-2 col-md-4" style="width: 200px;">
            <label>Видимість</label>
            <select name="status" class="form-select">
                <option value="published">Опубліковано</option>
                <option value="draft" selected>Чернетка</option>
            </select>
        </div>
        <div class="form-group col-12">
            <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-floppy-o" aria-hidden="true"></i> Створити</button>
        </div>
    </form>
</div>
<script src="/public/js/autosize.js"></script>
<script>
    autosize(document.querySelectorAll('textarea'));
</script>
<script src="/public/js/editor.js"></script>