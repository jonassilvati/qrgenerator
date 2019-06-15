<?php
/**
 * Created by PhpStorm.
 * User: progr
 * Date: 25/01/2019
 * Time: 14:52
 */
require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";


$nome = $_POST['nome'];

$con = Connection::connect();
$stmt = $con->prepare("insert into componentes(nome) values(:nome)");
$stmt->execute(array(
    ':nome' => $nome
));

$dados = array('sucesso'=>'1');
$dados = json_encode($dados);
echo $dados;


