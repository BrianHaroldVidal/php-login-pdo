<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../lib/session.php';
onsession::init();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_POST['action'])){
onsession::destroy();
}