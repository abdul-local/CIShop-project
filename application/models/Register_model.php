<?php
defined('BASEPATH') or exit('No direct script access allowed ');
class Register_model extends My_Model {

    protected $table ='user';
    public function getDefaulValues(){
        return [
            'name' => '',
            'email'=>'',
            'password'=>'',
            'role'=>'',
            'is_active'=>''
        ];
    }
    public function getValidationRules(){
        $validationRules = [
            [
            'field' =>'name',
            'label' =>'Nama',
            'rules' =>'trim|required'
            ],
            [
                'field'=>'email',
                'label'=>'Email',
                'rules'=>'trim|required|valid_email|is_unique[user.email]',
                'errors'=>
                [

                    'is_unique'=>'this %s already exist.'

                ]
                ],
                [
                    'field' =>'password',
                    'label' =>'Password',
                    'rules' =>'required|is_length[8]',
                ],
                [
                    'field' =>'password_confirmation',
                    'label' =>'konfirmasi Password',
                    'rules' =>'required|match[password]',
                ],

    ];
    return $validationRules;
    }
    public function run($input){
        $data =[
            'name' =>$input->name,
            'email' =>strtolower($input->email),
            'password'=>hashEncrypt($input->name),
            'role'=>'mamber'
        ];
        $user=$this->create($data);

        $sess_data =[
            'id'=>$user,
            'name'=>$data['name'],
            'email'=>$data['email'],
            'role'=>$data['role'],
            'is_login'=>true,
        ];
        $this->session->set_userdata($sess_data);
        return true;
    }
}


?>