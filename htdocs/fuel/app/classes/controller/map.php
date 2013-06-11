<?php
//require_once '/opt/lampp/htdocs/fuel/app/views/template.php';
class Controller_Map extends Controller_Template
{
        //funkcija atbild par kartes parādīšanu
	public function action_show_map()
	{
            //uzsauc funkciju, kura atjauno uzbūvetas celtnes
            Model_Map::update_buildings_done();
            //funkcija atjauno lietotaja zeltu
            $gold = Model_Map::update_gold();
            //funkcija sagatavo lietotāja uzbūvetās funkcijas tālākai padevei
            $results = Model_Map::get_built_structures();
            //funkcija iegūst celtņu tipus
            $results1 = Model_Map::get_build_types();
           // echo Model_Map::validatee();
            $view = View::forge('map/show_map');
            $view->set('results1', $results1, false);
            $view->set('results', $results, false);
            $view->set('gold', $gold);
            $this->template->content = $view;             
	    $this->template->title = 'Map &raquo; Show map';                
	}

        //funkcija atbild par to, lai būtu iespejams uzbūvetu jaunu celtni
	public function action_build()
	{                    
            $this->template->title = 'Map &raquo; Build';            
            $ur = Uri::segment(3);
            
            $results = Model_Map::get_map_cell_building_id($ur);
            
            $count = count($results);
            
     
            if ($count == 0)
            {
                if (Input::post())
                {
                    $ur = Uri::segment(3);
                    //$rtt
                    $type = Input::post('type');
                    //$g = Model_Map::validatee();
                    //ja lietotajam pietiek zelta celtnes būvniecībai ta tiek sakta būvēt
                    if (Model_Map::validate_cost($type) == true) //and Model_Map::validatee() >= 0)
                        { 
                        $building = Model_map::forge(array(
                    'user_id' => Model_Map::userid(),
                    'type' => Input::post('type'),
                    $type = Input::post('type'),
                    'name' => Input::post('name'),
                    'id' =>  $ur,
                    ));
                         if ($building and $building->save())
                        {
                            Session::set_flash('success', 'Added building #'.$building->id.'.');
                           // Response::redirect('map/show_map/'.$building->id); 
                            Response::redirect('map/show_map/');
                             
                        }
                        
                        else
                        {
                            Session::set_flash('error', 'Could not make building.');
                        }
                        }
                    else
                    {
                        Session::set_flash('error', 'Not enough resources');
                        $this->template->content = View::forge('map/build');
                    }
             
                }
             else {$this->template->content = View::forge('map/build');}
             }
             else
             {        
                $ur = Uri::segment(3);
                $view = View::forge('map/built'); 
                $this->template->content = $view;
                $results = Model_Map::get_map_cell_building_id($ur);
                $view->set('results', $results, false);
                if (Input::post())
                {
                    $input = Model_map::forge(array(
                    'user_id' => Model_Map::userid(),
                    'type' => Input::post('type'),
                    //$type = Input::post('type'),
                    'name' => Input::post('name'),
                    'id' =>  $ur,
                    ));
                    Model_Attack::make_soldiers($input);
                }
                
                if (Model_Map::get_remaining_time($ur) != 2)
                {
                    echo "Time till building is done:";
                }
                
       
               }

        }

}
