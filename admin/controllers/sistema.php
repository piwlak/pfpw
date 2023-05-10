<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once('config.php');
class Sistema{
    //primero nos conectamos a la base de datos, establecemos una variable para hacer una sola conexion
    var $db = null;
    //funcion que nos conecta con la base de datos
    public function db()
    {
        $dsn = DBDRIVER . ':host=' . DBHOST . ';dbname=' . DBNAME . ';port=' . DBPORT;
        $this->db = new PDO($dsn, DBUSER, DBPASS);
    }
    //funcion de alertas
    public function flash($color, $msg)
    {
        include('views/flash.php');
    }

    public function login($correo, $contrasena)
    {
        if (!is_null($contrasena)) {
            if (strlen($contrasena)>0) {
                if ($this->validateEmail($correo)) {
                    $contrasena = md5($contrasena);
                    $this->db();
                    $sql = 'select id_usuario, correo from usuario where correo = :correo and contrasena = :contrasena';
                    $st = $this->db->prepare($sql);
                    $st->bindParam(":correo", $correo, PDO::PARAM_STR);
                    $st->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
                    $st->execute();
                    $data = $st->fetchAll(PDO::FETCH_ASSOC);
                    if (isset($data[0])) {
                        $data = $data[0];
                        $_SESSION=$data;
                        $_SESSION['roles'] = $this->getRoles($correo);
                        $_SESSION['privilegios'] = $this->getPrivilegios($correo);
                        $_SESSION['validado']=true;
                        return true;
                    }
                }   
            }
        }
        return false;
    }

    public function logout(){
        unset($_SESSION['loggeado']);
        session_destroy();
    }

    public function getRoles($correo){
        $roles = array();
        if ($this->validateEmail($correo)) {
            $this->db();
            $sql = 'select r.rol from usuario u join usuario_rol ur on u.id_usuario = ur.id_usuario 
            join rol r on ur.id_rol = r.id_rol where u.correo = :correo';
            $st = $this->db->prepare($sql);
            $st->bindParam(":correo", $correo, PDO::PARAM_STR);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $key => $rol) {
                array_push($roles, $rol['rol']);
            }
        } 
        return $roles;
    }

    public function getPrivilegios($correo){
        $privilegios = array();
        if ($this->validateEmail($correo)) {
            $this->db();
            $sql = 'select p.privilegio from usuario u join usuario_rol ur on u.id_usuario = ur.id_usuario 
            join rol r on ur.id_rol = r.id_rol join rol_privilegio rp on r.id_rol = rp.id_rol 
            join privilegio p on rp.id_privilegio = p.id_privilegio where u.correo = :correo';
            $st = $this->db->prepare($sql);
            $st->bindParam(":correo", $correo, PDO::PARAM_STR);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $key => $privilegio) {
                array_push($privilegios, $privilegio['privilegio']);
            }
        } 
        return $privilegios;
    }

    public function validateEmail($correo){
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function validateRol($rol)
    {
        if (isset($_SESSION['validado'])) {
            if ($_SESSION['validado']) {
                if (isset($_SESSION['roles'])) {
                    if (!in_array($rol, $_SESSION['roles'])) {
                        $this->killApp('No tienes el rol adecuado');
                    }
                } else {
                    $this->killApp('No tienes roles asignados');
                }
            } else {
                $this->killApp('No estas validado');
            }
        } else {
            $this->killApp('No te has logueado');
        }
    }

    public function validatePrivilegio($privilegio)
    {
        if (isset($_SESSION['validado'])) {
            if ($_SESSION['validado']) {
                if (isset($_SESSION['privilegios'])) {
                    if (!in_array($privilegio, $_SESSION['privilegios'])) {
                        $this->killApp('No tienes el privilegio adecuado');
                    }
                } else {
                    $this->killApp('No tienes privilegios asignados');
                }
            } else {
                $this->killApp('No estas validado');
            }
        } else {
            $this->killApp('No te has logueado');
        }
    }

    public function killApp($mensaje)
    {
        ob_end_clean();
        include('views/header_error.php');
        $this->flash('danger', $mensaje);
        include('views/footer_error.php');
        die();
    }
    public function forgot($destinatario, $token)
    {
        if ($this->validateEmail($destinatario)) {
            require '../vendor/autoload.php';
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->Username = '19030608@itcelaya.edu.mx';
            $mail->Password = 'vyvxjkwzlbhnoxmi';
            $mail->setFrom('19030608@itcelaya.edu.mx', 'Adrian Morales');
            $mail->addAddress($destinatario, 'Escuela ...');
            $mail->Subject = 'Recuperacion de contraseña';
            $mensaje = "Estimado usuario <br> 
            Este es un mensaje de recuperacion de contraseña, si usted no solicito reestablecer la contraseña favor de comunicarse con servicio al cliente <br>
            <a href=\"http://localhost/escuela/admin/login.php?action=recovery&token=$token&correo=$destinatario\">Presiones aqui para recuperar la contaseña.</a> <br>
            Atentamente. Escuela";
            $mensaje = utf8_decode($mensaje);
            $mail->msgHTML($mensaje);
            if (!$mail->send()) {
                //echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Message sent!';
            }
            function save_email($mail){
                $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
                $imapStream = imap_open($path, $mail->Username, $mail->Password);
                $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
                imap_close($imapStream);

                return $result;
            }
        }
    }

    public function generarToken($correo){
        $token = "salchipapa";
        $n=rand(1,1000000);
        $x = md5(md5($token));
        $y = md5($x . $n);
        $token = md5($y);
        $token= md5($token . 'xerkai');
        $token = md5('buho'). md5($token . $correo);
        return $token;
    }

    public function loginSend($correo){
        $rc=0;
        if($this->validateEmail($correo)){
            $this->db();
            $sql = 'select correo from usuario where correo = :correo';
            $st = $this->db->prepare($sql);
            $st->bindParam(":correo", $correo, PDO::PARAM_STR);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            if (isset($data[0])) {
                $token = $this->generarToken($correo);
                $sql2 = 'update usuario set token = :token where correo = :correo';
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(":token", $token, PDO::PARAM_STR);
                $st2->bindParam(":correo", $correo, PDO::PARAM_STR);
                $st2->execute();
                $rc = $st2->rowCount();
                $this->forgot($correo, $token);
            }
        }
        return $rc;
    }

    function validateToken($correo, $token){
        if(strlen($token)==64){
            if($this->validateEmail($correo)){
                $this->db();
                $sql = "SELECT correo FROM usuario where correo=:correo and token=:token";
                $st = $this->db->prepare($sql);
                $st->bindParam(':correo', $correo, PDO::PARAM_STR);
                $st->bindParam(':token', $token, PDO::PARAM_STR);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
                if(isset($data[0])){
                    return true;
                }
            }
        }
        return false;
    }

    public function resetPassword($correo, $token, $contrasena){
        $cantidad=0;
        if(strlen($token)==64 and strlen($contrasena)>0){
            if($this->validateEmail($correo)){
                $contrasena=md5($contrasena);
                $this->db();
                $sql = "UPDATE usuario set contrasena=:contrasena,token=null 
                        where correo=:correo and token=:token";
                $st = $this->db->prepare($sql);
                $st->bindParam(':correo', $correo, PDO::PARAM_STR);
                $st->bindParam(':token', $token, PDO::PARAM_STR);
                $st->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
                $st->execute();
                $cantidad = $st->rowCount();
            }
        }
        return $cantidad;
    }    

}
$sistema = new Sistema;

?>