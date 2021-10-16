<?php 
    class Conector
    {
        protected $conn;
        public static function conectar()
        {
            $dsn = 'mysql:host=localhost;dbname=tp4;port=3306';
            $user = 'root';
            $pass = '';
            try{
                $conn = new PDO($dsn,$user,$pass);
            } catch(PDOException $Exception)
            {
                echo $Exception->getMessage();
                exit;
            }
            return $conn;
        }
    }
?>