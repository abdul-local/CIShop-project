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
    public function index($input = null){
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

    $data['input'] = $input ? $input : (object) $this->input->getDefaultValidation();
    $data['title'] ='Checkout';
    $data['page'] ='pages/checkout/index';
    return $this->view($data);
  
    }
    // buat method create
    public function create(){
        if(!$_POST){
            redirect(base_url());
        }else{
           $input = (object) $this->input->post(null,true);
        }
        if(!$this->checkout->validate()){
            return $this->index($input);
        }
        $total= $this->db->select_sum('subtotal')->where('id_user',$this->id)->get('cart')->row()->subtotal;
        $data =[
            'id_user'=>$this->id,
            'date'=>date('Y-m-d'),
            'invoice'=>$this->id.date('YmdHis'),
            'total'=>$total,
            'name'=>$input->name,
            'adress'=>$input->adress,
            'phone'=>$input->phone,
            'status'=>'waiting',
            
        ];
        if($order=$this->checkout->create()){
            $cart= $this->db->where('id_user',$this->id)
            ->get('cart')->result_array();
            foreach($cart as $row){
                $row['id_orders'] = $order;
                unset($row['id'],$row['id_user']);
                $this->db->insert('orders_detail',$row);
            }
            $this->db->delete('cart',['id_user'=>$this->id]);
            $this->session->set_flashdata('success','Data berhasil disimpan ');
            $data['title']='Checkout success';
            $data['content']= (object) $data;
            $data['page']='pages/checkout/success';

            return $this->view($data);
        }else{
            $this->session->set_flashdata('error','Opps! terjadi suatu kesalahan');
            return $this->index($input);
        }
    }

}


?>