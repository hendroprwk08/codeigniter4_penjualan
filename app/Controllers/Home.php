<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Home extends BaseController
{
	public function index()
	{
	    echo ('home page');
		//return view('welcome_message');
	}
	
	public function second()
	{
	    echo ('second page');
	}

	//--------------------------------------------------------------------

}
