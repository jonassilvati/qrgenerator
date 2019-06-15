var menu = "#menu-dashboard";
var fDateValid = true;
var newMenu = function(nmenu,title){
    $(menu).toggleClass('active');
    $(nmenu).toggleClass('active');
    menu = nmenu;
    $('.page-header').html(title);
}

var id_gerenciamento = '';
var nome_gerenciamento = '';

var gerenciar = function(id, nome){
    //abrir gerenciamento da remessa
    newMenu('#menu-manager', 'Gerenciamento de Requisição #'+id);
    id_gerenciamento = id;
    nome_gerenciamento = nome;
    //carregar views de gerenciamento
    $('.content').load('views/manager.php',{id:id, nome:nome});
}

var deleteQrcode = function (id) {

    $.confirm({
        title: 'Confirme',
        content: 'Excluir QrCode?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url:'app/deleteQrcode.php',
                    type:'post',
                    dataType:'json',
                    data:{id:id},
                    success:function(data){
                        if(data.sucesso == 1){
                            $('.content').load('views/manager.php',{id:id_gerenciamento, nome:nome_gerenciamento});
                        }
                    }
                })
            },
            cancel: function () {

            }
        }
    });
}

function validateDate(id) {
   var RegExPattern = /^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])      [\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/;

   if (!((id.value.match(RegExPattern)) && (id.value!=''))) {
       id.focus();
       return false;
   }
   else{
       return true;
   }
}

var deleteComponente = function(id){
    $.ajax({
        url:'app/deleteComponente.php',
        type: 'post',
        data:{id:id},
        dataType:'json',
        success: function (data) {
            if(data.sucesso == 1){
                $('.content').load('views/componentes.php');
            }
        }
    });
}

$(document).ready(function(){
    var ifield = 2;

    $('.mac').mask('aa:aa:aa:aa:aa:aa',{
        'translation':{
            a:{pattern:/[A-Za-z0-9]/}
        }
    });

    $('.date-mask').mask('aa/aa/aaaa',{
        'translation':{
            a:{pattern:/[0-9]/}
        }
    });

    $(document).on('focusout','.date-mask',function(event){
        if(validateDate(event.target)){
            $('.date-mask').css('background-color','rgba(0,255,0,0.5)')
        }else
            $('.date-mask').css('background-color','rgba(255,0,0,0.5)')
    });

    $(document).on('click', "#menu-manager", function(){
        newMenu('#menu-manager', 'Gerenciamento de Requisições');
        //carregar views de gerenciamento
        $('.content').load('views/managerMain.php');

    });

    $(document).on('click', "#menu-dashboard", function(){
        newMenu('#menu-dashboard', 'Board');
        //carregar views de gerenciamento
        //get qrcodes pendentes
        $('.content').load('views/dashboard.php');
    });

    $(document).on('click', '#componentes', function(){
        newMenu('#componentes','Componentes');
        $('.content').load('views/componentes.php');
    });



    $(document).on('click','#adicionar-componente', function(){
        if($('#nome-componente').val() == ''){
            return
        }
        var nome = $('#nome-componente').val();
        $.ajax({
            url:'app/addComponente.php',
            type:'post',
            data:{nome:nome},
            dataType:'json',
            success: function (data) {
                if(data.sucesso == '1'){
                    $.alert({
                        title: 'Sucesso',
                        content: 'sucesso na comunicacao'
                    });
                    $('.content').load('views/componentes.php');
                }
            }
        });
    })

    $(document).on('keypress','.field', function (e) {
        if (e.which == 13){
            e.preventDefault();
            /*add field in form*/
            $('#form-qr-append').append(
                '<div class="form-group col-lg-12">\n' +
                '<div class="col-md-6">\n'+
                '<label for="qrcode'+ifield+'">MAC do bluetooth</label>\n' +
                '<input type="text" class="mac form-control" name="qrcode'+ifield+'" id="qrcode'+ifield+'">\n' +
                '</div>\n'+
                '<div class="col-md-6">\n'+
                '<label for="desc">Descrição</label>\n'+
                '<input type="text" maxlength="30" class="field form-control" id="desc" name="desc">\n'+
                '</div>\n'+
                '</div>\n'
                );

            $('.mac:last-of-type').focus();

            ifield++;
            return false;
        }

    })

    $('#form-qr').submit(function(e){
       e.preventDefault();
       var dados = $('#form-qr').serializeArray();
        $('body').loading({
            message:'Carregando...'
        });
       $.ajax({
          url:'app/processor-teste.php',
          type:'post',
          data: {dados:dados},
          dataType: 'json',
           success: function (data) {
               if(data.sucesso == '1'){
                   $.alert({
                       title: 'Sucesso',
                       content: 'sucesso na comunicacao'
                   });
                   $('body').loading('stop');
                   window.open('app/files/'+data.src);
               }
           }
       });
       return false;
    });

    $(document).on('click','.show-componentes',function(){
        var id = $(this).attr('data-robo');
        $('.modal-body').load('views/getComponents.php',{id:id});
        $('#nome-robo').load('views/getNameComponente.php',{id:id});
        $('#exampleModal').modal();
    })

    $(document).on('click','#form-componentes',function(){
        //cadastrar robo_componente
        console.log('add componente');
        var robo       = $('.table-componentes').attr('data-robo');
        var componente = $('#componente').val();
        $.ajax({
            url:'app/addRoboComponente.php',
            type:'post',
            data:{robo:robo, componente:componente},
            dataType: 'json',
            success:function(data){
                if(data.sucesso == 1){
                    $('.modal-body').load('views/getComponents.php',{id:robo});
                }
            }
        });

    })

    $(document).on('click','.delete-componente',function(){
        var id_componente = $(this).attr('data-id-componente');
        var id_robo = $('.table-componentes').attr('data-robo');
        $.confirm({
            title: 'Confirme',
            content: 'Excluir Componente?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        url:'app/deleteComponenteRobo.php',
                        type:'post',
                        dataType:'json',
                        data:{componente:id_componente, robo: id_robo},
                        success:function(data){
                            if(data.sucesso == 1){
                                $('.modal-body').load('views/getComponents.php',{id:id_robo});
                            }
                        }
                    });
                },
                cancel: function () {
    
                }
            }
        });
    });

    $(document).on('click','#submit-gerenciamento',function(){
        //get the informations
        var formData = {
            'tipo' : $('select[name=tipo]').val(),
            'nome' : $('input[name=nome]').val(),
            'n_requisicao' : $('input[name=n_requisicao]').val(),
            'requerente' : $('input[name=requerente]').val(),
            'data_remessa' : $('input[name=data]').val(),
            'obs' : $('textarea[name=obs]').val(),
            'action' : 'save',
            'remessa_id' : $('#form-remessas').attr('data-id-remessa')
        }

        $.ajax({
            url : 'app/controllerGerenciamento.php',
            type : 'post',
            dataType : 'json',
            data : formData
        }).done(function(data){
            if(data.success == 1){
                $.alert({
                    title: 'Sucesso',
                    content: 'Remessa gerenciada com sucesso'
                });
            }
        })

    });


})