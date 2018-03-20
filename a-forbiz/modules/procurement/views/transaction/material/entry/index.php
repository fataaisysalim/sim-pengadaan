<?php 
if ($sess['position_id'] == 1 OR $sess['position_id'] == 4 OR $sess['position_id'] == 5 OR $sess['position_id'] == 11 OR isset($mog_id)) { ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
    <script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>

     <?php if($this->session->flashdata('message')) { ?>
         <div class="row">
            <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message'); ?></div>
         </div>
     <?php } ?> 
    <div class="row">
        <div class="col-sm-12 load_main_data"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
    </div>
    
    <script type="text/javascript">
        $(".load_main_data").load("<?php echo base_url().'procurement/transaction/material/form/' ?><?php echo isset($view) ? $view : NULL; ?>");
    </script>
<?php } else { ?>
    <h1 class="pull-left mg-t-sm"><i class="fa fa-warning mg-r-sm"></i></h1><h3><small>Mohon maaf anda tidak berhak mengakses fitur</small><br/> <b>Dashboard Pengajuan/Pengadaan</b></h3>
    <?php } ?>

