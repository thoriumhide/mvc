<div class="admin-card-header shadow rounded">
    <span class="admin-card-header-el"><?php echo $title; ?></span>
    <span class="float-end" style="margin-left: 10px;">
        <a href="/<?php echo $page['url']; ?>" class="btn btn-warning admin-btn" style="padding:1px 4px!important;" target="_blank">
            <i class="fa fa-external-link" aria-hidden="true"></i>
        </a>
    </span>
    <span class="float-end"><?php echo 'id '.$page['id']; ?></span>
</div>
<div class="admin-card-content shadow rounded">
    <form class="row admin-form" action="/admin/edit_page/<?php echo $page['id']; ?>" method="post" >
        <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
            <div class="form-group col-12">
                <label>Назва</label>
                <textarea class="form-control" type="text" name="name" placeholder="Додати заголовок"><?php echo htmlspecialchars($page['name'], ENT_QUOTES); ?></textarea>
            </div>
            <div class="form-group col-12">
                <label>Короткий опис</label>
                <textarea class="form-control" type="text" name="description" placeholder="Додати короткий опис"><?php echo htmlspecialchars($page['description'], ENT_QUOTES); ?></textarea>
            </div>
        </div>
        <div class="form-group col-xl-3 col-lg-4 col-md-5 col-sm-12">
            <label>Головне зображення</label>
            <?php $img = 'public/pic/page-'.$page['id'].'.jpg'; ?>
            <?php if (file_exists($img)) : ?>
                <img class="image-post" src="/public/pic/<?php echo 'page-'.$page['id'].'.jpg';?>" alt="Не знайдено зображення">
            <?php else : ?>
                <img class="image-post" src="/public/img/error-image.jpg" alt="Не знайдено зображення">
            <?php endif ; ?>
            <input class="form-control" type="file" name="img">
        </div>   
        <div class="form-group col-12" style="overflow: hidden;">
            <label>Контент</label>
            <textarea class="form-control html-textarea" name="text" style="padding: 10px; min-height: 250px; height: auto; overflow-y: hidden;"><?php echo ($page['text']); ?></textarea>

        </div>
        <div class="form-group col-9">
            <label>URL</label>
            <input class="form-control" type="text" name="url" value="<?php echo $page['url']; ?>">
        </div>
        <div class="form-group col-3">
            <label>Автор</label>
            <select name="author_id" class="form-select">
                <option value="<?php echo $page['author_id']; ?>" <?php if($user['id'] == $page['author_id']){echo' selected';} ?> ><?php echo $user['name']; ?></option>
            </select>
        </div>
        <div class="form-group col-2 col-md-4" style="width: 140px;">
            <label>Відображати в меню</label><br>
            <input type="radio" class="btn-check" name="menu" id="success-outlined" value="enabled" <?php if($page['menu'] == 'enabled'){echo' checked';} ?>>
            <label class="btn btn-outline-success" for="success-outlined"><i class="fa fa-check-square" aria-hidden="true"></i></label>
            <input type="radio" class="btn-check" name="menu" id="danger-outlined" value="disabled" <?php if($page['menu'] == 'disabled'){echo' checked';} ?>>
            <label class="btn btn-outline-danger" for="danger-outlined"><i class="fa fa-times-circle" aria-hidden="true"></i></label>
        </div>
        <div class="form-group col-2 col-md-4" style="width: 100px;">
            <label>Предок</label>
            <input class="form-control" type="text" name="parent" value="<?php echo htmlspecialchars($page['parent'], ENT_QUOTES); ?>">
        </div>
        <div class="form-group col-2 col-md-4" style="width: 100px;">
            <label>Порядок</label>
            <input class="form-control" type="text" name="order" value="<?php echo htmlspecialchars($page['order'], ENT_QUOTES); ?>">
        </div>
        <div class="form-group col-2 col-md-4" style="width: 200px;">
            <label>Видимість</label>
            <select name="status" class="form-select">
                <option value="published" <?php if($page['status'] == 'published'){echo' selected';} ?> >Опубліковано</option>
                <option value="draft" <?php if($page['status'] == 'draft'){echo' selected';} ?> >Чернетка</option>
            </select>
        </div>
        <div class="form-group col-12">
            <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-floppy-o" aria-hidden="true"></i> Зберегти</button>
        </div>
    </form>
</div>
<script src="/public/js/autosize.js"></script>
<script>
    autosize(document.querySelectorAll('textarea'));
</script>