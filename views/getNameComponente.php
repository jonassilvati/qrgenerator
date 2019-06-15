<?php

require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
$con = Connection::connect();
$id = $_POST['id'];

$stmt = $con->prepare('select descricao from qrcodes where id=:id');
$stmt->execute(array(
    ":id" => $id
));
$robo = $stmt->fetch();

echo $robo['descricao'];

