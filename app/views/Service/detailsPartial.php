<dl>
	<!-- definition term and definition -->
	<dt><?= _('description') ?></dt>
	<dd><?= $data->description ?></dd>

	<dt><?= _('Appointment date and time:') ?></dt>
	<dd><?= \app\core\TimeHelper::DTOutput($data->datetime) ?></dd>

	<dt><?= _('Appointment location:') ?></dt>
	<dd><?= $data->name ?></dd>

</dl>