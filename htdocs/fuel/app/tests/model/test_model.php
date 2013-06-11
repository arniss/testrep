<?php
class Tests_Controller_Users extends TestCase
{
    /**
     * @assert (0, 0) == 0
     * @assert (0, 1) == 1
     * @assert (1, 0) == 1
     * @assert (1, 1) == 2
     * @assert (1, 2) == 4
     */
    public function test_action_login()
    
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
    
}
?>

