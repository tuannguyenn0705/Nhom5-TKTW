<?php
$act = $_GET['act'] ?? '/';

    match ($act) {
    '/'=>(new LoginController())->Login(),

};
?>