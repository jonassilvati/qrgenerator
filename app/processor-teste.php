<?php
/**
 * Created by PhpStorm.
 * User: progr
 * Date: 09/11/2018
 * Time: 01:33
 * Desc:
 * Script para pegar endereços mac e gerar qrcodes
 */
error_reporting(-1);
ini_set('display_errors', 'On');

require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
require_once "..".DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR."phpqrcode".DIRECTORY_SEPARATOR."qrlib.php";
/*
 * pegar codigos e gerar imagens pelo script de parametro
 *
 */

$adoQr = new AdoQrcode();

function indexData($ar){
    $cont = 0;
    $ndata = array();
    $qr = array();
    for($i = 0; $i < count($ar); $i++){
        if ($cont == 2) {
            $cont = 0;
            $qr = array();
        }
        if ($cont == 0) {
            $qr['mac'] = $ar[$i]['value'];
        }else if($cont == 1){
            $qr['desc'] = $ar[$i]['value'];
            $ndata[] = $qr;
            $qr = null;
        }
        $cont++;
    }
    return $ndata;
}
$dados = $_POST['dados'];
$nome = $dados[0]['value'];

//criar remessa
$con = Connection::connect();
$stmt = $con->prepare("insert into remessas(nome, gerenciado) value (:nome, :gerenciado)");
$stmt->execute(array(
    ":nome" => $nome,
    ":gerenciado" => "n"
));
$idRemessa = $con->lastInsertId();

array_shift($dados);
$dados = indexData($dados);
$conteudo = '';
$contador = 1;
foreach ($dados as $id => $dado){
    if ($contador == 5){
        $contador = 1;
        $conteudo .= '</tr>';
    }
    if($contador == 1){
        $conteudo .= '<tr>';
    }
    $path = str_replace(":","-",$dado['mac']);
    QrCode::png($dado['mac'],$path);
    $conteudo .= "<td class='content'><figure>
        <img src='$path'/>
        <figcaption><div>".$dado['desc']."</div></figcaption>
    </figure></td>";

    //add in database;
    $qr = new QrCodeFigure();
    $qr->setAddress($dado['mac']);
    $qr->setDescricao($dado['desc']);
    $adoQr->add($qr, $idRemessa);

    $contador++;
}


$html = "<!DOCTYPE html><html ><head>
    <title>Title</title>
    <style>
        div.content{
            display: block;
            float: left;
            margin-left: 10px;
            padding-top: 5px;
            border: 2px solid black;
            font-size: 10pt;
            box-sizing: border-box; 
        }

        html{
            margin:40px 50px
        }

        *{
            padding:0;
            margin:0;
        }


        img{
            border: 2px solid black;
            width: 15mm;
            height: 15mm;
        }
        body{
            width: 650px;
            height: 1000px;
            padding: 0;
            margin:0;
        }
        div.container{
            border: 1px solid black;
        }
        table{
            width:100%;
            margin:0;
            padding:0;
        }
        
        td{
            padding:10px;
        }

        figcaption{
            padding: 2px;
        }
        
</style>
</head>
<body>
    <table>
    $conteudo
    </table>
</body>
</html>";

$dompdf = new \Dompdf\Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper("A4","portrait");
$dompdf->render();
$output = $dompdf->output();

$file_name  = date("Y.m.d-H.i.s").".pdf";
file_put_contents( "files".DIRECTORY_SEPARATOR.$file_name, $output);

//apagar qrcodes
foreach ($dados as $dado){
    if($dado != ''){
        $path = str_replace(":","-",$dado['mac']);
        if (file_exists($path)){
            unlink($path);
        }
    }
}

//confirmar sucesso
$dados = array('sucesso'=>'1','src'=>$file_name);
$dados = json_encode($dados);
echo $dados;