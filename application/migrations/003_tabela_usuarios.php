<?php

class Migration_Tabela_usuarios extends CI_Migration
{
    
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nome' => array(
                'type' => 'VARCHAR',
                'constraint' => 20
            ),
            'usuario' => array(
                'type' => 'VARCHAR',
                'constraint' => 20
            ),
            'senha' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
             ),
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('usuarios');
    }
    
    public function down()
    {
        $this->dbforge->drop_table('usuarios');
    }
}
