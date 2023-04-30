<div class="admin-card-header shadow rounded">
    <span class="admin-card-header-el"><?php echo $title; ?></span>
    <span class="float-end"><?php echo 'id '.$user['id']; ?></span>
</div>


<div class="admin-card-content shadow rounded">
    <form class="row admin-form" action="/admin/edit_user/<?php echo $user['id']; ?>" method="post" >
        <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
            <div class="form-group col-12">
                <label>Логін</label>
                <input class="form-control" type="text" name="login" placeholder="Введіть логін" value="<?php echo $user['login']; ?>">
            </div>
            <div class="form-group col-12">
                <label>E-mail</label>
                <input class="form-control" type="email" name="email" placeholder="Введіть E-mail" value="<?php echo $user['email']; ?>">
            </div>
            <div class="form-group col-12">
                <label>Прізвище та Ім'я</label>
                <input class="form-control" type="text" name="name" placeholder="Введіть Прізвище та Ім'я" value="<?php echo $user['name']; ?>">
            </div>
            <div class="form-group col-2 col-md-4" style="width: 200px;">
                <label>Роль</label>
                <select name="acl" class="form-select">
                    <option value="admin" <?php if($user['acl'] == 'admin'){echo' selected';} ?>>Адміністратор</option>
                    <option value="editor" <?php if($user['acl'] == 'editor'){echo' selected';} ?>>Редактор</option>
                </select>
            </div>    
        </div>
        <div class="form-group col-xl-3 col-lg-4 col-md-5 col-sm-12">
            <label>Головне зображення</label>
            <?php $img = 'public/pic/user-'.$user['id'].'.jpg'; ?>
            <?php if (file_exists($img)) : ?>
                <img class="image-post" src="/public/pic/<?php echo 'user-'.$user['id'].'.jpg';?>" alt="Не знайдено зображення">
            <?php else : ?>
                <img class="image-post" src="/public/img/error-image.jpg" alt="Не знайдено зображення">
            <?php endif ; ?>
            <input class="form-control" type="file" name="img">
        </div>   

        <div class="form-group col-12">
            <input type="text" name="id" value="<?php echo $user['id']; ?>" hidden>
            <input type="text" name="form_id" value="do_edit" hidden>
            <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-floppy-o" aria-hidden="true"></i> Зберегти</button>
        </div>
    </form>
    <form class="row admin-form" action="/admin/edit_user/<?php echo $user['id']; ?>" method="post" >
        <div class="form-group col-xl-4 col-lg-5 col-md-6 col-sm-12">
            <label>Пароль</label>
            <input type="text" name="id" value="<?php echo $user['id']; ?>" hidden>
            <input type="text" name="form_id" value="do_pass_edit" hidden>
            <input class="form-control" type="password" name="password" placeholder="Введіть новий пароль">
        </div> 
        <div class="form-group col-12">
            <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-floppy-o" aria-hidden="true"></i> Змінити пароль</button>
        </div>
    </form>
</div>
<script src="/public/js/autosize.js"></script>
<script>
    autosize(document.querySelectorAll('textarea'));
</script>