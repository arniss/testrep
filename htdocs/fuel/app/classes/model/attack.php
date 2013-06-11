<?php

class Model_Attack extends Model
{
    public static function show_users()
    {
        $results = DB::query('SELECT * FROM `users`', DB::SELECT)->execute();
        return $results;
    }
    
    public static function userinfo($user_id)
    {
        $results = DB::select()
        ->from('users')
        ->where('id', $user_id)
        ->execute();
        return $results;
    }
    
    public static function make_soldiers($input)
    { 
        //rezultāti par lietotāju
        $results = DB::select()
            ->from('users')
            ->where('id', Model_Map::userid())
            ->execute();
        //ja grib taisīt marines
        foreach($results as $item)
            {
                $gold = $item['gold'];
                $spent = $item['gold_spent'];
                $spent_gold = $gold - $spent;
                $marines = $item['marines'];
                
            }
            
         $soldier_count = $input['name'] ;
         $sold_expenses = $soldier_count * 10;
         if ($sold_expenses < $spent_gold)
         {
             $new_gold_spent = $spent + $sold_expenses;
             $new_sold = $soldier_count + $marines;
             $result2 = DB::update('users')
                //->value("marines", $new_sold)
                     ->set(array(
                    'marines'  => $new_sold,
                    'gold_spent' => $new_gold_spent
                     ))
                ->where('id', Model_Map::userid())        
                ->execute();
         }
         else Session::set_flash('error', 'Not enough money');
           
    }
    
    public static function attacking($user_id)
    {
        //atjaunojam lietotāja zeltu
        Model_Map::update_gold();
        //kurs uzbrūk
        $results = DB::select()
            ->from('users')
            ->where('id', Model_Map::userid())
            ->execute();
        //kuram uzbrūk
        $results1 = DB::select()
            ->from('users')
            ->where('id', $user_id)
            ->execute();
        //var_dump($user_id);
        foreach($results as $item)
        {
             $marines_attacker = $item['marines'];
             $att_gold = $item['gold'];
        }
        foreach($results1 as $item1)
        {
             $marines_defender = $item1['marines'];
             $defender_id = $item1['id'];
             $d_gold = $item1['gold'];
             $d_gold_spent = $item1['gold_spent'];
             $real_gold = $d_gold - $d_gold_spent;
        }
            
         if ($marines_attacker > $marines_defender and $d_gold > 0)
         {
             
             $new_attacker_marines = $marines_attacker - $marines_defender;
             //($number % 2 == 0)
             $new_def_gold = $real_gold / 2;
             $new_g_spent = $d_gold_spent + $new_def_gold;
             $time = time();
             //atjauninam zaudētaja datus
             $result2 = DB::update('users')
                     ->set(array(
                    'marines'  => 0,
                    'gold_spent' => $new_g_spent,
                    'last_attacked' => $time
                     ))
                ->where('id', $defender_id)        
                ->execute();
             //atjauninam uzbrucēja datus
             
             $att_ne_gold = $new_def_gold + $att_gold;
             $result3 = DB::update('users')
                     ->set(array(
                    'marines'  => $new_attacker_marines,
                    'gold' => $att_ne_gold
                    
                     ))
                ->where('id', Model_Map::userid())        
                ->execute();
             
             return array($new_def_gold, $new_attacker_marines);
             
             
         }
        
    }
}
?>
