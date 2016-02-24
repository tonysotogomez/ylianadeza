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
                     ->setCellValue('C1', 'I.E.I. “DIVIDO NIÑO JESÚS”')
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
                     ->setCellValue('B1', 'DETALLE DE EVALUACION')
                     ->setCellValue('B2', $datos_aula[0]->aula .$observacion)
                     ->setCellValue('B3', 'AULA "'.strtoupper($datos_aula[0]->titulo).'"');

      $fila = 6; // a partir de que fila empezara el listado
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

      //$this->phpexcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(34);

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
                  ->setCellValue('I'.$fila, 'TALLA para EDAD')
                  ->setCellValue('J'.$fila, 'PESO para EDAD')
                  ->setCellValue('K'.$fila, 'PESO para TALLA')
                  ->setCellValue('L'.$fila, 'DIAGNOSTICO NUTRICIONAL');

      $con = 1;


      foreach ($detalle as $datos) {
        $edad = $this->Edad->CargarEdad((float)$datos->edad);
        $talla_creci = comparar2($datos->talla_ant,$datos->talla);
        $peso_creci = comparar2($datos->peso_ant,$datos->peso);

        $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$f2, $con)
                    ->setCellValue('B'.$f2, $datos->apellidos.', '.$datos->nombres)
                    ->setCellValue('C'.$f2, $edad[0]->nombre)
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
      $sheet->getStyle("A".$fila.":L".($f2-1))->applyFromArray($border_style);
      $sheet->getStyle("A".$fila.":L".$fila)->applyFromArray($center_style)->getFont()->setBold(true);
      $sheet->getStyle("A".$fila.":A".($f2-1))->applyFromArray($center_style);
    //  $sheet->getStyle("C".$fila.":C".($f2-1))->applyFromArray($center_style);

      // renombro la hoja de trabajo con el nombre del aula
      $this->phpexcel->getActiveSheet()->setTitle('Evaluacion');


      // configuramos el documento para que la hoja
      // de trabajo número 0 sera la primera en mostrarse
      // al abrir el documento
      $this->phpexcel->setActiveSheetIndex(0);


      //redireccionamos la salida al navegador del cliente (Excel2007)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Evaluacion_'.$datos_aula[0]->titulo.'.xlsx"');
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

      $temp = array();

      for ($i=0, $len = count($evaluaciones); $i < $len; $i++) {
        $temp = $this->Evaluacion->VerDetalle2($evaluaciones[$i]->id);
      }

    echo var_dump($temp).'<pre><br>';


    /*

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
                     ->setCellValue('B1', 'DETALLE DE EVALUACION')
                     ->setCellValue('B2', $datos_aula[0]->aula .$observacion)
                     ->setCellValue('B3', 'AULA "'.strtoupper($datos_aula[0]->titulo).'"');

      $fila = 6; // a partir de que fila empezara el listado
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

      //$this->phpexcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(34);

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
                  ->setCellValue('I'.$fila, 'TALLA para EDAD')
                  ->setCellValue('J'.$fila, 'PESO para EDAD')
                  ->setCellValue('K'.$fila, 'PESO para TALLA')
                  ->setCellValue('L'.$fila, 'DIAGNOSTICO NUTRICIONAL');

      $con = 1;


      foreach ($detalle as $datos) {
        $edad = $this->Edad->CargarEdad((float)$datos->edad);
        $talla_creci = comparar2($datos->talla_ant,$datos->talla);
        $peso_creci = comparar2($datos->peso_ant,$datos->peso);

        $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$f2, $con)
                    ->setCellValue('B'.$f2, $datos->apellidos.', '.$datos->nombres)
                    ->setCellValue('C'.$f2, $edad[0]->nombre)
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
      $sheet->getStyle("A".$fila.":L".($f2-1))->applyFromArray($border_style);
      $sheet->getStyle("A".$fila.":L".$fila)->applyFromArray($center_style)->getFont()->setBold(true);
      $sheet->getStyle("A".$fila.":A".($f2-1))->applyFromArray($center_style);
    //  $sheet->getStyle("C".$fila.":C".($f2-1))->applyFromArray($center_style);

      // renombro la hoja de trabajo con el nombre del aula
      $this->phpexcel->getActiveSheet()->setTitle('Evaluacion');


      // configuramos el documento para que la hoja
      // de trabajo número 0 sera la primera en mostrarse
      // al abrir el documento
      $this->phpexcel->setActiveSheetIndex(0);


      //redireccionamos la salida al navegador del cliente (Excel2007)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Evaluacion_'.$datos_aula[0]->titulo.'.xlsx"');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
      $objWriter->save('php://output');
    */
    }


}
