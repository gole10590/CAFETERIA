<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class siteController {

    function siteController() {
        
    }

    function consulta_tipo_usuario() {
        $sisinfo = new Modelo();
        $sql = ("SELECT * FROM tipo_usuario");
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function consulta_estado_usuario($id_usuario) {
        $sisinfo = new Modelo();
        $sql = ("SELECT * FROM usuario where id_usuario=" . $id_usuario . ";");
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function consulta_productos() {
        $sisinfo = new Modelo();
        $sql = ("SELECT * FROM producto; ");
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function consulta_productosClient() {
        $sisinfo = new Modelo();
        $sql = ("SELECT * FROM producto where id_status=1; ");
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function consulta_usuarios($where = ";") {
        $sisinfo = new Modelo();
        $sql = ("SELECT * FROM usuario " . $where );
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function consulta_all_usuarios($id_admin) {
        $sisinfo = new Modelo();
        $sql = ("SELECT * FROM usuario u join tipo_usuario t on u.id_tipo=t.id_tipo 
                       join estado_usuario eu on eu.id_estado = u.id_estado
                         where id_usuario != " . $id_admin . ";" );
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function consulta_all_usuarios_fraude() {
        $sisinfo = new Modelo();
        $sql = ("SELECT u.id_usuario, u.nombre, u.email, t.tipo_user, eu.id_estado,eu.estado, COUNT( u.id_usuario ) AS Cant_Cancel
FROM usuario u
JOIN pedido p ON u.id_usuario = p.id_usuario
JOIN estado_pedido ep ON ep.id_estado_pedido = p.id_estado_pedido
JOIN tipo_usuario t ON u.id_tipo = t.id_tipo
JOIN estado_usuario eu ON eu.id_estado = u.id_estado
WHERE ep.id_estado_pedido =5;" );
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function consulta_producto($where = ";") {
        $sisinfo = new Modelo();
        $sql = ("SELECT * FROM producto " . $where );
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function actualiza_producto($status, $id_producto) {
        $sisinfo = new Modelo();
        $sql = ("UPDATE  `producto` SET  `id_status` =  '"
                . $status . "' WHERE  `producto`.`id_producto` =" . $id_producto . ";");
        $sisinfo->consulta_sql($sql);
    }

    function actualiza_Edo_user($estado, $id_usuario) {
        $sisinfo = new Modelo();
        $sql = ("UPDATE  `usuario` SET  `id_estado` =  '"
                . $estado . "' WHERE  `usuario`.`id_usuario` =" . $id_usuario . ";");
        $sisinfo->consulta_sql($sql);
    }

    function elimina_producto($id_producto) {
        $sisinfo = new Modelo();
        $sql = ("delete  from producto  WHERE  id_producto =" . $id_producto . ";");
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
            `nombre` =  '" . $valores['nombre'] . "',
            `apellido` =  '" . $valores['apellido'] . "',
            `no_ctrl` =  '" . $valores['no_ctrl'] . "',
            `correo` =  '" . $valores['correo'] . "',
            `usuario` =  '" . $valores['usuario'] . "',
            `password` =  '" . md5($valores['password']) . "' WHERE `id_usuario` =" . $valores['id_usuario'] . ";");
            $sisinfo->consulta_sql($sql);
        }
    }

    function actualiza_datos_producto($valores) {


        $sisinfo = new Modelo();
        $sql = ("            
            UPDATE  `producto` SET  
            `nombre` =  '" . $valores['nombre'] . "',
            `precio` =  '" . $valores['precio'] . "',
            `descripcion` =  '" . $valores['descripcion'] . "',
            `imagen` =  '" . $valores['imagen'] . "'
            
           WHERE `id_producto` =" . $valores['id_producto'] . ";");
        $sisinfo->consulta_sql($sql);
    }

    function actualiza_foto_usuario($valores, $usuario) {

        $sisinfo = new Modelo();
        $sql = ("
            UPDATE `usuario` 
            SET  `foto_perfil` =  '" . $valores["foto_perfil"] . "' 
            WHERE  `usuario`.`id_usuario` =" . $usuario);
        $sisinfo->consulta_sql($sql);
    }

}

?>
