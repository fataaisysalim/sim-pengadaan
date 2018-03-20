<div class="form-group">
    <select id="equipment_<?php echo $counter ?>" onchange="get_equipment_debt('<?php echo $counter ?>', this)" name="equipment[]" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Alat">
        <option value=""></option>
        <?php foreach ($equipment as $e) { ?>
        <option value="<?php echo $e->equipment_id; ?>" <?php echo isset($equipment_id) && $equipment_id == $e->equipment_id ? 'selected' : NULL; ?>><?php echo $e->equipment_name . ' ' . $e->equipment_type; ?></option>
        <?php } ?>
    </select>
</div>
<script>
    $('select.form-select2').select2();
    
    function get_equipment_debt(i, a) {
        if($("input[name=invoice_date_pry]").val() != '') {
            var val = a ? a.value : $("#equipment_" + i).val();
            $.ajax({
                url: "<?php echo base_url() . $url_access . 'get_debt_rest/'; ?>" + $('#actor').val() + "/" + $('#project').val() + "/" + val + "/" + $("input[name=invoice_date_pry]").val(),
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 1) {
                        $("#debt_" + i).attr('value', json.debt > 0 ? numberToCurrency(json.debt) : '0');
                    }
                }
            });
            return false;
        } else {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Harap tanggal kwitansi diisi terlebih dahulu");
            $("input[name=invoice_date_kwt]").focus();
            return false;
        }
    }
    
    function total_equipt(a) {
        if(a) {
            format_number(a);
        }
        for (var length = $(".row_out").length, total = parseInt(0), e = 1; e <= length; e++) {
            var sub_total = currencyToNumber($("#invoice_dt_total_" + e).val() ? $("#invoice_dt_total_" + e).val() : 0);
            total = total + sub_total;
        }
        $("#invoice_total").val(numberToCurrency(total));
        $("#invoice_netto").val(numberToCurrency(total));
        netto_bruto();
    }
    
    function get_debt() {
        if($("input[name=invoice_resource_code]:checked").val() == 4 && $("input[name=invoice_date_kwt]").val() != '') {
            for (var length = $(".row_out").length, total = parseInt(0), e = 1; e <= length; e++) {
               $.ajax({
                    url: "<?php echo base_url() . $url_access . 'get_debt_rest/'; ?>" + $('#actor').val() + "/" + $('#project').val() + "/" + $('#equipment_' + e).val() + "/" + $("input[name=invoice_date_kwt]").val(),
                    dataType: "JSON",
                    success: function(json) {
                        if (json.status == 1) {
                            $("#debt_" + e).attr('value', numberToCurrency(json.debt));
                        }
                    }
                });
            }
            return false;
        }
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>