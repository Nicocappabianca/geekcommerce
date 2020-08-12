<h1><?= lang('deactivate_heading');?></h1>
<p><?= sprintf(lang('deactivate_subheading'), $user->username);?></p>

<?= form_open("auth/deactivate/".$user->id);?>

  <p>
  	<?= lang('deactivate_confirm_y_label', 'confirm');?>
    <input type="radio" name="confirm" value="yes" checked="checked" />
    <?= lang('deactivate_confirm_n_label', 'confirm');?>
    <input type="radio" name="confirm" value="no" />
  </p>

  <?= form_hidden($csrf); ?>
  <?= form_hidden(['id' => $user->id]); ?>

  <p><?= form_submit('submit', lang('deactivate_submit_btn'));?></p>

<?= form_close();?>