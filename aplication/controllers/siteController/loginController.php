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
                where email = '" . $email . "' ";
        $rs = $this->consulta_sql($sql);
        $rows = $rs->GetArray();
        if (count($rows) == 1) {
            $ps1 = trim($rows[0]['password']);
          //  $ps2 = trim(md5($password));   ENCRIPTA EL PASSWORD
              $ps2 = trim($password);

            if ($ps1 == $ps2)
            {
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

        
        $_SESSION['id_usuario'] = $rows['id_usuario'];
        $_SESSION['nombre'] = $rows['nombre'];
        $_SESSION['apaterno'] = $rows['apaterno'];
        $_SESSION['amaterno'] = $rows['amaterno'];
        $_SESSION['telefono'] = $rows['telefono'];
        $_SESSION['email'] = $rows['email'];
        $_SESSION['password'] = $rows['password'];
        $_SESSION['id_tipo'] = $rows['id_tipo'];
         $_SESSION['foto_perfil'] = $rows['foto_perfil'];

        if ($rows['id_tipo']==1)
        {
            $_SESSION['admin'] = 'isAdmin';
            
        }
        else
        {
             if ($rows['id_tipo']==2)
             {
                $_SESSION['admin'] = 'isClient'; 
             }
             else
             {
                 $_SESSION['admin'] = 'isEmple'; 
             }
        }
        return true;
    }

}

?>
