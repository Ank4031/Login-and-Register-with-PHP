<?php

require_once "db.php";

$u1 = new user;
if ($_POST['task']=='login'){
    echo $u1->loginUser($_POST);
}else if($_POST['task']=='reg'){
    echo $u1->registerUser($_POST);
}
