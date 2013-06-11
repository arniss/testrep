<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 
 */
$user_id_whom_Attck = Uri::segment(3);
echo Html::anchor('attack/attacking/'.$user_id_whom_Attck.'', 'Attack' )
;?>
