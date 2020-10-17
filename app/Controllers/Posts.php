<?php namespace App\Controllers;
use App\Models\MetaModel;
use App\Models\HeaderModel;
use App\Models\InfoModel;
use App\Models\CategoryModel;
use App\Models\Sub_CategoryModel;
use App\Models\PostModel;
class Posts extends BaseController
{
	
	public $data;
	public $meta;
	public $header;
	public $info;
	public $category;
	public $sub_category;
	public $post;
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
		$this->post = new PostModel();

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
				'slug' => $this->to_slug($this->request->getVar('name')),
			
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
						'slug' => $this->to_slug($names[$count]),
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
				'slug' => $this->to_slug($this->request->getVar('name')),
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
						'slug' => $this->to_slug($names[$count]),
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
	public function write_post()
	{
		$rules = [
			'image_title' => 'required|min_length[6]|valid_url',
			'title_post' => 'required|min_length[6]',
			'category' => 'required',
			'sub_category_select' => 'required',
			'meta_keywork' => 'required|min_length[3]',
			'meta_description' => 'required|min_length[3]',
			'content' => 'required|min_length[6]',
			
		];
		if (! $this->validate($rules))
		{
			$data['validation'] = $this->validator;
			echo json_encode(array('status' => false , 'messages' =>'Thêm bài thất bại'));
		}
		else 
		{
			$newData = [
				'image_title' => $this->request->getVar('image_title'),
				'title_post' => $this->request->getVar('title_post'),
				'category' => $this->request->getVar('category'),
				'sub_category_select' => $this->request->getVar('sub_category_select'),
				'meta_keywork' => $this->request->getVar('meta_keywork'),
				'meta_description' => $this->request->getVar('meta_description'),
				'content' => $this->request->getVar('content'),
				'slug' => $this->to_slug($this->request->getVar('title_post')).rand(1000,9999),
			];
			$this->post->save($newData);
			echo json_encode(array('status' => true , 'messages' =>'Thêm bài thành công'));
		}
		
	}
	public function delete_post()
	{
		$id = $this->request->getVar('id');
        
		if(!empty($id))
		{
			$delete = $this->post->delete($id);
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
	public function edit_post()
	{
		$rules = [
			'image_title' => 'required|min_length[6]|valid_url',
			'title_post' => 'required|min_length[6]',
			'category' => 'required',
			'sub_category_select' => 'required',
			'meta_keywork' => 'required|min_length[3]',
			'meta_description' => 'required|min_length[3]',
			'content' => 'required|min_length[6]',
			
		];
		if (! $this->validate($rules))
		{
			$data['validation'] = $this->validator;
			echo json_encode(array('status' => false , 'messages' =>'Thêm bài thất bại'));
		}
		else 
		{
			$slug = $this->to_slug($this->request->getVar('title_post')).rand(1000,9999);
			$newData = [
				'id' => $this->request->getVar('id'),
				'image_title' => $this->request->getVar('image_title'),
				'title_post' => $this->request->getVar('title_post'),
				'category' => $this->request->getVar('category'),
				'sub_category_select' => $this->request->getVar('sub_category_select'),
				'meta_keywork' => $this->request->getVar('meta_keywork'),
				'meta_description' => $this->request->getVar('meta_description'),
				'content' => $this->request->getVar('content'),
				'slug' => $slug,
				
			];
			$this->post->save($newData);
			echo json_encode(array('status' => true , 'messages' =>'Thêm bài thành công' ,'slug' => base_url().'/posts/edit/'.$slug));
		}
		
	}
	
	private function to_slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
	
}