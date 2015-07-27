<?php

class Posts extends MY_Controller
{       
    /*public function index()
    {
        $this->load->helper('datas');
        $this->load->model('posts_model');
        
        $this->data['view'] = 'admin/posts/index';
        $this->data['titulo'] = 'Administração';
        
        $this->data['posts'] = $this->posts_model->pegar_todos();
        
        $this->load->view('admin/base', $this->data);
    }*/
	
	public function index($pagina = 0)
    {
		$this->load->helper('datas');
        $this->load->model('posts_model');
		
        $this->load->helper('text');
        $this->load->library('pagination');

        $this->data['view'] = 'admin/posts/index';
        $this->data['titulo'] = 'Administração';
           
        // Ir no banco e buscar os posts, paginados
        $this->data['posts'] = $this->posts_model->pegar_paginacao($pagina);
        
        $configuracao_paginacao = array(
            'base_url' => site_url('admin/posts/index/'),
            'total_rows' => $this->posts_model->contar_todos(),
			'uri_segment' => 4,
            'per_page' => 2,
        );

        $this->pagination->initialize($configuracao_paginacao);

        $this->data['paginacao'] = $this->pagination->create_links();
        
        // Exibir uma view com os posts
        $this->load->view('admin/base', $this->data);
    }
    
    public function novo()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('posts_model');
        
        if ($this->input->post()) {
            $this->_gravar();
        }

        // CASTING!
        $this->data['post'] = (object) array(
            'titulo' => '',
            'texto' => '',
            'autor' => ''
        );
        
        $this->data['view'] = 'admin/posts/form';
        $this->data['titulo'] = 'Novo post';
        
        $this->load->view('admin/base', $this->data);
    }

    public function editar($post_id)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('posts_model');
        
        $this->data['post'] = $this->posts_model->pegar_id($post_id);
        
        if (! is_object($this->data['post'])) {
            $this->session->set_flashdata('mensagem', 'Post não encontrado!');
            redirect('admin/posts');
        }
        
        if ($this->input->post()) {
            $this->_gravar($post_id);
        }
        
        $this->data['view'] = 'admin/posts/form';
        $this->data['titulo'] = 'Novo post';
        
        $this->load->view('admin/base', $this->data);
    }
	
	public function excluir($post_id)
    {
        $this->load->model('posts_model');
        
        $this->data['post'] = $this->posts_model->pegar_id($post_id);
        
        if (! is_object($this->data['post'])){
            $this->session->set_flashdata('mensagem', 'Post não encontrado!');
            redirect('admin/posts');
        }else{
			$this->posts_model->remove($post_id);
			
			$this->session->set_flashdata('mensagem', 'Post removido com sucesso!');
			redirect('admin/posts');
		}
    }

    private function _gravar($post_id = 0)
    {
        // Validação
        $regras = array(
            array(
                'field' => 'titulo',
                'label' => 'Título',
                'rules' => 'required'
            ),
            array(
                'field' => 'texto',
                'label' => 'Texto',
                'rules' => 'required'
            ),
            array(
                'field' => 'autor',
                'label' => 'Autor',
                'rules' => 'required'
            )
        );
        
        $this->form_validation->set_rules($regras);
        
        $this->form_validation->set_error_delimiters(
            '<p class="form_erro">', '</p>'
        );
        
        if ($this->form_validation->run()) {
            // Gravar
            $post = array(
                'titulo' => $this->input->post('titulo'),
                'texto' => $this->input->post('texto'),
                'autor' => $this->input->post('autor'),
                'url' => url_title($this->input->post('titulo'), '-', TRUE),
                'publicacao' => date('Y-m-d H:i:s')
            );
            
            if ($post_id > 0) {
                $post['id'] = $post_id;
            }
            
            $this->posts_model->gravar($post);
            
            if ($post_id > 0) {
                $this->session->set_flashdata('mensagem', 'Post editado com sucesso!');
            } else {
                $this->session->set_flashdata('mensagem', 'Post inserido com sucesso!');
            }
            
            redirect('admin/posts');
        }
    }
}
