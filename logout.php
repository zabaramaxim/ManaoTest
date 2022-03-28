<?php
session_start();
unset($_SESSION['user']);
session_destroy();
setcookie('user', '');

header('Location: /login_view.php');