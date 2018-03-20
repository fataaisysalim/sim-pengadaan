<header class="panel-heading"><i class="fa fa-signal mg-r-sm"></i>Usage Effectiveness</header>
<div class="panel-body">
    <div class="row">
        <div id="graphusageshow" style="height: 300px"></div>
    </div>
</div>
<script>
    $('#graphusageshow').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'UE Periode <?php echo $year ?>'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
        series: <?php echo $json ?>
    })
</script>