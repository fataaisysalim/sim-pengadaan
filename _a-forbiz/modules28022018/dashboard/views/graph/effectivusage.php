<header class="panel-heading"><i class="fa fa-signal mg-r-sm"></i>Usage Effectiveness</header>
<div class="panel-body">
    <div class="row">
        <div class="category chart"></div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/vendor/flot/jquery.flot.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/flot/jquery.flot.categories.js"></script>
<script>
    $.plot(".category", [<?php echo $json ?>], {
        colors: ['#1ec3c8'],
        series: {
            bars: {
                show: true,
                barWidth: 0.5,
                align: 'center',
                fill: 1
            },
            shadowSize: 0
        },
        grid: {
            color: '#c2c2c2',
            borderColor: '#f0f0f0',
            borderWidth: 1
        },
        xaxis: {
            mode: "categories",
            tickLength: 0
        }
    });
</script>