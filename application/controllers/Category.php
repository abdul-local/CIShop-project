<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller{
    public function __construct(){
        parent::__construct();
    }
    //buat method untuk menampilkan menu di admin
    public function index($page=null){
        $data['title']='Admin:Categori';
        $data['content']=$this->category->paginate($page)->get();
        $data['total_row']=$this->cateory->count();
        $data['pagination']=$this->category->makePagination(base_url('index.php/category'),2, $data['total_row']);


    }

} 

?>