<?php

$connect_menu = mysqli_connect('localhost', 'root', '', 'retrodinermenu');
$connect_users = mysqli_connect('localhost', 'root', '', 'retrodinerusers');

if(!$connect_menu || !$connect_users) {
    die('Error!') ;
}
