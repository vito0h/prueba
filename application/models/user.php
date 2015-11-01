<?php
Class User extends CI_Model
{

    public function validar_sesion($user,$pass){

        $consulta= $this->db->query(" SELECT * from USUARIOS where USUARIO='".$user."' AND  PASSWORD='".$pass."'");
        $datos=$consulta->num_rows();

        if($datos==1) {
            return true;
        }
        else{
            return false;
        }

    }

    function login($username, $password){

        $this -> db -> select('usuario, password');
        $this -> db -> from('usuarios');
        $this -> db -> where('usuario', $username);
        $this -> db -> where('password', MD5($password));
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    public function obtener_datoUser($user,$pass){

        $consulta = $this->db->query("SELECT * from USUARIOS where USUARIO='".$user."' AND PASSWORD='".$pass."'");
        return $consulta->result_array();
    }

    function buscar_user($usu){

        $result= $this->db->query("SELECT usuario FROM usuarios WHERE usuario='".$usu."'");
        $datos=$result->num_rows();

        if($datos==0){
            return true;
        }
        else{
            return false;
        }

    }

}
?>