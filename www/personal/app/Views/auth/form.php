<?php
$session = session();
$registerUrl = site_url('/registration/');
$logoutUrl = site_url('/logout/');

if ($session->get('is_auth')) {
    $login = $session->get('user_login');
    echo 'User is logged in as '.$login;
    echo '<br>';
    echo "<a href='$logoutUrl'>Logout</a>";
} else {
    echo "<h2>Enter your Login and Password to enter!</h2>";
    $attributes = ['method' => 'get'];
    echo form_open('/auth/handler/', $attributes);
    echo csrf_field();

    echo form_input(['type' => 'text', 'name' => 'login']);
    echo form_input(['type' => 'password', 'name' => 'pass']);

    echo form_submit('btnSubmit', 'Login');
    echo form_close();


    echo '<br>';
    echo "<a href='$registerUrl'>Registration</a>";
}
?>
