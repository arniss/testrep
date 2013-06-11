<?php
foreach($results as $item)
{
    
    if ($item['type'] == 'barracks')
    {
        echo Form::open();

  echo '<p>';
    echo Form::label('Quantity', 'quantity');
    echo Form::input('name');
echo '</p>
<p>
<p>';
    echo Form::label('Type', 'type');
echo Form::select('type', 'marine', array(
    'marine' => 'Marine'
//    'sawmill' => 'Sawmill',
//    'barracks' => 'Barracks',
));
echo '</p>
<div class="actions">';
    echo Form::submit();
echo '</div>';
echo Form::close(); 
    }
}

?>
