<?php
require_once("sistema.php");
class Alumno extends Sistema{

    public function get($id = null)
    {
        $this->db();
        try {
            $this->db->beginTransaction();

            if (is_null($id)) {
                $sql = "select * from alumno as a
                left join tutor t on a.id_tutor = t.id_tutor
                left join localidad l on a.id_localidad = l.id_localidad
                left join status s on a.id_status = s.id_status";
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = "select * from alumno as a
                left join tutor t on a.id_tutor = t.id_tutor
                left join localidad l on a.id_localidad = l.id_localidad
                left join status s on a.id_status = s.id_status
                where id_alumno = :id";
                $st = $this->db->prepare($sql);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
        return $data;
    }


    public function new($data)
    {
        $this->db();
        $sql = "INSERT INTO alumno( nombre_alumno, primer_apellido_alumno, segundo_apellido_alumno, curp_alumno, nacimiento_alumno, id_status, id_tutor, id_localidad, calle) 
        VALUES (:nombre_alumno, :primer_apellido_alumno, :segundo_apellido_alumno, :curp_alumno, :nacimiento_alumno, :id_status, :id_tutor,  :id_localidad, :calle)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":nombre_alumno", $data['nombre_alumno'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido_alumno", $data['primer_apellido_alumno'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido_alumno", $data['segundo_apellido_alumno'], PDO::PARAM_STR);
        $st->bindParam(":curp_alumno", $data['curp_alumno'], PDO::PARAM_STR);
        $st->bindParam(":nacimiento_alumno", $data['nacimiento_alumno'], PDO::PARAM_STR);
        $st->bindParam(":id_status", $data['id_status'], PDO::PARAM_INT);
        $st->bindParam(":id_tutor", $data['id_tutor'], PDO::PARAM_STR);
        $st->bindParam(":id_localidad", $data['id_localidad'], PDO::PARAM_INT);
        $st->bindParam(":calle", $data['calle'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function edit($id, $data)
    {
        $this->db();
        $sql = "UPDATE alumno SET primer_apellido_alumno=:primer_apellido_alumno,segundo_apellido_alumno=:segundo_apellido_alumno,
        nombre_alumno=:nombre_alumno,curp_alumno=:curp_alumno,nacimiento_alumno=:nacimiento_alumno,id_status=:id_status,id_tutor=:id_tutor,id_localidad=:id_localidad,calle=:calle   
        WHERE id_alumno=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $data['id_alumno'], PDO::PARAM_STR);
        $st->bindParam(":nombre_alumno", $data['nombre_alumno'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido_alumno", $data['primer_apellido_alumno'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido_alumno", $data['segundo_apellido_alumno'], PDO::PARAM_STR);
        $st->bindParam(":curp_alumno", $data['curp_alumno'], PDO::PARAM_STR);
        $st->bindParam(":nacimiento_alumno", $data['nacimiento_alumno'], PDO::PARAM_STR);
        $st->bindParam(":id_status", $data['id_status'], PDO::PARAM_INT);
        $st->bindParam(":id_tutor", $data['id_tutor'], PDO::PARAM_STR);
        $st->bindParam(":id_localidad", $data['id_localidad'], PDO::PARAM_INT);
        $st->bindParam(":calle", $data['calle'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id)
    {
        $this->db();
        $sql = "delete from alumno where id_alumno = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function getGrupo($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from grupo_detalle as gd 
            left join alumno as a on gd.id_alumno = a.id_alumno
            left join grupo as g on gd.id_grupo = g.id_grupo";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from grupo_detalle as gd 
            left join alumno as a on gd.id_alumno = a.id_alumno
            left join grupo as g on gd.id_grupo = g.id_grupo
            where gd.id_alumno=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function guardar($id, $data3)
{
    $this->db();
    try {
        $this->db->beginTransaction();
        $rc=0;
        foreach ($data3 as $key => $calificacion) {
            $id_materia = $calificacion['id_materia'];
            $periodo1 = $calificacion['periodo_1'];
            $periodo2 = $calificacion['periodo_2'];
            $periodo3 = $calificacion['periodo_3'];
            

            $sql = "UPDATE calificacion 
                    SET periodo_1 = :periodo1,
                        periodo_2 = :periodo2,
                        periodo_3 = :periodo3 
                    WHERE id_alumno = :id
                        AND id_materia = :id_materia";
            
            $st = $this->db->prepare($sql);
            $st->bindParam(':periodo1', $periodo1);
            $st->bindParam(':periodo2', $periodo2);
            $st->bindParam(':periodo3', $periodo3);
            $st->bindParam(':id', $id);
            $st->bindParam(':id_materia', $id_materia);
            
            $st->execute();
            $rc = $rc + ($st->rowCount());
        }
        $this->db->commit();
    } catch (PDOException $Exception) {
        $rc = 0;
        $this->db->rollBack();
    }
    
    return $rc;
}


    public function newGrupo($id,$data)
    {
        $number=0;
        $i=0;
        $this->db();
        $sql = "insert into grupo_detalle (id_alumno, id_grupo) values (:id, :id_grupo)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id_grupo", $data['id_grupo'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();

        $number = $this->HowMany($data);
        foreach ($number as $key => $num) :
            $numtostr = implode(',', $number[$i]);
            $sql2 = "insert into calificacion (id_alumno, id_materia) values (:id,$numtostr)";
            $st2 = $this->db->prepare($sql2);
            $st2->bindParam(":id", $id, PDO::PARAM_INT);
            $st2->execute();
            $i++;
        endforeach;
        
        return $rc;
    } 
    
    public function deleteGrupo($id)
    { 
        $number=0;
        $i=0;
        $this->db();
            $number = $this->HowMany2($id);
            foreach ($number as $key => $num) :
            $numtostr = implode(',', $number[$i]);
            $sql2 = "delete from calificacion where id_alumno = $numtostr";
            $st2 = $this->db->prepare($sql2);
            $st2->execute();
            $i++;
            endforeach;

            $sql = "delete from grupo_detalle where id_grupo = :id ";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            
        return $rc;
    }

    public function HowMany($data2)
    {
        $this->db();
        $sql = "select id_materia from materia as m 
        where id_grado = (select id_grado from grupo where id_grupo = :id_grupo)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_grupo", $data2['id_grupo'], PDO::PARAM_STR); 
        $st->execute();   
        $rc = $st->fetchAll(PDO::FETCH_ASSOC);
        return $rc;
    }

    public function HowMany2($id)
    {
        $this->db();
        $sql = "SELECT id_alumno FROM grupo_detalle WHERE id_grupo = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_STR); 
        $st->execute();   
        $rc = $st->fetchAll(PDO::FETCH_ASSOC);
        return $rc;
    }

    public function chartAlumno(){
        $this->db();
            $sql= "select count(id_alumno) as cantidad from alumno";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    
}
$alumno = new Alumno;
?>