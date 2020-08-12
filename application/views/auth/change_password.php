<h1><?= lang('change_password_heading');?></h1>

<div id="infoMessage"><?= $message;?></div>

<?= form_open("auth/change_password");?>

      <p>
            <?= lang('change_password_old_password_label', 'old_password');?> <br />
            <?= form_input($old_password);?>
      </p>

      <p>
            <label for="new_password"><?= sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
            <?= form_input($new_password);?>
      </p>

      <p>
            <?= lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
            <?= form_input($new_password_confirm);?>
      </p>

      <?= form_input($user_id);?>
      <p><?= form_submit('submit', lang('change_password_submit_btn'));?></p>

<?= form_close();?>
