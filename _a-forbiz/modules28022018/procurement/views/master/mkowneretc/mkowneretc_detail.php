<div class="panel-body">
    <div class="col-xs-12">
        <img style="width: 100%; margin-bottom: 20px" class="visible-xs" src="<?php echo base_url() ?>assets/<?php echo!empty($mkowneretc_dt->actor_image) ? "image/$mkowneretc_dt->actor_image" : "folarium/nonuser.png"; ?>"/>
        <div class="row">
            <table class="table">
                <tr>
                    <td rowspan="9" class="hidden-xs" style="max-width: 250px; padding-right: 10px">
                        <img src="<?php echo base_url() ?>assets/<?php echo!empty($mkowneretc_dt->actor_image) ? "image/$mkowneretc_dt->actor_image" : "folarium/nonuser.png"; ?>"
                    </td>
                    <td>Owner</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_name" value="<?php echo $mkowneretc_dt->actor_name; ?>" class="form-control" placeholder="Nama <?php echo $header; ?>"></td>
                </tr>
                <tr>
                    <td>NPWP</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_identity" value="<?php echo $mkowneretc_dt->actor_identity; ?>" class="form-control" placeholder="Identitas MK / Owner / Dll"></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_address" value="<?php echo $mkowneretc_dt->actor_address; ?>" class="form-control" placeholder="Alamat MK / Owner / Dll"></td>
                </tr>
                <tr>
                    <td>Telephone</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_phone" value="<?php echo $mkowneretc_dt->actor_phone; ?>" class="form-control" placeholder="Telp"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_email" value="<?php echo $mkowneretc_dt->actor_email; ?>" class="form-control" placeholder="Email"></td>
                </tr>
                <tr>
                    <td>Sender Code</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_code" value="<?php echo $mkowneretc_dt->actor_code; ?>" class="form-control" placeholder="Kode"></td>
                </tr>
                <tr>
                    <td>PKP Date</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_pkp_date" value="<?php echo ($mkowneretc_dt->actor_pkp_date == '') ? '' : date_format_indo_tgl($supplier_dt->actor_pkp_date); ?>" class="form-control" placeholder="PKP Date"></td>
                </tr>
                <tr>
                    <td>PKP Number</td>
                    <td>:</td>
                    <td><input disabled type="text" name="actor_pkp_number" value="<?php echo !empty($mkowneretc_dt->actor_pkp_number)?$mkowneretc_dt->actor_pkp_number:"-"; ?>" class="form-control" placeholder="Number PKP"></td>
                </tr>
            </table>
        </div>                    
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<a role="button" onclick="back_sup()" class="pull-left btn btn-sm btn-danger" style="margin-top:-5px"><i class="fa fa-reply"></i></a><i class="fa fa-search mg-r-md"></i>Detail Sender');
    function back_sup() {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>secretariat/mkowneretc/info/");

    }
</script>