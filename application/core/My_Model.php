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
    //membuat method select untuk menentukan colom mana saja yang bisa di akses oleh database
    public function select($column){
        $this->db->select($column);
        return $this;
    }
    // membuat method where untuk mecari data di dalam database
    public function where($column,$condition){
        $this->db->where($column,$condition);
        return $this;
    }
    // membuat method dengan like 
    public function like($column,$condition){
        $this->db->like($column,$condition);
        return $this;
    }
    // membuat method dengan orlike dengan fungsi yang lebih dari method like
    public function orlike($column,$condition){
        $this->db->or_like($column,$condition);
        return $this;
    }
    // kita gunakan method join untuk menggabungkan tabel dgn paramter lainnya
    public function join($table,$type=''){
        $this->db->join($table, "$this->table.id_$table=$table.id",$type);
        return $this;
    }
    // membuat method orderby untuk mengurutkannya
    public function oderby($column,$order='asc'){
        $this->db->order_by($column, $order);
        return $this;
    }
    //membuat method untuk mendapatkan semua datanya dari database dengan method get
    public function first(){
        return $this->db->get($this->table)->row();
    }
    // membuat method yang berfungsi untuk memanggil semua object di table dengan met
    public function get (){
        return $this->db-get($this->table)->result();
    }
    // membuat method count dengan berfungsi untuk menghitung jumlah data
    public function count(){
        return $this->db->count_all_results($this->table);
    }
    // membuat method untuk membuat data 
    public function create($data){
         $this->db->insert($this->table, $data);
         return $this->db->insert_id();
    }
    //membuat method update untuk update data
    public function update($data){
        return $this->db->update($this->table, $data);
    }
    // membuat method untuk menghapus data
    public function delete(){
        $this->db->delete($this->table);
        return $this->db->affected_rows();

    }

}

?>