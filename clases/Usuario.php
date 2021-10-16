<?php 

    class Usuario {
        protected $id;
        protected $usuario;
        protected $clave;
        protected $nombre;
        protected $apellido;

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
        
    }

?>