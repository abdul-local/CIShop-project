<?php
defined('BASEPATH') or exit ('No script access Allowed');
// buat class
class Checkout_model extends MY_Model {
    public $table ='orders';
    // buat method untuk nilai defaul
    public function geDefaultValues(){
        return [
            'name'=>'',
            'address'=>'',
            'phone'=>'',
            'status'=>'',
        ];

    }
    // buat method untuk validationRules
    public function getValidationRules(){
        $validationRules =[
            [
                'field'=>'name',
                'label'=>'Nama',
                'rules'=>'trim|required',
            ],
            [
                'field'=>'address',
                'label'=>'Alamat',
                'rules'=>'trim|required',
            ],
            [
                'field'=>'phone',
                'label'=>'Telepon',
                'rules'=>'trim|required|max_length[15]',
            ],

            ];
        return $validationRules;
    }

}




?>
