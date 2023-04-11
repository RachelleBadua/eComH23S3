<?php $this->view('shared/header', _('Create a new service appointment')); ?>

<p> Do you want to delete the service appointment presented on this screen.

<?php
$client= $data->getClient();
?> 

<?php $this->view('Client/detailsPartial', $data); ?>

<?php $this->view('Service/detailsPartial', $data); ?>

<form method ="post" action="">
	<!-- <label><?= _('Description:') ?></label><textarea name="description"></textarea><br><br>
	<label><?= _('Appointment date and time:') ?></label><input type="datetime-local" name="datetime"><br><br>
 -->
	<input type="submit" name="action" value='<?= _('Delete')?>'>
	<a href="/Service/index/<?= $data->client_id?>"><?= _('Cancel')?></a>
</form>

<?php $this->view('shared/footer'); ?>