<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        
        <?php echo link_tag('assets/css/blog.css'); ?> 
    </head>
    <body>
        <h1>Administração</h1>
        
        <?php if ($falha_login) : ?>
            <p style="color: #A33">Falha na autenticação!</p>
        <?php endif; ?>
        
        <?php
            echo form_open();
            
                echo form_fieldset('Login');
                
                    echo form_error('usuario');
                    echo form_label('Usuário: ', 'usuario');
                    echo form_input(array(
                        'id' => 'usuario',
                        'name' => 'usuario',
                        'value' => set_value('usuario', ''),
                        'maxlength' => 20
                    ));
                    
                    echo form_error('senha');
                    echo form_label('Senha: ', 'senha');
                    echo form_password(array(
                        'id' => 'senha',
                        'name' => 'senha',
                        'value' => '',
                        'maxlength' => 20
                    ));
                
                echo form_fieldset_close();
                
                echo form_submit('', 'Autenticar');
        
            echo form_close();
        ?>
    </body>
</html>