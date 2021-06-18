<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model {

	public function test_con($data){
		$data= $this->db->query("select * from $data order by tanggal_daftar desc;");
		return $data->result_array();
	}

	public function test_conDB(){

		$db2 = $this->load->database('tpbdb_ciesa', TRUE);
		$query = $db2->query("SELECT * FROM tpb_header order by ID desc");
	      // if ($query->num_rows() > 0) {
	      //      return true;
	      // }else{
	      //      return false;
	      // }
		return $query;
	}



	public function getDataUser($tbl ,$where, $order=null, $kolom=null){
		if($where) { 
			$this->db->where($where); 
		}
		
		if($order){
			$this->db->order_by($kolom, $order);
		}
		return $this->db->get($tbl);
	}

	public function getByQuery($query){
		return $this->db->query($query);
	}

	public function list_query($query){
		return $this->db->query($query);
	}

	public function list_query_ciesa($query){
		$db2 = $this->load->database('tpbdb_ciesa', TRUE);
		return $db2->query($query);
		
	}

	public function cekRole($menuId){
		$userId= $this->session->userdata("user_id");
		return $this->db->query("
			select u.USER_ID, u.USERNAME, m.NAME as MENU, m.POSITION, m.CATEGORY, m.ROOT_ID, m.URL, m.ICON, m.MENU_ID
			FROM user AS u 

			inner join role_user as ru
			on u.USER_ID = ru.USER_ID

			inner join role as r
			on ru.ROLE_ID = r.ROLE_ID

			inner join role_menu as rm
			on r.ROLE_ID = rm.ROLE_ID

			inner join menu as m
			on rm.MENU_ID = m.MENU_ID

			where u.USER_ID = $userId
			and m.MENU_ID = $menuId
			-- and m.URL is not null
			-- order by m.POSITION asc;
			order by m.POSITION asc, m.ROOT_ID asc;");
	}

	public function cek_id($tbl, $where){
          $this->db->where($where);
          $query = $this->db->get($tbl);
          if ($query->num_rows() > 0) {
               return true;
          }else{
               return false;
          }
     }

     public function cek_kode($id, $primary){
     	$db2 = $this->load->database('tpbdb_ciesa', TRUE);
     	$query = $db2->query("SELECT MAX($primary) as kode from $id WHERE kode_dokumen_pabean = 27");
        $hasil = $query->row();
        return $hasil->kode;
     }
	
	public function getQuery($query){
		$hasil = $this->db->query($query);
		return $hasil->result_array();
	}

// insert =====================================================


	public function insert_data($namaTabel, $data){
		$this->db->insert($namaTabel, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function insert_excel($tbl, $data){
		$this->db->insert_batch($tbl, $data);
	}

// /.insert =====================================================

// edit =========================================================	
	
	public function edit_produk(){
		$id = $this->input->get('id');
		$table = $this->input->get('table');
		$this->db->where('id', $id);
		$query = $this->db->get($table);
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	

// /.edit =========================================================		

	

// Update =========================================================	

	public function update_produk($id, $field){
		$this->db->where('id', $id);
		$this->db->update('produk', $field);
		if ($this->db->affected_rows() > 0 ) {
			return true;
		}else{
			return false;
		}
	}

	


// /.Update =========================================================	
}
