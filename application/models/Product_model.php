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
     //membuat method untuk uploadingImage
     public function uploadImage($fieldName,$fileName){
        $config =[
            'upload_path'=>'./images/product',
            'file_name' => $fileName,
            'allowed_types'=>'jpg|gif|png|jpeg|JPG|PNG',
            'max_size' =>1024,
            'max_width'=>0,
            'max_height'=>0,
            'overwrite'=>true,
            'file_ext_tolower'=>true
        ];

        $load->load->library('upload',$config);
        if($this->upload->do_upload($fileName)){
            return $this->upload->data();
        }else{
            $this->session->set_flashdata('image_error',$this->upload->display_error('',''));
            return false;
        }

    }

    
}

?>