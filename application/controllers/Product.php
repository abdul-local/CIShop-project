<?php
defined('BASEPATH') or exit ('No script access allowed');

class Product extends MY_Controller {

    public function __construct(){
        parent::__construct();

    }
    //buat method 
    public function index($page = null){
        $data['title']='Admin : Product';
        $data['content']=$this->product->select(
            ['product.id','product.title AS product_title'.'product.image',
            'product.price','product.avaible',
            'category.title AS category_title'
            ]
        )->join('category')
        ->paginate($page)
        ->get();
        $data['total_rows']=$this->product->count();
        $data['pagination']=$this->product->makePagination(
            base_url('index.php/product'), 2 ,$data['total_rows']
        );
        $data['page']='pages/product/index';
        $this->view($data);

    }
}




?>