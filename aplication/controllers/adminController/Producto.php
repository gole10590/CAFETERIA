<?php


Class Producto extends Modelo{
    
    public $nombre_tabla = 'producto';
    public $pk = 'id_producto';
    
    public $atributos = array(        
        
        'nombre' => array(),
        'precio' => array(),
        'descripcion' => array(),
        'imagen' => array(),
        'id_status' => array(),
       
    );
        
    
    private $nombre;
    private $precio;
    private $descripcion;
    private $imagen;
    private $id_status;
   
    
    function Producto(){
        parent::Modelo();
    }
    
    public function get_atributos() {
        $rs = array();
        foreach ($this->atributos as $key => $value) {
            $rs[$key] = $this->$key;
        }
        return $rs;
    }
    
  
    
    public function get_nombre() {
        return $this->nombre;
    }

    public function set_nombre($valor) {
        $this->nombre= $valor;
    }
    
    public function get_precio() {
        return $this->precio;
    }

    public function set_precio($valor) {
        $this->precio= $valor;
    }
    
    public function get_descripcion() {
        return $this->descripcion;
    }

    public function set_descripcion($valor) {
        $this->descripcion= $valor;
    }
    
    
    public function get_imagen() {
        return $this->imagen;
    }

    public function set_imagen($valor) {
        $this->imagen= $valor;
    }
    
    public function get_id_status() {
        return $this->id_status;
    }

    public function set_id_status($valor) {
        $this->id_status= $valor;
    }
    
    
}
?>
