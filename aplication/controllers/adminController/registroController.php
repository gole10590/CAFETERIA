<?php

/**
 * Modelo RegistroController.php
 * @author AuthorName <author.name@example.com>
 *   
 */

class RegistroController extends Usuario{
    
    function RegistroController(){
        
    }
    
    public function registraUsuario($valores){        
        
        if ($valores['password'] != $valores['password_confirma'])
            {
            header("Location: ErrorSession.php");
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
           
            
            if(count($this->errores) > 0 ){
                return false;
            }
                        
            return $this->inserta($this->get_atributos());
        } // else 
    }
    
    private function enviaMail($correo,$asunto,$mensaje){
               
                include("../libs/class.phpmailer.php");
                include("class.smtp.php");
             
                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = "ssl";
                    $mail->Host = "smtp.gmail.com";
                    $mail->Port = 465;
                    $mail->Username = "";
                    $mail->Password = "";

                    $mail->From = "";
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

                    $mail->AddAddress($correo,$correo);
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