<?php $this->view('shared/header', _('Create a new service appointment')); ?>

<?php $this->view('Client/detailsPartial', $data['client']); ?>

<form method ="post" action="">
	<label><?= _('Description:') ?></label><textarea name="description"></textarea><br><br>
	<label><?= _('Appointment date and time:') ?></label><input type="datetime-local" name="datetime"><br><br>
	<label><?_('Select the appointment location:') ?></label><select name='branch_id'>
	<?php
		foreach($data['branches'] as $branch){
			echo "<option value='$branch->branch_id'>$branch->name</option>\n";
		}
	?>
	</select><br>

	<input type="submit" name="action" value='<?= _('Create')?>'>
	<a href="/Service/index/<?= $data['client']->client_id?>"><?= _('Cancel')?></a>
</form>

<?php $this->view('shared/footer'); ?>