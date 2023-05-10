<?php
require_once("sistema.php");
class Materia extends Sistema{

    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from materia as m 
            left join grado as g on m.id_grado = g.id_grado
            left join nivel as n on g.id_nivel = n.id_nivel";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from materia where id_materia = :id";
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
        $sql = "insert into materia (materia, id_grado) values (:materia, :id_grado)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":materia", $data['materia'], PDO::PARAM_STR);
        $st->bindParam(":id_grado", $data['id_grado'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function edit($id, $data)
    {
        $this->db();
        $sql = "update materia set materia = :materia, id_grado = :id_grado where id_materia = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":materia", $data['materia'], PDO::PARAM_STR);
        $st->bindParam(":id_grado", $data['id_grado'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id)
    {
        $this->db();
        $sql = "delete from materia where id_materia = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
    
}
$materia = new Materia;
?>