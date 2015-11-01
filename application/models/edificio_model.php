<?php

class Edificio_model extends CI_Model{


    function __Construct()
    {
        $this->load->database();
    }

     function obtener_edificios()
    {

        $query = $this->db->get('edificio'); //get() es el equivalente a Select * from  nombre_tabla

        return $query->result_array();
    }

    function insert_edificio($nombre_edi,$numero,$direccion,$rut_admin,$fono_conserjeria,$ciudad,$descripcion){

            $data=array('nombre_edificio'=>$nombre_edi,
                        'numero'=>$numero,
                        'direccion'=>$direccion,
                        'rut_admin'=>$rut_admin,
                        'telefono_conserjeria'=>$fono_conserjeria,
                        'ciudad'=>$ciudad,
                        'descripcion'=>$descripcion);//se crea un array con los campos
            $result= $this->db->insert('edificio',$data);// se inserta ala base de datos

            if($result== 1)
            {
                return true;
            }
            else
            {
                return false;
            }
    }

    function obtener_administradores()
    {

        $query = $this->db->get('admin_edificio'); //get() es el equivalente a Select * from  nombre_tabla
        return $query->result_array();
    }

    public function obtener_datos_depto($id){

        //$consulta=$this->db->get_where('tipo_departamento',array('CODIGO_TIPO'=>$id));
        $consulta = $this->db->query(" SELECT * from DEPARTAMENTO where ID_DEPARTAMENTO='".$id."'");
        return $consulta->result_array();
    }

    public function obtener_edificio($id){

        $consulta = $this->db->query("SELECT * FROM edificio WHERE id_edificio='".$id."'");
        return $consulta->result_array();
    }

    public function update_edificio($id,$nom,$num,$dir,$adm,$tel,$ciu,$des){

        $data = array(
            'nombre_edificio'=>$nom,
            'numero'=>$num,
            'direccion'=>$dir,
            'rut_admin'=>$adm,
            'telefono_conserjeria'=>$tel,
            'ciudad'=>$ciu,
            'descripcion'=>$des
        );

        $this->db->where('ID_EDIFICIO',$id); //LE DECIMOS CUAL QUEREMOS MODIFICAR (CON LA ID)

        $result = $this->db->update('edificio',$data); //LE MANDAMOS LOS ATOS PAR QUE ACTUALIZARLOS EN LA TABLA

        if($result==1) // si actualizaco con exitó los datos
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}