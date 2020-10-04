<?php namespace App\Controllers;
// use App\Models\PostModel;
class Dashboard extends BaseController
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
			'title' => 'Dashboard',
		];
		echo view('admin/dashboard' , $this->data);
	}
}