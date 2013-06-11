<?php

class Controller_Attack extends Controller_Template
{

	public function action_index()
	{
            $results = Model_Attack::show_users();
            $view = View::forge('attack/show_users');
            
            $view->set('results', $results, false);
            $this->template->content = $view;
            $this->template->title = 'Map &raquo; Show users';            
        }
        
        public function action_attack()
        {
            $user_id = Uri::segment(3);
            $userinfo = Model_Attack::userinfo($user_id);
            $view = View::forge('attack/attack');
            
            $this->template->content = $view;
            $this->template->title = 'Map &raquo; Attack';
        }
        
        public function action_attacking()
        {
            $user_id = Uri::segment(3);
            $stats = Model_Attack::attacking($user_id);
            $view = View::forge('attack/after_fight');
            $view->set('stats', $stats, false);
            $this->template->content = $view;
            $this->template->title = 'Map &raquo; Attacking';
            //$this->template->content = View::forge('attack/after_fight');
        }
}
?>
