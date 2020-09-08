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
            base_url("index.php/order"),3,$data['total_rows']
        );
        $data['page']='pages/order/index';

        $this->view($data);
        
    }
}



?>