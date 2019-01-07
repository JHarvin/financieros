<?PHP
include_once './cabecera.php';

?>
<script type="text/javascript" src="../js/jquery.min2.2.4.js"></script>


        <script type="text/javascript">
            $(function () {
                $('#id_grafica_institucion').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'ESTE ES EL TITULO'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                            type: 'pie',
                            name: 'Genero',
                            data: [
                                ['Femenino: 4', 4],
                                ['marroquin: 4', 4],
                                ['Masculino: 3', 3],
                            ],
                        }]
                });
            });


        </script>


        <div id="id_grafica_institucion" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        <br><br>

        
        <script src="../Highcharts-4.1.5/js/highcharts.js"></script>
        <script src="../Highcharts-4.1.5/js/exporting.js"></script>

<?PHP
include_once './pie.php';
?>

