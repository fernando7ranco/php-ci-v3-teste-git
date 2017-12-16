<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('sessionMsg')):
	
	function sessionMsg($name, $data = null)
	{
		$ci = & get_instance();
		
		if($name and $data): 
			$ci->session->set_userdata('sessionMsg-'.$name, $data);
		else:
		
			if( $values = $ci->session->userdata('sessionMsg-'.$name) ):
				$ci->session->unset_userdata('sessionMsg-'.$name);	
				return $values;
			endif;
			
		endif;
		
		return null;
	}
	
endif;

if ( ! function_exists('dDebug')):

    function dDebug()
    {
        list($callee) = debug_backtrace();

        $args = func_get_args();

        $total_args = func_num_args();

        echo '<div><fieldset style="background: #fefefe !important; border:1px red solid; padding:15px">';
        echo '<legend style="background:blue; color:white; padding:5px;">'.$callee['file'].' @line: '.$callee['line'].'</legend><pre><code>';

        $i = 0;

        foreach ($args as $arg)
        {
            echo '<strong>Debug #' . ++$i . ' of ' . $total_args . '</strong>: ' . '<br>';

            var_dump($arg);
        }

        echo "</code></pre></fieldset><div><br>";
		
		exit;
    }
endif;