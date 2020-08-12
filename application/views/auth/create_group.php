<h1><?= lang('create_group_heading');?></h1>
<p><?= lang('create_group_subheading');?></p>

<div id="infoMessage"><?= $message;?></div>

<?= form_open("auth/create_group");?>

      <p>
            <?= lang('create_group_name_label', 'group_name');?> <br />
            <?= form_input($group_name);?>
      </p>

      <p>
            <?= lang('create_group_desc_label', 'description');?> <br />
            <?= form_input($description);?>
      </p>

      <p><?= form_submit('submit', lang('create_group_submit_btn'));?></p>

<?= form_close();?>