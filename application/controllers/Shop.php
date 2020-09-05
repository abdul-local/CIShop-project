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

    
}




?>