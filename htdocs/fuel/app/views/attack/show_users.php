<?php

foreach($results as $item)
{
    $last_time_Attacked = $item['last_attacked'];
    $nowtime = time();
    $time_diff = $nowtime - $last_time_Attacked;
    //var_dump($time_diff);
    if (($item['username'] != Auth::instance()->get_screen_name()) and $time_diff > 30  )
    {
        //echo $time_diff;
    //echo '</br>';
    echo "username:";
    $username = $item['username'];
    $user_id = $item['id'];
    //echo Html::anchor("attack/$user_id", $username);
    echo Html::anchor('attack/attack/'.$user_id.'', $username);
    echo "</br>";
    }
}
?>
