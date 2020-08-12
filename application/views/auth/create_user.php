<div class="container mt-4 pb-4">
      <div class="col-12 col-lg-6">
            <h1><?= lang('create_user_heading');?></h1>
            <p class="pb-3"><?= lang('create_user_subheading');?></p>
            <div id="infoMessage"><?= $message;?></div>
            <?php $attributes = array('id' => 'createUser-form'); ?>
            <?= form_open("auth/create_user", $attributes);?>
                  <p>
                        <?= lang('create_user_fname_label', 'first_name');?> <br />
                        <input class="form-control" type="text" name="first_name" value="<?= set_value('first_name');?>" required/>
                  </p>

                  <p>
                        <?= lang('create_user_lname_label', 'last_name');?> <br />
                        <input class="form-control" type="text" name="last_name" value="<?= set_value('last_name');?>" 
                        required/>
                  </p>
                  <?php
                  if($identity_column!=='email') {
                  echo '<p>';
                  echo lang('create_user_identity_label', 'identity');
                  echo '<br />';
                  echo form_error('identity');
                  echo form_input($identity);
                  echo '</p>';
                  }
                  ?>

                  <p>
                        <?= lang('create_user_email_label', 'email');?> <br />
                        <input class="form-control" type="email" name="email" value="<?= set_value('email');?>"
                        required/>
                  </p>
                  <p>
                        <?= lang('create_user_phone_label', 'phone');?> <br />
                        <input class="form-control" maxlength="17" type="tel" name="phone" value="<?= set_value('phone');?>"
                        required/>
                  </p>
                  <p>
                        <?= lang('create_user_password_label', 'password');?> <br />
                        <input id="password" class="form-control" type="password" name="password"
                        required/>
                  </p>
                  <p>
                        <?= lang('create_user_password_confirm_label', 'password_confirm');?> <br />
                        <input class="form-control" type="password" name="password_confirm"
                        required/>
                  </p>
                  <input class="btn btn-success mt-2" type="submit" name="submit" value="Crear Usuario" />
            <?= form_close();?>
      </div>
</div>

<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/localization/messages_es_AR.js');?>"> </script>
<script>
$("#createUser-form").validate({
      rules: {
            password_confirm:{
                  equalTo: "#password"
            }
      }
});
</script>