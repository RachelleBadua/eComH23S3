<?php $this->view('shared/header', 'Greetings ' . $data); ?>
	<!-- These two are the same way to ouput with php -->
	Hiiii <?= $data ?>! <br>
	Hiiii <?php echo $data; ?>! <br>
<?php $this->view('shared/footer'); ?>
