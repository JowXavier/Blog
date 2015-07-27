<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    // Form de login
    public function index()
    {
        $this->load->model('usuarios_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->data['falha_login'] = FALSE;
        
        if ($this->input->post()) {
            // Validação de dados
            $regras = array(
                array(
                    'field' => 'usuario',
                    'label' => 'Usuário',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'senha',
                    'label' => 'Senha',
                    'rules' => 'required'
                )
            );
            
            $this->form_validation->set_rules($regras);
            
            $this->form_validation->set_error_delimiters(
                '<p class="form_erro">', '</p>'
            );
            
            if ($this->form_validation->run()) {
                $resultado = $this->usuarios_model->autenticar(
                    $this->input->post('usuario'),
                    $this->input->post('senha')
                );
                
                if ($resultado) {
					$sessao = array(
					   'usuario' => $this->input->post('usuario')
				    );
                    $this->session->set_userdata($sessao);
                    
                    redirect('admin/posts');
                } else {
                    $this->data['falha_login'] = TRUE;
                }
            }
        }

        $this->load->view('admin/login', $this->data);
    }
}
