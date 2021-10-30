<?php
$logoutUrl = site_url('/logout/');
if (empty($user_lessons)) {
    echo 'EMPTY';
} else {
    foreach ($user_lessons as $lesson) {
        vardump($lesson);
    }
}
?>

<p>
    <a href="<?=$logoutUrl;?>">Logout</a>
</p>


