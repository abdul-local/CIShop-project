<?php
defined('BASEPATH') OR exit('No direct access allowed');
class MY_Model extends CI_Model{
    protected $table = ' ';
    protected $perpage= 5;
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
        $this->form_validation->set_error_delimiters(
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
    // membuat method pagination untuk pengaturan jumlah data yang di tampilkan
    public function paginate($page){
        $this->db->limit(
            $this->perpage,
            $this->calculateRealOffset($page)
        );
    }
    public function calculateRealOffset($page)
    {
        if(is_null($page) || empty($page)){
            $offset=0;
        }else{
            $offset =($page * $this->perpage)- $this->perpage;
        }
        return $offset;
    }
    // buat method dengan makePagination
    public function makePagination($baseUrl,$uriSegment,$totalRows= null){
        $this->load->library('pagination');
        $config = [
            'base_url' => $baseUrl,
            'uri_segment'=>$uriSegment,
            'per_page' => $this->perpage,
            'total_rows'=> $totalRows,
            'use_page_numbers'=> true,

            'full_tag_open' => '<ul class="pagniation">',
            'full_tag_close' => '</ul>',
            'atributes' => ['class'=>'page-link'],
            'first_link' => false,
            'last_link' => false,
            'first_tag_open'=>'<li class="page-item">',
            'first_tag_close'=>'</li>',
            'prev_link' =>'&laquo',
            'prev_tag_open'=>'<li class="page-item">',
            'prev_tage_close'=>'</li>',
            'nex_link' =>'$raquo',
            'next_tag_open'=>'<li class="page-item">',
            'next_tage_close'=>'</li>',
            'last_tag_open'=>'<li class="page-item">',
            'last_tag_close'=>'</li>',
            'cur_tag_open' =>'<li class="page-item active"></li> <a href="#" class="page-link">',
            'cur_tag_close' => '<span class="sr-only">(current)</span></a></li>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>'

        ];
        $this->pagination->intialize($config);
        return $this->pagination->create_link();
    }


}

?>