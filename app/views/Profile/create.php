<?php $this->view('shared/header', 'Create your Profile'); ?>

<form action='' method="post" enctype="multipart/form-data">
	<label>First name:<input type="text" name="first_name"></label><br/>
	<label>Last name:<input type="text" name="last_name"></label><br/>
	<label>Middle name:<input type="text" name="middle_name"></label><br/>
	<input type="submit" name="action" value="Create">
</form>

<a href='/Profile/index'>Back</a>

<?php $this->view('shared/footer'); ?>