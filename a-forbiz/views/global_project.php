<?php 
    $read="";
    $proj = $this->session->userdata('project_id');
    if(!empty($proj)){
        $read="disabled";
        echo '<input value="'.$proj.'" name="project" id="project" type="hidden">';
        
    }
    ?>    
    <div class="col-xs-6">
        <div class="form-group">
            <label>Proyek</label>
            <select  onchange="getProData()" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Project" <?php echo $read?>>
                <option value=""></option>
                <?php foreach ($project as $pro) : ?>
                    <option value="<?php echo $pro->project_id; ?>" <?php if ($pro->project_id == $proj) echo "selected"; ?> <?php if ($pro->project_id == set_value('project')) echo "selected"; ?>><?php echo ucwords($pro->project_name); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>