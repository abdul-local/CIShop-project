<?php
defined('BASEPATH') OR exit('No direct access allowed');
class My_Model extends CI_Model{
    protected $table = ' ';
    // buat fungsi untuk construct
    public function _construct(){
        parent::_construct();
        // kita cek tabel
        if(!$this->table){
            $this->table = strtolower (
                str_replace('_model','',get_class($this))
            );
        }
       

    }
     // buat method validation input
     public function validate(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimeters(
            '<small class="form-text text-danger">','</small>'

        );
        $validateRule=$this->getValidationRules();
        $this->form_validation->set_rules($validateRule);
        return $this->form_validation->run();
}
}

?>