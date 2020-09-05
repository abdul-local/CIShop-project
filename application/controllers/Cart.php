<?php
defined('BASEPATH') or exit ('No script Allowed acces');

// buat class
class Cart extends MY_Controller {
    protected $id;
    // buat method
    public function __construct(){
        parent:: __construct();
        $is_login=$this->session->userdata('is_login');
        $this->id = $this->session->userdata('id');
        if(!is_login){
            redirect(base_url());
            return;
        }

    }
    // buat method add
    public function add(){
        if(!$_POST){
            redirect(base_url());
            return;
        }else{
            $input = (object) $this->input->post(null, true);
            $this->cart->table ='product';
            $product = $this->cart->where('id',$input->id_product)->first();
            $subtotal= $cart->subtotal + $subtotal;

            $cart=$this->cart->where('id_user',$this->id)->where('id_product',$input->id)->first();
            $subtotal =$product->price * $input->qty;
            if($cart){
                $data =[
                    'qty'=>$cart->qty + $input->qty,
                    '$subtotal'=>$cart->subtotal + $subtotal,
                ];
                if($this->cart->where('id',$cart->id)->update($data)){
                    $this->session->set_flashdata('success','Product berhasil di tambah');
                }else{
                    $this->session->set_flashdata('error','Oops terjadi kesalahan');
                }
                redirect(base_url());
            }

            $data =[
                'id_user'=>$this->id,
                'id_product'-$input->id_product,
                'qty'=>$cart->$iput->qty,
                '$subtotal'=>$subtotal,
            ];
            if($this->cart->create($data)){
                $this->session->set_flashdata('success','Product berhasil di tambah');
            }else{
                $this->session->set_flashdata('error','Oops terjadi kesalahan');
            }
            redirect(base_url());
        }
    }
}


?>