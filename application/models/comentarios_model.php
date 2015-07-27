<?php

class Comentarios_model extends CI_Model
{
    
    public function gravar($comentario)
    {
        $this->db->insert('comentarios', $comentario);
    }
    
    public function pegar_por_post($post_id)
    {
        $this->db->where('post_id', $post_id);
        
        return $this->db->get('comentarios')->result();
    }
}
