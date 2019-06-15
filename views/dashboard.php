<form class="form col-md-12" id="form-qr">
    <div><h2>Nova Remessa</h2></div>
    <div class="form-group col-lg-12">
        <div class="col-md-6">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome">
        </div>
    </div>
    <span id="form-qr-append">
                  <div><h2>Robôs</h2></div>
                  <div class="form-group col-lg-12">
                    <div class="col-md-6">
                        <label for="qrcode1">MAC do bluetooth</label>
                        <input type="text" class="mac form-control" name="qrcode1" id="qrcode1">
                    </div>
                    <div class="col-md-6">
                        <label for="desc">Descrição</label>
                        <input type="text" class="field form-control" maxlength="30" id="desc" name="desc">
                    </div>
                  </div>
                </span>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <input type="submit" value="Gerar Qr's" class="form-control btn btn-primary ">
        </div>
        <div class="col-md-4"></div>
    </div>
</form>