<h2><?php echo $titulo; ?></h2>

<?php
    echo form_open();
    
        echo form_fieldset('Dados do post');
        
            echo form_error('titulo');
            echo form_label('Título: ', 'titulo');
            echo form_input(array(
                'id' => 'titulo',
                'name' => 'titulo',
                'value' => set_value('titulo', $post->titulo),
                'maxlength' => 80
            ));
        
            echo form_error('texto');
            echo form_label('Texto: ', 'texto');
            echo form_textarea(array(
                'id' => 'texto',
                'name' => 'texto',
                'value' => set_value('texto', $post->texto),
                'rows' => 8
            ));
            
            echo form_error('autor');
            echo form_label('Autor: ', 'autor');
            echo form_input(array(
                'id' => 'autor',
                'name' => 'autor',
                'value' => set_value('autor', $post->autor),
                'maxlength' => 100
            ));
            
        echo form_fieldset_close();
        
        echo form_submit('', 'Enviar');
        
    echo form_close();
?>