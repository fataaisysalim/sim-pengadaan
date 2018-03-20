<div class="saving"></div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo strtoupper($act . ' ' . $header); ?>
    </header>
    <div class="panel-body" style="margin-top: -10px">
        <?php echo form_open_multipart($url_action, array('id' => 'form')); ?>
        <?php if (!empty($actor_dt)) { ?>
            <input type="hidden" name="actor_id" value="<?php echo $actor_dt->actor_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <input type="hidden" name="actor_ct" value="<?php echo $ct_actor; ?>"/>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label><?php echo strtoupper($header) ?> NAME</label>
                    <input type="text" name="actor_name" value="<?php echo empty($actor_dt) ? set_value('actor_name') : $actor_dt->actor_name; ?>" class="form-control" placeholder="<?php echo strtoupper($header); ?> NAME">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>NPWP <?php echo strtoupper($header) ?></label>
                    <input type="text" name="actor_identity" value="<?php echo empty($actor_dt) ? set_value('actor_identity') : $actor_dt->actor_identity; ?>" class="form-control" placeholder="NPWP <?php echo strtoupper($header) ?>">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-sm">
                <div class="form-group">
                    <label><?php echo strtoupper($header) ?> ADDRESS</label>
                    <textarea name="actor_address" class="form-control" placeholder="ALAMAT <?php echo strtoupper($header) ?>"><?php echo empty($actor_dt) ? set_value('actor_address') : $actor_dt->actor_address; ?></textarea>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 mg-t-sm">
                <div class="form-group">
                    <label>TELP</label>
                    <input type="text" name="actor_phone" value="<?php echo empty($actor_dt) ? set_value('actor_phone') : $actor_dt->actor_phone; ?>" class="form-control" placeholder="TELP.">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 mg-t-sm">
                <div class="form-group">
                    <label>EMAIL</label>
                    <input type="text" name="actor_email" value="<?php echo empty($actor_dt) ? set_value('actor_email') : $actor_dt->actor_email; ?>" class="form-control" placeholder="EMAIL">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-sm">
                <div class="form-group">
                    <label>PKP DATE</label>
                    <?php
                    $date_ = '';
                    if (!empty($actor_dt)) :
                        if ($actor_dt->actor_pkp_date == '0000-00-00') :
                            $date_ = '';
                        elseif ($actor_dt->actor_pkp_date == '1970-01-01'):
                            $date_ = '';
                        elseif ($actor_dt->actor_pkp_date == ''):
                            $date_ = '';
                        else:
                            $date_ = date("d-m-Y", strtotime($actor_dt->actor_pkp_date));
                        endif;
                    endif;
                    ?>
                    <div class="input-group input-append date datepicker" data-date="<?php echo empty($actor_dt) ? set_value('actor_pkp_date') : $date_; ?>" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control datedate" name="actor_pkp_date" value="<?php echo empty($actor_dt) ? set_value('actor_pkp_date') : $date_; ?>" placeholder="PKP DATE">
                        <span class="input-group-btn"><button class="btn btn-white add-on" type="button"><i class="fa fa-calendar"></i></button></span>
                    </div>
                    <input type="checkbox" name="actor_pkp_date_checked" value="1"/> CLEAR
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 mg-t-sm">
                <div class="form-group">
                    <label>NUMBER PKP</label>
                    <input type="text" name="actor_pkp_number" value="<?php echo empty($actor_dt) ? set_value('actor_pkp_number') : $actor_dt->actor_pkp_number; ?>" class="form-control" placeholder="NUMBER PKP">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 mg-t-sm">
                <div class="form-group">
                    <label><?php echo strtoupper($header) ?> CODE</label>
                    <input type="text" name="actor_code" value="<?php echo empty($actor_dt) ? set_value('actor_code') : $actor_dt->actor_code; ?>" class="form-control" placeholder="<?php echo strtoupper($header) ?> CODE">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <?php if (!empty($actor_dt)) { ?>
                <div class="<?php echo!empty($actor_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" class="cancel btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> CANCEL </a>
                </div>
            <?php } ?>
            <div class="<?php echo!empty($actor_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> SAVE</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $(".datepicker").datepicker();
<?php if ($permit->access_create == 0) { ?>
            $("#display-form").attr("class","col-lg-4 col-md-4 col-sm-12");    
            $("#load_main_data").attr("class","col-lg-8 col-md-8 col-sm-12");
<?php } ?>
        $(".cancel").click(function() {
<?php if ($permit->access_create == 1) { ?>
                $("#load_sub_form").load('<?php echo base_url($url) ?>/form');
<?php } else { ?>
                $("#display-form").attr("class","hidden");    
                $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
        });
        $("input[name=actor_pkp_date_checked]").click(function () {
            var sts = $("input[name=actor_pkp_date_checked]").val();
            if (sts == 1) {
                $("input[name=actor_pkp_date]").attr("disabled", "disabled");
                $("input[name=actor_pkp_number]").attr("disabled", "disabled");
                $(".tg_pkp").attr("disabled", "disabled");
                $("input[name=actor_pkp_date]").val('');
                $("input[name=actor_pkp_number]").val('');
                $("input[name=actor_pkp_date_checked]").val('0');
            } else {
                $("input[name=actor_pkp_date]").removeAttr("disabled", "disabled");
                $("input[name=actor_pkp_number]").removeAttr("disabled", "disabled");
                $(".tg_pkp").removeAttr("disabled", "disabled");
                $("input[name=actor_pkp_date_checked]").val('1');
            }
        });
        $("#form").submit(function () {
            if ($("input[name=actor_name").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> <?php echo $header ?> Name can not be empty");
                $("input[name=actor_name").focus();
                return false;
            }
            if ($("input[name=actor_identity").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> <?php echo $header ?> Identity can not be empty");
                $("input[name=actor_identity").focus();
                return false;
            }
            if ($("input[name=actor_address").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> <?php echo $header ?> Address can not be empty");
                $("input[name=actor_address").focus();
                return false;
            }
            if ($("input[name=actor_code").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> <?php echo $header ?> Code can not be empty");
                $("input[name=actor_code").focus();
                return false;
            }
            if ($("input[name=actor_phone").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> <?php echo $header ?> Phone can not be empty");
                $("input[name=actor_phone").focus();
                return false;
            }

            $(".saving").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i> Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function (json) {
                    if (json.status == 0) {
                        $(".saving").html(json.msg);
                    } else {
<?php if ($permit->access_create == 1) { ?>
                            $("#load_sub_form").load('<?php echo base_url($url) ?>/form');
<?php } else { ?>
                            $("#display-form").attr("class","hidden");    
                            $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
                        $("#load_main_data").load('<?php echo base_url($url) ?>/table');
                    }
                }
            });
            return false;
        });
    });
</script>