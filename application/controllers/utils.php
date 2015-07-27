<?php

class Utils extends CI_Controller
{
    
    public function migrate()
    {
        $this->load->library('migration');
        
        if (! $this->migration->current()) {
            echo $this->migration->error_string();
        }
        else {
            echo 'ok';
        }
    }
}
