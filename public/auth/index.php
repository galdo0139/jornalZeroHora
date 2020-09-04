<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;
use App\Models\User;

include '../../app/config/autoloader.php';


$session = new SessionHandler();
$user = new User($db);
$result = $user->authenticate($_POST);


$_SESSION['data'] = $_POST;
$redirectTo = "login";

if ($result) {
    $_SESSION['logged'] = true;
    $redirectTo = "home";
}

header("location: ../$redirectTo");
