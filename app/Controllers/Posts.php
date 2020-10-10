<?php namespace App\Controllers;
use App\Models\MetaModel;
use App\Models\HeaderModel;
use App\Models\InfoModel;
use App\Models\CategoryModel;
class Posts extends BaseController
{
	
	public $data;
	public $meta;
	public $header;
	public $info;
	public $category;
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		
		$this->data = [];
		$this->meta = new MetaModel();
		$this->header = new HeaderModel();
		$this->info = new InfoModel();
		$this->category = new CategoryModel();

	}
	public function add_category()
	{
		$rules = [
			'name' => 'required|min_length[3]|is_unique[category.name]',
		];
		$errors = [
			'name' => [
				'required' => 'Tên danh mục Không được bỏ trống',
				'min_length' => 'Tên danh mục không được nhỏ hơn 3 kí tự',
				'is_unique' => 'Tên danh mục này đã tồn tại',
			],
		];
		if (! $this->validate($rules ,$errors))
		{
			$data['validation'] = $this->validator;
			die(json_encode(array('status' => false , 'messages' => $this->validator->listErrors())));
		}
		else
		{
			$newData = [
				'name' => $this->request->getVar('name'),
			
			];
			$this->category->save($newData);
			die(json_encode(array('status' => true , 'messages' => 'thêm mới thành công')));
		

		}
	}
	public function delete_category()
	{
		$ids = $_POST['hidden_id'];
           
		// If id array is not empty
	   if(!empty($ids)){
		   // Delete records from the database
		   $delete = $this->User_model->delete($ids);
		   
		   // If delete is successful
		   if($delete){
			   echo json_encode(array('status' => true , 'messages' => 'Xóa thành công'));
		   }else{
			   echo json_encode(array('status' => false , 'messages' => 'Xóa không thành công'));
		   }
	   }else{
		   echo json_encode(array('status' => false , 'messages' => 'Xóa không thành công'));
		   
	   }
	}
}