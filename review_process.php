<?php

require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/MovieDAO.php");
require_once("globals.php");
require_once("db.php");

$message = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);
$movieDAO = new MovieDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type"); // tipo do form
$userData = $userDAO->verifyToken();


if ($type == 'create') {

}else {
    $message->setMessage("Informações Inválidas", "error", "index.php");

}
?>