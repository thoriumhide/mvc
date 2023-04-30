<div class="admin-card-header shadow rounded"><span class="admin-card-header-el"><?php echo $title; ?></span></div>
<div class="admin-card-content shadow rounded">
    <form class="row admin-form" action="/admin/add_user" method="post" >
        <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
            <div class="form-group col-12">
                <label>Логін</label>
                <input class="form-control" type="text" name="login" placeholder="Введіть логін">
            </div>
            <div class="form-group col-12">
                <label>E-mail</label>
                <input class="form-control" type="email" name="email" placeholder="Введіть E-mail">
            </div>
            <div class="form-group col-12">
                <label>Прізвище та Ім'я</label>
                <input class="form-control" type="text" name="name" placeholder="Введіть Прізвище та Ім'я">
            </div>
            <div class="form-group col-12">
                <label>Пароль</label>
                <input class="form-control" type="password" name="password" placeholder="Введіть пароль">
            </div>           
        </div>
        <div class="form-group col-xl-3 col-lg-4 col-md-5 col-sm-12">
            <label>Головне зображення</label>
            <img class="image-post" src="/public/img/error-image.jpg" alt="Не знайдено зображення">
            <input class="form-control" type="file" name="img">
        </div>   
        <div class="form-group col-2 col-md-4" style="width: 200px;">
            <label>Роль</label>
            <select name="acl" class="form-select">
                <option value="admin">Адміністратор</option>
                <option value="editor" selected>Редактор</option>
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