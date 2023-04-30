<?php 
function loadOption($table_name, $option_name){
    $option = R::findOne($table_name, 'option_name = ?', [$option_name]);
    $option_value = $option->option_value;
    return $option_value;
}

?>


<div class="admin-card-header shadow rounded">
    <span class="admin-card-header-el btn admin-btn"><?php echo $title; ?></span>
</div>
<div class="admin-card-content shadow rounded">
    <form class="row admin-form" action="/admin/settings" method="post" >

        <div class="form-group col-12">
            <label>Назва сайту</label>
            <input class="form-control" type="text" name="options[sitename]" value="<?php echo @loadOption('options', 'sitename'); ?>">
        </div>
        <div class="form-group col-12">
            <label>Ключова фраза</label>
            <input class="form-control" type="text" name="options[sitedescription]" value="<?php echo @loadOption('options', 'sitedescription'); ?>">
        </div>
        <div class="form-group col-12">
            <label>Мова сайту</label>
            <select name="options[language]" class="form-select"  style="width: 200px;" >
                <option value="ua" <?php if(@loadOption('options', 'language') == 'ua'){echo 'selected';}?> >Українська</option>
                <option value="en" <?php if(@loadOption('options', 'language') == 'en'){echo 'selected';}?> >Англійська</option>
            </select>
        </div>
        <div class="form-group col-12">
            <label>Адміністративна E-mail адреса</label>
            <input class="form-control" type="text" name="options[email]" style="width: 300px;" value="<?php echo @loadOption('options', 'email'); ?>">
        </div>

        <div class="form-group col-xl-3 col-lg-4 col-md-5 col-sm-6">
            <label>Значок веб-сайту (favicon)</label>
            <input class="form-control" type="file" name="img">
        </div>
        <div class="form-group col-xl-3 col-lg-4 col-md-5 col-sm-6 d-flex align-items-center justify-content-start" style="height: 85px;">
            <img class="image-favicon" src="/public/img/favicon.ico" alt="">
        </div>
        <div class="form-group col-12">
            <button type="submit" name="do_edit" class="btn btn-danger btn-block"><i class="fa fa-floppy-o" aria-hidden="true"></i> Зберегти зміни</button>
        </div>
    </form>
</div>
