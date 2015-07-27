<?php

class Posts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('posts_model');
        $this->load->helper('datas');
        
        $this->data = array();
    }
    
    public function index($pagina = 0)
    {
        $this->load->helper('text');
        $this->load->library('pagination');

        $this->data['view'] = 'posts/index';
        $this->data['titulo'] = 'Blog Igniter';
           
        // Ir no banco e buscar os posts, paginados
        $this->data['posts'] = $this->posts_model->pegar_paginacao($pagina);
        
        $configuracao_paginacao = array(
            'base_url' => site_url('posts/index/'),
            'total_rows' => $this->posts_model->contar_todos(),
            'per_page' => 2,
        );

        $this->pagination->initialize($configuracao_paginacao);

        $this->data['paginacao'] = $this->pagination->create_links();
        
        // Exibir uma view com os posts
        $this->load->view('base', $this->data);
    }
    
    public function exibir($url)
    {
        $this->load->model('comentarios_model');
        $this->load->helper(array('form', 'captcha'));
        $this->load->library('form_validation');
        $this->load->spark('gravatar/1.1.1');
        
        // Verificar se tem post de comentário e gravar
        if ($this->input->post()) {
            // Validação de dados
            $regras = array(
                array(
                    'field' => 'autor',
                    'label' => 'Autor',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'email',
                    'label' => 'E-mail',
                    'rules' => 'required|valid_email'
                ),
                array(
                    'field' => 'comentario',
                    'label' => 'Comentário',
                    'rules' => 'required|min_length[10]'
                ),
                array(
                    'field' => 'captcha',
                    'label' => 'Código de verificação',
                    'rules' => 'required|callback_meucaptcha'
                )
            );
            
            $this->form_validation->set_rules($regras);
            
            $this->form_validation->set_error_delimiters(
                '<p class="form_erro">', '</p>'
            );
            
            if ($this->form_validation->run()) {
                // Validação passou!

                // Gravação do comentário
                $comentario = array(
                    'post_id' => $this->input->post('post_id'),
                    'autor' => $this->input->post('autor'),
                    'email_autor' => $this->input->post('email'),
                    'texto' => $this->input->post('comentario'),
                    'publicacao' => date('Y-m-d H:i:s')
                );
                
                $this->comentarios_model->gravar($comentario);
                
                $this->session->set_flashdata('mensagem', 'Comentário inserido com sucesso. Obrigado!');
            
                // Redirecionamento
                redirect('post/'.$url);
            }
        }
        
        $this->data['view'] = 'posts/exibir';
        
        // Buscar o post pela URL
        $this->data['post'] = $this->posts_model->pegar_post_url($url);
        $this->data['post']->comentarios = $this->comentarios_model->pegar_por_post(
            $this->data['post']->id
        );
        
        // Se não existir, redirecionar para uma págin 404
        if (! is_object($this->data['post'])) {
            redirect('/nao_encontrada');
        }
        
        $this->data['titulo'] = $this->data['post']->titulo;
        
        // Criação do Captcha
        $captcha = create_captcha(array(
            'font_path' => './assets/fonts/risque.ttf',
            'img_path' => './assets/captcha/',
            'img_url' => base_url() . 'assets/captcha/',
            'img_width' => 300,
            'img_height' => 130
        ));
        
        $this->session->set_userdata('captcha', mb_strtoupper($captcha['word']));
        
        $this->data['img_captcha'] = $captcha['image'];
         
        // Se existir, exibir a view
        $this->load->view('base', $this->data);
    }

    public function meucaptcha($captcha)
    {
        $this->form_validation->set_message('meucaptcha', 'O código de verificação está incorreto!');
        
        return (mb_strtoupper($captcha) == $this->session->userdata('captcha'));
    }
}