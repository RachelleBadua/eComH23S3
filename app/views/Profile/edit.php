<?php $this->view('shared/header', 'edit your Profile'); ?>

<form action='' method="post" enctype="multipart/form-data">
	<label>First name:<input type="text" name="first_name" value='<?=$data->first_name?>'></label><br/>
	<label>Last name:<input type="text" name="last_name" value='<?=$data->last_name?>'></label><br/>
	<label>Middle name:<input type="text" name="middle_name" value='<?=$data->middle_name?>'></label><br/>
	<label>Profile Picture:</label><input type="file" name="ProfilePicture"></form><br/>
	<input type="submit" name="action" value="Save changes">
</form>

<a href='/Profile/index'>Back</a>

<?php $this->view('shared/footer'); ?>