<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller{

    public function __construct()
	{
		parent::__construct();
	
	}
    
	public function index($page = null)
	{
		$data['title']		= 'Admin: Category';
		$data['content']	= $this->category->paginate($page)->get();
		$data['total_rows']	= $this->category->count();
		$data['pagination']	= $this->category->makePagination(
			base_url('index.php/category'), 2, $data['total_rows']
		);
		$data['page']		= 'pages/category/index';
		
		$this->view($data);
	}
	// method untuk search 
	public function search($page = null){
		if(isset($_POST['keyword'])){
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
		}else{
			redirect(base_url('index.php/category'));
		}
		$kyeword=$this->session->userdata('keyword');
		$data['title']		= 'Admin: Category';
		$data['content']	= $this->category->like('title',$kyeword)->paginate($page)->get();
		$data['total_rows']	= $this->category->like('title',$kyeword)->count();
		$data['pagination']	= $this->category->makePagination(
			base_url('index.php/category/search'), 3, $data['total_rows']
		);
		$data['page']		= 'pages/category/index';
		
		$this->view($data);

	}
	// method untuk reset
	public function reset(){
		$this->session->unset_userdata('keyword');
		redirect(base_url('index.php/category'));
	}


	public function create(){
		if(!$_POST){
			$input = (object) $this->category->getDefaultValues();
		}else{
			$input = (object) $this->input->post(null,true);
		}
		if(!$this->category->validate()){
			$data['title']='Tambah Kategori';
			$data['input']=$input;
			$data['form_action']=base_url('index.php/category/create');
			$data['page']='pages/category/form';
			$this->view($data);
			return ;

		}
		if($this->category->create($input)){
			$this->session->set_flashdata('success','Data Berhasil di inputkan');
		}else{
			$this->session->set_flashdata('error','!Opss terjadi kesalahan');
		}

		redirect(base_url('index.php/category'));

	}
	public function edit($id){
		$data['content']=$this->category->where('id',$id)->first();

		if(!$data['content']){
			$this->session->set_flashdata('warning','Maaf! Data tidak di temukan');
			redirect(base_url('index.php/category'));
		}

		if(!$_POST){
			$data['input']=$data['content'];
		}else{
			$data['input']= (object) $this->input->post(null, true);
		}

		if(!$this->category->validate()){
			$data['title']='Edit Kategori';
			$data['form_action']=base_url("index.php/category/edit/$id");
			$data['page']='pages/category/form';

			$this->view($data);
			return ;

		}
		if($this->category->where('id',$id)->update($data['input'])){
			$this->session->set_flashdata('success','Data sudah berhasil di edit');
		}else{
			$this->session->set_flashdata('error','Opps terjadi kesalhan');
		}
		redirect(base_url('index.php/category'));
	}
	//membuat method untuk delete
	public function delete($id){

		if(!$_POST){
			redirect(base_url('index.php/category'));
		}
		if(!$this->category->where('id',$id)->first()){
			$this->session->set_flashdata('warning','Maaf data tidak di temukan');
		}
		if($this->category->where('id',$id)->delete()){
			$this->session->set_flashdata('success','Data sudah berhasil dihapus');
		}else{
			$this->session->set_flashdata('error','Opps ! Terjadi suatu kesalhan');
		}
		redirect(base_url('index.php/category'));
	}


	public function unique_slug(){

		$slug =$this->input->post('slug');
		$id = $this->input->post('id');
		$category =$this->category->where('slug',$slug)->first();
		if($id == $category->id){
			return true;
		}
		if($category){
			$this->load->library('form_validation');
			$this->form_validation->set_message('unique_slug','%s sudah di gunakan');
			return false;
		}
		return true;
	}


} 

?>