<?php 
 include_once('./clases/Conector.php');
 include_once('./clases/Auto.php');
    class AutoRepository 
    {
        public static function all()
        {
            try 
            {
                $bd = Conector::conectar();
                $consulta = $bd->prepare("select * from autos");
                $consulta->execute();
                $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
                $autos = [];
                foreach($resultado as $r)
                {
                    $autos[] = new Auto($r['id'],$r['marca'],$r['modelo'],$r['precio']);
                }
                return $autos;
            } catch(PDOException $e)
            {
                echo "No se realiza la consulta <br>".$e->getMessage();
                exit;
            }
        }
    }
?>