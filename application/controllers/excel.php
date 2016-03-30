<?php

class Excel extends CI_Controller {

    /**
     *
     * __construct
     */
    public function __construct () {
        parent::__construct();

        // inicializamos la librería
        $this->load->library('Classes/PHPExcel.php');
        $this->load->helper(array('fechas_helper', 'evaluacion_helper'));
        $this->load->model("Alumno_model","Alumno");
    }
    // end: construc

    public function listado($idAula) {
      //cargo los alumnos
      $this->load->model("Aula_model","Aula");

      $datos_aula = $this->Aula->CargarAula($idAula);
      $alumnos_aula = $this->Aula->CargarAlumnos2($idAula); //carga solo estado 1
      // configuramos las propiedades del documento
      $this->phpexcel->getProperties()->setCreator("Yliana Deza")
                                   ->setLastModifiedBy("Yliana Deza")
                                   ->setTitle("Office 2007 XLSX Test Document")
                                   ->setSubject("Office 2007 XLSX Test Document")
                                   ->setDescription("Listado de Alumnos")
                                   ->setKeywords("office 2007 openxml php")
                                   ->setCategory("Alumnos");

      $observacion = ($datos_aula[0]->edades == "")?'':' - '.$datos_aula[0]->edades;

      $this->phpexcel->setActiveSheetIndex(0)
                     ->setCellValue('C1', 'I.E.I. “DIVINO NIÑO JESÚS”')
                     ->setCellValue('C2', 'NÓMINA DE NIÑOS')
                     ->setCellValue('C3', strtoupper($datos_aula[0]->aula).$observacion)
                     ->setCellValue('C4', 'AULA “'.strtoupper($datos_aula[0]->titulo).'”');

      $fila = 6; // a partir de que fila empezara el listado
      $f2 = $fila+1;

      //asigno el tamaño de las columnas
      $this->phpexcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
      $this->phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(36);
      $this->phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
      $this->phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
      $this->phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
      $this->phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);


      // agregamos información a las celdas
      $this->phpexcel->setActiveSheetIndex(0)
                  ->setCellValue('A'.$fila, 'N°')
                  ->setCellValue('B'.$fila, 'APELLIDOS Y NOMBRES')
                  ->setCellValue('C'.$fila, 'SEXO')
                  ->setCellValue('D'.$fila, 'FECHA DE NACIMIENTO')
                  ->setCellValue('E'.$fila, 'EDAD')
                  ->setCellValue('F'.$fila, 'PESO')
                  ->setCellValue('G'.$fila, 'TALLA');

      $con = 1;


      foreach ($alumnos_aula as $alumno) {
        $date = str_replace('/', '-', $alumno->fecha_nacimiento);
  			$nacimiento = date('d-m-Y', strtotime($date));
        if ($nacimiento == '01-01-1970') $nacimiento = ' ';
        $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$f2, $con)
                    ->setCellValue('B'.$f2, $alumno->apellidos .', '.$alumno->nombres)
                    ->setCellValue('C'.$f2, strtoupper($alumno->genero))
                    ->setCellValue('D'.$f2, $nacimiento)
                    ->setCellValue('E'.$f2, calcular_edad($alumno->fecha_nacimiento))
                    ->setCellValue('F'.$f2, '')
                    ->setCellValue('G'.$f2, '');
        $con++;
        $f2++;
      }
      //totales
      $hombres = $this->Aula->contarAlumnos('h', $idAula);
      $mujeres = $this->Aula->contarAlumnos('m', $idAula);
      $totales = $this->Aula->contarAlumnos('all', $idAula);

      $this->phpexcel->setActiveSheetIndex(0)
                     ->setCellValue('D'.($f2+1), 'HOMBRES:'.$hombres[0]->num)
                     ->setCellValue('D'.($f2+2), 'MUJERES:'.$mujeres[0]->num)
                     ->setCellValue('D'.($f2+3), 'TOTAL:'.$totales[0]->num);

      //agrego estilos
      $border_style= array(
        'borders' => array(
            'allborders' => array('style' =>PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000'),)
        )
      );
      $center_style = array(
          'alignment' => array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
          )
      );

      $sheet = $this->phpexcel->getActiveSheet();
      $sheet->getStyle("A".$fila.":G".($f2-1))->applyFromArray($border_style);
      $sheet->getStyle("A".$fila.":G".$fila)->applyFromArray($center_style)->getFont()->setBold(true);
      $sheet->getStyle("A".$fila.":A".($f2-1))->applyFromArray($center_style);
      $sheet->getStyle("C".$fila.":C".($f2-1))->applyFromArray($center_style);

      // renombro la hoja de trabajo con el nombre del aula
      $this->phpexcel->getActiveSheet()->setTitle($datos_aula[0]->titulo);


      // configuramos el documento para que la hoja
      // de trabajo número 0 sera la primera en mostrarse
      // al abrir el documento
      $this->phpexcel->setActiveSheetIndex(0);


      //redireccionamos la salida al navegador del cliente (Excel2007)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="'.$datos_aula[0]->titulo.'.xlsx"');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
      $objWriter->save('php://output');

    }

    //DETALLE DE LA EVALUACION
    public function detalle($idEvaluacion, $idAula) {
      //cargo los alumnos
      $this->load->model("Evaluacion_model","Evaluacion");
      $this->load->model("Aula_model","Aula");
      $this->load->model("Edad_model","Edad");

      $datos_aula = $this->Aula->CargarAula($idAula);
      $evaluaciones = $this->Evaluacion->CargarEvaluaciones($idAula);

      $detalle = $this->Evaluacion->VerDetalle($idEvaluacion);
      $eval = $this->Evaluacion->CargarID($idEvaluacion);


      // configuramos las propiedades del documento
      $this->phpexcel->getProperties()->setCreator("Yliana Deza")
                                   ->setLastModifiedBy("Yliana Deza")
                                   ->setTitle("Office 2007 XLSX Test Document")
                                   ->setSubject("Office 2007 XLSX Test Document")
                                   ->setDescription("Evaluacion")
                                   ->setKeywords("office 2007 openxml php")
                                   ->setCategory("Evaluacion");

      $observacion = ($datos_aula[0]->edades == "")?'':' - '.$datos_aula[0]->edades;

      $this->phpexcel->setActiveSheetIndex(0)
                     ->setCellValue('B1', 'EVALUACION NUTRICIONAL')
                     ->setCellValue('B2', $datos_aula[0]->aula .$observacion)
                     ->setCellValue('B3', 'AULA "'.strtoupper($datos_aula[0]->titulo).'"');

      $fila = 7; // a partir de que fila empezara el listado
      $f2 = $fila+1;

      //asigno el tamaño de las columnas
      $this->phpexcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);//nro
      $this->phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(36);//apellidos y nombres
      $this->phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(8);//EDAD
      $this->phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(7);
      $this->phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
      $this->phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(7);
      $this->phpexcel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
      $this->phpexcel->getActiveSheet()->getColumnDimension('H')->setWidth(16);
      $this->phpexcel->getActiveSheet()->getColumnDimension('I')->setWidth(16);
      $this->phpexcel->getActiveSheet()->getColumnDimension('J')->setWidth(16);
      $this->phpexcel->getActiveSheet()->getColumnDimension('K')->setWidth(16);
      $this->phpexcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);

    // /  $this->phpexcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(34);

      // agregamos información a las celdas
      $this->phpexcel->setActiveSheetIndex(0)
                  ->setCellValue('A'.$fila, 'Nro')
                  ->setCellValue('B'.$fila, 'APELLIDOS Y NOMBRES')
                  ->setCellValue('C'.$fila, 'EDAD')
                  ->setCellValue('D'.$fila, 'PESO')
                  ->setCellValue('E'.$fila, 'G.PESO')
                  ->setCellValue('F'.$fila, 'TALLA')
                  ->setCellValue('G'.$fila, 'G.TALLA')
                  ->setCellValue('H'.$fila, 'OBSERVACIONES')
                  ->setCellValue('I'.$fila, 'T/E')
                  ->setCellValue('J'.$fila, 'P/E')
                  ->setCellValue('K'.$fila, 'P/T')
                  ->setCellValue('L'.$fila, 'D. NUTRICIONAL');

      $con = 1;


      foreach ($detalle as $datos) {
        $edad = $this->Edad->CargarEdad((float)$datos->edad);
        $edad = (empty($edad))?' ':$edad[0]->nombre;

        $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$f2, $con)
                    ->setCellValue('B'.$f2, $datos->apellidos.', '.$datos->nombres)
                    ->setCellValue('C'.$f2, $edad)
                    ->setCellValue('D'.$f2, $datos->peso)
                    ->setCellValue('E'.$f2, $datos->gpeso)
                    ->setCellValue('F'.$f2, $datos->talla)
                    ->setCellValue('G'.$f2, $datos->gpeso)
                    ->setCellValue('H'.$f2, $datos->observaciones)
                    ->setCellValue('I'.$f2, $datos->diagnosticoTE)
                    ->setCellValue('J'.$f2, $datos->diagnosticoPE)
                    ->setCellValue('K'.$f2, $datos->diagnosticoPT)
                    ->setCellValue('L'.$f2, $datos->idDiagnostico);
        $con++;
        $f2++;
      }

      //agrego estilos
      $border_style= array(
        'borders' => array(
            'allborders' => array('style' =>PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000'),)
        )
      );
      $center_style = array(
          'alignment' => array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
          )
      );

      $sheet = $this->phpexcel->getActiveSheet();
      $sheet->getStyle("A".($fila-1).":L".($f2-1))->applyFromArray($border_style);
      $sheet->getStyle("A".($fila-1).":L".($fila))->applyFromArray($center_style)->getFont()->setBold(true);
      $sheet->getStyle("A".($fila-1).":A".($f2-1))->applyFromArray($center_style);
    //  $sheet->getStyle("C".$fila.":C".($f2-1))->applyFromArray($center_style);

      $this->phpexcel->setActiveSheetIndex(0)->mergeCells('A'.($fila-1).':L'.($fila-1));
      $this->phpexcel->setActiveSheetIndex(0)->setCellValue('A'.($fila-1), 'EVALUACION: '.strtoupper($eval[0]->nombre));
      //agrego la fecha de evaluacion
      $this->phpexcel->setActiveSheetIndex(0)->setCellValue('B'.($f2+2), 'Fecha: '.date("d-m-Y",strtotime($eval[0]->fecha)));

      //datos estadisticos
      $totales_num = $this->Evaluacion->count_totales($idAula, $idEvaluacion);//hombres, mujeres, totales
      $datos_num = $this->Evaluacion->count_diagnostico($idAula, $idEvaluacion);//normales, obesos, sobrepesos, etc

      $this->phpexcel->setActiveSheetIndex(0)
                     ->setCellValue('B'.($f2+4), 'Hombres:'.$totales_num[0]->hombres)
                     ->setCellValue('B'.($f2+5), 'Mujeres:'.$totales_num[0]->mujeres)
                     ->setCellValue('B'.($f2+6), 'Total:'.$totales_num[0]->totales)
                     ->setCellValue('E'.($f2+2), 'Normal')
                     ->setCellValue('E'.($f2+3), 'Obeso')
                     ->setCellValue('E'.($f2+4), 'Sobrepeso')
                     ->setCellValue('E'.($f2+5), 'Desnutrición Aguda')
                     ->setCellValue('E'.($f2+6), 'Desnutrición Severa')
                     ->setCellValue('E'.($f2+7), 'Desnutrición Crónica')
                     ->setCellValue('H'.($f2+2), $datos_num[0]->normales)
                     ->setCellValue('H'.($f2+3), $datos_num[0]->obesos)
                     ->setCellValue('H'.($f2+4), $datos_num[0]->sobrepesos)
                     ->setCellValue('H'.($f2+5), $datos_num[0]->agudas)
                     ->setCellValue('H'.($f2+6), $datos_num[0]->severos)
                     ->setCellValue('H'.($f2+7), $datos_num[0]->cronicos);


       //GRAFICA DE BARRAS
       $dataseriesLabels1 = array(
           new PHPExcel_Chart_DataSeriesValues('String', 'Evaluacion!$B$'.($f2+6), NULL, 1),   // leyenda
       );
       $xAxisTickValues = array(
           new PHPExcel_Chart_DataSeriesValues('String', 'Evaluacion!$E$'.($f2+2).':$E$'.($f2+7), NULL, 6),    //  Normal a Desnutrucion
       );
       $dataSeriesValues1 = array(
           new PHPExcel_Chart_DataSeriesValues('Number', 'Evaluacion!$H$'.($f2+2).':$H$'.($f2+7), NULL, 6),//datos
       );
       //  Build the dataseries
       $series1 = new PHPExcel_Chart_DataSeries(
           PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
           PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,  // plotGrouping
           range(0, count($dataSeriesValues1)-1),          // plotOrder
           $dataseriesLabels1,                             // plotLabel
           $xAxisTickValues,                               // plotCategory
           $dataSeriesValues1                              // plotValues
       );

       $series1->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
       //  Set the series in the plot area
       $plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series1));
       //  Set the chart legend
       $legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
       $title = new PHPExcel_Chart_Title(strtoupper($datos_aula[0]->titulo));
       //  Create the chart
       $chart = new PHPExcel_Chart(
           'chart1',       // name
           $title,         // title
           $legend,        // legend
           $plotarea,      // plotArea
           true,           // plotVisibleOnly
           0,              // displayBlanksAs
           NULL,           // xAxisLabel
           NULL            // yAxisLabel
       );
       //  Set the position where the chart should appear in the worksheet
       $chart->setTopLeftPosition('B'.($f2+10));
       $chart->setBottomRightPosition('M'.($f2+27));
       //  Add the chart to the worksheet
       $sheet->addChart($chart);

      // renombro la hoja de trabajo con el nombre del aula
      $this->phpexcel->getActiveSheet()->setTitle('Evaluacion');


      // configuramos el documento para que la hoja
      // de trabajo número 0 sera la primera en mostrarse
      // al abrir el documento
      $this->phpexcel->setActiveSheetIndex(0);


      //redireccionamos la salida al navegador del cliente (Excel2007)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Evaluacion_'.$datos_aula[0]->titulo.'_'.date('d/m/Y', strtotime($eval[0]->fecha)).'.xlsx"');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
      $objWriter->setIncludeCharts(TRUE);
      $objWriter->save('php://output');

    }

    //EVALUACIONES POR AULA
    public function evaluaciones($idAula) {
      //cargo los alumnos
      $this->load->model("Evaluacion_model","Evaluacion");
      $this->load->model("Aula_model","Aula");
      $this->load->model("Edad_model","Edad");

      $datos_aula = $this->Aula->CargarAula($idAula);
      $evaluaciones = $this->Evaluacion->CargarEvaluaciones($idAula);

    //  $temp = array();
      //$temp = $this->Evaluacion->VerDetalle2();
      //$temp = $evaluaciones;
      $Z = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
      'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AW','AX','AY','AZ',
      'BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BW','BX','BY','BZ',
      'CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CW','CX','CY','CZ',
      'DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DW','DX','DY','DZ',
      'EA','EB','EC','ED','EE','EF','EG','EH','EI','EJ','EK','EL','EM','EN','EO','EP','EQ','ER','ES','ET','EU','EW','EX','EY','EZ',
      'FA','FB','FC','FD','FE','FF','FG','FH','FI','FJ','FK','FL','FM','FN','FO','FP','FQ','FR','FS','FT','FU','FW','FX','FY','FZ',
      'GA','GB','GC','GD','GE','GF','GG','GH','GI','GJ','GK','GL','GM','GN','GO','GP','GQ','GR','GS','GT','GU','GW','GX','GY','GZ',
      'HA','HB','HC','HD','HE','HF','HG','HH','HI','HJ','HK','HL','HM','HN','HO','HP','HQ','HR','HS','HT','HU','HW','HX','HY','HZ',
      'IA','IB','IC','ID','IE','IF','IG','IH','II','IJ','IK','IL','IM','IN','IO','IP','IQ','IR','IS','IT','IU','IW','IX','IY','IZ',
      'JA','JB','JC','JD','JE','JF','JG','JH','JI','JJ','JK','JL','JM','JN','JO','JP','JQ','JR','JS','JT','JU','JW','JX','JY','JZ',
      'KA','KB','KC','KD','KE','KF','KG','KH','KI','KJ','KK','KL','KM','KN','KO','KP','KQ','KR','KS','KT','KU','KW','KX','KY','KZ',
      'LA','LB','LC','LD','LE','LF','LG','LH','LI','LJ','LK','LL','LM','LN','LO','LP','LQ','LR','LS','LT','LU','LW','LX','LY','LZ',
      'MA','MB','MC','MD','ME','MF','MG','MH','MI','MJ','MK','ML','MM','MN','MO','MP','MQ','MR','MS','MT','MU','MW','MX','MY','MZ',
      'NA','NB','NC','ND','NE','NF','NG','NH','NI','NJ','NK','NL','NM','NN','NO','NP','NQ','NR','NS','NT','NU','NW','NX','NY','NZ',
      'OA','OB','OC','OD','OE','OF','OG','OH','OI','OJ','OK','OL','OM','ON','OO','OP','OQ','OR','OS','OT','OU','OW','OX','OY','OZ',
      'PA','PB','PC','PD','PE','PF','PG','PH','PI','PJ','PK','PL','PM','PN','PO','PP','PQ','PR','PS','PT','PU','PW','PX','PY','PZ'];

      // configuramos las propiedades del documento
      $this->phpexcel->getProperties()->setCreator("Yliana Deza")
                                   ->setLastModifiedBy("Yliana Deza")
                                   ->setTitle("Office 2007 XLSX Test Document")
                                   ->setSubject("Office 2007 XLSX Test Document")
                                   ->setDescription("Evaluacion")
                                   ->setKeywords("office 2007 openxml php")
                                   ->setCategory("Evaluacion");

      $observacion = ($datos_aula[0]->edades == "")?'':' - '.$datos_aula[0]->edades;

      $this->phpexcel->setActiveSheetIndex(0)
                     ->setCellValue('B1', 'EVALUACIONES TOTALES')
                     ->setCellValue('B2', $datos_aula[0]->aula .$observacion)
                     ->setCellValue('B3', 'AULA "'.strtoupper($datos_aula[0]->titulo).'"');
      $filas= 6; //fila de celdas combinadas
      $fila = 7; // a partir de que fila empezara el listado
      $f1 = $fila+1;

    //ANCHOS
      $a = 2; //J
      $con1 = 1;
      //asigno el tamaño de las columnas
      $this->phpexcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);//nro
      $this->phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);//apellidos y nombres
      for ($i=0, $leng = count($evaluaciones); $i < $leng; $i++) {
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a])->setWidth(8);
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+1])->setWidth(8);
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+2])->setWidth(8);
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+3])->setWidth(8);
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+4])->setWidth(8);
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+5])->setWidth(10);
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+6])->setWidth(10);
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+7])->setWidth(10);
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+8])->setWidth(15);
        $a = $a+9;
        $con1++;
      }
    //FIN ANCHOS

    //CABECERAS
      //declaro variables
      $b = 2; //J
      $con2 = 1;
      // agregamos las cabeceras de las celdas
      $this->phpexcel->setActiveSheetIndex(0)
                  ->setCellValue('A'.$fila, 'Nro')
                  ->setCellValue('B'.$fila, 'APELLIDOS Y NOMBRES');

      for ($i=0, $leng = count($evaluaciones); $i < $leng; $i++) {
        $this->phpexcel->setActiveSheetIndex(0)->mergeCells($Z[$b].$filas.':'.$Z[$b+8].$filas);
      //$this->phpexcel->setActiveSheetIndex(0)->mergeCells('C'.$filas.':K'.$filas);

        $this->phpexcel->setActiveSheetIndex(0)->setCellValue($Z[$b].$filas, 'EVALUACION N°'.$evaluaciones[$i]->numero.' ('.date("d-m-Y",strtotime($evaluaciones[$i]->fecha)).')');
        $this->phpexcel->setActiveSheetIndex(0)
                ->setCellValue($Z[$b].$fila, 'EDAD')
                ->setCellValue($Z[$b+1].$fila, 'PESO')
                ->setCellValue($Z[$b+2].$fila, 'G.PESO')
                ->setCellValue($Z[$b+3].$fila, 'TALLA')
                ->setCellValue($Z[$b+4].$fila, 'G.TALLA')
                ->setCellValue($Z[$b+5].$fila, 'T/E')
                ->setCellValue($Z[$b+6].$fila, 'P/E')
                ->setCellValue($Z[$b+7].$fila, 'P/T')
                ->setCellValue($Z[$b+8].$fila, 'D. NUTRICIONAL');
        $b = $b+9;
        $con2++;
      }
    //FIN CABECERAS

    //CONTENIDO
      $alumnos = $this->Aula->CargarAlumnos($idAula);
      $num = 1;
      for ($i=0, $len = count($alumnos); $i < $len; $i++) {
        $c = 2;//a partir de la columna 2 :: (A,B)
        $con = 1;
        $y = false;
        $temp = $this->Evaluacion->VerDetalle2($alumnos[$i]->id);
        //si alumno no tiene ninguna evaluacion
        if(empty($temp)){
          $alumno = $this->Alumno->CargarAlumno($alumnos[$i]->id);
          $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$f1, $num)
                    ->setCellValue('B'.$f1, $alumno[0]->apellidos.', '.$alumno[0]->nombres);
          $c+=9;
        } else {
          foreach ($temp as $datos) {
            //$f1 = fila 8
            $edad = $this->Edad->CargarEdad((float)$datos->edad);
            $edad = (empty($edad))?' ':$edad[0]->nombre;
            if($y){
              $p = 1;
              $q = 1;
            } else {
              $p = count($evaluaciones);
              $q = count($temp);
            }
            //columnas estaticas
            $this->phpexcel->setActiveSheetIndex(0)
                      ->setCellValue($Z[0].$f1, $num)
                      ->setCellValue($Z[1].$f1, $datos->alumno);

            //total evaluaciones del aula - total evaluaciones de 1 alumno
            if(($p - $q) == 0){//si es 0 entonces no tiene falta de evaluacion
              $this->phpexcel->setActiveSheetIndex(0)
                      ->setCellValue($Z[$c].$f1, $edad)
                      ->setCellValue($Z[$c+1].$f1, $datos->peso)
                      ->setCellValue($Z[$c+2].$f1, $datos->gpeso)
                      ->setCellValue($Z[$c+3].$f1, $datos->talla)
                      ->setCellValue($Z[$c+4].$f1, $datos->gtalla)
                      ->setCellValue($Z[$c+5].$f1, $datos->diagnosticoTE)
                      ->setCellValue($Z[$c+6].$f1, $datos->diagnosticoPE)
                      ->setCellValue($Z[$c+7].$f1, $datos->diagnosticoPT)
                      ->setCellValue($Z[$c+8].$f1, $datos->idDiagnostico);
            } else {
              $c = $c + (9*($p - $q)); //validacion para alumnos que no estuvieron en evaluaciones pasadas
              $this->phpexcel->setActiveSheetIndex(0)
                      ->setCellValue($Z[$c].$f1, $edad)
                      ->setCellValue($Z[$c+1].$f1, $datos->peso)
                      ->setCellValue($Z[$c+2].$f1, $datos->gpeso)
                      ->setCellValue($Z[$c+3].$f1, $datos->talla)
                      ->setCellValue($Z[$c+4].$f1, $datos->gtalla)
                      ->setCellValue($Z[$c+5].$f1, $datos->diagnosticoTE)
                      ->setCellValue($Z[$c+6].$f1, $datos->diagnosticoPE)
                      ->setCellValue($Z[$c+7].$f1, $datos->diagnosticoPT)
                      ->setCellValue($Z[$c+8].$f1, $datos->idDiagnostico);
              $y = true;
            }
            $c+=9;
            $con++;
          }//end foreach
        } //end if alumno no tiene ninguna evaluacion pero esta activo
        $f1++;
        $num++;
      }
    //FIN CONTENIDO

      //agrego estilos
      $border_style= array(
        'borders' => array(
            'allborders' => array('style' =>PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000'),)
        )
      );
      $center_style = array(
          'alignment' => array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
          )
      );

      $sheet = $this->phpexcel->getActiveSheet();
      $sheet->getStyle('C'.$filas.':K'.$filas)->applyFromArray($center_style);
      $sheet->getStyle("A".$filas.":".$Z[($c-1)].$fila)->applyFromArray($center_style)->getFont()->setBold(true);
      $sheet->getStyle("A".$fila.":A".($f1-1))->applyFromArray($center_style);

      $sheet->getStyle("A".$filas.":".$Z[($c-1)].($f1-1))->applyFromArray($border_style);
      // renombro la hoja de trabajo con el nombre del aula
      $this->phpexcel->getActiveSheet()->setTitle($datos_aula[0]->titulo);


      // configuramos el documento para que la hoja
      // de trabajo número 0 sera la primera en mostrarse
      // al abrir el documento
      $this->phpexcel->setActiveSheetIndex(0);


      //redireccionamos la salida al navegador del cliente (Excel2007)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Evaluaciones - '.$datos_aula[0]->titulo.'.xlsx"');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
      $objWriter->save('php://output');

    }

    public function evaluacionNumero($num) {

      $this->load->model("Aula_model","Aula");
      $this->load->model("Evaluacion_model","Evaluacion");

      $evaluaciones_all = $this->Evaluacion->getEvaluacioNumero($num);//todas

      for ($i=0, $len = count($evaluaciones_all); $i < $len; $i++) {
        $aulas[$i] = $this->Evaluacion->count_diagnostico($evaluaciones_all[$i]->idAula, $evaluaciones_all[$i]->id);
      }


      // configuramos las propiedades del documento
      $this->phpexcel->getProperties()->setCreator("Yliana Deza")
                                   ->setLastModifiedBy("Yliana Deza")
                                   ->setTitle("Office 2007 XLSX Test Document")
                                   ->setSubject("Office 2007 XLSX Test Document")
                                   ->setDescription("Reporte de Evaluaciones")
                                   ->setKeywords("office 2007 openxml php")
                                   ->setCategory("Evaluaciones");

       //agrego estilos
       $border_style= array(
         'borders' => array(
             'allborders' => array('style' =>PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000'),)
         )
       );
       $center_style = array(
           'alignment' => array(
               'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
           )
       );
       $color1_style = array(
             'fill' => array(
              'type' => PHPExcel_Style_Fill::FILL_SOLID,
              'color' => array('rgb' => 'CEECF5')
            )
       );

      $this->phpexcel->setActiveSheetIndex(0)
                     ->setCellValue('B1', 'I.E.I. “DIVINO NIÑO JESÚS”')
                     ->setCellValue('B2', 'EVALUACION N°'.$num)
                     ->setCellValue('B3', '')
                     ->setCellValue('B4', '');

      $fila = 4; // a partir de que fila empezara el listado
      $f2 = $fila+1;

      $this->phpexcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
      $this->phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
      $this->phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(6);
      $this->phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
      $this->phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
      $this->phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);

      $sheet = $this->phpexcel->getActiveSheet();

      foreach ($aulas as $key) {
        $f1 = $f2;
        foreach ($key as $v) {
          $this->phpexcel->setActiveSheetIndex(0)->mergeCells('B'.$f2.':C'.$f2);
          $this->phpexcel->setActiveSheetIndex(0)
                      ->setCellValue('B'.($f2+1), 'Normal')
                      ->setCellValue('B'.($f2+2), 'Obeso')
                      ->setCellValue('B'.($f2+3), 'Sobrepeso')
                      ->setCellValue('B'.($f2+4), 'Desnutrición Aguda')
                      ->setCellValue('B'.($f2+5), 'Desnutrición Severa')
                      ->setCellValue('B'.($f2+6), 'Desnutrición Crónica')
                      ->setCellValue('B'.($f2+7), 'Alumnos');

          $this->phpexcel->setActiveSheetIndex(0)
                      ->setCellValue('B'.$f2, $v->aula)
                      ->setCellValue('C'.($f2+1), $v->normales)
                      ->setCellValue('C'.($f2+2), $v->obesos)
                      ->setCellValue('C'.($f2+3), $v->sobrepesos)
                      ->setCellValue('C'.($f2+4), $v->agudas)
                      ->setCellValue('C'.($f2+5), $v->severos)
                      ->setCellValue('C'.($f2+6), $v->cronicos)
                      ->setCellValue('C'.($f2+7), $v->totales);
                      $sheet->getStyle("B".$f2)->applyFromArray($center_style);
                      $sheet->getStyle("B".$f2)->applyFromArray($color1_style);

                      $dataseriesLabels1 = array(
                          new PHPExcel_Chart_DataSeriesValues('String', 'Evaluaciones!$B$'.($f2+7), NULL, 1),   // leyenda
                      );
                      $xAxisTickValues = array(
                          new PHPExcel_Chart_DataSeriesValues('String', 'Evaluaciones!$B$'.($f2+1).':$B$'.($f2+6), NULL, 6),    //  Normal a Desnutrucion
                      );
                      $dataSeriesValues1 = array(
                          new PHPExcel_Chart_DataSeriesValues('Number', 'Evaluaciones!$C$'.($f2+1).':$C$'.($f2+6), NULL, 6),//datos
                      );
                      //  Build the dataseries
                      $series1 = new PHPExcel_Chart_DataSeries(
                          PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
                          PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,  // plotGrouping
                          range(0, count($dataSeriesValues1)-1),          // plotOrder
                          $dataseriesLabels1,                             // plotLabel
                          $xAxisTickValues,                               // plotCategory
                          $dataSeriesValues1                              // plotValues
                      );

                      $series1->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
                      //  Set the series in the plot area
                      $plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series1));
                      //  Set the chart legend
                      $legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
                      $title = new PHPExcel_Chart_Title($v->aula);
                      //  Create the chart
                      $chart = new PHPExcel_Chart(
                          'chart1',       // name
                          $title,         // title
                          $legend,        // legend
                          $plotarea,      // plotArea
                          true,           // plotVisibleOnly
                          0,              // displayBlanksAs
                          NULL,           // xAxisLabel
                          NULL            // yAxisLabel
                      );
                      //  Set the position where the chart should appear in the worksheet
                      $chart->setTopLeftPosition('E'.$f2);
                      $chart->setBottomRightPosition('H'.($f2+11));
                      //  Add the chart to the worksheet
                      $sheet->addChart($chart);

                      $f2 = $f2+12;//separacion entre aulas
        }//end foreach
        $sheet->getStyle("B".$f1.":C".($f2-5))->applyFromArray($border_style); //border a cada cuadro
      }//end forreach $aula




/*
      $sheet = $this->phpexcel->getActiveSheet();
      $sheet->getStyle("A".$fila.":G".($f2-1))->applyFromArray($border_style);
      $sheet->getStyle("A".$fila.":G".$fila)->applyFromArray($center_style)->getFont()->setBold(true);
      $sheet->getStyle("A".$fila.":A".($f2-1))->applyFromArray($center_style);
      $sheet->getStyle("C".$fila.":C".($f2-1))->applyFromArray($center_style);
*/
      // renombro la hoja de trabajo con el nombre del aula
      $this->phpexcel->getActiveSheet()->setTitle('Evaluaciones');


      $this->phpexcel->setActiveSheetIndex(0);
      //redireccionamos la salida al navegador del cliente (Excel2007)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Evaluaciones - Numero '.$num.'.xlsx"');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
      $objWriter->setIncludeCharts(TRUE);
      $objWriter->save('php://output');
    }

}
