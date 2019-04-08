<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		for($i=1;$i<=100;$i++)
		{
			if(($i % 3 == 0) && ($i % 5 == 0))
			{	
					$data['arr'][] = "TrailconLeasing";
			}
			elseif($i % 3 == 0)
			{	
					$data['arr'][] = "Trailcon";
			}
			elseif($i % 5 == 0)
			{	
					$data['arr'][] = "Leasing";
			}
			else $data['arr'][] = $i; 
							 	# code...				 
		}	
		$this->load->view('welcome_message', $data);
	}
}