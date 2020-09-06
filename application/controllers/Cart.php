<?php
defined('BASEPATH') or exit ('No script Allowed acces');

// buat class
class Cart extends MY_Controller {
    private $id;
    // buat method
    public function __construct(){
        parent:: __construct();
        $is_login=$this->session->userdata('is_login');
        $this->id = $this->session->userdata('id');
        if(!$is_login){
            redirect(base_url());
            return;
        }

    }
    // membuat method index
    public function index(){
        $data['title']='Keranjang Belanja';
        $data['content']=$this->cart->select(
            [
                'cart.id','cart.qty','cart.subtotal',
                'product.title ','product.image','product.price AS product_price',
            ]
        )
        ->join('product')
        ->where('cart.id_user',$this->id)
        ->get();
        $data['page']='pages/cart/index';
        return $this->view($data);
    }

    // buat method add
    public function add(){
        if(!$_POST || $this->input->post('qty') < 1){
            $this->session->set_flashdata('error','Kuantitas tidak boleh kosong');
            redirect(base_url());
            return;
        }else{
            $input = (object) $this->input->post(null, true);
            $this->cart->table ='product';
            $product = $this->cart->where('id',$input->id_product)->first();
            $subtotal =$product->price * $input->qty;
            $this->cart->table ='cart';
            $cart= $this->cart->where('id_user',$this->id)->where('id_product',$input->id_product)->first();
            if($cart){
                $data =[
                    'qty'=>$cart->qty + $input->qty,
                    'subtotal'=>$cart->subtotal + $subtotal,
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
                'id_product'=>$input->id_product,
                'qty'=>$input->qty,
                'subtotal'=>$subtotal,
            ];
            if($this->cart->create($data)){
                $this->session->set_flashdata('success','Product berhasil di tambah');
            }else{
                $this->session->set_flashdata('error','Oops terjadi kesalahan');
            }
            redirect(base_url());
        }
    }
    // buat method untuk update
    public function update($id){
        if(!$_POST || $this->input->post('qty') < 1){
            $this->session->set_flashdata('error','kuatitas yang anda masukan kurang dari 1');
            redirect(base_url("index.php/cart/index"));
        }
        $data['content']=$this->cart->where('id',$id)->first();
        // jika tidak ada data
        if(!$data['content']){
            $this->session->set_flashdata('waring','Data tidak di temukan');
            redirect(base_url("index.php/cart/index"));
        }
        $data['input']= (object) $this->input->post(null,true);
        $this->cart->table ='product';
        $product=$this->cart->where('id',$data['content']->id_product)->first();
        $subtotal =$product->price * $data['input']->qty;

        $cart=[
            'qty'=>$data['input']->qty,
            'subtotal'=>$subtotal,

        ];

        $this->cart->table='cart';

        if($this->cart->where('id',$id)->update($cart)){
            $this->session->set_flashdata('success','Data Berhasil di simpan');
        }else{
            $this->session->set_flashdata('error','Opps terjadi kesalahan');
        }

        redirect(base_url('index.php/cart/index'));


    }
    // membeuat methdo delet
    public function delete($id){
    if(!$_POST){
        redirect(base_url("index.php/cart/index"));
    }
    if(!$this->cart->where('id',$id)->first()){
        $this->session->set_flashdata('warning','Maaf! Data tidak di temukan');
        redirect(base_url("index.php/cart/index"));
    }
    if($this->cart->where('id',$id)->delete()){
        $this->session->set_flashdata('succes','Data Berhasil di Hapus');
    }else{
        $this->session->set_flashdata('error','Opss! terjadi kesalahan');
    }
    redirect(base_url("index.php/cart/index"));
}
}


?>