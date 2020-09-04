<?php

defined('BASEPATH') or exit('No script allowed access');

//buat class untuk user
class User extends MY_Controller{

    // buat method construct untuk admin dan member
    public function __construct(){
        parent::__construct();

    }

    // buat method untuk tampilan usernya
    public function index($page = null){
        $data['title']='Admin : Pengguna';
        $data['content']=$this->user->paginate($page)->get();
        $data['total_rows']=$this->user->count();
        $data['pagination']=$this->user->makePagination(
            base_url('index.php/user'),2,$data['total_rows']
        );
        $data['page']='pages/user/index';

        $this->view($data);
    }

    // method untuk search 
	public function search($page = null){
		if(isset($_POST['keyword'])){
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
		}else{
			redirect(base_url('index.php/user'));
		}
		$keyword=$this->session->userdata('keyword');
		$data['title']		= 'Admin: user';
        $data['content']	= $this->user
        ->like('name',$keyword)
        ->orLike('email',$keyword)
        ->paginate($page)
        ->get();
    $data['total_rows']	= $this->user->count();
    $data['pagination']	= $this->user->makePagination(
        base_url('index.php/user'), 2, $data['total_rows']
    );
		$data['total_rows']	= $this->user->like('name',$keyword)->orLike('email',$keyword)->count();
		$data['pagination']	= $this->user->makePagination(
			base_url('index.php/user/search'), 3, $data['total_rows']
		);
		$data['page']		= 'pages/user/index';
		
		$this->view($data);

	}
	// method untuk reset
	public function reset(){
		$this->session->unset_userdata('keyword');
		redirect(base_url('index.php/user'));
	}
    // buat method create
    public function create()
	{
		if (!$_POST) {
			$input	= (object) $this->user->getDefaultValues();
		} else {
            $input	= (object) $this->input->post(null, true);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
			$input->password = hashEncrypt($input->password);
		}

		if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
			$imageName	= url_title($input->name, '-', true) . '-' . date('YmdHis');
			$upload		= $this->user->uploadImage('image', $imageName);
			if ($upload) {
				$input->image	= $upload['file_name'];
			} else {
				redirect(base_url('index.php/user/create'));
			}
		}

		if (!$this->user->validate()) {
			$data['title']			= 'Tambah pengguna';
			$data['input']			= $input;
			$data['form_action']	= base_url('index.php/user/create');
			$data['page']			= 'pages/user/form';
			$this->view($data);
			return;
		}

		if ($this->user->create($input)) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan!');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
		}

		redirect(base_url('index.php/user'));
    }
      // buat method edit
      public function edit($id){
        $data['content']=$this->user->where('id',$id)->first();
        if(!$data['content']){
            $this->session->set_flashdata('warning','maaf data tidak di temukan');
        }
        if(!$_POST){
           $data['input'] =$data['content'];
        }else{
            $data['input']=(object) $this->input->post(null,true);
            if($data['input']->password !== ''){
            $data['input']->password = hashEncrypt($data['input']->password);

            }else{
                $data['input']->password = $data['content']->password;
            }
        }
        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
			$imageName	= url_title($data['input']->name, '-', true) . '-' . date('YmdHis');
			$upload		= $this->user->uploadImage('image', $imageName);
			if ($upload) {
                if($data['content']->image !==''){
                    $this->user->deleteImage($data['content']->image);
                }
				$data['input']->image	= $upload['file_name'];
			} else {
				redirect(base_url("index.php/user/edit/$id"));
			}
        }
        if (!$this->user->validate()) {
			$data['title']			= 'Ubah Produk';
			$data['form_action']	= base_url("index.php/user/edit/$id");
			$data['page']			= 'pages/user/form';

			$this->view($data);
			return;
        }
        if($this->user->where('id',$id)->update($data['input'])){
            $this->session->set_flashdata('success','Data berhasil di simpan');
        }else{
            $this->session->set_flashdata('error','opps! Terjadi suatu kesalahan');
        }

        redirect(base_url("index.php/user"));
    }

    // membuat method delet untuk menghapus data user
    public function delete($id){
        if(!$_POST){
            redirect(base_url('index.php/user'));
        }
        $user=$this->user->where('id',$id)->first();
        if(!$user){
            $this->session->set_flashdata('Warning', 'Maaf data tidak di temukan');
        }
        if($this->user->where('id',$id)->delete()){
            $this->user->deleteImage($user->image);
            $this->session->set_flashdata('success','Data berhasil di hapus');
        }else{
            $this->session->set_flashdata('error','Opps terjadi suatu kesalahan');
        }

        redirect(base_url('index.php/user'));
    }

    public function unique_email(){

		$email =$this->input->post('email');
		$id = $this->input->post('id');
        $user =$this->user->where('email',$email)->first();
        
        if ($user) {
			if ($id == $user->id) {
				return true;
			}
			$this->load->library('form_validation');
			$this->form_validation->set_message('unique_email', '%s sudah digunakan!');
	     	return false;
        }
        return true;
		
	}
}



?>