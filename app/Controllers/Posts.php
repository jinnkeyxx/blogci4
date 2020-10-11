<?php namespace App\Controllers;
use App\Models\MetaModel;
use App\Models\HeaderModel;
use App\Models\InfoModel;
use App\Models\CategoryModel;
use App\Models\Sub_CategoryModel;
class Posts extends BaseController
{
	
	public $data;
	public $meta;
	public $header;
	public $info;
	public $category;
	public $sub_category;
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
		$this->sub_category = new Sub_CategoryModel();


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
		$ids = $this->request->getVar('hidden_id');
        
		if(!empty($ids))
		{
	 	 
			$delete = $this->category->delete($ids);
		   
		   	if($delete)
			{
			   die( json_encode(array('status' => true , 'messages' => 'Xóa thành công')));
			}
			else
			{
	 		   die( json_encode(array('status' => false , 'messages' => 'Xóa không thành công')));
	  		}
	    }
	    else
	    {
	 	   die( json_encode(array('status' => false , 'messages' => 'Không có lựa chọn nào')));
		   
	    }
	}
	public function update_category()
	{
		$ids = $this->request->getVar('hidden_id');
		$names = $this->request->getVar('name');
		if(!empty($ids))
		{
			for($count = 0; $count < count($ids); $count++)
			{
				if($names[$count] == "")
				{
					die(json_encode(array('status' => false , 'messages' => 'Tên danh mục không được bỏ trống')));
	
				}
				elseif(strlen($names[$count]) <=3 )
				{
					die(json_encode(array('status' => false , 'messages' => 'Tên mục không được nhỏ hơn 3 kí tự')));
	
				}
				else
				{
					$newData = [
						'id' => $ids[$count],
						'name' => $names[$count],
					];
					$this->category->save($newData);
				}
			}
		}
		else
		{
			die(json_encode(array('status' => false , 'messages' => 'Không có lựa chọn nào')));
		}
		return json_encode(array('status' => true , 'messages' => 'Cập nhật thành công'));

	}
	public function load_category()
	{
		$id = $this->request->getVar('id');
		$sub_category = $this->sub_category->where('id_category' , $id)->findAll();
		$stt = 0;
		$html = "";
		foreach($sub_category as $key => $value): 
			$stt = $key+1;
			$html = "<tr role='row' class='even'>
						<td tabindex='0' class='sorting_{$stt}'>
							<input type='checkbox' data-id='{$value['id']}' class='check_box'
								data-name='{$value['name']}' data-stt='{$stt}' id='{$value['id']}' />
								{$stt}
						</td>
						<td tabindex='0'>
							{$value['name']}
						</td>
					</tr>";
		endforeach; 
		die(json_encode(array('status' => true , 'html' => $html)));

	}
	public function load_category_select()
	{
		$id = $this->request->getVar('id');
		$sub_category = $this->sub_category->where('id_category' , $id)->findAll();
		$stt = 0;
		$html = "";
		foreach($sub_category as $key => $value): 
			
			$html = "<option value='{$value['id']}'>{$value['name']}</option>";
		endforeach; 
		die(json_encode(array('status' => true , 'html' => $html)));

	}
	public function add_sub_category()
	{
		$id_category = $this->request->getVar('id_category');
		$name = $this->request->getVar('name');
		if(!empty($id_category) && !empty($name)){
			$newData = [
				'id_category' => $id_category,
				'name' => $name,
			];
			$this->sub_category->save($newData);
			die(json_encode(array('status' => true , 'messages' => 'thêm mới danh mục con thành công')));
			
		}
		else {
			die(json_encode(array('status' => false , 'messages' => 'Lỗi thêm mới danh mục con')));
		}
	}
	public function delete_sub_category()
	{
		$ids = $this->request->getVar('hidden_id');
        
		if(!empty($ids))
		{
	 	 
			$delete = $this->sub_category->delete($ids);
		   
		   	if($delete)
			{
			   die( json_encode(array('status' => true , 'messages' => 'Xóa thành công')));
			}
			else
			{
	 		   die( json_encode(array('status' => false , 'messages' => 'Xóa không thành công')));
	  		}
		}else
		{
	 	   die( json_encode(array('status' => false , 'messages' => 'Không có lựa chọn nào')));
		   
	    }
	}
	public function update_sub_category()
	{
		$ids = $this->request->getVar('hidden_id');
		$names = $this->request->getVar('name');
		if(!empty($ids))
		{
			for($count = 0; $count < count($ids); $count++)
			{
				if($names[$count] == "")
				{
					die(json_encode(array('status' => false , 'messages' => 'Tên danh mục không được bỏ trống')));
	
				}
				elseif(strlen($names[$count]) <=3 )
				{
					die(json_encode(array('status' => false , 'messages' => 'Tên mục không được nhỏ hơn 3 kí tự')));
	
				}
				else
				{
					$newData = [
						'id' => $ids[$count],
						'name' => $names[$count],
					];
					$this->sub_category->save($newData);
					die(json_encode(array('status' => true , 'messages' => 'Cập nhật thành công')));
				}
			}
		}
		else
		{
			die(json_encode(array('status' => false , 'messages' => 'Không có lựa chọn nào')));
		}
	}
}