<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Home extends BaseController
{
	public function index()
	{
	    echo ('home page');
	    echo anchor ('supplier/', 'Lanjut');
            //return view('supplier');
	}
	
	public function second()
	{
	    echo ('second page');
	}

	//--------------------------------------------------------------------

}
