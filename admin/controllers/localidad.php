<?php
require_once("sistema.php");
class Localidad extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from localidad l
            join municipio m on l.id_municipio = m.id_municipio 
            where m.id_municipio = 327";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from localidad l
            join municipio m on l.id_municipio = m.id_municipio
            where id_localidad = :id and m.id_municipio = 327";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
}
$localidad = new Localidad;