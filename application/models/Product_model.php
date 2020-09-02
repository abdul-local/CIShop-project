<?php
defined('BASEPATH') OR exit('No script allowed access');

class Product_model extends MY_Model {
    protected $perPage = 5;

    //buat method defaultValues
    public function getDefaultValues(){
        return [
            'id_category'=>'',
            'slug' =>'',
            'title'=>'',
            'description'=>'',
            'price'=>'',
            'is_available'=>1,
            'image'=>'',

        ];


    }
    //buat metod untuk validationrules
    public function getValidationRules(){
        $validationRules=[
            [
                'field'=>'id_category',
                'label'=>'Kategori',
                'rules'=>'required',
            ],
            [
                'field'=>'slug',
                'label'=>'Slug',
                'rules'=>'trim|required|callback_unique_slug',
            ],

            [
                'field'=>'title',
                'label'=>'Nama Produk',
                'rules'=>'trim|required',
            ],
            [
                'field'=>'descriptio',
                'label'=>'Deskripsi',
                'rules'=>'trim|required',
            ],
            [
                'field'=>'price',
                'label'=>'Harga',
                'rules'=>'trim|required|numeric',
            ],
            [
                'field'=>'is_available',
                'label'=>'Ketersediaan',
                'rules'=>'trim|required',
            ],

            ];

    }

    
}

?>