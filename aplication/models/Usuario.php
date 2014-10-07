<?php

/**
 * Modelo Usuario.php
 * @author AuthorName <author.name@example.com>
 *   
 */

Class Usuario extends Modelo{
    
    public $nombre_tabla = 'usuario';
    public $pk = 'id_usuario';
    
    public $atributos = array(        
        'nombre' => array(),
        'apaterno' => array(),
        'amaetrno' => array(),
        'email' => array(),
        'telefono' => array(),
        'password' => array(),
        'foto_perfil' => array(),
        'id_tipo' => array(),
        
    );
    
    public $errores = array( );
    
    private $nombre;
    private $apaterno;
    private $amaterno;
    private $email;
    private $telefono;
    private $password;
    private $foto_perfil;
    private $id_tipo;
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
    
    public function get_nombres() {
        return $this->nombre;
    }

    public function set_nombres($valor) {
        $this->nombre= trim($valor);
    }
    
    public function get_telefono() {
        return $this->telefono;
    }

    public function set_telefono($valor) {
        $this->telefono= trim($valor);
    }
    
    public function get_apaterno() {
        return $this->apaterno;
    }

    public function set_apaterno($valor) {
        $this->apaterno= trim($valor);
    }
    
    public function get_amaterno() {
        return $this->amaterno;
    }

    public function set_amaterno($valor) {
        $this->amaterno= ($valor);
    }
    
    public function get_email() {
        return $this->email;
    }

    public function set_email($valor){
        
        $rs = $this->consulta_sql("select * from usuario where correo = '$valor'");
        $rows = $rs->GetArray();
        
        if(count($rows) > 0){
            $this->email = "";
            $this->errores[] = "Este e-mail (".$valor.") ya esta registrado"; 
        }else{
            $this->email = trim($valor);
        }
        
        //die("Ya existe: ".count($rows));        
    } 
    
    public function get_nombre() {
        return $this->nombre;
    }

    public function set_nombre($valor) {
        $this->nombre= trim($valor);
    }
    
    public function get_password() {
        return $this->password;
    }

    public function set_password($valor) {
        $this->password= trim($valor);
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
    
    
    public function get_password_confirma(){
        return $this->password_confirma;
    }
    
    public function set_password_confirma($valor){
        $this->password_confirma = md5($valor);
    }
}
?>
