<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Crud'); 

		
		$this->load->library('cetak_pdf');

	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function segitiga(){
		$count=10;
		for($a=$count;$a>0;$a--){
			for($i=1; $i<=$a; $i++){
				echo " &nbsp";
			}
			for($a1=$count;$a1>=$a;$a1--){
				echo"*";
			}
			echo"<br>";
		}
	}

	function diamond($n){
		echo "<pre>";
		for ($i = 1; $i < $n; $i++) {
		    for ($j = $i; $j < $n; $j++)
		        echo "&nbsp;&nbsp;";
		    for ($j = 2 * $i - 1; $j > 0; $j--)
		        echo "-"."*";
		    echo "<br>";
		}

		for ($i = $n; $i > 0; $i--) {
		    for ($j = $n - $i; $j > 0; $j--)
		        echo "&nbsp;&nbsp;";
		    for ($j = 2 * $i - 1; $j > 0; $j--)
		        echo "-"."*";
		    echo "<br>";
		}

		echo "</pre>";
	}
	function diamond2($n){
		echo "<pre>";

		for ($i = 1; $i < $n; $i++) {
		    for ($j = $i; $j < $n; $j++)
		        echo "&nbsp;&nbsp;";
		    for ($j = 2 * $i - 1; $j > 0; $j--)
		        echo "-"."*";
		    	
		    	

		    echo "-"."<br>";
		}

		for ($i = $n; $i > 0; $i--) {
		    for ($j = $n - $i; $j > 0; $j--)
		        echo "&nbsp;&nbsp;";
		    for ($j = 2 * $i - 1; $j > 0; $j--)
		        echo "-"."*";
		    	if ($j==0) {
		    		echo "-";
		    	}
		    echo "<br>";
		}



		echo "</pre>";
	}


	public function prima(){
		$angka=3;

		if ($angka%2 == 0) {
			echo "True";
		}else
		{
			echo "False";
		}

	}

	public function hitung_string(){
		$test1 = 'IFS Solusi Integrasi, PT';

		

		$hsl= substr_count($test1, "I");
		$hsl2= substr_count($test1, "i");

		$hsl3=$hsl+$hsl2;
		echo $hsl3;		
	}

	public function cariArray(){
		$inArray = array(8,20,50,33,89,35,23,90,101,77,23);
		echo "Nilai terbesar :".max($inArray);
	}

	public function sortArray(){
		$inArray = array("d","u","x","y","a","g","q","v","j","s");
		sort($inArray);
		foreach ($inArray as $hsl) {
			echo $hsl.",";
		}
	}

	public function regex_test(){
		$input=array(
    		"123{abcd[123(45)dd]bb}sss",
    		"abcd(ex45{uuuu)000]ccc"
    	);
		$this->output_regex($input);
	}


	public function output_regex($input){
		$regex = "/[\w]+@[a-z.]+/i";

		$regex6 = "/\([^\)]*\)/";
		$regex5 = array(
			"/\{[^\}]*\}/", "/\[[^\]]*\]/", "/\([^\)]*\)/"
		);

    	$hasil = [];

    	//$rslt= preg_match_all($regex6, $input, $hasil);
    	//echo json_encode($hasil);

    	$stat=0;
    	$stat2=0;
    	$stat3=0;
    	foreach ($input as $hsl) {
    		echo"$hsl = ";
    		if (preg_match("/\{[^\}]*\}/",$hsl)) {
    			$stat=1;
    		}
    		if (preg_match("/\[[^\]]*\]/",$hsl)) {
    			$stat2=1;
    		}
    		if (preg_match("/\[[^\]]*\]/",$hsl)) {
    			$stat3=1;
    		}

    		if ($stat==0 || $stat2==0 || $stat3==0) {
    			echo "False"."</br>";
    			$stat=0;
		    	$stat2=0;
		    	$stat3=0;
    		}else{
    			echo "True"."</br>";
    			$stat=0;
		    	$stat2=0;
		    	$stat3=0;
    		}



    	}

    	
	}	

	public function test_email()
    {
      // Konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'dwi.sulistio16@mhs.ubharajaya.ac.id',  // Email gmail
            'smtp_pass'   => 'dwi123456',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('dwi.sulistio16@mhs.ubharajaya.ac.id', 'Testing Notifikasi Email');

        // Email penerima (untuk satu penerima)
        // $this->email->to('dwi.sulistio16@mhs.ubharajaya.ac.id'); // Ganti dengan email tujuan
        
        // Lebih dari satu penerima
        $receive = array('dwisulistyon@gmail.com', 'dwi.sulistio16@mhs.ubharajaya.ac.id');
        $this->email->to($receive); // Ganti dengan email tujuan
        

        // Lampiran email, isi dengan url/path file
        $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

        // Subject email
        $this->email->subject('Kirim Email dengan SMTP Gmail CodeIgniter | MasRud.com');

        // Isi email
        $this->email->message("Ini adalah contoh email yang dikirim menggunakan SMTP Gmail pada CodeIgniter.<br><br> Klik <strong><a href='https://masrud.com/post/kirim-email-dengan-smtp-gmail' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }

	public function index()
	{
		

		// $dompdf = new Dompdf();

		// $data= array(
		// 	'nama' => 'Dwi Sulistyo',
		// 	'alamat' => 'Bekasi'
		// );

		// $html = $this->load->view('welcome_message', $data, true);

		// $dompdf->load_html($html);
		// $dompdf->render();
		// $dompdf->output();

		// $dompdf->stream('test.pdf', array("Attachment"=>false));	

		// $data = array(
  //       "dataku" => array(
  //           "nama" => "Petani Kode",
  //           "url" => "http://petanikode.com"
  //       )
  //   );

	    

	 //    $this->cetak_pdf->setPaper('A4', 'potrait');
	 //    $this->cetak_pdf->filename = "laporan-petanikode.pdf";
	 //    $this->cetak_pdf->load_view('welcome_message', $data);


	}

	public function test_con(){
		$this->load->view('welcome_message');
		
	}



}
