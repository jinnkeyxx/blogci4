<?php namespace App\Models;

use CodeIgniter\Model;

class InfoModel extends Model{
  protected $table = 'info';
  protected $allowedFields = ['facebook', 'twitter', 'gmail', 'youtube' , 'appid_fb' , 'appsecret_fb' , 'appid_gg' , 'appsecret_gg'];
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