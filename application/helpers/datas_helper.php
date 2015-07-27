<?php

/**
 * Esta função recebe uma data e hora no formato:
 * 
 * AAAA-MM-DD hh:mm:ss
 * 
 * E retorna no formato:
 * 
 * DD/MM/AAAA às hh:mm
 */
if (! function_exists('formatar_datahora_exibicao')) {
    function formatar_datahora_exibicao($datahora)
    {
    	$dh = new DateTime($datahora);
        
        return $dh->format('d/m/Y \à\s h:i');
    }
}