<div class="container mt-4 pb-4">
  <div class="col-12 col-md-6">
    <h1><?= lang('login_heading');?></h1>
    <p class="pb-4"><?= lang('login_subheading');?></p>
    <div class="pb-2" id="infoMessage"><?= $message;?></div>
    <?php $attributes = array('id' => 'login-form'); ?>
    <?= form_open("auth/login", $attributes);?>
      <p>
        <?= lang('login_identity_label', 'identity');?>
        <input class="form-control" type="email" name="identity" value="<?= set_value('identity')?>" required/>
      </p>
      <p>
        <?= lang('login_password_label', 'password');?>
        <input class="form-control" type="password" name="password" required/>
      </p>
      <p>
        <?= lang('login_remember_label', 'remember');?>
        <?= form_checkbox('remember', '1', FALSE, 'id="remember"');?>
      </p>
      <input class="btn btn-success" type="submit" name="submit" value="Ingresar" />
      <a class="btn btn-info ml-2" href="<?= base_url('auth/create_user') ?>">Registrarse</a>
    <?= form_close();?>
    <p class="mt-3"><a href="forgot_password"><?= lang('login_forgot_password');?></a></p>
  </div>
</div>

<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/localization/messages_es_AR.js');?>"> </script>
<script>
    $("#login-form").validate();
</script>