<?php

class ProductoController extends Producto{
    
    function ProductoController(){
        
    }
    
    public function registraProducto($valores){
            parent::Producto();            
            $this->set_nombre($valores['nombre']);
            $this->set_precio($valores['precio']);
            $this->set_descripcion($valores['descripcion']);
            $this->set_id_status($valores['status']);
            $this->set_imagen($valores['imagen']);
            
            
            return $this->inserta($this->get_atributos());
     }

}
?>