<h2>Listing Messages</h2>
<br>
<?php if ($messages): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Message</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($messages as $message): ?>		<tr>

			<td><?php echo $message->name; ?></td>
			<td><?php echo $message->message; ?></td>
			<td>
				<li><?php echo Html::anchor('messages/view/'.$message->id, $comment_links[$message->id]); ?></li> |
				<?php if ($message->name == Auth::instance()->get_screen_name()) : ?>
    <?php if ($message->name == Auth::instance()->get_screen_name()) : ?>
    <li><?php echo Html::anchor('messages/edit/'.$message->id, 'Edit'); ?></li>
    <li><?php echo Html::anchor('messages/delete/'.$message->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?></li>
<?php endif; ?>
    <li><?php echo Html::anchor('messages/delete/'.$message->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?></li>
<?php endif; ?>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Messages.</p>

<?php endif; ?>
<?php
if (Auth::instance()->check())
{
    echo Html::anchor('messages/create', 'Add new Message');
}
?>
