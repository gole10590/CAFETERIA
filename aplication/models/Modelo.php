<?php

/**
 * Admin Modelo.php
 * @author AuthorName <author.name@example.com>
 *   
 */

class Modelo extends Conexion {

    public $db;

    function Modelo() {
        parent::Conexion();
    }

    // Funcion para consultar cualquier Tabla de la Base de datos

    public function consulta_datos() {
        $rs = $this->db->Execute('SELECT * from ' . $this->nombre_tabla);
        $this->get_error($rs, 'Error en la consulta de datos de la tabla ' . $this->nombre_tabla);
        return $rs;
    }
    

    // Funcion para realizar cualquier consulta SQL (  MySql - PostgreSql  )

    public function consulta_sql($sql) {
        $rs = $this->db->Execute($sql);
        $this->get_error($rs, 'Error en ( consulta_datos )');
        return $rs;
    }

    // Funcion para insertar cualquier dato en la tabla solicitada

    public function inserta($rs) {
        $sql_insert = $this->db->GetInsertSQL($this->nombre_tabla, $rs);
        return $this->get_error($this->db->Execute($sql_insert), 'Error en funcion inserta SQL');
    }

    // Funcion para Detectar cualquier error en algun tipo de consulta

    public function get_error($result, $tipo_error) {
        if ($result === false) {
            die('---> ' . $tipo_error . ' <---');
            return false;
        } else {
            return true;
        }
    }

    // Mostrar datos en testing

    public function show_grid($select = '*', $where = ' ', $num = '10') {
        $sql = "SELECT " . $select . " 
                FROM " . $this->nombre_tabla . " 
                " . $where;
        $grid = new ADODB_Pager($this->db, $sql);
        $grid->Render($rows_per_page = $num);
    }
    
    public function show_grid2($consulta,$num='10') {
        $sql = $consulta;
        $grid = new ADODB_Pager($this->db, $sql);
        $grid->Render($rows_per_page = $num);
    }

}
?>