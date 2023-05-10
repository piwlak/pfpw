<?php
require_once("sistema.php");
class Grupo extends Sistema{

    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from grupo as gr 
            left join grado as g on gr.id_grado = g.id_grado
            left join nivel as n on g.id_nivel = n.id_nivel
            left join maestro as m on gr.id_maestro = m.id_maestro";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from grupo where id_grupo = :id";
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
        $sql = "insert into grupo (grupo, id_grado, id_maestro) values (:grupo, :id_grado, :id_maestro)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":grupo", $data['grupo'], PDO::PARAM_STR);
        $st->bindParam(":id_grado", $data['id_grado'], PDO::PARAM_INT);
        $st->bindParam(":id_maestro", $data['id_maestro'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function edit($id, $data)
    {
        $this->db();
        $sql = "update grupo set grupo = :grupo, id_grado = :id_grado, id_maestro = :id_maestro where id_grupo = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":grupo", $data['grupo'], PDO::PARAM_STR);
        $st->bindParam(":id_grado", $data['id_grado'], PDO::PARAM_INT);
        $st->bindParam(":id_maestro", $data['id_maestro'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id)
    {
        $this->db();
        $sql = "delete from grupo where id_grupo = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
    
}
$grupo = new Grupo;
?>