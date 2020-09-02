<?php
defined('BASEPATH') or exit ('No script access allowed');

class Product extends MY_Controller {

    public function __construct(){
        parent::__construct();

    }
    //buat method 
    public function index($page = null)
	{
		$data['title']		= 'Admin: Produk';
		$data['content']	= $this->product->select(
				[
					'product.id', 'product.title AS product_title', 'product.image', 
					'product.price', 'product.is_available',
					'category.title AS category_title',
				]
			)
			->join('category')
			->paginate($page)
			->get();
		$data['total_rows']	= $this->product->count();
		$data['pagination']	= $this->product->makePagination(
			base_url('product'), 2, $data['total_rows']
		);
		$data['page']		= 'pages/product/index';

		$this->view($data);
    }
    // buat method create
    public function create(){
        if(!$_POST){
            $input = $this->product->getDefaultValues();
        }else{
            $input = $this->input->post(null, true);
        }
        if(!empaty($_FILES) && $_FILES['image']['name'] !==''){
            $imageName = url_title($input->title,'-'. date('YmdHis'));
            $upload = $this->product->uploadImage('image',$iamgeName);
            if($upload){
                $input->image = $upload['file_name'];
            }else{
                redirect(base_url('index.php/product'));
            }

        }
        if(!$this->product->validate()){
            $data['title'] = 'Tambah Produk';
            $data['input'] = $input;
            $data['form_action'] = base_url('product/create');
            $data['page']='pages/product/form';

            $this->view($data);

            return ;
        }
        if($this->product->create($input)){
            $this->session->set_flashdata('success','Data berhasil di simmpan');
        }else{
            $this->session->set_flashdata('error','Opps terjadi kesalhan');
        }

        redirect(base_url('index.php/product'));
    }
}




?>