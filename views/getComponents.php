<?php
    require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
    $id_robo = $_POST['id'];

    $con = Connection::connect();
    $stmt = $con->prepare('SELECT c.id as id, c.nome as nome FROM componentes as c, robos_componentes as rc WHERE c.id = rc.componente_id and rc.robo_id = :id');
    $stmt->execute(array(
        ":id" => $id_robo
    ));     
    
    $componentesHas = $stmt->fetchAll();
    
    
    //get componentes
    $stmt = $con->prepare('select * from componentes');
    $stmt->execute();
    $componentes = $stmt->fetchAll();

?>
<table class="table table-componentes" data-robo="<?php echo $id_robo ?>"> 
    <tr>
        <td>Id</td>
        <td>Nome</td>
        <td>Ações</td>
    </tr>
    <?php foreach($componentesHas as $componente): ?>
        <tr>
            <td><?php echo $componente['id'] ?></td>
            <td><?php echo $componente['nome'] ?></td>
            <td><button class="delete-componente btn btn-danger" data-id-componente='<?php echo $componente['id'] ?>'>Excluir</button></td>
        </tr>
    <?php endforeach;?>
</table>
<div class="row">
    <div class="col-md-4">
        <h4>Novo Componente</h4>
        <div >
            <div class="form-group">
                <label for="componente">Componente</label>
                <select name="componente" id="componente" class="form-control">
                    <?php foreach($componentes as $componente): ?>
                        <option value="<?php echo $componente['id']?>"><?php echo $componente['nome']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <button id="form-componentes" class="btn btn-primary">Enviar</button>
            </div>
        </div   >
    </div>
</div>