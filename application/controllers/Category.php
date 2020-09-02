<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller{

    public function __construct()
	{
		parent::__construct();
		// $role = $this->session->userdata('role');
		// if ($role != 'admin') {
		// 	redirect(base_url('/'));
		// 	return;
		// }
	}
    //buat method untuk menampilkan menu di admin
    
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


} 

?>