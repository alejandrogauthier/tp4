<?php
    require_once('./clases/Conector.php');
    require_once('./clases/Auto.php');
    require_once('./clases/Usuario.php');
    class Venta {
        protected $id;
        protected $usuario_id;
        protected $auto_id;
        protected $fecha;

        public function __construct($id,$usuario_id,$auto_id,$fecha)
        {
                $this->setId($id);
                $this->setUsuarioId($usuario_id);
                $this->setAutoId($auto_id);
                $this->setFecha($fecha);
        }
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

        }

        public function getUsuarioId()
        {
                return $this->usuario_id;
        }

        public function setUsuarioId($usuario_id)
        {
                $this->usuario_id = $usuario_id;
        }
 
        public function getAutoId()
        {
                return $this->auto_id;
        }

        public function setAutoId($auto_id)
        {
                $this->auto_id = $auto_id;

        }

        public function getFecha()
        {
                return $this->fecha;
        }
 
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;                
        }

        public function auto()
        {
                try 
            {
                $bd = Conector::conectar();
                $consulta = $bd->prepare("select * from autos where id = ?");
                $consulta->bindValue(1, $this->getAutoId());
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                $auto = new Auto($resultado['id'],$resultado['marca'],$resultado['modelo'],$resultado['precio']);
                return $auto;
            } catch(PDOException $e)
            {
                echo "No se realizar la consulta <br>".$e->getMessage();
                exit;
            }
        }
        public function usuario()
        {
                try 
            {
                $bd = Conector::conectar();
                $consulta = $bd->prepare("select * from usuarios where id = ?");
                $consulta->bindValue(1, $this->getUsuarioId());
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                $usuario = new Usuario($resultado['id'],$resultado['usuario'],$resultado['clave'],$resultado['nombre'],$resultado['apellido'], $resultado['superadmin']);
                return $usuario;
            } catch(PDOException $e)
            {
                echo "No se realizar la consulta <br>".$e->getMessage();
                exit;
            }
        }
    }

?>