<h1><?= lang('reset_password_heading');?></h1>

<div id="infoMessage"><?= $message;?></div>

<?= form_open('auth/reset_password/' . $code);?>

	<p>
		<label for="new_password"><?= sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
		<?= form_input($new_password);?>
	</p>

	<p>
		<?= lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
		<?= form_input($new_password_confirm);?>
	</p>

	<?= form_input($user_id);?>
	<?= form_hidden($csrf); ?>

	<p><?= form_submit('submit', lang('reset_password_submit_btn'));?></p>

<?= form_close();?>