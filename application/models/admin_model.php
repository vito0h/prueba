<?php

class Admin_model extends CI_Model{


    function __Construct()
    {
        $this->load->database();
    }

    function obtener_admins()
    {
        $aux='admin';
        $query = $this->db->query("SELECT * FROM USUARIOS WHERE ROL='".$aux."'"); //get() es el equivalente a Select * from  nombre_tabla

        return $query->result_array();
    }

    function insert_admin($nom_u,$pass){

        $data=array('usuario'=>$nom_u,
            'password'=>$pass,
            'rol'=>"admin"
        );//se crea un array con los campos
        $result= $this->db->insert('usuarios',$data);// se inserta a la base de datos

        if($result== 1)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    function update_admin($user,$pass){

        $data=array('password'=>$pass
                    );//LE DECIMOS LOS DATOS QUE VAMOS A ACTUALIZAR

        $this->db->where('USUARIO',$user); //LE DECIMOS CUAL QUEREMOS MODIFICAR (CON LA ID)

        $result=$this->db->update('usuarios',$data); //LE MANDAMOS LOS ATOS PAR QUE ACTUALIZARLOS EN LA TABLA

        if($result==1) // si actualizaco con exitó los datos
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    
    function depto_ocupar(){
        $query = $this->db->query("select reserva_departamento.ID_DEPARTAMENTO,DEPARTAMENTO.NUMERO_DEPARTAMENTO,
tipo_departamento.NOMBRE_TIPO,reserva_departamento.FECHA_INICIO,
reserva_departamento.FECHA_FIN,CLIENTE.RUT,
CLIENTE.NOMBRE,CLIENTE.APELLIDOS,cliente.TELEFONO 
FROM reserva_departamento,DEPARTAMENTO,CLIENTE,RESERVA,tipo_departamento
WHERE RESERVA.RUT=CLIENTE.RUT AND reserva.ID_RESERVA=RESERVA_DEPARTAMENTO.ID_RESERVA
AND reserva_departamento.ID_DEPARTAMENTO=DEPARTAMENTO.ID_DEPARTAMENTO AND FECHA_INICIO=curdate()");
        return $query->result_array();
    
    }
    
    function depto_desocupar(){
        $query = $this->db->query("select reserva_departamento.ID_DEPARTAMENTO,DEPARTAMENTO.NUMERO_DEPARTAMENTO,
tipo_departamento.NOMBRE_TIPO,reserva_departamento.FECHA_INICIO,
reserva_departamento.FECHA_FIN,CLIENTE.RUT,
CLIENTE.NOMBRE,CLIENTE.APELLIDOS,cliente.TELEFONO 
FROM reserva_departamento,DEPARTAMENTO,CLIENTE,RESERVA,tipo_departamento
WHERE RESERVA.RUT=CLIENTE.RUT AND reserva.ID_RESERVA=RESERVA_DEPARTAMENTO.ID_RESERVA
AND reserva_departamento.ID_DEPARTAMENTO=DEPARTAMENTO.ID_DEPARTAMENTO AND FECHA_FIN=curdate()");
        return $query->result_array();
    
    }

}