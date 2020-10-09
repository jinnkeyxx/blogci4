<?php namespace App\Models;

use CodeIgniter\Model;

class HeaderModel extends Model{
  protected $table = 'header';
  protected $allowedFields = ['logo', 'title_logo', 'banner', 'title_banner'];
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