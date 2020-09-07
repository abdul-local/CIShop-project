<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Myorder extends MY_Controller 
{
	private $id;

	public function __construct()
	{
		parent::__construct();
		$is_login	= $this->session->userdata('is_login');
		$this->id	= $this->session->userdata('id');

		if (! $is_login) {
			redirect(base_url());
			return;
		}
	}

	public function index()
	{
		$data['title']		= 'Daftar Order';
		$data['content']	= $this->myorder->where('id_user', $this->id)
								->orderBy('date', 'DESC')->get();
		$data['page']		= 'pages/myorder/index';

		return $this->view($data);
    }
    
    //membuat method detai detail order
    
    public function detail($invoice){
       $data['order'] =$this->myorder->where('invoice',$invoice)->first();
       if(!$data['order']){
           $this->session->set_flashdata('error','Maaf data tidak ditemukan !');
           redirect(base_url("index.php/myorder"));
       }
       $this->myorder->table ="orders_detail";
       $data['orders_detail']= $this->myorder->select(
           [
               'orders_detail.id_orders','orders_detail.id_product','orders_detail.qty','orders_detail.subtotal',
               'product.title AS product_title','product.image AS product_image','product.price AS product_price',
           ]
       )
       ->join('product')
       ->where('orders_detail.id_orders',$data['order']->id)
       ->get();

       $data['page']='pages/myorder/detail';
       $this->view($data);

    }
}



?>