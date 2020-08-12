<h1><?= lang('index_heading');?></h1>
<p><?= lang('index_subheading');?></p>

<div id="infoMessage"><?= $message;?></div>

<table cellpadding=0 cellspacing=10>
	<tr>
		<th><?= lang('index_fname_th');?></th>
		<th><?= lang('index_lname_th');?></th>
		<th><?= lang('index_email_th');?></th>
		<th><?= lang('index_groups_th');?></th>
		<th><?= lang('index_status_th');?></th>
		<th><?= lang('index_action_th');?></th>
	</tr>
	<?php foreach ($users as $user):?>
		<tr>
            <td><?= htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?= htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?= htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?= anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                <?php endforeach?>
			</td>
			<td><?= ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
			<td><?= anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
		</tr>
	<?php endforeach;?>
</table>

<p><?= anchor('auth/create_user', lang('index_create_user_link'))?> | <?= anchor('auth/create_group', lang('index_create_group_link'))?></p>