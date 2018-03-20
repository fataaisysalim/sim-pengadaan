<script src="<?php echo base_url() ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url() ?>vendor/jquery/jquery_ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/skin/default_skin/css/theme.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/min/main.min.css">
<script src="<?php echo base_url() ?>assets/folarium/for.library.min.js"></script>
        
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
            <input type="hidden" name="mog_id" value="<?php echo $idne; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">

                    <div class="col-xs-4">
                    <div class="form-group">
                        <label>Nama Proyek</label>
                        <div class="input-group mg-b-md">
                            <?php echo $row->project_name;?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="form-group">
                        <label>SURAT PESANAN BARANG</label>
                        <div class="input-group mg-b-md">
                           <table class="table">
                               <tr>
                                   <td>No</td>
                                   <td>:</td>
                                   <td><?php echo isset($row->no_spb)?$row->no_spb:""?> / <?php echo $row->project_code?>-MDAN / XI / <?php echo date('Y')?></td>
                               </tr>
                               
                           </table>
                        </div>
                    </div>
                </div>

               <!--  <div class="col-xs-4">
                    <div class="form-group">
                        <label>Jenis Procurement</label>
                        <div class="input-group mg-b-md">
                            <?php echo $row->jenis_procurement;?>
                        </div>
                    </div>
                </div> -->
                
        </div>  
        <div class="row">
        <hr />
            <div class="col-xs-8">
                <div class="form-group">
                    <label>Dengan Hormat, </label>
                    <div class="input-group mg-b-md">
                        Berdasarkan Surat Perjanjian Tanggal <?php echo indo_date($row->mog_date,1,1)?> , Serta Adendum kesatu tanggal <?php echo indo_date($row->tanggal_kirim,1,1)?> , maka kami memesan material seperti yang tercantum dibawah ini :
                    </div>
                </div>
            </div>           
        </div>
        </div>
        <!--div class="row">
            <div class="col-xs-4 mg-b-sm">
                <div class="form-group">
                    <label>Nama Supplier <?php echo $sess['users']->users_jenis?></label>
                       <?php $idSupplier   = $row->actor_id;
                        $supplier_id    = $this->crud_model->getNameSupplier($idSupplier);
                        ?>
                        <?php 
                        if($supplier_id->num_rows()) {
                            echo $supplier_id->row()->actor_name;
                        }?>
                </div>
                
            </div>
            <div class="col-xs-4 mg-b-md">
                <div class="form-group">
                    <label>Supplier/Subcon Code</label>
                    <div class="input-group mg-b-md">
                        <?php 
                        if($supplier_id->num_rows()) {
                            echo $supplier_id->row()->actor_code;
                        }?>
                    </div>
                </div>
            </div>
            <div class="col-xs-4 mg-b-md">
                <div class="form-group">
                    <label>Npwp</label>
                    <div class="input-group mg-b-md">
                        <?php 
                        if($supplier_id->num_rows()) {
                            echo $supplier_id->row()->npwp;
                        }?>
                    </div>
                </div>
            </div>
        </div-->
           
            <!-- <div class="row pengajuan_tampil">
                <div class="col-xs-4 mg-b-md">
                    <div class="form-group">
                        <label>Tanggal Pengiriman</label>
                        <?php echo indo_date($row->tanggal_kirim, 1, 1) ?>
                    </div>
                </div>   
            </div> -->
        <section class="panel">
            <div class="panel-body row">
                <div class="row">
                    <table class="table table-bordered table-striped" style="margin-top: -13px">
                        <thead class="bg-dark" style="color: white">
                            <tr>
                                <th class="text-center hidden-xs" style="width: 30px; padding: 15px">No.</th>
                                 <th class="text-center" style="width: 150px; padding: 15px">KODE S. DAYA</th>
                                <th class="text-center" style="width: 250px; padding: 15px">JENIS MATERIAL</th>
                                <th class="text-center" style="width: 100px; padding: 15px">SATUAN</th>
                                
                                <th class="text-center" style="width: 90px; padding: 15px">VOLUME</th>
                               
                                <th class="text-center" style="width: 140px; padding: 15px">H.SATUAN</th>
                                <th class="text-center hidden-xs" style="width: 150px; padding: 15px">JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody id="show_row">
                           <?php 
                           $total=0;
                           foreach($mog_dt as $i => $row) { 
                            $total = $total+$row->mog_dt_price;
                            ?>
                            <?php $no = $i + 1; ?>
                            <tr class="row_out row_tam">
                                <td class="text-center hidden-xs"><p <?php echo $row->mog_dt_status == 1 ? NULL : "style='background-color: red'"; ?> id="nom_<?php echo $no; ?>"><?php echo ++$i; ?></p></td>
                                <td>
                                <?php echo $row->code_id; ?>
                                </td>
                                <?php //} ?>
                                <td id="material_counter_<?php echo $no; ?>">
                                    <?php echo $row->material_sub_name; ?>
                                </td>
                                <td class="hidden-xs">
                                    <?php echo $row->material_unit_name; ?>
                                </td>
                                <td>
                                    <?php echo rupiah($row->mog_dt_volume); ?>
                                </td>
                                <td>
                                    <?php echo isset($row->mog_dt_price) ? rupiah($row->mog_dt_price) : NULL; ?>
                                </td>
                                <td class="hidden-xs total_sub" id="total_sub_<?php echo $no; ?>">
                                    <?php $convert = $row->mog_dt_convertion == 0 ? 1 : $row->mog_dt_convertion; echo isset($row->mog_dt_price) ? rupiah($row->mog_dt_price * $row->mog_dt_volume * $convert) : NULL; ?>
                                </td>
                                
                            </tr>
                            <tr class="note_row_<?php echo $no; ?>">
                                <td class="hidden-xs" colspan="6">
                                    <?php echo $row->mog_dt_note; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                         <tr>
                            <td colspan="5">&nbsp;</td>
                            <?php //if ($permit->access_special == 1) { ?>
                                <th class="text-right">Total (Rp.)</th>
                                <th><?php echo $total?></th>
                            <?php //} ?>
                        </tr>
                    </table> 
                </div>
                
                <div class="row">
                <div class="col-xs-1 mg-b-md">&nbsp;</div>
                    <div class="col-xs-3 mg-b-md">
                        <div class="form-group">
                            <label>Mengetahui, <br /> PT WIJAYA KARYA BANGUNAN GEDUNG</label>
                            <div class="input-group mg-b-md">
                            <br />
                            <br />
                               <p>(.........)</p>
                            </div>
                        </div>
                    </div>
                     <div class="col-xs-3 mg-b-md">
                        <div class="form-group">
                            <label>Menyetujui, <br />-</label>
                            <div class="input-group mg-b-md">
                            <br />
                            <br />
                               <p>(........).</p>
                            </div>
                        </div>
                    </div>
                     <div class="col-xs-3 mg-b-md">
                        <div class="form-group">
                            <label>Pemesan, <br /> PT WIJAYA KARYA BANGUNAN GEDUNG</label>
                            <div class="input-group mg-b-md">
                            <br />
                            <br />
                               <p>(.........)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"><center><input type="button" onclick="print_pengajuan()" value="Print" id="print"></center></div>
        </section>
    </div>
</section>
<?php echo form_close();?>
<script type="text/javascript">
    $(document).ready(function() {
            
            
            

        });

           

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

            function print_pengajuan(){
                $("#print").hide();
                window.print(); 
                window.location.href="<?php echo base_url() ?>procurement/transaction/material";
            }
        /*window.onload = function() { 
          
        } */       
                
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
