<?php

/**
 * Login Controller.php
 * 
 * 
 */

class LoginController extends Usuario {

    private $admins = array('elias_gomez10@hotmail.com', 'aqui van otros Admins');

    // Validar el inicio de session de un usuario

    public function valida_usuario($email, $password) {
        $sql = "SELECT * FROM usuario 
                where correo = '" . $email . "' ";
        $rs = $this->consulta_sql($sql);
        $rows = $rs->GetArray();
        if (count($rows) == 1) {
            $ps1 = trim($rows[0]['password']);
            $ps2 = trim(md5($password));

            if ($ps1 == $ps2) {
                return $this->inicia_sesion($rows[0]);
            } else {
                echo "contraseña no encontrada";
                return false;
            }
        } else {
            echo "Email no encontrado";
            return false;
        }
    }

    // Recolectamos datos del usuario que inicia session para hacer actividades

    public function inicia_sesion($rows) {
        $_SESSION['correo'] = $rows['correo'];
        $_SESSION['nombre'] = $rows['nombre'];
        $_SESSION['apellido'] = $rows['apellido'];
        $_SESSION['no_ctrl'] = $rows['no_ctrl'];
        $_SESSION['usuario'] = $rows['usuario'];
        $_SESSION['roles'] = array('admin', 'Usuario');
        $_SESSION['foto_perfil'] = $rows['foto_perfil'];
        $_SESSION['id_usuario'] = $rows['id_usuario'];

        if (in_array($rows['correo'], $this->admins))
            $_SESSION['admin'] = 'isAdmin';

        return true;
    }

}

?>
