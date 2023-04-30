  <div class="container d-flex justify-content-center align-items-center vh-100">
    <form action="/admin/login" method="post" class="p-5 rounded-3 form-login">
      <h3 class="mb-3"><?php echo $title; ?></h3>
      <div class="mb-3">

        <input type="text" class="form-control" id="login" name="login" placeholder="Логин">
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
      </div>
      <button type="submit" name="do_login" class="btn btn-success w-100">Вход</button>

    </form>
  </div>