<?php
/**
 * Created by PhpStorm.
 * User: progr
 * Date: 11/12/2018
 * Time: 14:15
 */
require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
class AdoQrcode
{
    private $conn;
    private $qrs = array();

    public function __construct()
    {
        $this->conn = Connection::connect();
    }

    public function add(QrCodeFigure $qrcode, $idRemessa){
        $stmt = $this->conn->prepare("insert into qrcodes (mac, descricao, created_at, remessa_id) values (:mac, :descricao, :created_at, :remessa_id)");
        $stmt->execute(array(
            ":mac" => $qrcode->getAddress(),
            ":descricao" => $qrcode->getDescricao(),
            ":created_at" => $qrcode->getCreatedAt(),
            ":remessa_id" => $idRemessa
        ));
    }

    public function get($id){
        $stmt = $this->conn->prepare("select * from qrcodes where id=?");
        $stmt->execute([$id]);

        $qrcode = $stmt->fetchObject('QrCode');
        return $qrcode;
    }

    public function delete($id){
        $stmt = $this->conn->prepare("delete from qrcodes where id=?");
        $stmt->execute([$id]);
    }

    public function getAll(){
        $stmt = $this->conn->prepare("select * from qrcodes");
        $stmt->execute();

        return $stmt->fetchAll();
    }


}