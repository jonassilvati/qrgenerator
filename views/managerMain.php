<?php
require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

$con = Connection::connect();
$stmt = $con->prepare("select * from remessas where gerenciado=:gerenciado");
$stmt->execute(array(
    ":gerenciado" =>  "n"
));
$itens = $stmt->fetchAll();
?>

<div class="col-md-8">
    <table class="table">
        <?php foreach($itens as $item): ?>
            <tr>
                <td><?php echo $item['nome']?> </td>
                <td><button onclick="gerenciar(<?php echo $item['id'] ?>,'<?php echo $item['nome'] ?>')">Gerenciar</button></td>
            </tr>
        <?php endforeach;?>
    </table>
</div>


