<div class="container mb-10 pb-4">
      <div class="col-12 col-lg-6">
            <h1><?= lang('forgot_password_heading');?></h1>
            <p class="pb-4"><?= sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

            <div id="infoMessage"><?= $message;?></div>
            <?php $attributes = array('id' => 'forgot-form'); ?>
            <?= form_open("auth/forgot_password", $attributes);?>

                  <p>
                        <label for="identity"><?= (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
                        <input class="form-control" type="text" name="identity" required/>
                  </p>

                  <input class="btn btn-success" type="submit" name="submit" value="Enviar" />

            <?= form_close();?>
      </div>
</div>

<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/localization/messages_es_AR.js');?>"> </script>
<script>
    $("#forgot-form").validate();
</script>