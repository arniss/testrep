




<?php
//require_once '/opt/lampp/htdocs/fuel/app/views/map/show_map.php';
class Tests_View_map extends PHPUnit_Framework_TestCase
{
/**
     * @assert $gold = 10
 * @assert $results = 12
  
     */

public function test_map()
{
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
}
}
?>


