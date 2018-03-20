<div class="panel-body ">
    <div class="row">
        <div class="col-xs-12">
            <?php echo form_open("", array('id' => "formFn")); ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group mg-b-sm">
                            <a disabled id="byproject" onclick="searchby(1)" class="btn btn-success">Search by Project</a>
                            &nbsp;
                            <a id="bysubcon" onclick="searchby(2)" class="btn btn-primary">Search by Subcon</a>
                            <input type="hidden" name="searchby" value="1">
                        </div>
                    </div>
                </div>
                
                <div id="project" class="col-sm-8 col-md-4 col-xs-12">
                    <label>Project :</label>
                    <select name="projectFn" class="form-control form-select2  mg-t-xs" data-style="btn-white">
                        <?php foreach ($project as $i => $pro) : ?>
                            <option value="<?php echo md5($pro->project_id); ?>"><?php echo ucwords($pro->project_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="subcon" style="display: none" class="col-sm-8 col-md-4 col-xs-12">
                    <label>Subcon :</label>
                    <select name="subconFn" class="form-control form-select2  mg-t-xs" data-style="btn-white">
                        <?php foreach ($subcon as $s) : ?>
                            <option value="<?php echo md5($s->actor_id); ?>"><?php echo ucwords($s->actor_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-4 col-md-3 col-xs-12">
                    <button type="submit" class="btn btn-md btn-block btn-warning" style="margin-top: 28px"><i class="fa fa-search mg-r-sm"></i>Search</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
    <div class="load_main_datax row"><div class="col-xs-12"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div></div> 
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i>WO Progress & Information');
        $(".datepicker").datepicker();
    });

    load();

    $("#formFn").submit(function () {
        load();
        return false;
    });

    function load() {
        var info_projects = $("select[name=projectFn] option:selected").val();
        var info_subcon = $("select[name=subconFn] option:selected").val();
        var searchby = $("input[name=searchby]").val();
        if(searchby == 1) {
            var parameter = info_projects;
        } else if(searchby == 2) {
            var parameter = info_subcon;
        }
        var info_starts = $('.startFn').val();
        var info_ends = $('.endFn').val();
        $(".load_main_datax").load('<?php echo base_url($this->uri->segment(1)) ?>/wo-progress/'+ parameter + '/' + searchby);
    }
    
    function searchby(e) {
        if(e == 1) {
            $("#byproject").attr('disabled', 'disabled');
            $("#byproject").attr('class', 'btn btn-success');
            $("#bysubcon").attr('disabled', false);
            $("#bysubcon").attr('class', 'btn btn-primary');
            $("#project").attr('style', 'display: block');
            $("#subcon").attr('style', 'display: none');
        }
        if(e == 2) {
            $("#byproject").attr('disabled', false);
            $("#byproject").attr('class', 'btn btn-primary');
            $("#bysubcon").attr('disabled', 'disabled');
            $("#bysubcon").attr('class', 'btn btn-success');
            $("#subcon").attr('style', 'display: block');
            $("#project").attr('style', 'display: none');
        }
        $("input[name=searchby]").val(e);
    }
</script>

