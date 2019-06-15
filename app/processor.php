<?php
/**
 * Created by PhpStorm.
 * User: progr
 * Date: 09/11/2018
 * Time: 01:33
 * Desc:
 * Script para pegar endereços mac e gerar qrcodes
 */

require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
require_once "..".DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR."phpqrcode".DIRECTORY_SEPARATOR."qrlib.php";
/*
 * pegar codigos e gerar imagens pelo script de parametro
 *
 */

parse_str($_POST['dados'], $dados);

$conteudo = '';
$contador = 1;
foreach ($dados as $id => $dado){
    if($contador == 1){
        $conteudo .= '<tr>';
    }
    $path = str_replace(":","-",$dado);
    QrCode::png($dado,$path);
    $conteudo .= "<td class='content'><figure>
        <img src='$path'/>
        <figcaption>$dado</figcaption>
    </figure></td>";
    if ($contador == 5){
        $conteudo .= '</tr>';
    }
    $contador+=1;
    if ($contador == 5){
        $contador = 1;
    }

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

$arquivo = "saida.txt";
//Variável $fp armazena a conexão com o arquivo e o tipo de ação.
$fp = fopen($arquivo, "a+");
//Escreve no arquivo aberto.
fwrite($fp, $html);
//Fecha o arquivo.
fclose($fp);

$file_name  = date("Y.m.d-H.i.s").".pdf";
file_put_contents( "files".DIRECTORY_SEPARATOR.$file_name, $output);

//apagar qrcodes
foreach ($dados as $dado){
    if($dado != ''){
        if (file_exists($dado)){
            unlink($dado);
        }
    }
}


//confirmar sucesso
$dados = array('sucesso'=>'1','src'=>$file_name);
$dados = json_encode($dados);
echo $dados;