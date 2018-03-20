<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="row">
            <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
        </div>
        <div class="load_main_data"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
    </div>
</div>
<script type="text/javascript">
    $(".load_main_data").load("<?php echo base_url($url_access) ?>/form/<?php echo!empty($docId) ? $docId : null ?>");
<?php if ($this->session->flashdata('idDoc')) { ?>
    <?php if ($this->session->flashdata('DocCt') == md5(1)) { ?>
                window.open("<?php echo base_url($url_access) ?>/disposition/<?php echo $this->session->flashdata('idDoc') ?>");
    <?php } else { ?>
                window.open("<?php echo base_url($url_access) ?>/receipt/<?php echo $this->session->flashdata('idDoc') ?>");
    <?php } ?>
<?php } ?>
</script>

