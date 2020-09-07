<?php
defined('BASEPATH') OR exit('No direct scribe allowed acces');

// buat class
class Myorder_model extends MY_Model
{

    public $table = 'orders';

    // membuat method confirmasi
    public function getDefalutValues(){
        return [
            'id_orders'=>'',
            'account_name'=>'',
            'account_number'=>'',
            'nomial'=>'',
            'note'=>'',
            'image'=>'',

        ];
    }
    // membuat method untuk validationRules
    public function ValidationRules(){
        $validationRules=[
            [
                'field'=>'account_name',
                'label'=>'Nama Pemilik',
                'rules'=>'trim|required',
            ],
            [
                'field'=>'account_number',
                'label'=>'No Rekening',
                'rules'=>'trim|required|length[50]',
            ],
            [
                'field'=>'nominal',
                'label'=>'Nominal',
                'rules'=>'trim|numeric|required',
            ],
            [
                'field'=>'note',
                'label'=>'Catetan',
                'rules'=>'trim|required',
            ],
            [
                'field'=>'image',
                'label'=>'Bukti Transaksi',
                'rules'=>'callback_image_required',
            ]
            ];
            return $validationRules;
    }
    // membuat method untuk upload data
    public function UploadImage($fieldName,$fileName){
        $config= [

            'upload_path'=>'./images/confirm',
            'file_name'=>$fileName,
            'allowed_type'=>'jpg|png|gif|jpeg|JPG|PNG',
            'max_size'=>1024,
            'max_width'=>0,
            'max_height'=>0,
            'overwrite'=>true,
            'file_ext_tolower'=>true

        ];
        $this->load->libary('upload',$config);
        if($this->upload->do_upload($fileName)){
            return $this->upload->data();
        }else{
            $this->session->set_flashdata('image_error',$this->upload->display_errors('',''));
            return false;
        }
    }



}


?>