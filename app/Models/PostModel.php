<?php namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model{
  protected $table = 'post';
  protected $allowedFields = ['image_title', 'title_post', 'category', 'sub_category_select' , 'meta_keywork' , 'meta_description' , 'content' ,'slug'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];
  protected function beforeInsert(array $data){
    
    $data['data']['created_at'] = date('Y-m-d H:i:s');

    return $data;
  }

  protected function beforeUpdate(array $data){
    
    $data['data']['updated_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  
  

  


}