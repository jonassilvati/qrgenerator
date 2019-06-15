<?php
/**
 * Created by PhpStorm.
 * User: progr
 * Date: 28/12/2018
 * Time: 16:47
 */
    require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
    //get id of remessa to manager
    $id = $_POST['id'];
    $con = Connection::connect();
    $stmt = $con->prepare("select * from qrcodes where remessa_id=:remessa_id");
    $stmt->execute(array(
        ":remessa_id" =>  $id
    ));
    $itens = $stmt->fetchAll();


?>
<div class="row">
    <form action="" id="form-remessas" data-id-remessa="<?php echo $id ?>">
        <div class="col-md-12">
            <div class="col-md-2 form-group">
                <label for="tipo">Tipo</label>
                <select name="tipo" class="form-control" id="tipo" >
                    <option value="escola">Escola</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $_POST['nome'] ?>" />
            </div>
            <div class="col-md-2 form-group">
                <label for="n_requisicao">Nº da Requisição(Opcional)</label>
                <input type="text" name="n_requisicao" class="form-control" autofocus>
            </div>
            <div class="col-md-4 form-group">
                <label for="requerente">Requerente *</label>
                <input type="text" name="requerente" id="requerente" class="form-control">
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-2 form-group">
                <label for="data">Data da Requisição *</label>
                <input type="text" class="date-mask form-control" id="data" name="data">
            </div>
            <div class="col-md-4 form-group">
                <label for="obs">Observações(Opcional)</label>
                <textarea class="form-control" name="obs" id="obs" cols="30" rows="5"></textarea>
            </div>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-md-8">
        <table class="table">
            <tr>
                <td>Mac</td>
                <td>Descrição</td>
                <td>Ações</td>
            </tr>
            <?php foreach ($itens as $item): ?>
                <tr>
                    <td><?php echo $item['mac']?></td>
                    <td><?php echo $item['descricao']?></td>
                    <td><button class="show-componentes" data-robo="<?php echo $item['id']?>" class="btn btn-default">Componentes</button> <a onclick="deleteQrcode(<?php echo $item['id']?>)" id="deleteQrcode" class="btn btn-default">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-4 ">
        <button id='submit-gerenciamento' class="btn btn-primary">Salvar Gerenciamento</button>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span id="nome-robo"></span> - Componentes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>