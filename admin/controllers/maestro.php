<?php
require_once("sistema.php");
class Maestro extends Sistema{

    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from maestro as m
            left join usuario as u on m.id_usuario = u.id_usuario";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from maestro where id_maestro = :id";
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
        $sql = "INSERT INTO maestro( nombre, primer_apellido, segundo_apellido,  rfc, curp, nacimiento, id_usuario) 
        VALUES (:nombre, :primer_apellido, :segundo_apellido, :rfc, :curp, :nacimiento, :id_usuario)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
        $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
        $st->bindParam(":nacimiento", $data['nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function edit($id, $data)
    {
        $this->db();
        $sql = "UPDATE maestro SET primer_apellido=:primer_apellido,segundo_apellido=:segundo_apellido,
        nombre=:nombre,rfc=:rfc,curp=:curp,nacimiento=:nacimiento,id_usuario=:id_usuario WHERE id_maestro=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
        $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
        $st->bindParam(":nacimiento", $data['nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_INT);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id)
    {
        $this->db();
        $sql = "delete from maestro where id_maestro = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
    
}
$maestro = new Maestro;
?>