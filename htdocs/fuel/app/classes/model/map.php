<?php

class Model_Map extends \Orm\Model
{
    /**
     * @assert $buildinid = 1;
     */
	protected static $_properties = array(
                'user_id',
		'id',
		'name',
		'type',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);
        
        public static function build(Fieldset $kkas)
        {
            //$form->add('username', 'Username:');
            
            //$new = Model_Example::forge($props);
           // $new->save();
            $kkas = Input::get('building');
            
            
            return $kkas;
        }
        
        public static function userid()
        {
            //$username = Auth::instance()->get_screen_name();
            $username = 'test';
            $results = DB::select()
            ->from('users')
            ->where('username', $username)
            ->execute();
            
            
            foreach($results as $item)
            {
                $userid = $item['id'];
                //$userid = 
            }
        return $userid;
        }
        
        public static function get_built_structures()
        {
           // $username = Auth::instance()->get_screen_name();
            $results = DB::select()
            ->from('maps')
            ->where('user_id', Model_Map::userid())
            ->execute();
            
            return $results;

        }   
        
        public static function get_build_types()
        {
            $results1 = DB::select('type_id', 'building_name', 'time_to_build')
            ->from('buildings')
            //->where('user_id', Model_Map::userid())
            ->execute();
            
            return $results1;
        }
        
        public static function validate_cost($type)
        {
//            if (Model_Map::validatee() < 0)
//            {
//                return false;
//            }
            $results = DB::select()
            ->from('buildings')
            ->where('building_name', $type)
            ->execute();
            foreach($results as $item)
            {
                $build_cost = $item['cost'];
                $build_wood = $item['wood_cost'];
                
            }
            $results1 = DB::select()
            ->from('users')
            ->where('id', Model_Map::userid())
            ->execute();
            foreach($results1 as $item1)
            {
                $user_gold = $item1['gold'];
                $goldspent = $item1['gold_spent'];
                $user_wood = $item1['wood'];
                $wood_spent = $item1['wood_spent'];
            }
            
            if ($user_gold >= $build_cost and $user_wood >= $build_wood and Model_Map::validatee() > 0)
            {
                $new_gold = $build_cost + $goldspent;
                $new_wood = $build_wood + $wood_spent;
                                             
                 $result2 = DB::update('users')
                     ->set(array(
                    'gold_spent'  => $new_gold,
                    'wood_spent' => $new_wood
                     ))
                ->where('id', Model_Map::userid())        
                ->execute();
                
                 return true;
            }
            else return false;
            
        }
         /**
     * @assert $buildinid = 1;
     */  
        public static function get_remaining_time($buildinid)
        {
            /**
     * @assert $buildinid = 1;
     */
            
            $results = DB::select()
            ->from('maps')
            ->where('user_id', Model_Map::userid())
            ->and_where('id', $buildinid)
            ->execute();
            
            foreach($results as $item)
            {
                
                $buildname =  $item['type'];
                $buildcreated = $item['created_at'];
                //echo "build name = ";
                //echo $buildname;
                //echo " and buildcreatedc = ";
               // echo $buildcreated;
                
            }    
            
            $results1 = DB::select()
            ->from('buildings')
            ->where('building_name', $buildname)
            //->and_where('id', $buildinid)
            ->execute();
        
        foreach($results1 as $item)
            {
                
                $buildtime =  $item['time_to_build'];
                //date($format)
                //echo $buildtime;
                //$buildcreated = date("Y-m-d H:i:s");
                //$buildtime = date("H:i:s");
                //echo date("m/d/Y h:i:s a", time());
                $current_time = time();

                $time_till_building_done = $buildcreated + $buildtime - $current_time;
                //echo date('H:i:s', $time_till_building_done);
                //
                $prr = $buildcreated + $buildtime;
                $pr = date("Y-m-d H:i:s", $prr);  
                //echo var_dump($prr);
                $now = new DateTime();
                $future_date = new DateTime($pr);

                $interval = $future_date->diff($now);

                ////////echo $interval->format("%d days, %h hours, %i minutes, %s seconds");
                //echo $buildinid;
                //echo var_dump($interval);
            } 
            if ($time_till_building_done < 0)
            {
               
                return 2;
            }
            else echo $interval->format("%d days, %h hours, %i minutes, %s seconds");
            
            
        }
        public static function update_buildings_done()
        {
            $results = DB::select()            
            ->from('maps')
            ->where('user_id', Model_Map::userid())
            ->execute();
            
            $results1 = DB::select()
            ->from('buildings')
            ->execute();
            
            foreach($results as $item)
            {
                foreach ($results1 as $item1)
                {
                    if ($item['type'] == $item1['building_name'] and $item['is_built'] < 1)
                    {
                        $current_time = time();
                        $buildtime =  $item1['time_to_build'];
                        $buildcreated = $item['created_at'];
                        $time_till_building_done = $buildcreated + $buildtime - $current_time;
                        if ($time_till_building_done < 0)
                        {
                            $result = DB::update('maps')
                            ->value("is_built", "1")
                            ->where('user_id', Model_Map::userid())
                            ->and_where('id', $item['id'])        
                            ->execute();
                            $was_built = $buildcreated + $buildtime;
                            $result = DB::update('maps')
                            ->value("was_built", $was_built)
                            ->where('user_id', Model_Map::userid())
                            ->and_where('id', $item['id'])        
                            ->execute();
                        }
                    }
                    
                }
            }
        }
        
        public static function update_gold()
        {
            
            $z = 0;    
            $results = DB::select()            
            ->from('maps')
            ->where('user_id', Model_Map::userid())
            ->execute();
            
            $results3 = DB::select()            
            ->from('users')
            ->where('id', Model_Map::userid())
            ->execute();
            foreach($results3 as $item)
            {
                $gold_spent = $item['gold_spent'];
                $start_gold = $item['gold'];
            }
            
            $results1 = DB::select()
            ->from('buildings')
            ->execute();
            $gold_from_goldmines = 0;
            //$gold_spent = 0;
            foreach($results as $item)
            {
                //$gold_spent = $item['gold_spent'];
                foreach ($results1 as $item1)
                {
                    if ($item['type'] == $item1['building_name'] and $item['is_built'] == 1)
                    {
                     $current_time = time();
                     $was_built = $item['was_built'];
                     $time_passed = $current_time - $was_built;
                     if ($item['is_built'] == 1)
                     {
                         $gold_from_goldmines = $gold_from_goldmines + ($time_passed / 10);
                         $z = 1;
                     }
                    }
                }
            }
            if ($z == 1)
            {
                $result2 = DB::update('users')
                ->value("gold", $gold_from_goldmines)
                ->where('id', Model_Map::userid())        
                ->execute();
                //return $gold_from_goldmines;
            }
            $gold_from_goldmines = $start_gold;
            $gold_from_goldmines = $gold_from_goldmines - $gold_spent;
            return $gold_from_goldmines;
        }
        
        public static function get_map_cell_building_id($ur)
        {
            $results = DB::select()
            ->from('maps')
            ->where('id', $ur)
            ->and_where('user_id', Model_Map::userid())
            ->execute();
            return $results;
        }
        
        public static function validatee()
        {
             $results3 = DB::select()            
            ->from('users')
            ->where('id', Model_Map::userid())
            ->execute();
            foreach($results3 as $item)
            {
                $gold_spent = $item['gold_spent'];
                $start_gold = $item['gold'];
            }
            return $start_gold - $gold_spent;
        }
        
}
