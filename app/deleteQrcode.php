<?php
/**
 * Created by PhpStorm.
 * User: progr
 * Date: 25/01/2019
 * Time: 15:55
 */

require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

$id = $_POST['id'];

$con = Connection::connect();
$stmt = $con->prepare('delete from qrcodes where id=:id');
$stmt->execute(array(
    ':id' => $id
));

$dados = array('sucesso'=>'1');
$dados = json_encode($dados);
echo $dados;