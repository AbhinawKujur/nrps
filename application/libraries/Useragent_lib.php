<?php 

class Useragent_lib
{

function user_agents()
    {
    	$ci =& get_instance();
        if ($ci->agent->is_browser())
		{
		    $agent = $ci->agent->browser().' '.$ci->agent->version();
		}
		elseif ($ci->agent->is_robot())
		{
		    $agent = $ci->agent->robot();
		}
		elseif ($ci->agent->is_mobile())
		{
		    $agent = $ci->agent->mobile();
		}
		else
		{
		    $agent = 'Unidentified User Agent';
		}

		return $agent.', '.$ci->agent->platform();
    }   

}