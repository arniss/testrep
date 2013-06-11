<p>Show map</p>
<style>

.ex {/*this is a box */
  background: #FFFFFF;
  display: block;
  color : black;
  font-family : Arial, Tahoma, Verdana, Helvetica, sans-serif;
  font-size: 12px;
  padding : 0px;
  margin: 1px;
  border-color : grey;
  border-style : groove;
  border-width : 2px;/* the border property in longhand*/
  width:40px;
  float:left;
  }
</style>




<?php

//foreach($results as $item)
//            {
//                
//                echo $item['id'];
//              
//
//                //$userid = 
//    
//            }
           
       //echo $results[2];
      // var_dump($results);

$count = 0;
$cell = 0;
$a = -1;
$irmape = 0;
for($i=0; $i<20; $i++){ //num of rows
  for($j=0; $j<20; $j++){ //num of cols     
  foreach($results as $item)
            {              
                if (($count == $item['id'])) //&& (($item['created_at'] + 3600 ) < time() ))
                {
                    foreach ($results1 as $item1)
                    {
                    if ($item1['building_name'] == $item['type'] )
                    {
                        $current_time = time();
                        $buildcreated = $item['created_at'];
                        $buildtime =  $item1['time_to_build'];
                        $time_till_building_done = $buildcreated + $buildtime - $current_time;
                        $buildname =  $item['type'];                                               
                    //$prr = $buildcreated + $buildtime;
                //$pr = date("Y-m-d H:i:s", $prr); 
                    //$now = new DateTime();
                //$future_date = new DateTime($pr);

                //$interval = $future_date->diff($now);
                if ($time_till_building_done < 0)
                {
                    $irmape = 3;
                }
                else if ($item['id'] == 0 or $item['id']) 
                    {
                    $irmape = 2;                  
                    }
                else $irmape = 0;
                    }
                    }             
                }
            }
   if ($irmape == 3) 
   {
  echo '<span class="ex">'. Html::anchor("map/build/$count", $buildname).'  </span>';
  $irmape = 0;
   }
   else if ($irmape == 2)
   {
       echo '<span class="ex">'. Html::anchor("map/build/$count", "IP").'  </span>';
   }   
   else echo '<span class="ex">'. Html::anchor("map/build/$count", "Build").'  </span>';
  ++$count;
  $irmape = 0;
  }
  echo "<br>";
}
echo "tev ir ";
echo $gold;
echo " zelts";

?>

