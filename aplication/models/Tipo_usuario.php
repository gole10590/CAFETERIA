<?php

/**
 * Modelo TipoUsuario.php
 * 
 *   
 */

Class Tipo_usuario extends Modelo{
    
    public $nombre_tabla = 'tipo_usuario';
    public $pk = 'id_tipo';
    
    public $atributos = array(        
        'descripcion' => array()
    );
    
    private $descripcion;
    
    function Tipo_usuario(){
        parent::Modelo();
    }
    
    public function get_atributos() {
        $rs = array();
        foreach ($this->atributos as $key => $value) {
            $rs[$key] = $this->$key;
        }
        return $rs;
    }
    
    public function get_descripcion() {
        return $this->descripcion;
    }

    public function set_descripcion($valor) {
        $this->descripcion= $valor;
    }
}
?>
