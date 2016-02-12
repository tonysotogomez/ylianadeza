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
      $alumnos_aula = $this->Aula->CargarAlumnos($idAula);
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
                     ->setCellValue('B1', 'NÓMINA DE NIÑOS')
                     ->setCellValue('B2', $datos_aula[0]->aula .$observacion)
                     ->setCellValue('B3', 'AULA "'.strtoupper($datos_aula[0]->titulo).'"');

      $fila = 6; // a partir de que fila empezara el listado
      $f2 = $fila+1;

      //asigno el tamaño de las columnas
      $this->phpexcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
      $this->phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
      $this->phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
      $this->phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
      $this->phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
      $this->phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);


      // agregamos información a las celdas
      $this->phpexcel->setActiveSheetIndex(0)
                  ->setCellValue('A'.$fila, 'N°')
                  ->setCellValue('B'.$fila, 'APELLIDOS Y NOMBRES')
                  ->setCellValue('C'.$fila, 'SEXO')
                  ->setCellValue('D'.$fila, 'EDAD')
                  ->setCellValue('E'.$fila, 'PESO')
                  ->setCellValue('F'.$fila, 'TALLA');
              /*    ->setCellValue('G'.$fila, 'DIAGNOSTICO 1')
                  ->setCellValue('H'.$fila, 'DIAGNOSTICO 2')
                  ->setCellValue('I'.$fila, 'DIAGNOSTICO 3');*/

      $con = 0;


      foreach ($alumnos_aula as $alumno) {
        $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$f2, $con)
                    ->setCellValue('B'.$f2, $alumno->apellidos .', '.$alumno->nombres)
                    ->setCellValue('C'.$f2, strtoupper($alumno->genero))
                    ->setCellValue('D'.$f2, calcular_edad($alumno->fecha_nacimiento))
                    ->setCellValue('E'.$f2, '')
                    ->setCellValue('F'.$f2, '');
            /*        ->setCellValue('G'.$f2, '')
                    ->setCellValue('H'.$f2, '')
                    ->setCellValue('I'.$f2, ''); */
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
      $sheet->getStyle("A".$fila.":F".($f2-1))->applyFromArray($border_style);
      $sheet->getStyle("A".$fila.":F".$fila)->applyFromArray($center_style)->getFont()->setBold(true);
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


    public function detalle($idEvaluacion, $idAula) {
      //cargo los alumnos
      $this->load->model("Evaluacion_model","Evaluacion");
      $this->load->model("Aula_model","Aula");
      $this->load->model("Edad_model","Edad");

      $datos_aula = $this->Aula->CargarAula($idAula);
      $evaluaciones = $this->Evaluacion->CargarEvaluaciones($idAula);
      $pos = count($evaluaciones);
      $penul_eval = $evaluaciones[$pos-2]->id;

      $detalle = $this->Evaluacion->VerDetalle($idEvaluacion, $penul_eval);



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
                     ->setCellValue('B1', 'DETALLE DE EVALUACION')
                     ->setCellValue('B2', $datos_aula[0]->aula .$observacion)
                     ->setCellValue('B3', 'AULA "'.strtoupper($datos_aula[0]->titulo).'"');

      $fila = 6; // a partir de que fila empezara el listado
      $f2 = $fila+1;

      //asigno el tamaño de las columnas
      $this->phpexcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);//nro
      $this->phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(21);//apellidos
      $this->phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);//nombres
      $this->phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);//edad
      $this->phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);//peso
      $this->phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(6);
      $this->phpexcel->getActiveSheet()->getColumnDimension('G')->setWidth(5);//talla
      $this->phpexcel->getActiveSheet()->getColumnDimension('H')->setWidth(6);
      $this->phpexcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);//OBSERVACIONES
      $this->phpexcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
      $this->phpexcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
      $this->phpexcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);


      // agregamos información a las celdas
      $this->phpexcel->setActiveSheetIndex(0)
                  ->setCellValue('A'.$fila, 'Nro')
                  ->setCellValue('B'.$fila, 'APELLIDOS')
                  ->setCellValue('C'.$fila, 'NOMBRES')
                  ->setCellValue('D'.$fila, 'EDAD')
                  ->setCellValue('E'.$fila, 'PESO')
                  ->setCellValue('F'.$fila, 'C.PESO')
                  ->setCellValue('G'.$fila, 'TALLA')
                  ->setCellValue('H'.$fila, 'C.TALLA')
                  ->setCellValue('I'.$fila, 'OBSERVACIONES')
                  ->setCellValue('J'.$fila, 'TALLA EDAD')
                  ->setCellValue('K'.$fila, 'PESO EDAD')
                  ->setCellValue('L'.$fila, 'PESO TALLA');

      $con = 0;


      foreach ($detalle as $datos) {
        $edad = $this->Edad->CargarEdad((float)$datos->edad);
        $talla_creci = comparar2($datos->talla_ant,$datos->talla);
        $peso_creci = comparar2($datos->peso_ant,$datos->peso);

        $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$f2, $con)
                    ->setCellValue('B'.$f2, $datos->apellidos)
                    ->setCellValue('C'.$f2, $datos->nombres)
                    ->setCellValue('D'.$f2, $edad[0]->nombre)
                    ->setCellValue('E'.$f2, $datos->peso)
                    ->setCellValue('F'.$f2, $peso_creci)
                    ->setCellValue('G'.$f2, $datos->talla)
                    ->setCellValue('H'.$f2, $talla_creci)
                    ->setCellValue('I'.$f2, $datos->observaciones)
                    ->setCellValue('J'.$f2, $datos->diagnosticoTE)
                    ->setCellValue('K'.$f2, $datos->diagnosticoPE)
                    ->setCellValue('L'.$f2, $datos->diagnosticoPT);
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
      header('Content-Disposition: attachment;filename="Evaluacion_'.$evaluaciones[0]->fecha.'.xlsx"');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
      $objWriter->save('php://output');

    }


}
