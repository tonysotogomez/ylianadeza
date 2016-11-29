<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function script_pie($num, $datos)
{

  if(isset($datos[0]->subtitulo)) $subtitulo = $datos[0]->subtitulo;
  else $subtitulo = 'Subtitulo';

  if(isset($datos[0]->titulo)) $titulo = $datos[0]->titulo;
  else $titulo = 'Titulo';

  $script = "<script>
  $(function () {
    $('#pie_container').highcharts({
        credits: {
              text: 'SoftGroup Perú',
              href: 'http://softgroup-peru.com/'
          },
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '$titulo'
        },
        subtitle: {
            text: '".$subtitulo."'
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
            name: 'Alumnos',
            colorByPoint: true,
            data: [{
                name: 'Normal',
                y: ".$datos[0]->normales.",
                sliced: true,
                selected: true
            }, {
                name: 'Obesidad',
                y: ".$datos[0]->obesos."

            }, {
                name: 'Sobrepeso',
                y: ".$datos[0]->sobrepesos."
            }, {
                name: 'Desnutrición Aguda',
                y: ".$datos[0]->agudas."
            },{
                name: 'Desnutrición Severa',
                y: ".$datos[0]->severos."
            }, {
                name: 'Desnutrición Crónica',
                y: ".$datos[0]->cronicos."
            }, {
                name: 'Sin Diagnóstico',
                y: ".$datos[0]->sindiag."
            }]
        }]
    });
});
</script>";
  return $script;
}


function script_barras($num, $datos)
{
  if(isset($datos[0]->subtitulo)) $subtitulo = $datos[0]->subtitulo;
  else $subtitulo = 'Subtitulo';

  if(isset($datos[0]->titulo)) $titulo = $datos[0]->titulo;
  else $titulo = 'Titulo';

  $script = "<script>
  $(function () {
    // Create the chart
    $('#bar_container').highcharts({
        credits: {
              text: 'SoftGroup Perú',
              href: 'http://softgroup-peru.com/'
          },
        chart: {
            type: 'column'
        },
        title: {
            text: '$titulo'
        },
        subtitle: {
            text: '".$subtitulo."'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Cantidad de alumnos'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style=\"font-size:11px\">{series.name}</span><br>',
            pointFormat: '<span style=\"color:{point.color}\">{point.name}</span>: <b>{point.y:.f}</b><br/>'
        },

        series: [{
            name: 'Alumnos',
            colorByPoint: true,
            data: [{
                name: 'Normal',
                y: ".$datos[0]->normales."
            }, {
                name: 'Obesidad',
                y: ".$datos[0]->obesos."
            }, {
                name: 'Sobrepeso',
                y: ".$datos[0]->sobrepesos."
            }, {
                name: 'Desnutrición Aguda',
                y: ".$datos[0]->agudas."
            }, {
                name: 'Desnutrición Severa',
                y: ".$datos[0]->severos."
            }, {
                name: 'Desnutrición Crónica',
                y: ".$datos[0]->cronicos."
            }, {
                name: 'Sin Diagnóstico',
                y: ".$datos[0]->sindiag."
            }]
        }]
    });
});
</script>";
  return $script;
}


function script_line($valores)
{


  $script = "<script>
  $(function () {
      $('#line_container').highcharts({
          title: {
              text: 'Titulo',
              x: -20 //center
          },
          subtitle: {
              text: 'Subtitulo',
              x: -20
          },
          xAxis: {
              categories: [".$valores['evaluaciones']."]
          },
          yAxis: {
              title: {
                  text: 'peso o altura'
              },
              plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
              }]
          },
          tooltip: {
              valueSuffix: 'kg o cm'
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
          },
          series: [{
              name: 'Alumno nombre',
              data: [".$valores['peso']."]
          }]
      });
  });
</script>";
  return $script;
}
