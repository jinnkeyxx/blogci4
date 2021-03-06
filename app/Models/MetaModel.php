<?php namespace App\Models;

use CodeIgniter\Model;

class MetaModel extends Model{
  protected $table = 'meta';
  protected $allowedFields = ['description', 'region', 'copyright', 'author' , 'position' , 'ICBM'];
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