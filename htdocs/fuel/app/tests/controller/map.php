<?php
/**
 * @group App
 */
class Test_Controller_Map extends TestCase

{
    
        public function test_user_have_gold()             
        { 
            //iegūst lietotāja zelta daudzumu
            $gold = Model_Map::update_gold();
            //lietotājs kuram zelts vairak nekā maksā celtne
            $user = Model_User::find(8);
            $usergold = $user->gold;
            $gldspent = $user->gold_spent;
            $this->assertEquals($usergold-$gldspent, $gold);        
        }

        public function test_calculate_cost($type)
        {
            $type = 1;//celtne maksā 50 zelts
            $user = Model_User::find(8);
            $user_gold = $user->gold;
            $this->assertGreaterThanOrEqual(50, $user_gold);  
        }
        
        public function test_user_register()
        
        {
            
        }
        public function test_get_userid()
        {
            
        }
        
        public function test_get_userids()
        {
            
        }
        
        public function test_get_useridss()
        {
            
        }
        
        public function test_get_useridsss()
        {
            $id = 8;
            $get_id = Model_Map::userid();
            $this->assertEquals($get_id, $id);
        }
        
        public function test_get_userissss()
        {
            $id = 8;
            $get_id = Model_Map::userid();
            $this->assertEquals($get_id, $id);
        }
        
        public function test_get_useridssss()
        {
            $id = 8;
            $get_id = Model_Map::userid();
            $this->assertEquals($get_id, $id);
        }
        
        public function test_get_useridssssss()
        {
            $id = 8;
            $get_id = Model_Map::userid();
            $this->assertEquals($get_id, $id);
        }
        
        public function test_get_useridzz()
        {
            $id = 8;
            $get_id = Model_Map::userid();
            $this->assertEquals($get_id, $id);
        }
        
        public function test_get_useridzzz()
        {
            $id = 8;
            $get_id = Model_Map::userid();
            $this->assertEquals($get_id, $id);
        }
        
        public function test_get_useridzzzz()
        {
            $id = 8;
            $get_id = Model_Map::userid();
            $this->assertEquals($get_id, $id);
        }
        
  

}
