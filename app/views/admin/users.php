
<div class="admin-card-header shadow rounded">
    <span class="admin-card-header-el btn admin-btn"><?php echo $title; ?></span>
    <span class="float-end"><a href="/admin/add_user/" class="btn btn-success admin-btn">Додати користувача</a></span>
</div>

<?php if (empty($users)): ?>
    <div class="admin-card-content shadow rounded">   
        <p>Список користувачів пустий</p>
    </div>
<?php else: ?>
    <div class="admin-card-content shadow rounded" style="padding: 10px 0;">   
        <table class="table table-grey table-hover admin-table">
            <thead>
            <tr> 
                <th class="" width="100%">Прізвище та Ім'я користувача</th>
                <th class="w-100 text-right">Логін</th>
                <th class="w-100 text-right">E-mail</th>
                <th class="w-100 text-right">Роль</th>
                <th class="w-100 text-right"></th>
                <th class="w-100 text-right"></th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="w-auto" width="100%">
                            <a href="/admin/edit_user/<?php echo $user['id']; ?>" class="btn btn-link admin-btn"><?php echo $user['name']; ?></a>
                        </td>
                        <td class="w-100 text-right"><?php echo $user['login']; ?></td>
                        <td class="w-100 text-right"><?php echo $user['email']; ?></td>
                        <td class="w-100 text-right"><?php if($user['acl'] == 'admin'){echo 'Адміністратор';} if($user['acl'] == 'editor'){echo 'Редактор';} ?></td>
                        <td class="w-100 text-right"><a href="/admin/edit_user/<?php echo $user['id']; ?>" class="btn btn-primary admin-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                        <td class="w-100 text-right"><a href="/admin/delete_user/<?php echo $user['id']; ?>" class="btn btn-danger admin-btn"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
    </div>
    <div class="admin-card-header shadow rounded">
        <?php echo $pagination; ?>
    </div>
<?php endif; ?>

