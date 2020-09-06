<?php

defined('BASEPATH') or exit('No script alloed access');
//buat classs
class Checkout extends MY_Controller{

    // buat vaiabel
    private $id;
    // buat method construct
    public function __construct(){
        parent::__construct();
        $is_login= $this->session->userdata('is_login');
        $this->id = $this->session->userdata('id');
        if(!$is_login){
            redirect(base_url());
            return;
        }
    }
    // buat method untuk menampikan data
    public function index(){
        $this->checkout->table ='cart';

        $data['cart']=$this->checkout->select(
            [
                'cart.id','cart.qty','cart.subtotal',
                'product.title AS product_title ','product.image','product.price AS product_price',
            ]
        )
        ->join('product')
        ->where('cart.id_user',$this->id)
        ->get();
        if(!$data['cart']){
            $this->session->set_flashdata('warning','Tidak ada produk dalam keranjang');
            // kembalikan ke halaman utama
            redirect(base_url());
        }


    $data['title'] ='Checkout';
    $data['page'] ='pages/checkout/index';
    return $this->view($data);
  
    }

}


?>