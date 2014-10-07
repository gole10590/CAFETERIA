<?php

/**
 * Modelo Usuario.php
 * 
 *   
 */

Class Usuario extends Modelo{
    
    public $nombre_tabla = 'usuario';
    public $pk = 'id_usuario';
    
    public $atributos = array(        
        'nombre' => array(),
        'apellido' => array(),
        'no_ctrl' => array(),
        'correo' => array(),
        'usuario' => array(),
        'password' => array(),
        'foto_perfil' => array(),
        'id_tipo' => array(),
        'id_carrera' => array(),
    );
    
    public $errores = array( );
    
    private $nombre;
    private $apellido;
    private $no_ctrl;
    private $correo;
    private $usuario;
    private $password;
    private $foto_perfil;
    private $id_tipo;
    private $id_carrera;
    private $password_confirma;
    
    function Usuario(){
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
        $this->nombre= trim($valor);
    }
    
    public function get_apellido() {
        return $this->apellido;
    }

    public function set_apellido($valor) {
        $this->apellido= trim($valor);
    }
    
    public function get_no_ctrl() {
        return $this->no_ctrl;
    }

    public function set_no_ctrl($valor) {
        $this->no_ctrl= ($valor);
    }
    
    public function get_correo() {
        return $this->correo;
    }

    public function set_correo($valor){
        
        $rs = $this->consulta_sql("select * from usuario where correo = '$valor'");
        $rows = $rs->GetArray();
        
        if(count($rows) > 0){
            $this->correo = "";
            $this->errores[] = "Este e-mail (".$valor.") ya esta registrado"; 
        }else{
            $this->correo = trim($valor);
        }
        
        //die("Ya existe: ".count($rows));        
    } 
    
    public function get_usuario() {
        return $this->usuario;
    }

    public function set_usuario($valor) {
        $this->usuario= trim($valor);
    }
    
    public function get_password() {
        return $this->password;
    }

    public function set_password($valor) {
        $this->password= md5($valor);
    }
    
    public function get_foto_perfil() {
        return $this->foto_perfil;
    }

    public function set_foto_perfil($valor) {
        $this->foto_perfil= trim($valor);
    }
    
    public function get_id_tipo() {
        return $this->id_tipo;
    }

    public function set_id_tipo($valor) {
        $this->id_tipo= trim($valor);
    }
    
    public function get_id_carrera() {
        return $this->id_carrera;
    }

    public function set_id_carrera($valor) {
        $this->id_carrera= trim($valor);
    }
    
    public function get_password_confirma(){
        return $this->password_confirma;
    }
    
    public function set_password_confirma($valor){
        $this->password_confirma = md5($valor);
    }
}
?>
