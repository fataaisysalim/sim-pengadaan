<script>
    $(document).ready(function() {
        $('.supplier_tampil').hide();
        $('.npwp_tampil').hide();
		
		//jenis pengajuan
        <?php if(isset($row->jenis_procurement)):?>
        <?php if($row->jenis_procurement=="pengajuan"){?>
            $(".pengajuan").attr('checked', true);
            var c = "pengajuan";
        <?php }else{?>
            $('.pengajuan').removeAttr('checked')
            $(".pengadaan").attr('checked', true)
            var c="pengadaan";
        <?php }?>
        if(c==="pengadaan"){
            $('.supplier_tampil').show();
            $('.npwp_tampil').show();
            $('.pengajuan_tampil').hide();
            $('#label_tanggal').html("SPB");
            $('#label_upload').html("SPB");
        }else{
            $('.supplier_tampil').hide();
            $('.npwp_tampil').hide();
            $('.pengajuan_tampil').show();
            $('#label_tanggal').html("Pengajuan");
            $('#label_upload').html("Pengajuan");
        }  
        <?php endif;?>

        <?php if($aksi=="view"){?>
             //$('#formTransM input[type=text]').attr("disabled",true);
             $('#formTransM').find('input, textarea, button, select').attr('disabled','disabled');
        <?php } ?>
        $("#approve").removeAttr("disabled", "disabled");
        $("#reject").removeAttr("disabled", "disabled");
        $("#no_spb").removeAttr("disabled", "disabled");
        $("#mog_id").removeAttr("disabled", "disabled");
        $("#jenis_procurement").removeAttr("disabled", "disabled");

        <?php if(isset($row->role_id)):
            if($row->role_id==16){
        ?>
			$('.supplier_tampil').show();
			$(".datepicker").removeAttr("disabled", "disabled");
			$("#actor").removeAttr("disabled", "disabled");
            $(".add_btn").removeAttr("disabled", "disabled");
            $(".masterial").removeAttr("disabled", "disabled");
        <?php 
        }
        endif;?>

        <?php if(isset($row->role_id)):
            if($row->role_id==17){
        ?>
            $("#no_bapb").removeAttr("disabled", "disabled");
            $("#surat_jalan_document").removeAttr("disabled", "disabled");
        <?php 
        }
        endif;?>
		
		<?php if(isset($row->role_id)):
            if($row->role_id==18){
        ?>
            //$("#no_bapb").removeAttr("disabled", "disabled");
            $("#no_surat_jalan").removeAttr("disabled", "disabled");
        <?php 
        }
        endif;?>
		
        //pph
        <?php if(isset($row->pph)):?>
         <?php if($row->pph=="PKP"){?>
            $(".pph_pkp").attr('checked', true);
        <?php }else{?>
            $('.pph_pkp').removeAttr('checked')
            $(".pph_nonpkp").attr('checked', true)
        <?php }
        endif;
        ?>
        

        $('input[type="radio"]').on('click', function(e) {
            var checked = $('input:radio[name=jenis]:checked').val(); 
            if(checked==="pengadaan"){
                $('.supplier_tampil').show();
                $('.npwp_tampil').show();
                $('.pengajuan_tampil').hide();
                $('#label_tanggal').html("SPB");
                $('#label_upload').html("SPB");
            }else{
                $('.supplier_tampil').hide();
                $('.npwp_tampil').hide();
                $('.pengajuan_tampil').show();
                $('#label_tanggal').html("Pengajuan");
                $('#label_upload').html("Pengajuan");
            }  
        });
    });
</script>

<?php //print_r($row); die();?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
    <script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="row">
    <div class="loadertab col-xs-12"><?php //echo $this->session->flashdata('msgTransM') ?></div>
</div>
<?php //echo form_open($url_action, array('id' => 'formTransM')); 
            $attribute = array('name'=>'formTransM','class'=>'','id'=>'formTransM');
            echo form_open_multipart($url_action, $attribute);
        ?>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-edit mg-r-sm'></i> <?php echo $transaction_ct; ?>
    </header>
    <div class="panel-body">
        
        <?php if (!empty($idne)) { ?>
            <input type="hidden" name="mog_id" id="mog_id" value="<?php echo $idne; ?>"/>
        <?php } ?>
            <input type="hidden" name="jenis_procurement" id="jenis_procurement" value="pengajuan"/>
            <input type="hidden" name="jenis" id="jenis_procurement" value="pengajuan"/>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">

            <div class="col-sm-12">
                <?php echo $this->load->view("global_project");?>
                <div class="col-xs-3">
                    <div class="form-group">
                        <label>Tanggal <span id="label_tanggal">Pengajuan</span></label>
                        <div class="input-group mg-b-md">
                            <input type="text" class="datepicker" name="tanggal" id="tanggal" value="<?php echo isset($row->tanggal_spb) ? date("m/d/Y", strtotime($row->tanggal_spb)) : NULL; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="form-group">
                        <label>Upload  <span id="label_upload">Pengajuan</span></label>
                        <div class="input-group mg-b-md">
                            <input type="file" name="spb_document" id="spb_document" class="form-control">
                            <?php if(!empty($row->upload_file)){
                                $file = base_url().'uploads/bapb_doc/'.$row->upload_file;
                                echo "<a target='_blank' href='".$file."'>".$row->upload_file."</a>";
                                }?>
                        </div>
                    </div>
                </div>
                <?php if(!empty($row->catatan)){?>
                <div class="col-xs-3" style="background-color: red">
                    <div class="form-group alert alert-error">
                        Catatan : Reject <br/><?php echo $row->catatan?>
                    </div>
                </div>
                <?php } ?>
                <?php 

                if(isset($row->role_id)):
                if($row->role_id==17 || $row->role_id==15 || $row->role_id==19 || $row->role_id==20): ?>
                    <!--div class="col-xs-6">
                        <div class="form-group">
                            <label>BAPB Number</label>
                           
                            <input type="text" id="no_bapb" name="no_bapb" class="form-control form-select2"  value="<?php echo isset($row->no_bapb)?$row->no_bapb:$no_bapb?>">
                            
                        </div>
                    </div-->
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Upload  <span id="label_upload">Surat Jalan</span></label>
                            <div class="input-group mg-b-md">
                            <?php 
                            $up = "";
                            if($row->role_id==15 || $row->role_id==19 || $row->role_id==20 || $row->role_id==17):
                                $up = "disabled";
                            endif;
                            ?>


                                <input <?php echo $up;?> type="file" name="surat_jalan_document" id="surat_jalan_document" class="form-control">
                                <?php if(!empty($row->upload_file_surat_jalan)){
                                    $file = base_url().'uploads/bapb_doc/'.$row->upload_file_surat_jalan;
                                    echo "<a target='_blank' href='".$file."'>".$row->upload_file_surat_jalan."</a>";
                                    }?>
                            </div>
                        </div>
                    </div>
                <?php endif;?>    
                <?php endif;?>    
                
                <div class="supplier_tampil">
                <?php if($sess['users']->users_divisi == 16 || $sess['users']->users_divisi == 17 || $sess['position_id']==11): ?>
                     <div class="col-xs-3 mg-b-md">
                        <div class="form-group">
                            <label>No SPB</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                                <input type="text" name="no_spb" id="no_spb" class="form-control"  placeholder="No SPB" value="<?php echo isset($row->no_spb) ? $row->no_spb : NULL; ?>" <?php echo !empty($row->no_spb)?"readonly":""?>/>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                <div class="col-xs-3 mg-b-sm">
                    <div class="form-group">
                        <label>Nama Supplier <?php echo $sess['users']->users_jenis?></label>
                           <select id="actor" name="actor" onchange="getActData()" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Supplier/Nasabah">
                                <option value="">-Pilih Supplier-</option>
                                <?php foreach ($supplier['ct'] as $nom => $ct) : ?>
                                     <option <?php if (isset($row->actor_id) && $row->actor_id == $ct->actor_id) echo "selected"; ?> value="<?php echo $ct->actor_id; ?>"><?php echo $ct->actor_name; ?></option>
                                <?php endforeach; ?>   
                            </select>
                    </div>
                    
                </div>
                <div class="col-xs-3 mg-b-md">
                        <div class="form-group">
                            <label>Supplier/Subcon Code</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                                <input type="text" class="codeAct form-control" value="<?php echo isset($mog_dt) ? $mog_dt->actor_code : NULL; ?>" placeholder="Code" readonly/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="npwp_tampil">
                        <div class="col-xs-3 mg-b-md">
                            <div class="form-group">
                                <label>NPWP</label>
                                <input type="text" class="npwpAct form-control" value="<?php echo isset($mog_dt) ? $mog_dt->actor_identity : NULL; ?>" placeholder="NPWP" readonly/>
                            </div>
                        </div>
                         <div class="col-xs-2 mg-b-sm">
                        <div class="form-group">
                            <label>Pilihan PKP/Non PKP</label><br />
                            <input type="radio" name="pph" id="pph" class="pph_pkp" value="PKP" checked> PKP
                            <input type="radio" name="pph" id="pph" class="pph_nonpkp" value="NonPKP"> Non PKP
                        </div>
                    </div>
                </div>
            
                
                <div class="pengajuan_tampil">
                    <div class="col-xs-3 mg-b-md">
                        <div class="form-group">
                            <label>No Pengajuan</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                                <input type="text" name="nomor_pengajuan" class="form-control" value="<?php echo isset($row->nomor_pengajuan) ? $row->nomor_pengajuan : $nomor_pengajuan; ?>" placeholder="No Pengajuan" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 mg-b-md">
                        <div class="form-group">
                            <label>Tanggal Pengiriman</label>
                            <input type="text" name="tanggal_kirim" class="datepicker form-control" value="<?php echo isset($row->tanggal_kirim) ? date("m/d/Y", strtotime($row->tanggal_kirim)) : NULL; ?>" placeholder="Tanggal Pengiriman"/>
                        </div>
                    </div>

                    <!-- edit by yenda -->
                    <div class="col-xs-3 mg-b-sm">
                        <div class="form-group">
                            <label>Nama Supplier <?php echo $sess['users']->users_jenis?></label>
                            <select name="supplier" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Supplier/Nasabah">
                                <option value="">-Pilih Supplier-</option>
                                <?php foreach ($supplier['ct'] as $nom => $ct) : ?>
                                        <option <?php if (isset($row->actor_id) && $row->actor_id == $ct->actor_id) echo "selected"; ?> value="<?php echo $ct->actor_id; ?>"><?php echo $ct->actor_name; ?></option>
                                <?php endforeach; ?>   
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-3 mg-b-sm">
                        <div class="form-group">
                            <label>No Kontrak</label>
                            <select name="no_kontrak" class="form-control form-select2" data-style="btn-white"> 
                                <option value="">--- select supplier first ---</option>
                            </select>
                        </div>
                    </div>
                    <!-- end edit by yenda -->
                    
                    <?php if ($role_id == 18) { ?>
                        <div class="col-xs-4 mg-b-md">
                        <div class="form-group">
                            <label>No Surat Jalan</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                                <input type="text" name="no_surat_jalan" id="no_surat_jalan" class="form-control"  placeholder="No Surat Jalan" value="<?php echo isset($row->mog_number_letter) ? $row->mog_number_letter : NULL; ?>" enable/>
                            </div>
                        </div>
                        </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
           
        </div>
        <section class="panel">
            <div class="panel-body row">
                <div class="row">
                    <table class="table table-bordered table-striped" style="margin-top: -13px">
                        <thead class="bg-dark" style="color: white">
                            <tr>
                                <th class="text-center hidden-xs" style="width: 30px; padding: 15px">No.</th>
                                <th class="text-center" style="width: 150px; padding: 15px">Uraian Barang</th>
                                <th class="text-center" style="width: 250px; padding: 15px">Sumber Daya</th>
                                <th class="text-center" style="width: 100px; padding: 15px">Unit/Satuan</th>
                                
                                <th class="text-center" style="width: 90px; padding: 15px">Konversi</th>
                                <th class="text-center" style="width: 90px; padding: 15px">Volume</th>
								
								<?php if($role_id!=15) { ?>
                                <th class="text-center" style="width: 140px; padding: 15px">Price</th>
								<th class="text-center hidden-xs" style="width: 150px; padding: 15px">Sub Total</th>
								<th class="text-center" style="width: 50px; padding: 15px"><i class="fa fa-gear"></i></th>
								<?php } ?>
                            </tr>
                        </thead>
                        <tbody id="show_row">
                           
                        </tbody>
                        <tr>
                            <td colspan="6"><button class="btn btn-md btn-dark col-xs-12 add_btn" onclick="adds_row()" type="button"><i class="fa fa-plus"></i></button></td>
                            <th>Budget Amount</th>
                            <th><input type="text" class="form-control" name="budget_amount" value="" readonly style="text-align:right" /></th>                            
                        </tr>
                        <tr>
                            <td colspan="6"></td>                                
                            <th>Grand Total Mog</th>
                            <th><input type="text" class="form-control" name="total_pengajuan" value="" readonly style="text-align:right" /></th>
                        </tr>
                        <tr>
                            <td colspan="6"></td>
                            <?php //if ($permit->access_special == 1) { ?>
                            <?php if($role_id!=15) { ?>
								<th class="text-right">Total (Rp.)</th>
                                <th>
                                    <input type="text" class="form-control" name="mog_total" id="mog_total" readonly style="text-align:right" />
                                    <input type="hidden" class="form-control" name="mog_total_h" readonly style="text-align:right" />                                    
                                </th>
                            <?php } ?>
							<?php //} ?>                            
                        </tr>
                    </table> 
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-xs-12" pull-right>
             <?php 
            if(!empty($idne)){
            if($sess['users']->users_divisi <> 1):
                $read="disabled";
                if($row->role_id==$sess['users']->users_divisi){
                    $read="";
                }
            //print_r($row->role_id."~".$read);
            ?>
               
                <div class="col-xs-6 col-xs-offset-6">
                        <button onclick="approved()" <?php echo $read?> type="button" id="approve" class="btn btn-primary"><i class="fa fa-check mg-r-sm"></i> Approve</button>
                    <?php if($sess['users']->users_divisi<>18 && $sess['users']->users_divisi<>17):?>
                         <button onclick="rejected(<?php echo $row->mog_id?>)" <?php echo $read?> type="button" id="reject" class="btn btn-danger"><i class="fa fa-check mg-r-sm"></i> Reject</button> 
                     <?php endif;?>
                    </div>
               
            <?php else:?>
                <div class="col-xs-6 col-xs-offset-6">
                    <button type="submit" id="save_btn" class="btn btn-primary col-xs-4"><i class="fa fa-check mg-r-sm"></i> Save</button> &nbsp;
                    <a href="<?php echo base_url()?>procurement/transaction/material"  class="cancelMt btn btn-danger"><i class="fa fa-times mg-r-sm"></i> Kembali </a>
                </div>
            <?php endif;
            }else{
            ?>
            <div class="col-xs-6 col-xs-offset-6">
                    <button type="submit" id="save_btn" class="btn btn-primary col-xs-4"><i class="fa fa-check mg-r-sm"></i> Save</button> &nbsp;
                    <a href="<?php echo base_url()?>procurement/transaction/material"  class="cancelMt btn btn-danger"><i class="fa fa-times mg-r-sm"></i> Kembali </a>
                </div>
            <?php } ?>    
            </div>
        </div>
        
    </div>
</section>
<?php echo form_close();?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".datepicker").datepicker();
        $("select.form-select2").select2();
             <?php if(!empty($idne)){?>
                $("#project").val('<?php echo $row->project_id?>');
                $("#tanggal").val('<?php echo date("d/m/Y", strtotime($row->tanggal_spb))?>');
                $("#no_bapb").val('<?php echo $row->no_bapb?>');
                $("#actor").val('<?php echo $row->actor_id?>');
                getActData();
                $("#show_row").load("<?php echo base_url() . $url_access . 'get_mog_detail/'.$idne.'/'.$aksi ?>");
             <?php } ?>   
            $(".cancelMt").click(function() {
                $(".load_main_data").load("<?php echo base_url() . $url_access . 'form'; ?>");
            });
            adds_row();

            $('[name=supplier]').change(function(){
                var supplier = $(this).val();
                var default_opt = '<option value="">--- select supplier first ---</option>';
                var first_opt 	= '<option value="">--- choose no contract ---</option>';
                var load_opt	= '<option value="">contains a list of data...</option>';

                if(supplier != ''){
                    $('[name=no_kontrak]').select2().select2().html(load_opt);
                    
                    $.post(
                        '<?php echo base_url($url_access.'ajax_by_id_supplier'); ?>'
                        , {
                            supplier : supplier
                        }
                        , function(data){ 
                            $('[name=no_kontrak]').select2().select2().html(first_opt);
                            $('[name=no_kontrak]').select2().select2().append(data);                
                        }               
                    );
                }
            });

            $('[name=no_kontrak]').change(function(){
                var no_kontrak = $(this).val();
                
                if(no_kontrak != ''){
                    $.post(
                        '<?php echo base_url($url_access.'ajax_get_total_pengajuan'); ?>'
                        , {
                            no_kontrak : no_kontrak
                        }
                        , function(data) { 
                            var result = data.split('#');

                            $('[name=budget_amount]').val(currency_commas(result[0]));                                          
                            $('[name=total_pengajuan]').val(currency_commas(result[1]));              
                        }               
                    );
                }
            });
        });

        function currency_commas(str) {
            var parts = (str + "").split("."),
                main = parts[0],
                len = main.length,
                output = "",
                i = len - 1;

            while(i >= 0) {
                output = main.charAt(i) + output;
                if ((len - i) % 3 === 0 && i > 0) {
                    output = "," + output;
                }
                --i;
            }
            if (parts.length > 1) {
                output += "." + parts[1];
            }
            return output;
        }

        function currencytonum(str){
            if (str == "") return 0;

            // replace all comma to blank
            str = str.replace(/\,/g, "");
            
            // str to int
            return parseFloat(str);
        }

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
                    <?php //if ($sess['position_id'] == 5 || ($sess['position_id'] == 1 && ((isset($mog_id) && $mog_dt->mog_status != 0) || !isset($mog_id)))) { ?>
                        + '<td>'
                        + '<input type="text" id="uraian_' + counter + '" name="uraian[]" value="" class="form-control" placeholder="Uraian">'
                        + '</td>'
                    <?php //} ?>
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
                    <?php //if ($sess['position_id'] == 5 || ($sess['position_id'] == 1 && ((isset($mog_id) && $mog_dt->mog_status != 0) || !isset($mog_id)))) { ?>					
                        + '<td>'
                        + '<input id="mog_dt_price_' + counter + '" class="form-control get_total" onkeyup="get_count(this,' + counter + ')" name="mog_dt_price[]" value="" class="form-control" placeholder="Price">'
                        + '</td>'
                        + '<td rowspan="2" style="padding-left: 18px" class="hidden-xs total_sub" id="total_sub_' + counter + '">'
                        + '</td>'
                    <?php //} ?>
                    + '<td rowspan="2" class="text-center"><button type="button" class="btn btn-danger" id="btn_' + counter + '" onclick="cut(this, ' + counter + ')" value="+"><i class="fa fa-times"></i></button></td>'
                    + '</tr><tr class="note_row_' + counter + '">'
                    + '<td class="hidden-xs" colspan="<?php echo $sess['position_id'] == 5 ? '5' : '4' ?>">'
                    + '<input type="text" maxlength="20" id="mog_dt_note_' + counter + '" name="mog_dt_note[]" value="" class="form-control" placeholder="Note (Panjang huruf 20 karakter)">'
                    + '</td></tr>';
                $('#show_row').append(baris);
                $('#material_select_' + counter).load("<?php echo base_url() . $url_access . 'get_material/all/'; ?>"+ counter);

                $('.get_total').keyup(function(){
                    var budget_amount   = $('[name=budget_amount]').val();
                        budget_amount   = parseInt(currencytonum(budget_amount));
                    var total_pengajuan = $('[name=total_pengajuan]').val();
                        total_pengajuan = parseInt(currencytonum(total_pengajuan));
                    var mog_total       = $('[name=mog_total_h]').val();
                        mog_total       = parseInt(currencytonum(mog_total));
                    var sum_pengajuan   = total_pengajuan + mog_total;

                    if(sum_pengajuan > budget_amount){
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Total pengajuan tidak boleh > dari budget amount");
                        $('#save_btn').attr('disabled', true);
                        return false; 
                    }
                    else{
                        $('#save_btn').attr('disabled', false);                        
                    }
                });
        }

        function get_unit(i) {
            $.ajax({
                url: "<?php echo base_url() . $url_access . 'get_unit_material'; ?>/" + $('#material_' + i).val() + '/' + $('#project').val(),
                dataType: "JSON",
                success: function(json) {
                    //if (json.status == 1) {
                        // if(json.stock_fn != 0) {
                            $("#mog_dt_unit_" + i).attr('value', json.data.satuan);
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
                        // } else {
                            //                        $("#material_" + i + " option:selected").prop('selected', false);
                            /*$("#kosong").attr("selected", true);
                            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material tidak bisa dipilih, harap input stok awal terlebih dahulu");
                            return false;*/
                        // }
                    //}
                }
            });
            return false;
        }

        //console.log('write code of remove item.');
        /*$.ajax({
            url: "<?php echo base_url() . $url_access . 'approve'; ?>",
            type:"POST",
            data:{"id":id, "no_spb":spb},
            success: function(result) {
                window.location.href="<?php echo base_url() ?>procurement/transaction/material";
            }
        });*/

        function approved(){
            var spb = $("#no_spb").val()
            var no_bapb = $("#no_bapb").val()
            var jenis_procurement = $("#jenis_procurement").val()

                bootbox.confirm("Anda Yakin akan Menyetujui data Pengajuan ini?", function(result) {
                    if(result){
                        //$("#save_btn").click();
                        var form = $('#formTransM').get(0);
                        
                        var formData = new FormData(form);
                        $.ajax({
                            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                            contentType: false, // The content type used when sending data to the server.
                            cache: false,       // To unable request pages to be cached
                            processData:false,
                            type: "POST",
                            url: "<?php echo base_url() . $url_access . 'approve/'; ?>" + jenis_procurement,
                            success: function(response) {
                                <?php if(isset($row->role_id)):
                                    if($row->role_id==19){
                                ?>
                                    window.location.href="<?php echo base_url() ?>procurement/transaction/material/cetak_bapb/<?php echo $idne; ?>";
                                <?php }elseif($row->role_id==12 || $row->role_id==13 || $row->role_id==10 || $row->role_id==7){?>
                                window.location.href="<?php echo base_url() ?>procurement/transaction/material/cetak_spb/<?php echo $idne; ?>";
                                <?php }else{ ?>
                                    window.location.href="<?php echo base_url() ?>procurement/transaction/material";
                                <?php
                                }
                                else:
                                ?>
                                    window.location.href="<?php echo base_url() ?>procurement/transaction/material";
                                <?php
                                endif;  
                                ?>
                                //window.location.href="<?php echo base_url() ?>procurement/transaction/material";
                            }
                        });
                        //return false;
                    }
                }); 
        }

        function rejected(id){
            bootbox.prompt({
                title: "This is a prompt with a textarea!",
                inputType: 'textarea',
                callback: function (result) {
                    if(result!=""){
                        $.ajax({
                            type:"POST",
                            url: "<?php echo base_url() . $url_access . 'reject'; ?>/" + id,
                            data:{"id":id, "komentar":result},
                            //dataType: "JSON",
                            success: function(json) {
                                window.location.href="<?php echo base_url() ?>procurement/transaction/material";
                            }
                        });
                    }
                    return false;
                }
            });
            /*bootbox.confirm("Anda Yakin akan Menolak data Pengajuan ini?", function(result) {
                if(result){
                    
                }
            }); */
        }

        function getActData() {
            $.ajax({
                url: "<?php echo base_url() . $url_access . 'getdata_suplier'; ?>/" + $('#actor').val(),
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 1) {
                        $(".codeAct").attr('value', json.data.actor_code);
                        $(".npwpAct").attr('value', json.data.npwp);
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
            $('[name=mog_total_h]').val(total);
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
            
            if ($("input[name=tanggal]").val() == "") {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Tanggal Pengajuan/SPB can not empty");
                //$("select[name=mog_number] option:selected").focus();
                $("input[name=tanggal]").focus();
                return false;
            }

            if ($("[name=supplier]").val() == "") {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Supplier can not empty");
                //$("select[name=mog_number] option:selected").focus();
                $("input[name=supplier]").focus();
                return false;
            }

            if ($("[name=no_kontrak]").val() == "") {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>No. Kontrak can not empty");
                //$("select[name=mog_number] option:selected").focus();
                $("input[name=no_kontrak]").focus();
                return false;
            }
            
            /* if ($("input[name=mog_number_letter]").val() == "") {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Letter Number can not empty");
                $("input[name=mog_number_letter]").focus();
                return false;
            }*/
            
            /*if ($("input[name=actor]").val() == "") {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Supplier can not empty");
                $("input[name=actor]").focus();
                return false;
            }*/
            
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
            var form = $('#formTransM').get(0);
            var formData = new FormData(form);
            $.ajax({
                url: $("#formTransM").attr('action'),
                data: formData,
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
                        
                        window.location.href="<?php echo base_url() ?>procurement/transaction/material";    
                        
                    }
                }
            });
            return false;
        });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
