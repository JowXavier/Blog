<?php

class Migration_Tabela_comentarios extends CI_Migration
{
    public function up()
    {
        // criar a tabela de comentários
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'post_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE
            ),
            'autor' => array(
                'type' => 'VARCHAR',
                'constraint' => 20
            ),
            'email_autor' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
            ),
            'texto' => array(
                'type' => 'TEXT'
            ),
            'publicacao' => array(
                'type' => 'DATETIME'
            ),
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('comentarios');
    }
    
    public function down()
    {
        // Remover a tabela de comentários
        $this->dbforge->drop_table('comentarios');
    }
}
