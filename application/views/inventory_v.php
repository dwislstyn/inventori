<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!--global styles-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/components.css');?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/custom.css');?>" />
    <!-- Plugin -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>assets/vendors/select2/css/select2.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>assets/css/pages/dataTables.bootstrap.css" />
    <!--End of plugin styles-->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>assets/css/pages/tables.css" />
    <!-- end of global styles-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendors/chartist/css/chartist.min.css');?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendors/circliful/css/jquery.circliful.css');?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/pages/index.css');?>">
    
    <link type="text/css" rel="stylesheet" href="" id="skin_change" />

</head>
<body>

<!-- page loader -->

<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
        <img src="<?php echo base_url('assets/img/loader.gif');?>" style=" width: 50px;" alt="loading...">
    </div>
</div>


<!-- end page loader -->


<div class="bg-container">
    <div class="outer">
        <div class="inner bg-light lter bg-container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            Data Produk
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- main table -->
    <div class="card-block m-t-35">
        <div class="table-toolbar">
            
            <div class="form-group row">
                <div class="col-lg-2 col-xl-1 col-md-2 col-sm-2 col-xs-2 text-lg-right">
                <div class="btn btn-primary layout_btn_prevent" id="btnTambah" style="width: 80px">Tambah</div>
                </div>

                <div class="col-md-2">
                    <input type="text" id="txtCari" name="txtCari" class="form-control" placeholder="Cari" >
                </div>
            </div>
            

            
        </div>
        <div class="alert alert-success" style="display: none; margin-top: 10px;">

        </div>
        <div style="margin-top: 10px;">
            <div id='mainTable'>
                <table id="example1" class="display table table-stripped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal IN</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    
                    <tbody id="show_data">
                    
                    </tbody>
                </table>
            </div>
            
            <div id="secondTable">
                <table id="example2" class="display table table-stripped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal IN</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    
                    <tbody id="show_data">
                    
                    </tbody>
                </table>    
            </div>
            
        </div>
    </div>

    <!-- end main table -->

    <!-- modal -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTambahTitle">Tambah Data Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <form id="formSave" method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control" id="txtId" name="txtId" style="display: none;" required>
                <div class="form-group">
                    <label for="txtNamaProduk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="txtNamaProduk" name="txtNamaProduk" required>
                </div>
                <div class="form-group">
                    <label for="txtKodeBarang" class="form-label">Kode Barang</label>
                    <input type="text" class="form-control" id="txtKodeBarang" name="txtKodeBarang" required>
                </div>
                <div class="form-group">
                    <label for="txtJumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="txtJumlah" name="txtJumlah" required>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCancel">Keluar</button>
                <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
                
            </div>
            </form>
        </div>
    </div>

    <!-- end modal -->

</div>






<?php $this->load->view('footer/footer.php'); ?>

<script type="text/javascript">

    var baseUrl = "<?php echo base_url('inventory/getsearch')?>";

    tampilData();
    
    function tampilData(){
        $('#secondTable').hide();
        $('#mainTable').show();
        $('#example1').DataTable( {
            destroy: true,
            "processing": true, 
            "serverSide": true, 
            "autoWidth": false,

            "dom": "<'row'<'col-md-5 col-12'l><'col-md-7 col-12'f>r><'table-responsive't><'row'<'col-md-5 col-12'i><'col-md-7 col-12'p>>",

            "columnDefs": [
                            { "width": "150px", "targets": 2 }
                    ],

            "order": [],

            "ajax": {
                "url": "<?php echo base_url('Inventory/getData'); ?>",
                "type": "POST"
            },
            // "columnDefs": [
            //         { 
            //             "targets": [ 0 ], 
            //             "orderable": false, 
            //         }],
            "searching": false,
            "lengthChange": false,
            "ordering": false
        });
    }

    $('#btnTambah').click(function(){
        $('#formSave').attr('action', '<?php echo base_url(); ?>Inventory/add');
        $('#formSave').trigger('reset');
        $('#myModal').modal('show');
    });

    $('#btnSimpan').click(function(){
        tambahData();
    });

    function tambahData(){
        var link = $('#formSave').attr('action');
        var data = $('#formSave').serialize();

        // var id = $('input[name=txtid]');
        var namaProduk = $('input[name=txtNamaProduk]');
        var kodeBarang = $('input[name=txtKodeBarang]');
        var jumlahBarang = $('input[name=txtJumlah]');

        var result = "";

        if (namaProduk.val()=='') {
                        namaProduk.parent().addClass('has-error');
                    }else{
                        namaProduk.parent().removeClass('has-error');
                        result += '1';  
                    }
                    if (kodeBarang.val()=='') {
                        kodeBarang.parent().addClass('has-error');
                    }else{
                        kodeBarang.parent().removeClass('has-error');
                        result+= '2';
                    }
                    if (jumlahBarang.val()=='') {
                        jumlahBarang.parent().addClass('has-error');
                    }else{
                        jumlahBarang.parent().removeClass('has-error');
                        result+= '3';
                    }

                    


        if (result=='123') {
            alert(data);
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: link,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response) {

                    // alert(data);
                    if (response.success) {
                        $('#myModal').modal('hide');
                        $('#formSave')[0].reset();
                        if (response.type == "Add") {
                            var type = "Tambah";
                        } else if (response.type == "Update") {
                            var type = "Update";
                        }
                        $('.alert-success').html('' + type + ' Data Produk Berhasil')
                            .fadeIn().delay(4000).fadeOut('slow');
                        $('#modalLoader').modal('show');
                        tampilData();
                        $('#modalLoader').modal('hide');
                        
                    } else {
                        $('#btnCancel').click();
                        tampilData();
                    }

                },
                error: function() {
                    alert('Input data user gagal');
                }
            });
        }
    }

    $('#show_data').on('click', '.item-edit', function(){
        var id = $(this).attr('data');
        var table = 'produk';
        $('#myModal').modal('show');
        $('#myModal').find('.modal-title').text('Edit Data Produk');
        $('#formSave').attr('action', '<?php echo base_url() ?>Inventory/update');
        
        var url = $('#formSave').attr('action');

        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '<?php echo base_url() ?>Inventory/edit',
            data: {
                id: id,
                table: table,
            },
            async: false,
            dataType: 'json',
            success: function(data) {
                $('#txtId').val(data.id);
                $('#txtNamaProduk').val(data.nama_barang);
                $('#txtKodeBarang').val(data.kode_barang);
                $('#txtJumlah').val(data.jumlah_barang);
                
            },
            error: function() {
                alert('Tidak Bisa Melakukan Edit Data!');
            }
        });

    })

    $(document).keypress(function(e) {
    if(e.which == 13) {
            filter();
        }
    });

    function filter(){
        var cari = $('#txtCari').val();

        if (cari==''|| cari==null) {
            tampilData();
        }else{
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Inventory/search'); ?>",
                data:   { cari: cari },
                success: function(data){
                    
                    dataInput=data+"/asc";
                    var url=baseUrl.concat(dataInput);
                    
                    $('#modalLoader').modal('show');
                    tampilCari(url);
                    
                }
            });
        }
        
        
    }

    function tampilCari(url){
        $('#mainTable').hide();
        $('#secondTable').show();
        $('#example2').DataTable( {
            destroy: true,
            "processing": true, 
            "serverSide": true, 
            "autoWidth": true,

            "dom": "<'row'<'col-md-5 col-12'l><'col-md-7 col-12'f>r><'table-responsive't><'row'<'col-md-5 col-12'i><'col-md-7 col-12'p>>",

            "columnDefs": [
                            { "width": "150px", "targets": 2 }
                    ],

            "order": [],

            "ajax": {
                "url": url,
                "type": "POST"
            },
            // "columnDefs": [
            //         { 
            //             "targets": [ 0 ], 
            //             "orderable": false, 
            //         }],
            "searching": false,
            "lengthChange": false,
            "ordering": false
        });

        $('#modalLoader').modal('hide');
    }

</script>
</body>
</html>