<?php namespace App\Controllers;
// use App\Models\PostModel;
class Admin extends BaseController
{
	
	public $data;
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		
		$this->data = [];
	}
	public function index()
	{
		
		$this->data = [
			'title' => 'Login',
		
		];
        echo view('admin/login' , $this->data);
		
	}
	
	

	//--------------------------------------------------------------------

}