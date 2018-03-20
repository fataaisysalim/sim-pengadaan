<div class="panel-body">
    <div class="col-xs-12">
        <table class="table">
            <tr>
                <td rowspan="6" style="max-width: 250px">
                    <img src="<?php echo base_url() ?>assets/<?php echo!empty($supplier_dt->actor_image) ? "image/$supplier_dt->actor_image" : "folarium/nonuser.png"; ?>"
                </td>
                <td>Supplier Name</td>
                <td>:</td>
                <td><input disabled type="text" name="actor_name" value="<?php echo $supplier_dt->actor_name; ?>" class="form-control" placeholder="Nama <?php echo $header; ?>"></td>
            </tr>
            <tr>
                <td>Supplier NPWP</td>
                <td>:</td>
                <td><input disabled type="text" name="actor_identity" value="<?php echo $supplier_dt->actor_identity; ?>" class="form-control" placeholder="Identitas Supplier"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><input disabled type="text" name="actor_address" value="<?php echo $supplier_dt->actor_address; ?>" class="form-control" placeholder="Alamat Supplier"></td>
            </tr>
            <tr>
                <td>Telephone</td>
                <td>:</td>
                <td><input disabled type="text" name="actor_phone" value="<?php echo $supplier_dt->actor_phone; ?>" class="form-control" placeholder="Telp"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><input disabled type="text" name="actor_email" value="<?php echo $supplier_dt->actor_email; ?>" class="form-control" placeholder="Email"></td>
            </tr>
            <tr>
                <td>Code</td>
                <td>:</td>
                <td><input disabled type="text" name="actor_code" value="<?php echo $supplier_dt->actor_code; ?>" class="form-control" placeholder="Kode"></td>
            </tr>
        </table>                    
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-search mg-r-md"></i>Detail Supplier');
</script>