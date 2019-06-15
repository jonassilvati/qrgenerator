<?php
date_default_timezone_set('America/Fortaleza');
class QrCodeFigure{
    private $id;
    private $mac;
    private $descricao;
    private $created_at;

    public function __construct()
    {
        $this->setCreatedAt(date('d/m/Y H:i:s'));
    }

    public function sayHello(){
        echo "Olá mundo";
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setAddress($mac){
        $this->mac = $mac;
    }

    public function getAddress(){
        return $this->mac;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }



}