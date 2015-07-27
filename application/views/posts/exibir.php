<h2><?php echo $post->titulo; ?></h2>
<p><?php echo nl2br($post->texto); ?></p>
<p><small>Autor: <?php echo $post->autor; ?></small></p>
<p><small>Publicação: <?php echo formatar_datahora_exibicao($post->publicacao); ?></small></p>

<?php if (count($post->comentarios) > 0) : ?>
    <h3>Comentários</h3>
    
    <?php foreach($post->comentarios as $c) : ?>
        <div class="comentario">
            <?php echo gravatar($c->email_autor, 50); ?>
            <p>Por: <?php echo $c->autor; ?></p>
            <p>Quando: <?php echo formatar_datahora_exibicao($c->publicacao); ?></p>
            <p>
                <?php echo nl2br($c->texto); ?>
            </p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Listar os comentários -->

<!-- Formulário para cadastrar um novo comentário -->

<h3>Novo comentário</h3>

<?php
    echo form_open();
    
        echo form_hidden('post_id', $post->id);
    
        echo form_fieldset('Comentário');
        
            echo form_error('autor');
            echo form_label('Nome: ', 'autor');
            echo form_input(array(
                'id' => 'autor',
                'name' => 'autor',
                'value' => set_value('autor', ''),
                'maxlength' => 20
            ));
            
            echo form_error('email');
            echo form_label('E-mail: ', 'email');
            echo form_input(array(
                'id' => 'email',
                'name' => 'email',
                'value' => set_value('email', ''),
                'maxlength' => 50
            ));
            
            echo form_error('comentario');
            echo form_label('Comentário: ', 'comentario');
            echo form_textarea(array(
                'id' => 'comentario',
                'name' => 'comentario',
                'value' => set_value('comentario', ''),
                'rows' => 8
            ));
            
            echo form_error('captcha');
            echo form_label('Código de verificação: ', 'captcha');
            echo form_input(array(
                'id' => 'captcha',
                'name' => 'captcha',
                'value' => ''
            ));
            echo $img_captcha;
        
        echo form_fieldset_close();
        
        echo form_submit('', 'Enviar');

    echo form_close();
?>