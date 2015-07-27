<?php

class Migration_Tabela_posts extends CI_Migration
{
    public function up()
    {
        // criar a tabela de posts
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'titulo' => array(
                'type' => 'VARCHAR',
                'constraint' => 80
            ),
            'url' => array(
                'type' => 'VARCHAR',
                'constraint' => 80
            ),
            'texto' => array(
                'type' => 'TEXT'
            ),
            'autor' => array(
                'type' => 'VARCHAR',
                'constraint' => 10),
            'publicacao' => array(
                'type' => 'DATETIME'
            ),
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('posts');
    }
    
    public function down()
    {
        // Remover a tabela de posts
        $this->dbforge->drop_table('posts');
    }
}
