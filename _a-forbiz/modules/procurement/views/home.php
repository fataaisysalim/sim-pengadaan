<?php
$link = "#";
$bg ="bg-light darker";
$master = $this->db->query("SELECT * FROM master_user_role WHERE id_user_role='".$sess['users']->users_divisi."'")->row();
?>
<style type="text/css">
.badge_green {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: 700;
    color: #fff;
    line-height: 1;
    vertical-align: baseline;
    white-space: nowrap;
    text-align: center;
    background-color: green;
    border-radius: 10px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="row hidden-xs">
            <div class="col-md-12">
                <h4><b><i class="fa fa-bank mg-r-sm"></i>PENGAJUAN / PENGADAAN PROYEK</b></h4>
                <hr class="divider" style="margin: 0px 0px 10px 0px"/>
            </div>
            <div class="col-md-3">
            <?php 
            if($master->nama_user_role=="Staff Pengadaan"){
                $link = base_url()."procurement/transaction/material/index/all";
                $bg = "bg-primary light";
            }?>
                <a href="<?php echo $link?>">    
                    <div class="panel <?php echo $bg?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-file"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 1</b> </h3>
                            <h5 class="mt15 lh15-p"> <b><?php echo "PENGAJUAN/PENGADAAN" ?></b> </h5>
                            <span class="badge badge-danger" style="color: #FFFFFF !important;">
                            <?php $sql = $this->db->query("SELECT * FROM mog");
                            echo $sql->num_rows();
                            ?>
                            </span>
                            <span class="badge_green" style="color: #FFFFFF !important;">
                            <?php $sql = $this->db->query("SELECT jml_proses FROM master_user_role where id_user_role=1");
                            echo $sql->row()->jml_proses;
                            ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
            <?php 
            $bg_kspp="bg-light darker";
            $link_kspp="#";
            if($master->nama_user_role=="Approval KSPP"){
                $link_kspp = base_url()."procurement/transaction/material";
                $bg_kspp = "bg-primary light";
            }?>
                <a href="<?php echo $link_kspp?>">    
                    <div class="panel <?php echo $bg_kspp?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-check"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 1</b> </h3>
                            <h4 class="mt15 lh15-p"> <b><?php echo "APPROVAL KSPP" ?></b> </h4>
<br>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <?php 
                $bg_mp="bg-light darker";
                $link_mp="#";
                if($master->nama_user_role=="Approval MP"){
                    $link_mp = base_url()."procurement/transaction/material";
                    $bg_mp = "bg-success light";
                }?>
                <a href="<?php echo $link_mp?>">    
                    <div class="panel <?php echo $bg_mp?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-check"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 3</b> </h3>
                            <h4 class="mt15 lh15-p"> <b><?php echo "APPROVAL MP" ?></b> </h4>
<br>
                        </div>
                    </div>
                </a>
            </div>
           <div class="col-md-3">
           <?php 
            $bg_kor="bg-light darker";
            $link_kor="#";
            if($master->nama_user_role=="Staff Pengadaan"){
                $link_kor = base_url()."procurement/transaction/material";
                $bg_kor = "bg-warning light";
            }?>
                <a href="<?php echo $link_kor?>">    
                    <div class="panel <?php echo $bg_kor?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-list"></i> </div>
                            <h4 class="mt15 lh15-p"> <b><?php echo "KOREKSI" ?></b> </h4>
                            <br>
                            <br>
                            <span class="badge badge-danger" style="color: #FFFFFF !important;">
                                <?php 
                                    $sql = $this->db->query("SELECT * FROM mog where role_id='".$sess['users']->users_divisi."' and mog_status=2");
                                    echo $sql->num_rows();
                                ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <br>
            <div class="col-md-12">
                <h4><b><i class="fa fa-bank mg-r-sm"></i>PENGADAAN PUSAT</b></h4>
                <hr class="divider" style="margin: 0px 0px 10px 0px"/>
            </div>
            <div class="col-md-3">
            <?php 
             $bg_ver="bg-light darker";
            $link_ver="#";
            if($master->nama_user_role=="Staff Pengadaan Pusat"){
                $link_ver = base_url()."procurement/transaction/material";
                $bg_ver = "bg-danger light";
            }?>
                <a href="<?php echo $link_ver?>">    
                    <div class="panel <?php echo $bg_ver?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-clipboard"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 4</b> </h3>
                            <h5 class="mt15 lh15-p"> <b><?php echo "VERIFIKASI PENGAJUAN" ?></b> </h5>
                            <span class="badge badge-danger" style="color: #FFFFFF !important;">
                                
                                <?php 
                                    $sql = $this->db->query("SELECT * FROM mog where role_id='".$sess['users']->users_divisi."' AND tujuan='Verifikasi Pengajuan'");
                                    echo $sql->num_rows();
                                ?>
                            </span>
                            <span class="badge_green" style="color: #FFFFFF !important;">
                            <?php $sql = $this->db->query("SELECT jml_proses FROM master_user_role where id_user_role=16");
                            echo $sql->row()->jml_proses;
                            ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
            <?php 
            $bg_dan="bg-light darker";
            $link_dan="#";
            if($master->nama_user_role=="Approval M.Dan"){
                $link_dan = base_url()."procurement/transaction/material";
                $bg_dan = "bg-success light";
            }?>
                <a href="<?php echo $link_dan?>">    
                    <div class="panel <?php echo $bg_dan?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-check"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 5</b> </h3>
                            <h4 class="mt15 lh15-p"> <b><?php echo "APPROVAL M.DAN" ?></b> </h4>
<br>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
            <?php 
            $bg_div="bg-light darker";
            $link_div="#";
            if($master->nama_user_role=="Approval M.Div"){
                $link_div = base_url()."procurement/transaction/material";
                $bg_div = "bg-success light";
            }?>
                <a href="<?php echo $link_div?>">    
                    <div class="panel <?php echo $bg_div?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-check"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 6</b> </h3>
                            <h4 class="mt15 lh15-p"> <b><?php echo "APPROVAL M.DIV" ?></b> </h4>
<br>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
            <?php 
            $bg_dir="bg-light darker";
            $link_dir="#";
            if($master->nama_user_role=="Direksi"){
                $link_dir = base_url()."procurement/transaction/material";
                $bg_dir = "bg-success light";
            }?>
                <a href="<?php echo $link_dir?>">    
                    <div class="panel <?php echo $bg_dir?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-check"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 7</b> </h3>
                            <h4 class="mt15 lh15-p"> <b><?php echo "APPROVAL DIREKSI" ?></b> </h4>
<br>
                        </div>
                    </div>
                </a>
            </div>
             <div class="col-md-12">
                <h4><b><i class="fa fa-bank mg-r-sm"></i>KIRIM BARANG</b></h4>
                <hr class="divider" style="margin: 0px 0px 10px 0px"/>
            </div>
            <div class="col-md-3">
            <?php 
            $bg_sup="bg-light darker";
            $link_sup="#";
            if($master->nama_user_role=="Supplier"){
                $link_sup = base_url()."procurement/transaction/material";
                $bg_sup = "bg-primary light";
            }?>
                <a href="<?php echo $link_sup?>">    
                    <div class="panel <?php echo $bg_sup?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-send"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 8</b> </h3>
                            <h4 class="mt15 lh15-p"> <b><?php echo "KIRIM BARANG" ?></b> </h4>
                            <span class="badge badge-danger" style="color: #FFFFFF !important;">
                                
                                <?php 
                                    $sql = $this->db->query("SELECT * FROM mog where role_id='".$sess['users']->users_divisi."' AND tujuan='Kirim Barang'");
                                    echo $sql->num_rows();
                                ?>
                            </span>
                            <span class="badge_green" style="color: #FFFFFF !important;">
                            <?php $sql = $this->db->query("SELECT jml_proses FROM master_user_role where id_user_role=18");
                            echo $sql->row()->jml_proses;
                            ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-12">
                <h4><b><i class="fa fa-bank mg-r-sm"></i>TERIMA BARANG</b></h4>
                <hr class="divider" style="margin: 0px 0px 10px 0px"/>
            </div>
            <div class="col-md-3">
            <?php 
            $bg_ter="bg-light darker";
            $link_ter="#";
            if($master->nama_user_role=="Gudang"){
                $link_ter = base_url()."procurement/transaction/material";
                $bg_ter = "bg-primary light";
            }?>
                <a href="<?php echo $link_ter?>">    
                    <div class="panel <?php echo $bg_ter?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-truck"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 9</b> </h3>
                            <h4 class="mt15 lh15-p"> <b><?php echo "TERIMA BARANG" ?></b> </h4>
                            <span class="badge badge-danger" style="color: #FFFFFF !important;">
                                
                                <?php 
                                    $sql = $this->db->query("SELECT * FROM mog where role_id='".$sess['users']->users_divisi."' AND tujuan='Supplier'");
                                    echo $sql->num_rows();
                                ?>
                            </span>
                            <span class="badge_green" style="color: #FFFFFF !important;">
                            <?php $sql = $this->db->query("SELECT jml_proses FROM master_user_role where id_user_role=17");
                            echo $sql->row()->jml_proses;
                            ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
            <?php 
            $bgs = "bg-light darker";
            $links="#";
            if($master->nama_user_role=="QC"){
                $links = base_url()."procurement/transaction/material";
                $bgs = "bg-danger light";
            }?>
                <a href="<?php echo $links?>">    
                    <div class="panel <?php echo $bgs?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-clipboard"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 10</b> </h3>
                            <h4 class="mt15 lh15-p"> <b><?php echo "VERFIKASI QC" ?></b> </h4>
                           <span class="badge badge-danger" style="color: #FFFFFF !important;">
                                
                                <?php 
                                    $sql = $this->db->query("SELECT * FROM mog where role_id='".$sess['users']->users_divisi."' AND tujuan='Bagian Gudang'");
                                    echo $sql->num_rows();
                                ?>
                            </span>
                            <span class="badge_green" style="color: #FFFFFF !important;">
                            <?php $sql = $this->db->query("SELECT jml_proses FROM master_user_role where id_user_role=15");
                            echo $sql->row()->jml_proses;
                            ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
            <?php 
            $bg_ka = "bg-light darker";
            $links_ka="";
            if($master->nama_user_role=="KASI KA"){
                $links_ka = base_url()."procurement/transaction/material";
                $bg_ka = "bg-danger light";
            }?>
                <a href="<?php echo $links_ka?>">    
                    <div class="panel <?php echo $bg_ka?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-check"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 11</b> </h3>
                            <h4 class="mt15 lh15-p"> <b><?php echo "APPROVAL KASI KA" ?></b> </h4>
                            <span class="badge badge-danger" style="color: #FFFFFF !important;">
                                
                                <?php 
                                    $sql = $this->db->query("SELECT * FROM mog where role_id='".$sess['users']->users_divisi."'  AND tujuan='Bagian QC'");
                                    echo $sql->num_rows();
                                ?>
                            </span>
                            <span class="badge_green" style="color: #FFFFFF !important;">
                            <?php $sql = $this->db->query("SELECT jml_proses FROM master_user_role where id_user_role=20");
                            echo $sql->row()->jml_proses;
                            ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
           <div class="col-md-3">
            <?php 
            $bg_kspp2 = "bg-light darker";
            $link_kspp2="";
            if($master->nama_user_role=="KSPP"){
                $link_kspp2 = base_url()."procurement/transaction/material";
                $bg_kspp2 = "bg-success light";
            }?>
                <a href="<?php echo $link_kspp2?>">    
                    <div class="panel <?php echo $bg_kspp2?> of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg-p"> <i class="fa fa-check"></i> </div>
                            <h3 class="mt15 lh15"> <b>Step 12</b> </h3>
                            <h4 class="mt15 lh15-p"> <b><?php echo "APPROVAL KSPP" ?></b> </h4>
                            <span class="badge badge-danger" style="color: #FFFFFF !important;">
                                
                                <?php 
                                    $sql = $this->db->query("SELECT * FROM mog where role_id='".$sess['users']->users_divisi."' AND tujuan='Approval KASI KA'");
                                    echo $sql->num_rows();
                                ?>
                            </span>
                            <span class="badge_green" style="color: #FFFFFF !important;">
                            <?php $sql = $this->db->query("SELECT jml_proses FROM master_user_role where id_user_role=19");
                            echo $sql->row()->jml_proses;
                            ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        document.getElementById("demo").innerHTML = "Hello World";
    }
</script>