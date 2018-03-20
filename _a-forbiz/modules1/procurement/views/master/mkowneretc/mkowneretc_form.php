<div class="saving"></div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $act . ' ' . $title; ?>
    </header>
    <div class="panel-body" style="margin-top: -10px">
        <?php echo form_open_multipart($url_action, array('id' => 'form')); ?>
        <?php if (!empty($mkowneretc_dt)) { ?>
            <input type="hidden" name="actor_id" value="<?php echo $mkowneretc_dt->actor_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Sender Name</label>
                    <input type="text" name="actor_name" value="<?php echo empty($mkowneretc_dt) ? set_value('actor_name') : $mkowneretc_dt->actor_name; ?>" class="form-control" placeholder="Nama Owner">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>NPWP</label>
                    <input type="text" name="actor_identity" value="<?php echo empty($mkowneretc_dt) ? set_value('actor_identity') : $mkowneretc_dt->actor_identity; ?>" class="form-control" placeholder="NPWP">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-sm">
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="actor_address" class="form-control" placeholder="Alamat"><?php echo empty($mkowneretc_dt) ? set_value('actor_address') : $mkowneretc_dt->actor_address; ?></textarea>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-sm">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="actor_email" value="<?php echo empty($mkowneretc_dt) ? set_value('actor_email') : $mkowneretc_dt->actor_email; ?>" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 mg-t-sm">
                <div class="form-group">
                    <label>Telp</label>
                    <input type="text" name="actor_phone" value="<?php echo empty($mkowneretc_dt) ? set_value('actor_phone') : $mkowneretc_dt->actor_phone; ?>" class="form-control" placeholder="Telephone">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 mg-t-sm">
                <div class="form-group">
                    <label>Sender Code</label>
                    <input type="text" name="actor_code" value="<?php echo empty($mkowneretc_dt) ? set_value('actor_code') : $mkowneretc_dt->actor_code; ?>" class="form-control" placeholder="Sender Code">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-md-6 mg-t-sm">
                        <div class="form-group">
                            <label>PKP Date</label>
                            <?php
                            $date_ = '';
                            if (!empty($mkowneretc_dt)) :
                                if ($mkowneretc_dt->actor_pkp_date == '0000-00-00') :
                                    $date_ = '';
                                elseif ($mkowneretc_dt->actor_pkp_date == '1970-01-01'):
                                    $date_ = '';
                                elseif ($mkowneretc_dt->actor_pkp_date == ''):
                                    $date_ = '';
                                else:
                                    $date_ = date("d-m-Y", strtotime($mkowneretc_dt->actor_pkp_date));
                                endif;
                            endif;
                            ?>
                            <div class="input-group input-append date datepicker" data-date="<?php echo empty($mkowneretc_dt) ? set_value('actor_pkp_date') : $date_; ?>" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control datedate" name="actor_pkp_date" value="<?php echo empty($mkowneretc_dt) ? set_value('actor_pkp_date') : $date_; ?>" placeholder="PKP Date">
                                <span class="input-group-btn"><button class="btn btn-white add-on tg_pkp" type="button"><i class="fa fa-calendar"></i></button></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mg-t-md">
                        <div class="form-group mg-t-lg">
                            <input type="checkbox" name="actor_pkp_date_checked" value="1"/> Kosongkan
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 mg-t-sm">
                <div class="form-group">
                    <label>PKP Number</label>
                    <input type="text" name="actor_pkp_number" value="<?php echo empty($mkowneretc_dt) ? set_value('actor_pkp_number') : $mkowneretc_dt->actor_pkp_number; ?>" class="form-control" placeholder="Nomor PKP">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 mg-t-sm">
                <?php if (!empty($mkowneretc_dt)) { ?>
                    <?php if (!empty($mkowneretc_dt->actor_image)) { ?>
                        <img src="<?php echo base_url() ?>assets/image<?php echo $mkowneretc_dt->actor_image ?>"
                    <?php } ?>
                <?php } ?>
                     <div class="form-group">
                    <label>Photo</label>
                    <input type="file" name="foto" placeholder="Foto">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($mkowneretc_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($mkowneretc_dt)) { ?>
                <div class="<?php echo!empty($mkowneretc_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" class="cancel btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $(".datepicker").datepicker();
        $(".cancel").click(function () {
            $("#load_sub_form").load('<?php echo base_url() ?>secretariat/mkowneretc/form');
        });
        $("input[name=actor_pkp_date_checked]").click(function(){
            var sts = $("input[name=actor_pkp_date_checked]").val();
            if(sts == 1){
                $("input[name=actor_pkp_date]").attr("disabled","disabled");
                $(".tg_pkp").attr("disabled","disabled");
                $("input[name=actor_pkp_date]").val('');
                $("input[name=actor_pkp_date_checked]").val('0');
            }else{
                $("input[name=actor_pkp_date]").removeAttr("disabled","disabled");
                $(".tg_pkp").removeAttr("disabled","disabled");
                $("input[name=actor_pkp_date_checked]").val('1');
            }
        })
        $("#form").submit(function () {
            if ($("input[name=actor_name").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nama MK / Owner / Dll tidak boleh kosong");
                $("input[name=actor_name").focus();
                return false;
            }
            if ($("input[name=actor_identity").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nomor Identitas tidak boleh kosong");
                $("input[name=actor_identity").focus();
                return false;
            }
            if ($("input[name=actor_address").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Alamat tidak boleh kosong");
                $("input[name=actor_address").focus();
                return false;
            }
            if ($("input[name=actor_code").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Kode tidak boleh kosong");
                $("input[name=actor_code").focus();
                return false;
            }
            if ($("input[name=actor_phone").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Telepon tidak boleh kosong");
                $("input[name=actor_phone").focus();
                return false;
            }

            $(".saving").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function (json) {
                    if (json.status == 0) {
                        $(".saving").html(json.msg);
                    } else {
                        $(".load_main_data").load('<?php echo base_url() ?>secretariat/mkowneretc/table');
                        $("#load_sub_form").load('<?php echo base_url() ?>secretariat/mkowneretc/form');
                    }
                }
            });
            return false;
        });
    });

</script>