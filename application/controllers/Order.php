<?php
defined('BASEPATH') OR exit('No direct scribe allowed access');
// buat class
class Order extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $role =$this->session->userdata('role');
        if($role != 'admin'){
            redirect(base_url());
        }
    }
    
    public function index($page=null){
        // untuk tampilannya
        $data['title']='Admin:Order';
        $data['content']=$this->order->orderBY('date','DESC')->paginate($page)->get();
        $data['total_rows']=$this->order->count();
        $data['pagination']=$this->order->makePagination(
            base_url("index.php/order"),2,$data['total_rows']
        );
        $data['page']='pages/order/index';

        $this->view($data);
        
    }
    // buat method detail order
    public function detail($id){
        // cet dulu datanya
        $data['order']=$this->order->where('id',$id)->first();
        if(! $data['order']->id){
            $this->session->set_flashdata('waring','Maaf data Anda tidak ditemukan');
            redirect("index.php/order");
        }
        $this->order->table ='orders_detail';

        $data['orders_detail']=$this->order->select(
            [
            'orders_detail.id_orders','orders_detail.id_product','orders_detail.qty','orders_detail.subtotal',
            'product.image AS product_image','Product.title AS product_title','product.price AS product_price',
            ]
        )
        ->join('product')
        ->where('orders_detail.id_orders',$id)
        ->get();
       if($data['order']->status !=='waiting'){
        $this->order->table ='orders_confirm';
        $data['orders_confirm']=$this->order->where('id_orders',$id)->first();

       }
        $data['page']='pages/order/detail';
        $this->view($data);

    }
}



?>