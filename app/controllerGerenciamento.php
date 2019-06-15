<?php
    require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
    $con = Connection::connect();

    $action = $_POST['action'];

    $errors = array();

    if($action == 'save'){
        //save data of 
        $stmt = $con->prepare('UPDATE remessas 
                               SET tipo=:tipo, n_requisicao=:n_requisicao, requerente=:requerente, data_requisicao=:data_remessa, obs=:obs, gerenciado=:gerenciado
                               WHERE id=:id');
        
        $stmt->execute(array(
            ':tipo' => $_POST['tipo'],
            ':n_requisicao' => $_POST['n_requisicao'],
            ':requerente' => $_POST['requerente'],
            ':data_remessa' => $_POST['data_remessa'],
            ':obs' => $_POST['obs'],
            ':id' => $_POST['remessa_id'],
            ':gerenciado' => 's'
        ));
    }

    $callback = array();
    if(empty($errors)){
        $callback['sucesso'] = '1';
    }else{
        $callback['sucesso'] = '0';
    }
    $callback = json_encode($callback);
    echo $callback;