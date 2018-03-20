<script>
    $(document).ready(function() {
    //$('#window').hide();
});
    /*$("#radio_submit").click(function (e) {
        var checked_option_radio = $('input:radio[name=condition]:checked').val();       
        if(checked_option_radio===undefined)
        {
            alert('Silahkan Pilih Terlebih Dahulu');
        }else if(checked_option_radio==1){
            $('#window').show(500);
            $('.pilih').attr("disabled", 'disabled');
            $('#radio_submit').hide();
            $('#radio_retry').removeAttr("hidden");

        }else{
         $('#window').show(500);
         $('.pilih').attr("disabled", 'disabled');
         $('#radio_submit').hide();
         $('#radio_retry').removeAttr("hidden");
     }
 });
    $("#radio_retry").click(function (e) {
        $('#window').hide(1000);
        $('#radio_submit').show();
        $('#radio_retry').attr("hidden", 'hidden');
        $('.pilih').removeAttr("disabled");


    });*/
    $('input[type="radio"]').on('click', function(e) {
        var checked = $('input:radio[name=jenis]:checked').val(); 
        if(checked==="pengadaan"){
            $('.nomor_pengajuan').html("SPB");
            $('.nomor_pengajuan2').html("SPB");
            $('.tanggal_pengajuan').html("SPB");
            $('.buat_pengajuan').html("SPB");
            $('#save_btn').attr("href","<?php echo base_url()?>procurement/transaction/material/add_pengadaan");
        }else{
            $('.nomor_pengajuan').html("Pengajuan");
            $('.nomor_pengajuan2').html("Pengajuan");
            $('.tanggal_pengajuan').html("Pengajuan");
            $('.buat_pengajuan').html("Pengajuan");
            $('#save_btn').attr("href","<?php echo base_url()?>procurement/transaction/material/tambah");
        }  
    });
</script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" language="javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

<!--script src="<?php echo base_url('assets/easyautocomplete/jquery.easy-autocomplete.min.js')?>"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/easyautocomplete/easy-autocomplete.min.css"-->
<!--script src="<?php echo base_url('assets/jquery-2.1.4.min.js')?>"></script-->
  <script>
$( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
        $( "#supplier" ).autocomplete({
          source: "<?php echo base_url(); ?>procurement/transaction/material/autosupplier"
        });

        $( "#jenis_material" ).autocomplete({
          source: "<?php echo base_url(); ?>procurement/transaction/material/automaterial"
        });
  } );
</script>
<div class="row">
    <div class="loadertab col-md-12"><?php echo $this->session->flashdata('msgTransM') ?></div>
</div>

<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-edit mg-r-sm'></i> <?php echo $transaction_ct; ?>
    </header>
    
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'formTransM')); ?>
        <?php //if($sess['users']->users_divisi == 17 || $sess['users']->users_divisi == 15 || $sess['users']->users_divisi == 20 || $sess['users']->users_divisi == 19)
            //{
        ?>
        <?php //}else{?>
    <!--     <div class="form-group">  
            <div class="col-md-2">
                <input type="radio"  class="getCondition pilih" name="condition" value="1"/> PENGAJUAN
            </div>
            <div class="col-md-2"> 
                <input type="radio"  class="getCondition pilih" name="condition" value="2"/> PENGADAAN
            </div>
            <div class="col-md-2"> 
                <button class="btn-primary" id="radio_submit" type="button">Silahkan Pilih</button>
                <button class="btn-primary" hidden id="radio_retry" type="button">Pilih Lagi</button>
            </div>
        </div> -->
                 <div class="row">
                    <div class="col-xs-3">
                        <div class="form-group">
                        <label>Jenis Procurement</label>
                        <div class="input-group mg-b-md">
                            <input type="radio" name="jenis" id="jenis" value="pengajuan" checked> Pengajuan
                            <input type="radio" name="jenis" id="jenis" value="pengadaan"> Pengadaan
                         </div>
                        </div>
                    </div>
                    <?php echo $this->load->view("global_project");?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="changeNo"><label>Nomor <span class="nomor_pengajuan">Pengajuan</span></label></div>
                            <input type="text" id="mog_number" name="mog_number" class="form-control form-select2" data-style="btn-white" data-placeholder="Tanggal Mulai">
                        </div>
                    </div>
                </div>
 
            <input type="hidden" id="data">


            
            <?php if (!empty($mog_dt)) { ?>
            <input type="hidden" name="mog_id" value="<?php //echo $mog_dt->mog_id; ?>"/>
            <?php } ?>
            <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
            <section>
            <div class="row">
             <div class="col-xs-3">
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="text" id="mog_numberstart" name="mog_number" class="form-control form-select2" data-style="btn-white" data-placeholder="Tanggal Mulai">
                </div>
            </div>

            <div class="col-xs-3">
                <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <input type="text" id="mog_numberend" name="mog_number" class="form-control form-select2" data-style="btn-white" data-placeholder="Tanggal Mulai">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label>Supplier</label>
                    <input type="text" id="supplier" name="supplier" class="form-control" data-placeholder="Tanggal Mulai">
                </div>
            </div>

            <div class="col-xs-1">
                <div class="form-group">
                <label>&nbsp;<span style="color:white">Tom</span></label>
                    <input type="button" id="mog_number" name="mog_number" onclick="getTabs()" class="btn btn-success" value="Filter">
                </div>
            </div>
            <?php  if($sess['users']->users_divisi == 1 || $sess['users']->users_divisi == 16): ?>
            <div class="col-xs-1">
                <div class="form-group">
                <label>&nbsp;<span style="color:white">Tom</span></label>
                   <span class="tombol"> 
                        <a href="<?php echo base_url()?>procurement/transaction/material/tambah" id="save_btn" class="btn btn-primary"><i class="fa fa-plus mg-r-sm"></i> Buat Baru <span class="buat_pengajuan">Pengajuan</span>
                        </a>
                    </span>
                </div>
            </div>
            <?php endif;?>
        </div>
        <div class="row">
             <div class="col-xs-3">
                <div class="form-group">
                    <label>Jenis Material</label>
                    <input type="text" id="jenis_material" name="jenis_material" class="form-control" data-style="btn-white" data-placeholder="Jenis Material">
                </div>
            </div>
            <div class="col-xs-4">
                <div class="row">
                <div class="col-xs-2">
                <div class="form-group">
                    <label>Operator</label>
                     <div class="input-group mg-b-md">
                        <span class="input-group-addonx">
                            <select name="operator" id="operator" style="width:10%;border-style:none !important;">
                                <option value="=">=</option>    
                                <option value=">=">>=</option>    
                                <option value="<="><=</option>    
                            </select>&nbsp;
                        </span>
                        <!-- <input type="text" id="jenis_material" name="jenis_material" class="form-control form-select2" data-style="btn-white" data-placeholder="Tanggal Mulai"> -->
                    </div>
                </div>
                </div>
                <div class="col-xs-6">
                <div class="form-group">
                    <label>Volume Total</label>
                     <div class="input-group mg-b-md">
                       
                        <input type="text" id="volume" name="volume" class="form-control form-select2" data-style="btn-white" data-placeholder="Tanggal Mulai">
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <br />
    <section class="panel">
        <div class="panel-body row">
            <div class="row">
                <table class="table table-bordered table-striped datatable" style="margin-top: -13px">
                    <thead class="bg-dark" style="color: white">
                        <tr>
                            <th class="text-center hidden-xs" style="width: 30px; padding: 15px">No.</th>

                            <th class="text-center" style="width: 250px; padding: 15px">Nomor <span class="nomor_pengajuan2">Pengajuan</span></th>
                            <th class="text-center" style="width: 100px; padding: 15px">Tanggal <span class="tanggal_pengajuan">Pengajuan</span></th>
                            <th class="text-center" style="width: 150px; padding: 15px">Nama Proyek</th>
                            <th class="text-center" style="width: 90px; padding: 15px">Nama Supplier</th>
                            <th class="text-center" style="width: 90px; padding: 15px">Jenis Material</th>
                            <th class="text-center" style="width: 90px; padding: 15px">Volume Total</th>
                            <th class="text-center" style="width: 90px; padding: 15px">Status</th>
                            <th class="text-center" style="width: 50px; padding: 15px"><i class="fa fa-gear"></i></th>
                        </tr>
                    </thead>
                    <tbody id="filterTabs">
                        <?php $no=1;foreach($mog_dt as $x => $row){ 
                            if($row->jenis_procurement=="pengajuan"){
                                $link_edit = base_url()."procurement/transaction/material/tambah/".$row->mog_id."/edit";
                                $link_view = base_url()."procurement/transaction/material/tambah/".$row->mog_id."/view";
                            }else{
                                $link_edit = base_url()."procurement/transaction/material/add_pengadaan/".$row->mog_id."/edit";
                                $link_view = base_url()."procurement/transaction/material/add_pengadaan/".$row->mog_id."/view";
                            }
                            ?>
                       <tr>
                        <td class="text-center" style="width: 20px; padding: 15px"><?php echo $no; ?></td>
                        <td class="text-center" style="width: 50px; padding: 15px"><?php 
                            if($row->role_id==17 || $row->role_id==15 || $row->role_id==19 || $row->role_id==20){
                                echo "nomor spb : ".$row->no_spb;
                            }else{
                                echo $row->nomor_pengajuan; 
                            }
                        ?>
                        <?php if($row->mog_status==2){?>
                            <br/>
                            <span class="badge" style="color: #FFFFFF !important; background-color:red !important;">Rejected</span>
                        <?php } ?>
                        </td>
                        <td class="text-center" style="width: 150px; padding: 15px"><?php echo date('d-m-Y',strtotime($row->tanggal_spb)); ?></td>
                        <?php $idProject= $row->project_id;
                        $project_id    = $this->crud_model->getNameProject($idProject);
                        ?>
                        <td class="text-center" style="width: 250px; padding: 15px"><?php echo @$project_id ->project_name; ?></td>
                        <?php $idSupplier   = $row->actor_id;
                        $supplier_id    = $this->crud_model->getNameSupplier($idSupplier);
                         ?>
                        <td class="text-center" style="width: 250px; padding: 15px">
                        <?php 
                        if($supplier_id->num_rows()) {
                            echo $supplier_id->row()->actor_name;
                        }
                        ?></td>
                         <td class="text-center" style="width: 250px; padding: 15px">
                            <?php 
                                $idMog  = $row->mog_id;
                                $mat    = $this->crud_model->read_fordata(array("table" => "mog_dt md", "join" => array("material_sub ms" => "ms.material_sub_id = md.material_sub_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id"), "where" => array("mog_id" => $idMog, "mog_dt_status" => 1)));
                                $brg="";
                                $vol=0;
                                foreach ($mat->result() as $key => $value) {
                                    $brg .= $value->material_sub_name;
                                    $brg .=", ";
                                    $vol = $vol+$value->mog_dt_volume;
                                }
                                echo $brg;
                            ?>
                         </td>
                        <td class="text-center" style="width: 250px; padding: 15px"><?php echo $vol ?></td>
                        <td class="text-center" style="width: 50px; padding: 15px">Approved by <?php echo $row->tujuan; ?>
                        </td>
                        <?php  
                        $view="View";
                        if($sess['users']->users_divisi == 16){
                            $view="Verifikasi";
                        } ?>
                        <td class="text-center" style="width: 250px; padding: 15px">
                            <a class="btn btn-success" href="<?php echo $link_view?>"><i class="fa fa-edit"></i><?php echo $view?>
                            </a>
                            <?php 
                            if($sess['users']->users_divisi == 15 || $sess['users']->users_divisi == 20 || $sess['users']->users_divisi == 19 || $sess['users']->users_divisi == 18)
                            {
                            }else{
							if ($sess['users']->users_divisi == 16){ ?>
								<a class="btn btn-success" href="<?php echo $link_edit?>"><i class="fa fa-edit"></i>Edit</a>
								<?php if ($row->stat_edit == "0") { ?>
									<a class="btn btn-success" onclick="appEdit('<?php echo $idMog;?>')"><i class="fa fa-edit"></i>Approve Edit</a>
								<?php } ?>
							<?php } else { 
							
							if ($row->stat_edit == NULL){ ?>
								<a class="btn btn-success" onclick="reqEdit('<?php echo $idMog;?>')"><i class="fa fa-edit"></i>Req Edit</a>
							<?php } else if ($row->stat_edit == 1) { ?>
								<a class="btn btn-success" href="<?php echo base_url() ?>procurement/transaction/material/tambah/<?php echo $row->mog_id?>/edit"><i class="fa fa-edit"></i>Edit</a>
                            <?php } else { ?> 
								<a class="btn btn-success" onclick="alert('Menunggu Approval Edit')"><i class="fa fa-edit"></i>Edit</a>
							<?php }}} ?>
                        <?php  if($sess['users']->users_divisi == 1 || $sess['users']->users_divisi == 17){ ?>
                            <?php if (@$row->stat_del == NULL){ ?>
								<a class="btn btn-success" onclick="reqDelete('<?php echo $idMog;?>')"><i class="fa fa-edit"></i>Req Delete</a>
							<?php } else if ($row->stat_del == 1){ ?>
								<a class="btn btn-danger" class="delete"  onclick="return confirm('Apakah anda yakin untuk Menghapus Data ini?')" href="<?php echo base_url() ?>procurement/transaction/material/delete/<?php echo $idMog?>"><i class="fa fa-trash"></i>Delete</a>
							<?php } else { ?>
								<a class="btn btn-success" onclick="alert('Menunggu Approval Delete')"><i class="fa fa-edit"></i>Delete</a>
							<?php } ?>
						<?php }?>
						<?php if ($sess['users']->users_divisi == 16) { ?>
							<?php if (@$row->stat_del == '0'){ ?>
							<a class="btn btn-success" onclick="appDelete('<?php echo $idMog;?>')"><i class="fa fa-edit"></i>Approve Delete</a>
							<?php } ?>
						<?php }?>
						<a class="btn btn-success" href="<?php echo base_url() ?>procurement/transaction/material/cetak/<?php echo $row->mog_id?>" target="_blank"><i class="fa fa-print"></i>Cetak</a>
                        </td>
                    </tr>
                        <?php $no++;} ?>
                </tbody>

            </table> 
        </div>
    </div>
</section>
<!-- <div class="row">
    <div class="col-xs-12">
        <?php //if (!empty($mog_dt)) { ?>
        <div class="<?php echo!empty($mog_dt) ? 'col-xs-6' : null ?>">
            <a href="<?php echo base_url()?>warehouse/transaction/material"  class="cancelMt btn btn-danger col-xs-6"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
        </div>
        <?php //} ?>
        <div class="<?php echo!empty($mog_dt) ? 'col-xs-6' : 'col-xs-6 col-xs-offset-6' ?> pull-right">
            <button type="submit" id="save_btn" class="btn btn-primary col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
        </div>
    </div>
</div> -->
<?php echo form_close(); ?>

</div>
</section>


 <script>
$( document ).ready(function() {
    $("#mog_numberstart").datepicker({ 
        format: 'yyyy-mm-dd'
    });
     $("#mog_numberend").datepicker({ 
        format: 'yyyy-mm-dd'
    });

   $('.delete').click(function(e){
        cnfrm = confirm("Apakah anda yakin untuk menghapus?");
        if(cnfrm){
            window.location = $(this).attr('href');
        }else{
            return false;
        }
    });

        /*$('.datatable').dataTable({
           "bInfo" : true
        });*/
       

}); 
</script>
<script type="text/javascript">
    function getTabs(){
        var noPengajuan= $('#mog_number').val();
        var tglAwal= $('#mog_numberstart').val();
        var tglAkhir= $('#mog_numberend').val();
        var jenis= $("input[name='jenis']:checked"). val();
        var supplier= $('#supplier').val();
        var jenis_material= $('#jenis_material').val();
        var volume= $('#volume').val();
        var operator= $('#operator').val();
        $.ajax({
            url : "<?php echo site_url('procurement/transaction/material/filter')?>",
            type: "POST",
            data: {"noPengajuan":noPengajuan, "tglAwal":tglAwal, "tglAkhir":tglAkhir, "jenis":jenis, "supplier":supplier, "jenis_material":jenis_material, "volume":volume, "operator":operator},
            success: function(data){
                if(data!="kosong"){
                     $(".dataTables_info").html(" ");
                    $(".dataTables_info").val(" ");
                    $(".dataTables_info").hide();
                    $("#DataTables_Table_0_info").css({ 'display': "none" }); 
                    $("#filterTabs").html(data);
                } 
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }
</script>

<script type="text/javascript">
	function reqEdit(idMog){
		if (confirm('Anda ingin melakukan request Edit?')) {
			$.ajax({
				url : "<?php echo site_url('procurement/transaction/material/reqEdit')?>/" + idMog,
				dataType: "JSON",
				success: function(data){
					if (data.status == 1) {
						location.reload(true);
					} 
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error get data from ajax');
				}
			});
		}
	}
	
	function appEdit(idMog){
		if (confirm('Anda ingin melakukan approve Edit?')) {
			$.ajax({
				url : "<?php echo site_url('procurement/transaction/material/appEdit')?>/" + idMog,
				dataType: "JSON",
				success: function(data){
					if (data.status == 1) {
						location.reload(true);
					} 
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error get data from ajax');
				}
			});
		}
	}
	
	
	function reqDelete(idMog){
		if (confirm('Anda ingin melakukan request Delete?')) {
			$.ajax({
				url : "<?php echo site_url('procurement/transaction/material/reqDelete')?>/" + idMog,
				dataType: "JSON",
				success: function(data){
					if (data.status == 1) {
						location.reload(true);
					} 
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error get data from ajax');
				}
			});
		}
	}
	
	function appDelete(idMog){
		if (confirm('Anda ingin melakukan approve Delete?')) {
			$.ajax({
				url : "<?php echo site_url('procurement/transaction/material/appDelete')?>/" + idMog,
				dataType: "JSON",
				success: function(data){
					if (data.status == 1) {
						location.reload(true);
					} 
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error get data from ajax');
				}
			});
		}
	}
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();
        <?php if ($sess['position_id'] == 1 && isset($mog_id)) { ?>
            <?php if ($sess['position_id'] == 1) { ?>
                $("#show_row").load("<?php echo base_url() . $url_access . 'get_mog_detail/' . $mog_id; ?>");
            <?php } ?>
                adds_row();
        <?php } ?>

        $(".cancelMt").click(function() {
            $(".load_main_data").load("<?php echo base_url() . $url_access . 'form'; ?>");
            $("#show_row").load("<?php echo base_url() . $url_access . 'get_mog_detail'; ?>");
        });

    });

    function adds_row() {
        var counterss = $('.row_tam').length + 1;
        var counter = $('.row_out').length + 1;
        for (var a = counter; a >= counterss; a--) {
            var rz = a + 1;
            $(".nom_" + a).html(rz);
            $(".nom_" + a).attr('class', "nom_" + rz);
            $("#menu_select_" + a).attr('id', "menu_select_" + rz);
            $("#btn_" + a).attr('onclick', "cut(this, " + rz + ")");
            $("#menu_" + a).attr('onchange', "menusa(" + rz + ")");
            $("#menu_" + a).attr('id', "menu_" + rz);
            $("#btn_" + a).attr('id', "btn_" + rz);
            $("#qty_" + a).attr('onkeyup', "calcPay(this, " + rz + ")");
            $("#qty_" + a).attr('id', "qty_" + rz);

        }

        var baris = '<tr class="row_out row_tam">'
        + '<td class="text-center hidden-xs" rowspan="2"><p id="nom_' + counter + '">' + counter + '</p></td>'
        + '<input type="hidden" name="action[]" value="add" class="form-control">'
        + '<input type="hidden" name="mog_dt_status[]" value="1" class="form-control">'
        <?php if ($sess['position_id'] == 5 || ($sess['position_id'] == 1 && ((isset($mog_id) && $mog_dt->mog_status != 0) || !isset($mog_id)))) { ?>
            + '<td>'
            + '<select name="code[]" id="code_'+counter+'" class="form-control" data-style="btn-white" data-placeholder="Code">'
            + '<option value="">Code</option>'
            <?php foreach ($code as $cd) { ?>
                + '<option value="<?php echo $cd->code_id; ?>"><?php echo $cd->code_name; ?></option>'
                <?php } ?>
                + '</select>'
                + '</td>'
                <?php } ?>
                + '<td id="material_select_' + counter + '"></td>'
                + '<td class="hidden-xs">'
                + '<input type="text" id="mog_dt_unit_' + counter + '" name="mog_dt_unit[]" value="" class="form-control" placeholder="Unit" readonly>'
                + '</td>'
                + '<td class="hidden-xs">'
                + '<input type="text" id="mog_dt_convertion_' + counter + '" name="mog_dt_convertion[]" value="" class="form-control" placeholder="Convertion" readonly>'
                + '</td>'
                + '<td>'
                    //            + '<input id="mog_dt_volume_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="mog_dt_volume[]" value="" class="form-control" placeholder="Volume">'
                    + '<input id="mog_dt_volume_' + counter + '" class=" form-control" onkeyup="get_count(this,' + counter + ')" name="mog_dt_volume[]" value="" class="form-control" placeholder="Volume">'
                    + '</td>'
                    <?php if ($sess['position_id'] == 5 || ($sess['position_id'] == 1 && ((isset($mog_id) && $mog_dt->mog_status != 0) || !isset($mog_id)))) { ?>
                        + '<td>'
                        + '<input id="mog_dt_price_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="mog_dt_price[]" value="" class="form-control" placeholder="Price">'
                        + '</td>'
                        + '<td rowspan="2" style="padding-left: 18px" class="hidden-xs total_sub" id="total_sub_' + counter + '">'
                        + '</td>'
                        <?php } ?>
                        + '<td rowspan="2" class="text-center"><button type="button" class="btn btn-danger" id="btn_' + counter + '" onclick="cut(this, ' + counter + ')"><i class="fa fa-times"></i></button></td>'
                        + '</tr><tr class="note_row_' + counter + '">'
                        + '<td class="hidden-xs" colspan="<?php echo $sess['position_id'] == 5 ? '5' : '4' ?>">'
                        + '<input type="text" maxlength="20" id="mog_dt_note_' + counter + '" name="mog_dt_note[]" value="" class="form-control" placeholder="Note (Panjang huruf 20 karakter)">'
                        + '</td></tr>';
                        $('#show_row').append(baris);
                        $('#material_select_' + counter).load("<?php echo base_url() . $url_access . 'get_material/all/'; ?>"+ counter);
                    }

                    function get_unit(i) {
                        $.ajax({
                            url: "<?php echo base_url() . $url_access . 'get_unit_material'; ?>/" + $('#material_' + i).val() + '/' + $('#project').val(),
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    if(json.stock_fn != 0) {
                                        $("#mog_dt_unit_" + i).attr('value', json.data.material_unit_name);
                                        $("#mog_dt_convertion_" + i).attr('value', floatToCurrency(json.data.material_sub_convertion));
                                        var volume = currencyToNumber($("#mog_dt_volume_" + i).val() != '' ? $("#mog_dt_volume_" + i).val() : 0);
                                        var convertion = currencyToNumber($("#mog_dt_convertion_" + i).val() != '' ? $("#mog_dt_convertion_" + i).val() : 0);
                                        if($("#mog_dt_price_" + i).val()) {
                                            var price = currencyToNumber($("#mog_dt_price_" + i).val() != '' ? $("#mog_dt_price_" + i).val() : 0);
                                            if(convertion == 0) {
                                                var count = numberToCurrency2((volume * 1) * price);
                                            } else {
                                                var count = numberToCurrency2((volume * convertion) * price);
                                            }
                                            $("#total_sub_" + i).html(count);
                                        }
                                    } else {
                                    //                        $("#material_" + i + " option:selected").prop('selected', false);
                                    $("#kosong").attr("selected", true);
                                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material tidak bisa dipilih, harap input stok awal terlebih dahulu");
                                    return false;
                                }
                            }
                        }
                    });
                        return false;
                    }
                    function getActData() {
                        $.ajax({
                            url: "<?php echo base_url() . $url_access . 'getdata_suplier'; ?>/" + $('#actor').val(),
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $(".codeAct").attr('value', json.data.actor_code);
                                    $(".npwpAct").attr('value', json.data.actor_identity);
                                }
                            }
                        });
                        return false;
                    }

                    function get_detail(el) {
                        $.ajax({
                            url: "<?php echo base_url() . $url_access . 'get_mog/'; ?>" + el.value,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $("#formTransM").attr('action', "<?php echo base_url() . $url_action ?>" + el.value);
                                    $("input[name=actor_name]").attr('value', json.mog.actor_name);
                                    $("input[name=actor]").attr('value', json.mog.actor_id);
                                    $("input[name=project]").attr('value', json.mog.project_id);
                                    $("input[name=project_name]").attr('value', json.mog.project_name);
                                    $("input[name=mog_project_code]").attr('value', json.mog.project_code);
                                    $("input[name=mog_number]").attr('value', json.mog.mog_number);
                                    $("input[name=mog_number_letter]").attr('value', json.mog.mog_number_letter);
                                    $(".npwpAct").attr('value', json.mog.actor_id);
                                    $('#show_row').load("<?php echo base_url() . $url_access .'get_mog_detail/'; ?>" + el.value);
                                }
                            }
                        });
                        return false;
                    }

                    function getProData() {
                        $.ajax({
                            url: "<?php echo base_url() . $url_access . 'getdata_project'; ?>/" + $('#project').val() + '/1',
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $(".proCode").attr('value', json.data.project_code);
                                //                    $("input[name=mog_number]").attr('value', json.data.project_code + json.number);
                                $("input[name=mog_number]").attr('value', json.number);
                            }
                        }
                    });
                        return false;
                    }

                    function format_number(a) {
                        a.value = numberToCurrency(a.value);
                    }

                    function get_count(a, i, ct) {
                        if(a && i) {
                            a.value = numberToCurrency(a.value);
                            var volume = currencyToNumber($("#mog_dt_volume_" + i).val() != '' ? $("#mog_dt_volume_" + i).val() : 0);
                            var convertion = currencyToNumber($("#mog_dt_convertion_" + i).val() != '' ? $("#mog_dt_convertion_" + i).val() : 0);
                            if($("#mog_dt_price_" + i).val()) {
                                var price = currencyToNumber($("#mog_dt_price_" + i).val() != '' ? $("#mog_dt_price_" + i).val() : 0);
                                if(convertion == 0) {
                                    var count = numberToCurrency2((volume * 1) * price);
                                } else {
                                    var count = numberToCurrency2((volume * convertion) * price);
                                }
                                $("#total_sub_" + i).html(count);
                            }
                        }
                        if(ct) {
                            var new_val = currencyToNumber(a.value);
                            var val = parseInt($("#" + ct + "_" + i).val());
                            var st = $("#status_" + ct + "_" + i).val();

                            if(new_val != val) {
                                if(new_val > val) {
                                    var diff = new_val - val;
                                    $("#status_" + ct + "_" + i).attr('value', 2);
                                }
                                if(val > new_val) {
                                    var diff = val - new_val;
                                    $("#status_" + ct + "_" + i).attr('value', 3);
                                }
                                $("#diff_" + ct + "_" + i).attr('value', diff);
                            } else {
                                $("#diff_" + ct + "_" + i).attr('value', '0');
                                $("#status_" + ct + "_" + i).attr('value', '0');
                            }
                        //            alert(st);
                    }
                    for (var length = $(".total_sub").length, total = parseInt(0), e = 1; e <= length; e++) {
                        var sub_total = currencyToNumber($("#total_sub_" + e).html() ? $("#total_sub_" + e).html() : 0);
                        total = total + sub_total;
                    }
                    $("#mog_total").val(numberToCurrency2(total));
                }

                function cut(el, i) {
                    var rowx = $('.row_out').length;
                    $(".note_row_"+i).remove();
                    for (var a = i; a < rowx; a++) {
                        var rz = a + 1;
                        $("#nom_" + rz).html(a);
                        $("#nom_" + rz).attr('class', "nom_" + a);
                        $("#nom_" + rz).attr('id', "nom_" + a);
                        $("#material_" + rz).attr('onchange', "get_unit(" + a + ")");
                        $("#material_" + rz).attr('id', "material_" + a);
                        $("#mog_dt_unit_" + rz).attr('id', "mog_dt_unit_" + a);
                        $("#mog_dt_note_" + rz).attr('id', "mog_dt_note_" + a);
                        $(".note_row_" + rz).attr('class', "note_row_" + a);
                        $("#mog_dt_volume_" + rz).attr('onkeyup', "get_count(this, " + a + ")");
                        $("#mog_dt_volume_" + rz).attr('id', "mog_dt_volume_" + a);
                        $("#mog_dt_price_" + rz).attr('onkeyup', "get_count(this, " + a + ")");
                        $("#mog_dt_price_" + rz).attr('id', "mog_dt_price_" + a);
                        $("#total_sub_" + rz).attr('id', "total_sub_" + a);
                        $("#btn_" + rz).attr('onclick', "cut(this, " + a + ")");
                        $("#btn_" + rz).attr('id', "btn_" + a);
                    }
                    var parent = el.parentNode.parentNode;
                    parent.parentNode.removeChild(parent);

                    get_count();
                }

                $("#formTransM").submit(function() {
                    var err = 0;
                    if (err > 0) {
                        return false;
                    }
                    if ($("input[name=project]").val() == "") {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project can not empty");
                        $("input[name=project]").focus();
                        return false;
                    }
                    
                    if ($("select[name=mog_number] option:selected").val() == "") {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>BAPB Number can not empty");
                        $("select[name=mog_number] option:selected").focus();
                        return false;
                    }
                    
                    if ($("input[name=mog_number_letter]").val() == "") {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Letter Number can not empty");
                        $("input[name=mog_number_letter]").focus();
                        return false;
                    }
                    
                    if ($("input[name=actor]").val() == "") {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Supplier can not empty");
                        $("input[name=actor]").focus();
                        return false;
                    }
                    
                    var jmlTransM = $('.row_out').length;
                    if(jmlTransM == 0){
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>item/material input least 1");
                        return false;
                    }
                    if($("#material_1 option:selected").val() ==''){
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>No item/material input");
                        return false;
                    }

                    for (var e = 1; e <= jmlTransM; e++) {
                        var code = $("#code_" + e + " option:selected").val();
                        var material = $("#material_" + e + " option:selected").val();
                        var qty = $("#mog_dt_volume_" + e).val();
                        var price = $("#mog_dt_price_" + e).val();
                        if (material != '') {
                            <?php //if ($sess['position_id'] == 5) { ?>
                                if(code ==''){
                                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Code ordered can not empty");
                                    return false;
                                }
                                <?php //} ?>
                                
                                if(qty ==''){
                                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Volume ordered can not empty");
                                    return false;
                                }
                                if(price == ''){
                                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Price ordered can not empty");
                                    return false;
                                }
                            }
                        }

                        $(".loadertabo1").show();
                        $('input').attr('readonly', 'readonly');
                        $('select').attr('readonly', 'disabled');
                        $('textarea').attr('readonly', 'readonly');
                        $("#save_btn").attr("disabled", "disabled");
                        $.ajax({
                            url: $("#formTransM").attr('action'),
                            data: $("#formTransM").serialize(),
                            type: "POST",
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 0) {
                                    $(".msgTransM").html(json.msg);
                                    $('input').removeAttr('readonly', 'readonly');
                                    $('select').removeAttr('readonly', 'readonly');
                                    $('textarea').removeAttr('readonly', 'readonly');
                                    $(".loadertabo1").hide();
                                    $("#save_btn").attr("disabled", false);
                                    bootbox.alert(json.msg);
                                } else if (json.status == 1) {
                                    <?php if ($sess['position_id'] == 1) { ?>
                                        window.open("<?php echo base_url() ?>warehouse/formcontrollertemplate/bapb/" + json.id);
                                        <?php } elseif ($sess['position_id'] == 5) { ?>
                                            window.open("<?php echo base_url() ?>warehouse/formcontrollertemplate/bapb_procurement/" + json.id);    
                                            <?php } ?>
                                            $(".load_main_data").load("<?php echo base_url() . $url_access . 'form'; ?>");
                                        }
                                    }
                                });
                        return false;
                    });
                </script>
                <script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
