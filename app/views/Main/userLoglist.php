<?php $this->view('shared/header', 'User log book'); ?>

<table>
	<tr><th>Log entry</th><th>actions</th></tr>
<?php
foreach ($data as $key=>$logEntry) { ?>
	<!-- echo $logEntry; -->
	<!-- echo nl2br($logEntry); -->
	<tr><td><?=	$logEntry ?></td><td><a href='/Main/logDelete/<?=$key?>'>delete</a></td></tr>
<?php
}
?>
</table>

<?php $this->view('shared/footer'); ?>

