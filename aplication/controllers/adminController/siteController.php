<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class siteController{
    
    function siteController(){
        
    }
    
    function consulta_tipo_usuario(){
        $sisinfo = new Modelo();
        $sql = ("SELECT * FROM tipo_usuario");
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }
    
    function consulta_productos(){
        $sisinfo = new Modelo();
        $sql = ("SELECT * FROM producto; ");
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;        
    }
    
    
    
    function consulta_usuarios($where = ";"){
        $sisinfo = new Modelo();
        $sql = ("SELECT * FROM usuario ".$where );
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;          
    }
    
    function consulta_producto( $where = ";"){
        $sisinfo = new Modelo();
        $sql = ("SELECT * FROM producto ".$where );
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }
    
  
    
 
            
    function actualiza_producto($status, $id_producto) {
        $sisinfo = new Modelo();
        $sql = ("UPDATE  `producto` SET  `id_status` =  '"
                .$status."' WHERE  `producto`.`id_producto` =".$id_producto.";");
        $sisinfo->consulta_sql($sql);        
    }
    
    function elimina_producto( $id_producto) {
        $sisinfo = new Modelo();
        $sql = ("delete  from producto  WHERE  id_producto =".$id_producto.";");
        $sisinfo->consulta_sql($sql);        
    }
    
    function actualiza_usuario($valores) {
              
        if ($valores['password'] != $valores['password_confirma']) {
            header("Location: ErrorConfiguracion.php");
            die("Error :(");
        } else {  
        
        $sisinfo = new Modelo();
        $sql = ("            
            UPDATE  `usuario` SET  
            `nombre` =  '".$valores['nombre']."',
            `apellido` =  '".$valores['apellido']."',
            `no_ctrl` =  '".$valores['no_ctrl']."',
            `correo` =  '".$valores['correo']."',
            `usuario` =  '".$valores['usuario']."',
            `password` =  '".md5($valores['password'])."' WHERE `id_usuario` =".$valores['id_usuario'].";");   
        $sisinfo->consulta_sql($sql);
        }
    }
    
    
    function actualiza_datos_producto($valores) {
              
       
        $sisinfo = new Modelo();
        $sql = ("            
            UPDATE  `producto` SET  
            `nombre` =  '".$valores['nombre']."',
            `precio` =  '".$valores['precio']."',
            `descripcion` =  '".$valores['descripcion']."',
            `imagen` =  '".$valores['imagen']."'
            
           WHERE `id_producto` =".$valores['id_producto'].";");   
        $sisinfo->consulta_sql($sql);
        
    }
    
    
    
    
      function actualiza_foto_usuario($valores, $usuario) {        
                
        $sisinfo = new Modelo();
        $sql = ("
            UPDATE `usuario` 
            SET  `foto_perfil` =  '".$valores["foto_perfil"]."' 
            WHERE  `usuario`.`id_usuario` =".$usuario);   
        $sisinfo->consulta_sql($sql);
    }     
}

?>
