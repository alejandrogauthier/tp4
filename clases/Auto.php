<?php 

    class Auto {
        protected $id;
        protected $marca;
        protected $modelo;
        protected $precio;
    
        public function __construct($id,$marca,$modelo,$precio)
        {
            $this->setId($id);
            $this->setMarca($marca);
            $this->setModelo($modelo);
            $this->setPrecio($precio);
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setMarca($marca)
        {
            $this->marca = $marca;
        }
        public function getMarca()
        {
            return $this->marca;
        }
        public function setModelo($modelo)
        {
            $this->modelo = $modelo;
        }
        public function getModelo()
        {
            return $this->modelo;
        }
        
        public function setPrecio($precio)
        {
            $this->precio = $precio;
        }
        public function getPrecio()
        {
            return $this->precio;
        }
    }

?>