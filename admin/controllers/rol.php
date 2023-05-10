<?php
require_once("sistema.php");
class Rol extends Sistema{

    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from rol";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from rol where id_rol = :id";
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
        $sql = "insert into rol (rol) values (:rol)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":rol", $data['rol'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function edit($id, $data)
    {
        $this->db();
        $sql = "update rol set rol = :rol where id_rol = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":rol", $data['rol'], PDO::PARAM_STR);
        
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id)
    {
        $this->db();
        $sql = "delete from rol where id_rol = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
    public function getPrivilegio($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from rol_privilegio as rp 
            left join privilegio as p on rp.id_privilegio = p.id_privilegio
            left join rol as r on rp.id_rol = r.id_rol";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from rol_privilegio as rp 
            left join privilegio as p on rp.id_privilegio = p.id_privilegio
            left join rol as r on rp.id_rol = r.id_rol
            where rp.id_rol=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function newprivilegio($id,$data)
    {
        $this->db();
        $sql = "insert into rol_privilegio (id_privilegio, id_rol) values (:id_privilegio, :id)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id_privilegio", $data['id_privilegio'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
    
    public function deletePrivilegio($id)
    {
        $this->db();
        $sql = "delete from rol_privilegio where id_privilegio = :id ";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
    
$rol = new Rol;
?>