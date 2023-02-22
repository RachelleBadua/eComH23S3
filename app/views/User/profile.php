<?php $this->view('shared/header', 'Login into your acount'); ?>

USER PROFILE
<a href='/Profile/index'>See my profile</a>

<h1>Messages</h1>

<h2>My messages</h2>
<table class="container px-4">
	<tr><th>sender</th><th>receiver</th><th>message</th><th>time</th><th>actions</th></tr>

<?php
//display all messages
foreach ($data as $message) {
	echo "<tr>
			<td>$message->sender_name</td>
			<td>$message->receiver_name</td>
			<td>$message->message</td>
			<td>$message->timestamp</td>
			<td><a href='/Message/delete/$message->message_id'>DELETE</a></td>
		</tr>";	
}
?>
</table>
<h2>Send a messages</h2>
<p>Send a nessage using the following form</p>
<form method ="post" action='/Message/send'>
	<label>TO: <input type="text" name="receiver"></label><br><br>
	<label>Message: <textarea name="message"></textarea></label><br><br>
	<input type="submit" name="action" value='Send Message'>
</form>

<a href="/User/logout">Logout</a>

<?php $this->view('shared/footer'); ?>