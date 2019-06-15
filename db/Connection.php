<?php 
class Connection{
    private static $user = 'drayocom_qr_gen';
    private static $password = 'xth401std';
    private static $conn = null;


    static function connect(){
        try{
          self::$conn = new PDO('mysql:host=localhost;dbname=drayocom_qrcode', self::$user, self::$password);
          self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return self::$conn;
        } catch(PDOException $e) {
          echo 'ERROR: ' . $e->getMessage();
        }
    }



}




