<?php

defined('BASEPATH') or exit('No script allowed access');

//buat class untuk user
class User extends MY_Controller{

    // buat method construct untuk admin dan member
    public function __construct(){
        parent::__construct();

    }

    // buat method untuk tampilan usernya
    public function index($page = null){
        $data['title']='Admin : Pengguna';
        $data['content']=$this->user->paginate($page)->get();
        $data['total_rows']=$this->user->count();
        $data['pagination']=$this->user->makePagination(
            base_url('index.php/user'),2,$data['total_rows']
        );
        $data['page']='pages/user/index';

        $this->view($data);
    }
}



?>