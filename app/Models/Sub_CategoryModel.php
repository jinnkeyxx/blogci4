<?php namespace App\Models;

use CodeIgniter\Model;

class Sub_CategoryModel extends Model{
  protected $table = 'sub_category';
  protected $allowedFields = ['id_category','name'];
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