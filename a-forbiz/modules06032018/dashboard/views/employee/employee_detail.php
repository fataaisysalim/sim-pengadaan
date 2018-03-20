
<div class="panel-body">
    <div class="col-xs-12">
        <table class="table">
            <tr>
                <?php if (!empty($employee_dt->employee_photo)) { ?>
                    <td rowspan="6" style="min-width: 250px">
                        <img src="<?php echo base_url() ?>assets/image/<?php echo $employee_dt->employee_photo; ?>"
                    </td>
                <?php } ?>
                <td>Employee Name</td>
                <td>:</td>
                <td><input disabled type="text" name="employee_name" value="<?php echo $employee_dt->employee_name; ?>" class="form-control" placeholder="Employee Name"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><input disabled type="text" name="employee_address" value="<?php echo $employee_dt->employee_address; ?>" class="form-control" placeholder="Employee Address"></td>
            </tr>
            <tr>
                <td>Telephone</td>
                <td>:</td>
                <td><input disabled type="text" name="employee_phone" value="<?php echo $employee_dt->employee_phone; ?>" class="form-control" placeholder="Telephone"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><input disabled type="text" name="employee_email" value="<?php echo $employee_dt->employee_email; ?>" class="form-control" placeholder="Email"></td>
            </tr>
        </table>                  
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-search mg-r-md"></i>Detail Employee');
</script>