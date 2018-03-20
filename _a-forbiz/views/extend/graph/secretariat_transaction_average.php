<div id="graphusageshow" style="height: 300px"></div>
<script type="text/javascript">
    $('#graphusageshow').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'ATD Periode <?php echo $year ?>'
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