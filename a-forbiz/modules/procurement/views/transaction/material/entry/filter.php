 <?php $no=1;foreach($mog_dt as $x => $row){ ?>
       <tr>
        <td class="text-center" style="width: 20px; padding: 15px"><?php echo $no; ?></td>
        <td class="text-center" style="width: 50px; padding: 15px"><?php echo $row->nomor_pengajuan; ?>
        <?php if($row->mog_status==2){?>
            <br/>
            <span class="badge" style="color: #FFFFFF !important; background-color:red !important;">Rejected</span>
        <?php } ?>
        </td>
        <td class="text-center" style="width: 150px; padding: 15px"><?php echo date('d-m-Y',strtotime($row->tanggal_spb)); ?></td>
        <?php $idProject= $row->project_id;
        $project_id    = $this->crud_model->getNameProject($idProject);
        ?>
        <td class="text-center" style="width: 250px; padding: 15px"><?php echo @$project_id ->project_name; ?></td>
        <?php $idSupplier   = $row->actor_id;
        $supplier_id    = $this->crud_model->getNameSupplier($idSupplier);
         ?>
        <td class="text-center" style="width: 250px; padding: 15px">
        <?php 
        if($supplier_id->num_rows()) {
            echo $supplier_id->row()->actor_name;
        }
        ?></td>
        <td class="text-center" style="width: 250px; padding: 15px">
            <?php 
                $idMog  = $row->mog_id;
                $mat    = $this->crud_model->read_fordata(array("table" => "mog_dt md", "join" => array("material_sub ms" => "ms.material_sub_id = md.material_sub_id", "material_unit mu" => "mu.material_unit_id = ms.material_unit_id"), "where" => array("mog_id" => $idMog, "mog_dt_status" => 1)));
                $brg="";
                $vol=0;
                foreach ($mat->result() as $key => $value) {
                    $brg .= $value->material_sub_name;
                    $brg .=", ";
                    $vol = $vol+$value->mog_dt_volume;
                }
                echo $brg;
            ?>
         </td>
        <td class="text-center" style="width: 250px; padding: 15px"><?php echo $vol ?></td>
        <td class="text-center" style="width: 50px; padding: 15px">Approved by <?php echo $row->tujuan; ?>
        </td>
        <td class="text-center" style="width: 250px; padding: 15px">
            <a class="btn btn-success" href="<?php echo base_url() ?>procurement/transaction/material/tambah/<?php echo $row->mog_id?>/view"><i class="fa fa-edit"></i>View</a>
            <?php 
            if($sess['users']->users_divisi == 17 || $sess['users']->users_divisi == 15 || $sess['users']->users_divisi == 20 || $sess['users']->users_divisi == 19)
            {
            }else{
            ?>
            <a class="btn btn-success" href="<?php echo base_url() ?>procurement/transaction/material/tambah/<?php echo $row->mog_id?>/edit"><i class="fa fa-edit"></i>Edit</a>
            <?php } ?>
        <?php  if($sess['users']->users_divisi == 1): ?>
            <a class="btn btn-danger" class="delete" href="<?php echo base_url() ?>procurement/transaction/material/delete_procurement/<?php echo $idProject?>"><i class="fa fa-trash"></i>Delete</a>
        <?php endif;?>
        </td>
    </tr>
<?php $no++;} ?>