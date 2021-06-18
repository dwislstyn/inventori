<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Crud'); 

	}

	public function index(){
		$this->load->view("inventory_v");
	}

	public function segitiga($count){
		echo "<pre>";
		for($a=$count;$a>0;$a--){

			for($i=1; $i<=$a; $i++){
			echo "&nbsp";
			}

			for($a1=$count;$a1>=$a;$a1--){
			echo"*";
			}
			echo"<br>";
		}
		echo "</pre>";
	}

	public function loop(){
		$n = 1225441;
		$fact = 1000000;
		$rslt = strlen($n);
		for ($i=0; $i < $rslt ; $i++) { 
			$ambil = substr($n, $i, 1);
			
			if ($i>0) {
				$fact = $fact /10;
			}
			$ambil = $ambil*$fact;
			echo $ambil."<br>";
		}
		$fact = 0;
	}

	public function getData(){
		$limit="";
		$offset="";

		if($_POST['length'] !=null && $_POST['start'] != null){
			$length=$_POST['length'];
			$start=$_POST['start'];
			$limit = "limit $length";
			$offset = "offset $start";
		}

		$list = $this->Crud->getByQuery("select * from produk order by nama_barang $limit $offset");

		$data = array();
		$no = $_POST['start'];

		foreach ($list->result() as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_barang;
			$row[] = $field->kode_barang;
			$row[] = $field->jumlah_barang;
			$row[] = $field->tanggal;
			$row[] = "<a href='javascript:;' class='item-edit' data='".$field->id."' style='margin-right: 15px'><i class='fa fa-pencil text-warning'></i></a>";
			//$row[] = $field->tgltransfer;
			
			$data[] = $row;
		}

		$total="";
		$count_all = $this->Crud->getByQuery("select count(1) as count_all from produk");
		foreach($count_all->result() as $rslt){
			$total=$rslt->count_all;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $total,
			"data" => $data,
		);

        echo json_encode($output);
	}

	public function add(){
		$id = null;
		$namaProduk = $_POST['txtNamaProduk'];
		$kodeProduk = $_POST['txtKodeBarang'];
		$jumlahBarang = $_POST['txtJumlah'];
		$tanggal = date("Y-m-d");

		$inputData = array(
				'id' => $id,
				'nama_barang' => $namaProduk,
				'kode_barang' => $kodeProduk,
				'jumlah_barang' => $jumlahBarang,
				'tanggal' => $tanggal
			);
		$result = $this->Crud->insert_data('produk', $inputData);
		$msg['success'] = FALSE;
		$msg['type'] = 'Add';
		if ($result) {
			$msg['success'] = TRUE;
		}
		echo json_encode($msg);
	}

	public function edit(){
		$result = $this->Crud->edit_produk();
		echo json_encode($result); 
	}

	public function update(){

		$id = $_POST['txtId'];
		$field = array(
			'nama_barang' => $this->input->post('txtNamaProduk'),
			'kode_barang' => $this->input->post('txtKodeBarang'),
			'jumlah_barang' => $this->input->post('txtJumlah')
			);


		$result = $this->Crud->update_produk($id, $field);
		$msg['success'] = false;
		$msg['type'] = 'Update';
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function search(){

		$cari = $this->input->post("cari");
		
		
		
		echo "/".$cari;
	}

	public function getsearch($cari, $sortKode){
		$limit="";
		$offset="";

		if($_POST['length'] !=null && $_POST['start'] != null){
			$length=$_POST['length'];
			$start=$_POST['start'];
			$limit = "limit $length";
			$offset = "offset $start";
		}

		$list = $this->Crud->getByQuery("select * from produk 
											where id like '%$cari%' or 
											nama_barang like '%$cari%' or 
											kode_barang like '%$cari%' or
											jumlah_barang like '%$cari%' or
											tanggal like '%$cari%'
											order by nama_barang
											$limit $offset");

		$data = array();
		$no = $_POST['start'];

		foreach ($list->result() as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_barang;
			$row[] = $field->kode_barang;
			$row[] = $field->jumlah_barang;
			$row[] = $field->tanggal;
			$row[] = "<a href='javascript:;' class='item-edit' data='".$field->id."' style='margin-right: 15px'><i class='fa fa-pencil text-warning'></i></a>";
			
			$data[] = $row;
		}

		$total="";
		$count_all = $this->Crud->getByQuery("select count(1) as count_all from produk 
												where id like '%$cari%' or 
												nama_barang like '%$cari%' or 
												kode_barang like '%$cari%' or
												jumlah_barang like '%$cari%' or
												tanggal like '%$cari%'
												order by nama_barang");
		foreach($count_all->result() as $rslt){
			$total=$rslt->count_all;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $total,
			"data" => $data,
		);

        echo json_encode($output);

	}



}
