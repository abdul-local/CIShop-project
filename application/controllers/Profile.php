<?php

defined('BASEPATH') or exit('No script allowed access');

//buat class untuk user
class Profile extends MY_Controller{
    private $id;

    // buat method construct untuk admin dan member
    public function __construct(){
        parent::__construct();
        $is_login = $this->session->userdata('is_login');
        $this->id =$this->session->userdata('id');
        if(!$is_login){
            redirect(base_url());
            return;
        }

    }
  public function index(){
    $data['title']='Profile';
    $data['content']= $this->profile->where('id',$this->id)->first();
    $data['page']='pages/profile/index';

    return $this->view($data);

}


}




?>