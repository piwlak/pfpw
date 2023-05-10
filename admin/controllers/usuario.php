<?php
require_once("sistema.php");
class Usuario extends Sistema{

    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from usuario order by id_usuario";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from usuario where id_usuario = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }


    public function new($data)
    {
        $this->db();
        $sql = "insert into usuario (correo, contrasena) values (:correo, md5(:contrasena))";
        $st = $this->db->prepare($sql);
        $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $st->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function edit($id, $data)
    {
        $this->db();
        $sql = "update usuario set correo = :correo where id_usuario = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id)
    {
        $this->db();
        $sql = "delete from usuario where id_usuario = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function getRol($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from usuario_rol as ur 
            left join usuario as u on ur.id_usuario = u.id_usuario
            left join rol as r on ur.id_rol = r.id_rol";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from usuario_rol as ur 
            left join usuario as u on ur.id_usuario = u.id_usuario
            left join rol as r on ur.id_rol = r.id_rol
            where ur.id_usuario=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function newRol($id,$data)
    {
        $this->db();
        $sql = "insert into usuario_rol (id_usuario, id_rol) values (:id, :id_rol)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id_rol", $data['id_rol'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
    
    public function deleteRol($id)
    {
        $this->db();
        $sql = "delete from usuario_rol where id_rol = :id ";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$usuario = new Usuario;
?>