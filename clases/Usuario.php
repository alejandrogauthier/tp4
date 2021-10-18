<?php 
    require('Conector.php');
    class Usuario {
        protected $id;
        protected $usuario;
        protected $clave;
        protected $nombre;
        protected $apellido;
        protected $superadmin;

        public function __construct($id,$usuario,$clave,$nombre,$apellido,$superadmin)
        {
            $this->id = $id;
            $this->usuario = $usuario;
            $this->clave = $clave;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->superadmin = $superadmin;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setUsuario($usuario)
        {
            $this->usuario = $usuario;
        }
        public function getUsuario()
        {
            return $this->usuario;
        }
        public function setClave($clave)
        {
            $this->clave = $clave;
        }
        public function getClave()
        {
            return $this->clave;
        }
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function setApellido($apellido)
        {
            $this->apellido = $apellido;
        }
        public function getApellido()
        {
            return $this->apellido;
        }
        public function setSuperadmin($superadmin)
        {
            $this->superadmin = $superadmin;
        }
        public function getSuperadmin()
        {
            return $this->superadmin;
        }
        public static function all()
        {
            try 
            {
                $bd = Conector::conectar();
                $consulta = $bd->prepare("select * from usuarios");
                $consulta->execute();
                $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            } catch(PDOException $e)
            {
                echo "No se realizar la consulta <br>".$e->getMessage();
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
                echo "No se puede validar mail <br>".$e->getMessage();
                exit;
            }
        }
            }

?>