<div class="panel-body">
    <div class="col-xs-12">
        <img style="width: 100%; margin-bottom: 20px" class="visible-xs" src="<?php echo base_url() ?>assets/<?php echo!empty($atr->actor_image) ? "image/$atr->actor_image" : "folarium/nonuser.png"; ?>"/>
        <div class="row">
            <table class="table">
                <tr>
<!--                    <td rowspan="9" class="hidden-xs" style="max-width: 250px; padding-right: 10px">
                        <img src="<?php echo base_url() ?>assets/<?php echo!empty($atr->actor_image) ? "image/$atr->actor_image" : "folarium/nonuser.png"; ?>"
                    </td>-->
                    <td><?php echo strtoupper($atr->actor_category_name); ?> NAME</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_name" value="<?php echo $atr->actor_name; ?>" class="form-control" placeholder="Nama"></td>
                </tr>
                <tr>
                    <td><?php echo strtoupper($atr->actor_category_name); ?> NPWP</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_identity" value="<?php echo $atr->actor_identity; ?>" class="form-control" placeholder="Identitas Supplier"></td>
                </tr>
                <tr>
                    <td><?php echo strtoupper($atr->actor_category_name); ?> ADDRESS</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_address" value="<?php echo $atr->actor_address; ?>" class="form-control" placeholder="Alamat Supplier"></td>
                </tr>
                <tr>
                    <td>TELEPOHONE</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_phone" value="<?php echo $atr->actor_phone; ?>" class="form-control" placeholder="Telp"></td>
                </tr>
                <tr>
                    <td>EMAIL</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_email" value="<?php echo $atr->actor_email; ?>" class="form-control" placeholder="Email"></td>
                </tr>
                <tr>
                    <td>CODE</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_code" value="<?php echo $atr->actor_code; ?>" class="form-control" placeholder="Kode"></td>
                </tr>
                <tr>
                    <td>PKP DATE</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_pkp_date" value="<?php echo ($atr->actor_pkp_date == '0000-00-00' OR $atr->actor_pkp_date == '1970-01-01' OR $atr->actor_pkp_date == '') ? ' - ' : date_format_indo_tgl($atr->actor_pkp_date); ?>" class="form-control" placeholder="PKP Date"></td>
                </tr>
                <tr>
                    <td>NUMBER PKP</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_pkp_number" value="<?php echo $atr->actor_pkp_number; ?>" class="form-control" placeholder="Number PKP"></td>
                </tr>
            </table>
        </div>                    
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<a role="button" onclick="backAtr()" class="pull-left btn btn-sm btn-danger" style="margin-top:-5px"><i class="fa fa-reply"></i></a><i class="fa fa-search mg-r-md"></i> DETAIL <?php echo strtoupper($atr->actor_category_name); ?>');
    function backAtr() {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url($url) ?>");

    }
</script>