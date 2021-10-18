<?php 

    class Auto {
        protected $id;
        protected $marca;
        protected $modelo;
        protected $precio_costo;
        protected $precio_venta;
        protected $usuario_id;

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
        public function setPrecioCosto($precio_costo)
        {
            $this->precio_costo = $precio_costo;
        }
        public function getPrecioCosto()
        {
            return $this->precio_costo;
        }
        public function setPrecioVenta($precio_venta)
        {
            $this->precio_venta = $precio_venta;
        }
        public function getPrecioVenta()
        {
            return $this->precio_venta;
        }
        
        public function setUsuarioId($usuario_id)
        {
            $this->usuario_id = $usuario_id;
        }
        public function getUsuarioId()
        {
            return $this->usuario_id;
        }

    }

?>