<?php
require_once("sistema.php");
class Calificacion extends Sistema{

    public function get($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from calificacion as c 
            left join alumno as a on c.id_alumno = a.id_alumno
            left join materia as m on c.id_materia = m.id_materia";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from calificacion as c 
            left join alumno as a on c.id_alumno = a.id_alumno
            left join materia as m on c.id_materia = m.id_materia
            where a.id_alumno = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    
}
$calificacion = new Calificacion;
?>