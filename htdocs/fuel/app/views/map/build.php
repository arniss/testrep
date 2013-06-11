<p>Build</p>
<?php //echo $form; ?>
<?php echo Form::open(); ?>

<p>
    <?php echo Form::label('Name', 'name'); ?>
    <?php echo Form::input('name'); ?>
</p>
<p>
<p>
    <?php echo Form::label('Type', 'type'); ?>
<?php echo Form::select('type', 'sawmill', array(
    'goldmine' => 'Gold mine',
    'sawmill' => 'Sawmill',
    'barracks' => 'Barracks',
));?>
</p>
<div class="actions">
    <?php echo Form::submit(); ?>
</div>
<?php echo Form::close(); ?>




