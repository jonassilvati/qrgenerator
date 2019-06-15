<?php
    require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

    $id_componente = $_POST['componente'];
    $id_robo = $_POST['robo'];

    $con = Connection::connect();
    $stmt = $con->prepare('insert into robos_componentes(robo_id, componente_id) values(:robo_id, :componente_id)');
    $stmt->execute(array(
        ":robo_id" => $id_robo,
        ":componente_id" => $id_componente
    ));


    $dados = array('sucesso'=>'1');
    $dados = json_encode($dados);
    echo $dados;
    