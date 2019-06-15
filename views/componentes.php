<?php
/**
 * Created by PhpStorm.
 * User: progr
 * Date: 25/01/2019
 * Time: 13:54
 */

require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

$con = Connection::connect();
$stmt = $con->prepare("select * from componentes");
$stmt->execute();
$itens = $stmt->fetchAll();

?>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <h3>Listagem</h3>
        </div>
        <table class="table">
            <tr>
                <td class="col-md-2">Código</td>
                <td class="col-md-8">Nome</td>
                <td class="col-md-2">Ações</td>
            </tr>
            <?php foreach($itens as $item): ?>
                <tr>
                    <td>#<?php echo $item['id'] ?></td>
                    <td><?php  echo $item['nome'] ?></td>
                    <td><button class="btn btn-default" onclick="deleteComponente(<?php echo $item['id'] ?>)" >apagar</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="col-md-6">
        <div class="row"><h3>Novo componente</h3></div>
        <div>
            <div class="form-group">
                <input type="text" id="nome-componente" placeholder="Nome" class="form-control">
            </div>
            <div class="form-group">
                <button id="adicionar-componente" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
    </div>
</div>

