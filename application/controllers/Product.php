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
			base_url("index.php/product"), 2, $data['total_rows']
		);
        $data['page']		= 'pages/product/index';
        $this->view($data);
    }
    // method untuk search 
	public function search($page = null){
		if(isset($_POST['keyword'])){
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
		}else{
			redirect(base_url('index.php/product'));
		}
		$keyword=$this->session->userdata('keyword');
		$data['title']		= 'Admin: Product';
        $data['content']	= $this->product->select(
            [
                'product.id', 'product.title AS product_title', 'product.image', 
                'product.price', 'product.is_available',
                'category.title AS category_title',
            ]
        )
        ->join('category')
        ->like('product.title',$keyword)
        ->orLike('description',$keyword)
        ->paginate($page)
        ->get();
    $data['total_rows']	= $this->product->count();
    $data['pagination']	= $this->product->makePagination(
        base_url('index.php/product'), 3, $data['total_rows']
    );
		$data['total_rows']	= $this->product->like('product.title',$keyword)->orLike('description',$keyword)->count();
		$data['pagination']	= $this->product->makePagination(
			base_url('index.php/product/search'), 3, $data['total_rows']
		);
		$data['page']		= 'pages/product/index';
		
		$this->view($data);

	}
	// method untuk reset
	public function reset(){
		$this->session->unset_userdata('keyword');
		redirect(base_url('index.php/product'));
	}
    // buat method create
    public function create()
	{
		if (!$_POST) {
			$input	= (object) $this->product->getDefaultValues();
		} else {
			$input	= (object) $this->input->post(null, true);
		}

		if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
			$imageName	= url_title($input->title, '-', true) . '-' . date('YmdHis');
			$upload		= $this->product->uploadImage('image', $imageName);
			if ($upload) {
				$input->image	= $upload['file_name'];
			} else {
				redirect(base_url('index.php/product/create'));
			}
		}

		if (!$this->product->validate()) {
			$data['title']			= 'Tambah Produk';
			$data['input']			= $input;
			$data['form_action']	= base_url('index.php/product/create');
			$data['page']			= 'pages/product/form';

			$this->view($data);
			return;
		}

		if ($this->product->create($input)) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan!');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
		}

		redirect(base_url('index.php/product'));
    }
    // buat method edit
    public function edit($id){
        $data['content']=$this->product->where('id',$id)->first();
        if(!$data['content']){
            $this->session->set_flashdata('warning','maaf data tidak di temukan');
        }
        if(!$_POST){
           $data['input'] =$data['content'];
        }else{
            $data['input']=(object) $this->input->post(null,true);
        }
        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
			$imageName	= url_title($data['input']->title, '-', true) . '-' . date('YmdHis');
			$upload		= $this->product->uploadImage('image', $imageName);
			if ($upload) {
                if($data['content']->image !==''){
                    $this->product->deleteImage($data['content']->image);
                }
				$data['input']->image	= $upload['file_name'];
			} else {
				redirect(base_url("index.php/product/edit/$id"));
			}
        }
        if (!$this->product->validate()) {
			$data['title']			= 'Ubah Produk';
			$data['form_action']	= base_url("index.php/product/edit/$id");
			$data['page']			= 'pages/product/form';

			$this->view($data);
			return;
        }
        if($this->product->where('id',$id)->update($data['input'])){
            $this->session->set_flashdata('success','Data berhasil di simpan');
        }else{
            $this->session->set_flashdata('error','opps! Terjadi suatu kesalahan');
        }

        redirect(base_url("index.php/product"));
    }

    // membuat method delet untuk menghapus data product
    public function delete($id){
        if(!$_POST){
            redirect(base_url('index.php/product'));
        }
        $product=$this->product->where('id',$id)->first();
        if(!$product){
            $this->session->set_flashdata('Warning', 'Maaf data tidak di temukan');
        }
        if($this->product->where('id',$id)->delete()){
            $this->product->deleteImage($product->image);
            $this->session->set_flashdata('success','Data berhasil di hapus');
        }else{
            $this->session->set_flashdata('error','Opps terjadi suatu kesalahan');
        }

        redirect(base_url('index.php/product'));
    }

    public function unique_slug(){

		$slug =$this->input->post('slug');
		$id = $this->input->post('id');
		$product =$this->product->where('slug',$slug)->first();
		if($id == $product->id){
			return true;
		}
		if($product){
			$this->load->library('form_validation');
			$this->form_validation->set_message('unique_slug','%s sudah di gunakan');
			return false;
		}
		return true;
	}

}




?>