<?php

/**
 * Modelo RegistroController.php
 * 
 *   
 */

class RegistroController extends Usuario{
    
    function RegistroController(){
        
    }
    
    public function registraUsuario($valores){        
        
        if ($valores['password'] != $valores['password_confirma'])
            {
            header("Location: ErrorPassword.php");
            } else {            
                
        // Falta Validar COntraseñas 
            parent::Usuario();
            $this->set_nombre($valores['nombre']);
            $this->set_apaterno($valores['apaterno']);
            $this->set_amaterno($valores['amaterno']);
            $this->set_id_usuario($valores['id_usuario']);
            $this->set_email($valores['email']);
            $this->set_password($valores['password']);
            $this->set_foto_perfil('user.jpg');
            $this->set_telefono($valores['telefono']);
            $this->set_id_tipo($valores['id_tipo']);
            $this->set_id_estado('1');
           
            
            if(count($this->errores) > 0 )
            {
                return false;
            }
             else
             {
                //return $this->inserta($this->get_atributos());
                if ($this->inserta($this->get_atributos())) {
                    if ($this->enviaMail($valores['email'], "CORREO REGISTRADO", "SU CUENTA HA SIDO CREADA CON EXITO\nUsuario :".$valores['email']."\nPassword: ".$valores['password']."")) {
                        
                        return true;
                    }
                    return false;
                    echo "Error al enviar correo  ";
                } else {
                    return false;
                }
             }
        }  
    }
    
      public  function enviaMail($correo,$asunto,$mensaje){
               
                
                require("../../libs/PHPMailer_v2.0.4/class.phpmailer.php"); 
                require '../../libs/PHPMailer_v2.0.4/class.smtp.php';

                include "../../libs/adodb5/adodb.inc.php";
                
                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = "ssl";
                    $mail->Host = "smtp.gmail.com";
                    $mail->Port = 465;
                    
                    //Nos autenticamos con nuestras credenciales en el servidor de correo Gmail
                    $mail->Username = "tcdgole@gmail.com";
                    $mail->Password = "123Tamarindo";

                    $mail->From = "Cafeteria campus 2";
                    $mail->FromName = "Instituto Tecnologico de Celaya";
                    $mail->Subject = "Contacto Web: ".$asunto;
                    $mail->MsgHTML("
                            	<style>
                                h2{
                                    background: #D5EDF8;
                                    color: #205791;
                                    border:2px solid #92CAE4;
                                    padding:10px;
                                }
                                p{
                                    background: #E6EFC2;
                                    color: #264409;
                                    border:2px solid #C6D880;
                                    padding:10px;
                                }
                                b{
                                    background: #FBE3E4;
                                    color: #8A1F11;
                                    border:2px solid #FBC2C4;
                                    padding:10px;
                                }
                                </style>
                                <h2>Contacto Web</h2>
                                <h3>".$asunto."</h3>
                                <b>".$mensaje."</b>
                    ");
                    $mail->AddAttachment("-");
                    $mail->AddAttachment("-");

                    $mail->AddAddress($correo);
                    $mail->IsHTML(true);

                    if(!$mail->Send()) {
                        echo "Error: " . $mail->ErrorInfo;
                        return false; 
                    } else {
                        return true;
                    }
             
         }
    
        
}


?>