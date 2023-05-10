<?php
require_once("sistema.php");
class Tutor extends Sistema{

    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from tutor as t
            left join usuario as u on t.id_usuario = u.id_usuario
            left join rol_tutor as rt on t.id_rol_tutor = rt.id_rol_tutor";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from tutor where id_tutor = :id";
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
        $sql = "INSERT INTO tutor( nombre, primer_apellido, segundo_apellido,  rfc, curp, nacimiento, id_usuario, id_rol_tutor) 
        VALUES (:nombre, :primer_apellido, :segundo_apellido, :rfc, :curp, :nacimiento, :id_usuario, :id_rol_tutor)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
        $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
        $st->bindParam(":nacimiento", $data['nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_INT);
        $st->bindParam(":id_rol_tutor", $data['id_rol_tutor'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function edit($id, $data)
    {
        $this->db();
        $sql = "UPDATE tutor SET primer_apellido=:primer_apellido,segundo_apellido=:segundo_apellido,
        nombre=:nombre,rfc=:rfc,curp=:curp,nacimiento=:nacimiento,id_usuario=:id_usuario,id_rol_tutor=:id_rol_tutor  
        WHERE id_tutor=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
        $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
        $st->bindParam(":nacimiento", $data['nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_INT);
        $st->bindParam(":id_rol_tutor", $data['id_rol_tutor'], PDO::PARAM_INT);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id)
    {
        $this->db();
        $sql = "delete from tutor where id_tutor = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
    
}
$tutor = new Tutor;
?>