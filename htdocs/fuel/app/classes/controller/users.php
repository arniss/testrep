<?php

class Controller_Users extends Controller_Template
{

	public function action_login()
{
    $view = View::forge('users/login');
    $form = Form::forge('login');
    $auth = Auth::instance();
    $form->add('username', 'Username:');
    $form->add('password', 'Password:', array('type' => 'password'));
    $form->add('submit', ' ', array('type' => 'submit', 'value' => 'Login'));
    if (Input::post())
    {
        if ($auth->login(Input::post('username'), Input::post('password')))
        {
            Session::set_flash('success', 'Successfully logged in! Welcome '.$auth->get_screen_name());
            Response::redirect('messages/');
        }
        else
        {
            Session::set_flash('error', 'Username or password incorrect.');
        }
    }
    $view->set('form', $form, false);
    $this->template->title = 'User &raquo; Login';
    $this->template->content = $view;
}
 
public function action_logout()
{
    $auth = Auth::instance();
    $auth->logout();
    Session::set_flash('success', 'Logged out.');
    Response::redirect('messages/');
}

	public function action_register()
	{
    $auth = Auth::instance();
    $view = View::forge('users/register');
    $form = Fieldset::forge('register');
    Model_User::register($form);
 
    if (Input::post())
    {
        $form->repopulate();
        $result = Model_User::validate_registration($form, $auth);
        if ($result['e_found'])
        {
            $view->set('errors', $result['errors'], false);
        }
        else
        {
            Session::set_flash('success', 'User created.');
            Response::redirect('./');
        }
    }
 
    if (Input::post())
    {
        $form->repopulate();
        $result = Model_User::validate_registration($form, $auth);
    }
 
    $view->set('reg', $form->build(), false);
    $this->template->title = 'User &raquo; Register';
    $this->template->content = $view;
}
        
//        public static function validate_registration(Fieldset $form, $auth)
//        {
//            $form->field('password')->add_rule('match_value', $form->field('password2')->get_attribute('value'));
//            $val = $form->validation();
//            $val->set_message('required', 'The field :field is required');
//            $val->set_message('valid_email', 'The field :field must be an email address');
//            $val->set_message('match_value', 'The passwords must match');
//            
//            if ($val->run())
//            {
//                $username = $form->field('username')->get_attribute('value');
//                $password = $form->field('password')->get_attribute('value');
//                $email = $form->field('email')->get_attribute('value');
//                 try
//                {
//                 $user = $auth->create_user($username, $password, $email);
//                }
//                catch (Exception $e)
//                {
//                    $error = $e->getMessage();
//                }
//                if (isset($user))
//        {
//            $auth->login($username, $password);
//        }
//        else
//        {
//            if (isset($error))
//            {
//                $li = $error;
//            }
//            else
//            {
//                $li = 'Something went wrong with creating the user!';
//            }
//            $errors = Html::ul(array($li));
//            return array('e_found' => true, 'errors' => $errors);
//        }
//            }
//            else
//            {
//            $errors = $val->show_errors();
//            return array('e_found' => true, 'errors' => $errors);
//            }
//        }
}


