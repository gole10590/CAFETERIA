<?php

/**
 * Descripcion de Conexion *
 * @author AuthorName <author.name@example.com>
 * 
 */
class Conexion {
    
    
    function Conexion(){
        $this->db = ADONewConnection('mysql');
        $this->db->debug = FALSE;
                                      #usuario  #Password   #nombre BD
        $this->db->Connect('localhost','root', '123Tamarindo', 'cafeteria');

    }
    
}

?>
