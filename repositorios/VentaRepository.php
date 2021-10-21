<?php 
    include_once('./clases/Venta.php');
    class VentaRepository 
    {
        public static function all()
        {
            try 
            {
                $bd = Conector::conectar();
                $consulta = $bd->prepare("select * from ventas");
                $consulta->execute();
                $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
                $ventas = [];
                foreach($resultado as $r)
                {
                    $ventas[] = new Venta($r['id'],$r['usuario_id'],$r['auto_id'],$r['fecha']);
                }
                return $ventas;
            } catch(PDOException $e)
            {
                echo "No se realiza la consulta <br>".$e->getMessage();
                exit;
            }
        }  
        public static function min()
        {
            try 
            {
                $bd = Conector::conectar();
                $consulta = $bd->prepare("select distinct min(precio) as min from ventas inner join autos on autos.id = ventas.auto_id");
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                return $resultado['min'];
            } catch(PDOException $e)
            {
                echo "No se realiza la consulta <br>".$e->getMessage();
                exit;
            }
        }  
        public static function max()
        {
            try 
            {
                $bd = Conector::conectar();
                $consulta = $bd->prepare("select distinct max(precio) as min from ventas inner join autos on autos.id = ventas.auto_id");
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                return $resultado['min'];
            } catch(PDOException $e)
            {
                echo "No se realiza la consulta <br>".$e->getMessage();
                exit;
            }
        }  
        public static function create($datos)
        {
            try 
            {        
                $bd = Conector::conectar();
                $bd->beginTransaction();
                $consulta = $bd->prepare("insert into ventas(usuario_id,auto_id,fecha) values(?,?,?)");
                $consulta->bindValue(1,$datos['usuario_id']);
                $consulta->bindValue(2,$datos['auto_id']);
                $consulta->bindValue(3,$datos['fecha']);
                $consulta->execute();
                $bd->commit();
            } catch(PDOException $e)
            {
                echo "No se realiza el insert <br>".$e->getMessage();
                exit;
            }
        }
        public static function update($datos)
        {
            try 
            {        
                $bd = Conector::conectar();
                $bd->beginTransaction();
                $consulta = $bd->prepare("update ventas set usuario_id = ?, auto_id = ?, fecha = ? where id = ?");
                $consulta->bindValue(1,$datos['usuario_id']);
                $consulta->bindValue(2,$datos['auto_id']);
                $consulta->bindValue(3,$datos['fecha']);
                $consulta->bindValue(4,$datos['id']);
                $consulta->execute();
                $bd->commit();
            } catch(PDOException $e)
            {
                echo "No se realiza el update <br>".$e->getMessage();
                exit;
            }
        }
        public static function delete($datos)
        {
            try 
            {        
                $bd = Conector::conectar();
                $bd->beginTransaction();
                $consulta = $bd->prepare("delete from ventas where id = ?");
                $consulta->bindValue(1,$datos['id']);
                $consulta->execute();
                $bd->commit();
            } catch(PDOException $e)
            {
                echo "No se realiza el delete <br>".$e->getMessage();
                exit;
            }
        }
    }
?>