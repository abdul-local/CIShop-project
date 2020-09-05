<?php
defined('BASEPATH') or exit('No scriot access Allowed');
class Shop extends MY_Controller{
    // buat method
    public function orderby($sort,$page = null){
        $data['title'] = 'Belanja';
        $data['content']	= $this->shop->select(
            [
                'product.id', 'product.title AS product_title', 
                'product.description AS product_description',
                'product.image', 
                'product.price AS product_price', 'product.is_available',
                'category.title AS category_title',
                'category.slug AS category_slug',
                
            ]
        )
        ->join('category')
        ->where('product.is_available',1)
        ->orderBy('product_price',$sort)
        ->paginate($page)
        ->get();
    $data['total_rows']	= $this->shop->where('product.is_available',1)->count();
    $data['pagination']	= $this->shop->makePagination(
        base_url("index.php/shop/orderby/$sort"), 5, $data['total_rows']
    );
        $data['page'] ="pages/home/index";
        $this->view($data);
    }
    // buat method untuk katgory
    public function category($category,$page = null){
        $data['title'] = 'Category';
        $data['content']	= $this->shop->select(
            [
                'product.id', 'product.title AS product_title', 
                'product.description AS product_description',
                'product.image', 
                'product.price AS product_price', 'product.is_available',
                'category.title AS category_title',
                'category.slug AS category_slug',
            ]
        )
        ->join('category')
        ->where('product.is_available',1)
        ->where('category.slug',$category)
        ->paginate($page)
        ->get();
    $data['total_rows']	= $this->shop->where('product.is_available',1)->where('category.slug',$category)->join('category')->count();
    $data['pagination']	= $this->shop->makePagination(
        base_url("index.php/shop/category/$category"), 5, $data['total_rows']
    );
        $data['category']=ucwords(str_replace('-','',$category));
        $data['page'] ="pages/home/index";
        $this->view($data);
    }
    // method untuk search 
	public function search($page = null){
		if(isset($_POST['keyword'])){
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
		}else{
			redirect(base_url('index.php/home'));
		}
		$keyword=$this->session->userdata('keyword');
		$data['title']		= 'search product';
        $data['content']	= $this->shop->select(
            [
                'product.id', 'product.title AS product_title', 'product.image', 
                'product.price AS product_price', 'product.is_available','product.description AS product_description',
                'category.title AS category_title',
                'category.slug AS category_slug',
            ]
        )
        ->join('category')
        ->like('product.title',$keyword)
        ->orLike('description',$keyword)
        ->paginate($page)
        ->get();
    $data['total_rows']	= $this->shop->count();
    $data['pagination']	= $this->shop->makePagination(
        base_url('index.php/shop'), 3, $data['total_rows']
    );
		$data['total_rows']	= $this->shop->like('product.title',$keyword)->orLike('product.description',$keyword)->count();
		$data['pagination']	= $this->shop->makePagination(
			base_url('index.php/shop/search'), 3, $data['total_rows']
		);
		$data['page']		= 'pages/home/index';
		
		$this->view($data);

	}

    
}




?>