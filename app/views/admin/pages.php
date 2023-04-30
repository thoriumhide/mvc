<div class="admin-card-header shadow rounded">
    <form action="/admin/pages" method="post" style="display: inline-block;">
        <input type="text" name="id" value="0" hidden>
        <input type="text" name="form_id" value="do_home" hidden>
        <button type="submit" class="btn btn-link admin-btn" style="<?php if($_SESSION['page_id'] == 0){echo 'color: #a9ff00!important;';} ?>"><i class="fa fa-home" aria-hidden="true"></i></button>
    </form>    
    <?php if($_SESSION['page_id'] != 0) : ?>
        <?php foreach ($arr_pages as $page_a) : ?>
            <form action="/admin/pages" method="post" style="display: inline-block;">
                <input type="text" name="form_id" value="do_page" hidden>
                <i class="fa fa-chevron-right" aria-hidden="true" style="font-size: 10px;"></i>
                <?php echo $page_a; ?>
            </form>    
        <?php endforeach; ?>
    <?php endif; ?>
    <span class="float-end"><a href="/admin/add_page/" class="btn btn-success admin-btn">Додати сторінку</a></span>
</div>
<?php if (empty($pages)): ?>
    <div class="admin-card-content shadow rounded">   
        <p>Список сторінок пустий</p>
    </div>
<?php else: ?>
    <div class="admin-card-content shadow rounded" style="padding: 10px 0;">   
        <table class="table table-grey table-hover admin-table">
            <thead>
            <tr> 
                <th class="" >#</th>
                <th class="" width="100%"><?php echo $title; ?></th>
                <th class="w-100 text-right"></th>
                <th class="w-100 text-right"></th>
                <th class="w-100 text-right"></th>
                <th class="w-100 text-right"></th>
                <th class="w-100 text-right"></th>
                <th class="w-100 text-right"></th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($pages as $page): ?>
                    <tr>
                        <td class=""><?php echo $page['order']; ?></td>
                        <td class="w-auto" width="100%">
                            <form action="/admin/pages" method="post">
                                <input type="text" name="id" value="<?php echo $page['id']; ?>" hidden>
                                <input type="text" name="form_id" value="do_page" hidden>
                                <button type="submit" class="btn btn-link admin-btn"><?php echo htmlspecialchars($page['name'], ENT_QUOTES); ?></button>
                            </form>
                        </td>
                        <td class="w-100 text-right"><i class="fa fa-bars" aria-hidden="true" style="<?php if($page['menu'] == 'enabled'){echo 'color:green';}else{echo 'color:red';} ?>"></i></td>
                        <td class="w-100 text-right"><i class="fa fa-circle" aria-hidden="true" style="<?php if($page['status'] == 'published'){echo 'color:green';}else{echo 'color:red';} ?>"></i></td>
                        <td class="w-100 text-right"><?php echo 'id:'.$page['id']; ?></td>
                        <td class="w-100 text-right"><a href="/<?php echo $page['url']; ?>" class="btn btn-warning admin-btn " target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                        <td class="w-100 text-right"><a href="/admin/edit_page/<?php echo $page['id']; ?>" class="btn btn-primary admin-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                        <td class="w-100 text-right"><a href="/admin/delete_page/<?php echo $page['id']; ?>" class="btn btn-danger admin-btn"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
    </div>
    <div class="admin-card-header shadow rounded">
        <?php echo $pagination; ?>
    </div>
<?php endif; ?>