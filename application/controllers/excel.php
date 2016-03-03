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

      for ($i=0, $len = count($evaluaciones); $i < $len; $i++) {
  			if ($idEvaluacion == $evaluaciones[$i]->id) {
  				if($i == 0){ $penul_eval = $idEvaluacion; break;}
  				$penul_eval = $evaluaciones[$i-1]->id; break;
  			} else {
  				$penul_eval = $idEvaluacion;
  			}
  		}

      $detalle = $this->Evaluacion->VerDetalle($idEvaluacion, $penul_eval);
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
      $this->phpexcel->getActiveSheet()->getColumnDimension('L')->setWidth(26);

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
        $talla_creci = comparar2($datos->talla_ant,$datos->talla);
        $peso_creci = comparar2($datos->peso_ant,$datos->peso);

        $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$f2, $con)
                    ->setCellValue('B'.$f2, $datos->apellidos.', '.$datos->nombres)
                    ->setCellValue('C'.$f2, $edad)
                    ->setCellValue('D'.$f2, $datos->peso)
                    ->setCellValue('E'.$f2, $peso_creci)
                    ->setCellValue('F'.$f2, $datos->talla)
                    ->setCellValue('G'.$f2, $talla_creci)
                    ->setCellValue('H'.$f2, $datos->observaciones)
                    ->setCellValue('I'.$f2, $datos->diagnosticoTE)
                    ->setCellValue('J'.$f2, $datos->diagnosticoPE)
                    ->setCellValue('K'.$f2, $datos->diagnosticoPT)
                    ->setCellValue('L'.$f2, $datos->diagnosticoF);
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
      $this->phpexcel->setActiveSheetIndex(0)->setCellValue('A'.($fila-1), 'EVALUACION N° : '.strtoupper($eval[0]->nombre));
      //agrego la fecha de evaluacion
      $this->phpexcel->setActiveSheetIndex(0)->setCellValue('B'.($f2+2), 'Fecha: '.date("d-m-Y",strtotime($eval[0]->fecha)));

      // renombro la hoja de trabajo con el nombre del aula
      $this->phpexcel->getActiveSheet()->setTitle('Evaluacion '. strtoupper($eval[0]->nombre));


      // configuramos el documento para que la hoja
      // de trabajo número 0 sera la primera en mostrarse
      // al abrir el documento
      $this->phpexcel->setActiveSheetIndex(0);


      //redireccionamos la salida al navegador del cliente (Excel2007)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Evaluacion_'.strtoupper($eval[0]->nombre).'_'.$datos_aula[0]->titulo.'.xlsx"');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
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
      $temp = $evaluaciones;
      $Z = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AW','AX','AY','AZ'];

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
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+3])->setWidth(10);
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+4])->setWidth(10);
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+5])->setWidth(10);
        $this->phpexcel->getActiveSheet()->getColumnDimension($Z[$a+6])->setWidth(15);
        $a = $a+7;
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

      $this->phpexcel->setActiveSheetIndex(0)->mergeCells($Z[$b].$filas.':'.$Z[$b+6].$filas);
      $this->phpexcel->setActiveSheetIndex(0)->setCellValue($Z[$b].$filas, 'EVALUACION N°'.($i+1));
      $this->phpexcel->setActiveSheetIndex(0)
              ->setCellValue($Z[$b].$fila, 'EDAD')
              ->setCellValue($Z[$b+1].$fila, 'PESO')
              ->setCellValue($Z[$b+2].$fila, 'TALLA')
              ->setCellValue($Z[$b+3].$fila, 'T/E')
              ->setCellValue($Z[$b+4].$fila, 'P/E')
              ->setCellValue($Z[$b+5].$fila, 'P/T')
              ->setCellValue($Z[$b+6].$fila, 'D. NUTRICIONAL');
      $b = $b+7;

        $con2++;
      }
    //FIN CABECERAS

    //CONTENIDO
      $alumnos = $this->Aula->CargarAlumnos($idAula);
      $num = 1;
      for ($i=0, $len = count($alumnos); $i < $len; $i++) {
        $c = 2;
        $con = 1;
        $z = false;
        $temp = $this->Evaluacion->VerDetalle2($alumnos[$i]->id);
        //si alumno no tiene ninguna evaluacion
        if(empty($temp)){
          $alumno = $this->Alumno->CargarAlumno($alumnos[$i]->id);
          $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue($Z[0].$f1, $num)
                    ->setCellValue($Z[1].$f1, $alumno[0]->apellidos.', '.$alumno[0]->nombres);
        } else {
          foreach ($temp as $datos) {
            //$f1 = fila 8
            $edad = $this->Edad->CargarEdad((float)$datos->edad);
            $edad = (empty($edad))?' ':$edad[0]->nombre;
            if($z){
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


            if(($p - $q) == 0){
              $this->phpexcel->setActiveSheetIndex(0)
                      ->setCellValue($Z[$c].$f1, $edad)
                      ->setCellValue($Z[$c+1].$f1, $datos->peso)
                      ->setCellValue($Z[$c+2].$f1, $datos->talla)
                      ->setCellValue($Z[$c+3].$f1, $datos->diagnosticoTE)
                      ->setCellValue($Z[$c+4].$f1, $datos->diagnosticoPE)
                      ->setCellValue($Z[$c+5].$f1, $datos->diagnosticoPT)
                      ->setCellValue($Z[$c+6].$f1, $datos->diagnosticoF);
              $c = $c+7;
            } else {
              $c = $c + (7*($p - $q)); //validacion para alumnos que no estuvieron en evaluaciones pasadas
              $this->phpexcel->setActiveSheetIndex(0)
                      ->setCellValue($Z[$c].$f1, $edad)
                      ->setCellValue($Z[$c+1].$f1, $datos->peso)
                      ->setCellValue($Z[$c+2].$f1, $datos->talla)
                      ->setCellValue($Z[$c+3].$f1, $datos->diagnosticoTE)
                      ->setCellValue($Z[$c+4].$f1, $datos->diagnosticoPE)
                      ->setCellValue($Z[$c+5].$f1, $datos->diagnosticoPT)
                      ->setCellValue($Z[$c+6].$f1, $datos->diagnosticoF);
              $z = true;
              $c = $c+7;
            }
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
      $sheet->getStyle("A".$filas.":".$Z[($c-1)].($f1-1))->applyFromArray($border_style);
      $sheet->getStyle("A".$filas.":".$Z[($c-1)].$fila)->applyFromArray($center_style)->getFont()->setBold(true);
      $sheet->getStyle("A".$fila.":A".($f1-1))->applyFromArray($center_style);
    //  $sheet->getStyle("C".$fila.":C".($f2-1))->applyFromArray($center_style);

      // renombro la hoja de trabajo con el nombre del aula
      $this->phpexcel->getActiveSheet()->setTitle('Evaluaciones');


      // configuramos el documento para que la hoja
      // de trabajo número 0 sera la primera en mostrarse
      // al abrir el documento
      $this->phpexcel->setActiveSheetIndex(0);


      //redireccionamos la salida al navegador del cliente (Excel2007)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Evaluaciones - '.$datos_aula[0]->titulo.'_.xlsx"');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
      $objWriter->save('php://output');

    }


}
