<?php

class Usuarios_model extends CI_Model
{
    
    public function autenticar($usuario, $senha)
    {
        $this->db->where('usuario', $usuario);
        $this->db->where('senha', md5($senha));
        
        $u = $this->db->get('usuarios')->row();
        
        return is_object($u);
    }
}
