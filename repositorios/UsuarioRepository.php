<?php 
    include_once('./clases/Conector.php');
    include_once('./clases/Usuario.php');
    class UsuarioRepository 
    {
        public static function all()
        {
            try 
            {
                $bd = Conector::conectar();
                $consulta = $bd->prepare("select * from usuarios");
                $consulta->execute();
                $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
                $usuarios = [];
                foreach($resultado as $r)
                {
                    $usuarios[] = new Usuario($r['id'],$r['usuario'],$r['clave'],$r['nombre'],$r['apellido'], $r['superadmin']);
                }
                return $usuarios;
            } catch(PDOException $e)
            {
                echo "No se realiza la consulta <br>".$e->getMessage();
                exit;
            }
        }
        public static function buscarUsuario(String $usuario)
        {
            try 
            {
                $bd = Conector::conectar();
                $consulta = $bd->prepare("select * from usuarios WHERE usuario = ?");
                $consulta->bindValue(1,$usuario);
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                return $resultado;
            } catch(PDOException $e)
            {
                echo "No se puede validar usuario <br>".$e->getMessage();
                exit;
            }
        }
    }
?>