<?php
$session = session();
$authUrl = site_url('/auth/');
$logoutUrl = site_url('/logout/');

if ($session->get('is_auth')) {
    $login = $session->get('user_login');
    echo 'User is logged in as '.$login;
    echo '<br>';
    echo "<a href='$logoutUrl'>Logout</a>";
} else {
    echo "<h2>New User Registration</h2>";
    $attributes = ['method' => 'get'];
    echo form_open('/registration/handler/', $attributes);
    echo csrf_field();

    echo "<p>Login *</p>";
    echo form_input(['type' => 'text', 'name' => 'login'])."<br/>";
    echo "<p>Email *</p>";
    echo form_input(['type' => 'email', 'name' => 'email'])."<br/>";
    echo "<p>Password *</p>";
    echo form_input(['type' => 'password', 'name' => 'pass'])."<br/>";
    echo "<p>Repeat password *</p>";
    echo form_input(['type' => 'password', 'name' => 'pass2'])."<br/>"."<br/>";
    echo form_submit('btnSubmit', 'Send')."<br/>"."<br/>";
    echo form_close();

    echo "<a href='$authUrl'>Auth</a>";
}
?>

