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
     function consulta_pedido($fecha) {
        $sisinfo = new Modelo();
        $sql = ("SELECT id_pedido FROM pedido where fecha='".$fecha."';");
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
    
    
    function consulta_pedidos_pendientes($id_usuario) {
        $sisinfo = new Modelo();
        $sql = ("SELECT id_pedido,p.id_estado_pedido,status_pedido FROM pedido p join estado_pedido ep on ep.id_estado_pedido=p.id_estado_pedido where id_usuario='".$id_usuario."' and p.id_estado_pedido<4  ;" );
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }
    function consulta_pedidos_listos() {
        $sisinfo = new Modelo();
        $sql = ("SELECT p.id_pedido,u.email FROM pedido p join usuario u on u.id_usuario=p.id_usuario 
                   join detalle_pedido dp on dp.id_pedido=p.id_pedido where p.id_estado_pedido=3;" );
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
    
     function cantidad_pedidos_usuario($id_usuario) {
        $sisinfo = new Modelo();
        $sql = (" select COUNT(id_pedido) from  pedido   where id_usuario=".$id_usuario." and id_estado_pedido<4");
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function consulta_all_usuarios_fraude() {
        $sisinfo = new Modelo();
        $sql = ("SELECT id_usuario, nombre, email, tipo_user, id_estado,estado ,COUNT(id_usuario) as Cant_Cancel from (SELECT u.id_usuario, u.nombre, u.email, t.tipo_user, eu.id_estado,eu.estado
FROM usuario u JOIN pedido p ON u.id_usuario = p.id_usuario 
JOIN estado_pedido ep ON ep.id_estado_pedido = p.id_estado_pedido 
JOIN tipo_usuario t ON u.id_tipo = t.id_tipo JOIN estado_usuario eu ON eu.id_estado = u.id_estado 
WHERE ep.id_estado_pedido =5) as cancel group by id_usuario;" );
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
    
    function status_pedido($id_pedido) {
        $sisinfo = new Modelo();
        $sql = ("SELECT id_estado_pedido FROM pedido where id_pedido=".$id_pedido." ;" );
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }
    
    function total_pedido($id_pedido) {
        $sisinfo = new Modelo();
        $sql = (" SELECT  SUM( (precio * cantidad) - DESCUENTO ) AS total

              from 
                  detalle_pedido dv 
                          join producto p on p.id_producto=dv.id_producto
            
                           where id_pedido=".$id_pedido.";" );
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    
   
    
    function consulta_prod_mas_vendidos() {
        $sisinfo = new Modelo();
        $sql = ("SELECT id_pedido,id_estado_pedido,id_producto,nombre,
           SUM( (precio * cantidad) - DESCUENTO ) AS total,
           (SUM(cantidad))as cantidad
from
(select pe.id_pedido,pe.id_estado_pedido,p.id_producto,
          ep.status_pedido,p.nombre,p.precio,dv.cantidad,
             dv.descuento,pe.comentario,u.nombre as nom,u.apaterno,u.amaterno,u.email,u.id_usuario
      from 
       
      pedido pe join estado_pedido ep on ep.id_estado_pedido=pe.id_estado_pedido
        join  detalle_pedido dv ON dv.id_pedido = pe.id_pedido
           join producto p on p.id_producto=dv.id_producto
            join usuario u on u.id_usuario=pe.id_usuario 
          )as detalle 
          where  id_estado_pedido=4           
             group by id_producto
             order by cantidad desc
     
 limit 0,10 ;");
    }

    function consulta_prod_menos_vendidos() {
        $sisinfo = new Modelo();
        $sql = ("SELECT id_pedido,id_estado_pedido,id_producto,nombre,
           SUM( (precio * cantidad) - DESCUENTO ) AS total,
           (SUM(cantidad))as cantidad
from
(select pe.id_pedido,pe.id_estado_pedido,p.id_producto,
          ep.status_pedido,p.nombre,p.precio,dv.cantidad,
             dv.descuento,pe.comentario,u.nombre as nom,u.apaterno,u.amaterno,u.email,u.id_usuario
      from 
       
      pedido pe join estado_pedido ep on ep.id_estado_pedido=pe.id_estado_pedido
        join  detalle_pedido dv ON dv.id_pedido = pe.id_pedido
           join producto p on p.id_producto=dv.id_producto
            join usuario u on u.id_usuario=pe.id_usuario 
          )as detalle 
          where  id_estado_pedido=4           
             group by id_producto
             order by cantidad asc
     
 limit 0,10 ;");
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function consulta_total_ventas() {
        $sisinfo = new Modelo();
        $sql = ("SELECT id_pedido,id_estado_pedido,id_producto,nombre,
           SUM( (precio * cantidad) - DESCUENTO ) AS total,
           (SUM(cantidad))as cantidad
from
(select pe.id_pedido,pe.id_estado_pedido,p.id_producto,
          ep.status_pedido,p.nombre,p.precio,dv.cantidad,
             dv.descuento,pe.comentario,u.nombre as nom,u.apaterno,u.amaterno,u.email,u.id_usuario
      from 
       
      pedido pe join estado_pedido ep on ep.id_estado_pedido=pe.id_estado_pedido
        join  detalle_pedido dv ON dv.id_pedido = pe.id_pedido
           join producto p on p.id_producto=dv.id_producto
            join usuario u on u.id_usuario=pe.id_usuario 
          )as detalle 
          where  id_estado_pedido=4           
             group by id_producto
     
 ;");
        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function consulta_pedidos_activos() {
        $sisinfo = new Modelo();
        $sql = ("SELECT id_pedido,id_estado_pedido,foto_perfil,
          status_pedido,comentario,nom,apaterno,amaterno,id_usuario,email, SUM( (precio * cantidad) - DESCUENTO ) AS total

from
(select pe.id_pedido,pe.id_estado_pedido,u.foto_perfil,
          ep.status_pedido,p.nombre,p.precio,dv.cantidad,
             dv.descuento,pe.comentario,u.nombre as nom,u.apaterno,u.amaterno,u.email,u.id_usuario
      from 
       
      pedido pe join estado_pedido ep on ep.id_estado_pedido=pe.id_estado_pedido
        join  detalle_pedido dv ON dv.id_pedido = pe.id_pedido
           join producto p on p.id_producto=dv.id_producto
            join usuario u on u.id_usuario=pe.id_usuario 
          )as detalle 
          where  id_estado_pedido=1 or  id_estado_pedido=2  or id_estado_pedido=3           
             group by id_pedido
     
 ;" );
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

    function actualiza_pedido_estatus($status, $id_pedido) {
        $sisinfo = new Modelo();
        $sql = ("UPDATE  `pedido` SET  `id_estado_pedido` =  '"
                . $status . "' WHERE  `pedido`.`id_pedido` =" . $id_pedido . ";");
        $sisinfo->consulta_sql($sql);
    }

    function lista_productos($id_pedido) {
        $sisinfo = new Modelo();
        $sql = ("SELECT pr.nombre,dp.cantidad,pr.precio FROM detalle_pedido dp join producto pr on pr.id_producto=dp.id_producto where dp.id_pedido=" . $id_pedido . ";");

        $rs = $sisinfo->consulta_sql($sql);
        $arreglo = $rs->GetArray();
        return $arreglo;
    }

    function actualiza_Edo_user($estado, $id_usuario) {
        $sisinfo = new Modelo();
        $sql = ("UPDATE  `usuario` SET  `id_estado` =  '"
                . $estado . "' WHERE  `usuario`.`id_usuario` =" . $id_usuario . ";");
        $sisinfo->consulta_sql($sql);
    }
    
    function inserta_pedido($fecha,$id_usuario,$comentario) {
        $sisinfo = new Modelo();
        $sql = ("insert into pedido (fecha,id_usuario,comentario,id_estado_pedido) values ('".$fecha."','".$id_usuario."','".$comentario."',1);");
        $sisinfo->consulta_sql($sql);
    }
    
    function inserta_detalle_pedido($id_pedido,$id_producto,$cantidad,$descuento) {
        $sisinfo = new Modelo();
        $sql = ("insert into detalle_pedido (id_pedido,id_producto,cantidad,descuento) values (".$id_pedido.",".$id_producto.",".$cantidad.",".$descuento.");");
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
