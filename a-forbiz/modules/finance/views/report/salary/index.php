<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<?php echo form_open("", array('id' => "forms")); ?>
<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label>Project</label>
            <select id="projectsalary" name="projectsalary" class="form-control form-select2" data-style="btn-white">
                <?php foreach ($project as $i => $pro) : ?>
                    <option value="<?php echo md5($pro->project_id); ?>"><?php echo ucwords($pro->project_name); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br style="margin-bottom: 15px" class="visible-xs"/>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label>Foreman</label>
            <select id="actor" name="actor" class="form-control form-select2 actoras" data-style="btn-white" data-placeholder="Pilih Mandor">
                <option value="">All</option>
                <?php foreach ($mandor['ct'] as $nom => $ct) : ?>
                    <optgroup label="<?php echo $ct->actor_category_name; ?>">
                        <?php foreach ($mandor['act'][$nom] as $num => $man) : ?>
                            <option value="<?php echo md5($man->actor_id); ?>"><?php echo $man->actor_name; ?></option>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
            </select>
            <div class="clearfix visible-xs" style="margin-top: 0px;">&nbsp;</div>
        </div>
    </div>
    <div class="col-sm-4 col-xs-12">
        <label>Date :</label>
        <div class="row">
            <div class="col-sm-5">
                <div class="input-group input-append date datepickers" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                    <input type="text" class="form-control startas" name="start" value="<?php echo date('d-m-Y') ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-white add-on" type="button">
                            <i class="fa fa-calendar"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="clearfix visible-xs" style="margin-top: 0px;">&nbsp;</div>
            <div class="col-sm-2 hidden-xs"><b style="font-size: 20px; padding-top: 120px">-</b></div>
            <div class="col-sm-5">
                <div class="input-group input-append date datepickers" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                    <input type="text" class="form-control endas" name="end" value="<?php echo date('d-m-Y') ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-white add-on" type="button">
                            <i class="fa fa-calendar"></i>
                        </button>
                    </span>
                </div>
                <div class="clearfix visible-xs" style="margin-top: 0px;">&nbsp;</div>
            </div>
        </div>
    </div>
    <div class="col-sm-2 col-xs-12">
        <div style="margin-top: 6px;" class="hidden-xs">&nbsp;</div>
        <button type="submit" class="btn btn-block btn-sm btn-primary" >
            <i class="fa fa-search mg-r-sm"></i>Search
        </button>
    </div>
    <div class="col-sm-2 col-xs-6 hidden-xs">
        <div style="margin-top: 6px;" class="hidden-xs">&nbsp;</div>
        <a onclick="onExport()" class="btn btn-block btn-sm btn-dark"><i class="fa fa-download"></i> <span class="mg-l-sm hidden-xs"></span> Excel</a>
    </div>
    <?php echo form_close(); ?>
</div>
<hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 load_main_data"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".datepickers").datepicker();
        $("select.form-select2").select2();
        $(".load_main_data").load("<?php echo base_url() ?>finance/report/salary/table/" + $("select[name=projectsalary] option:selected").val() + "/" + $('.startas').val() + "/" + $('.endas').val() + '/' + '<?php echo $mode; ?>');
    });

    $("#forms").submit(function () {
        var starts = $('.startas').val();
        var ends = $('.endas').val();
        var actors = $("select[name=actor] option:selected").val();
        var project = $("select[name=projectsalary] option:selected").val();
        console.log("<?php echo base_url() ?>finance/report/salary/table/" + project + "/" + starts + "/" + ends + '/' + '<?php echo $mode; ?>' + '/' + actors);
        $(".load_main_data").load("<?php echo base_url() ?>finance/report/salary/table/" + project + "/" + starts + "/" + ends + '/' + '<?php echo $mode; ?>' + '/' + actors);
        return false;
    });

    function onExport() {
        var starts = $('.startas').val();
        var ends = $('.endas').val();
        var actors = $("select[name=actor] option:selected").val();
        var project = $("select[name=projectsalary] option:selected").val();

        window.open("<?php echo base_url('finance/report/export/salary'); ?>" + '/' + project + '/' + starts + '/' + ends + '/' + '<?php echo $mode; ?>' + '/' + actors);
    }
</script>