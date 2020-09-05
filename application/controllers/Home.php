<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller 
{
    public function index($page = null)
    {
        $data['title'] = 'Homepage';
        $data['content']	= $this->home->select(
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
        ->paginate($page)
        ->get();
    $data['total_rows']	= $this->home->where('product.is_available',1)->count();
    $data['pagination']	= $this->home->makePagination(
        base_url("index.php/home"), 2, $data['total_rows']
    );
        $data['page'] ='pages/home/index';
        $this->view($data);
    }
    
}


?>