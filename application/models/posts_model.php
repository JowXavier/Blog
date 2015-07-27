<?php

/**
 * @property CI_DB_active_record $db
 */
class Posts_model extends CI_Model
{
    public function contar_todos()
    {
        return $this->db->count_all('posts');
    }
    
    public function pegar_paginacao($pagina = 0)
    {
        $this->db->order_by('publicacao', 'DESC');
        $this->db->limit(2, $pagina);
        
        return $this->db->get('posts')->result();
    }
    
    public function pegar_todos()
    {
        $this->db->order_by('publicacao', 'DESC');
        return $this->db->get('posts')->result();
    }
    
    public function pegar_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('posts')->row();
    }
    
    public function pegar_post_url($url)
    {
        $this->db->where('url', $url);
        return $this->db->get('posts')->row();
    }
    
    public function gravar($post)
    {
        if (isset($post['id'])) {
            $this->db->where('id', $post['id']);
            $this->db->update('posts', $post);
        } else {
            $this->db->insert('posts', $post);
        }
    }
	
	public function remove($id)
    {
		$this->db->where('id', $id);
		$this->db->delete('posts');
    }
}