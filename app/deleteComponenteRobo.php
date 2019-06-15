<?php

require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

$robo = $_POST['robo'];
$componente = $_POST['componente'];

$con = Connection::connect();

$stmt = $con->prepare('delete from robos_componentes where componente_id=:cid and robo_id=:rid');
$stmt->execute(array(
    ':cid' => $componente,
    ':rid' => $robo
));




$dados = array('sucesso'=>'1');
$dados = json_encode($dados);
echo $dados;