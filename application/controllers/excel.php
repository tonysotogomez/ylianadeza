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
        $this->load->helper('fechas_helper');
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
      $this->phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
      $this->phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
      $this->phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);


      // agregamos información a las celdas
      $this->phpexcel->setActiveSheetIndex(0)
                  ->setCellValue('A'.$fila, 'N°')
                  ->setCellValue('B'.$fila, 'APELLIDOS Y NOMBRES')
                  ->setCellValue('C'.$fila, 'SEXO')
                  ->setCellValue('D'.$fila, 'EDAD')
                  ->setCellValue('E'.$fila, 'PESO')
                  ->setCellValue('F'.$fila, 'TALLA')
                  ->setCellValue('G'.$fila, 'DIAGNOSTICO 1')
                  ->setCellValue('H'.$fila, 'DIAGNOSTICO 2')
                  ->setCellValue('I'.$fila, 'DIAGNOSTICO 3');

      $con = 0;


      foreach ($alumnos_aula as $alumno) {
        $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$f2, $con)
                    ->setCellValue('B'.$f2, $alumno->apellidos .', '.$alumno->nombres)
                    ->setCellValue('C'.$f2, strtoupper($alumno->genero))
                    ->setCellValue('D'.$f2, calcular_edad($alumno->fecha_nacimiento))
                    ->setCellValue('E'.$f2, '')
                    ->setCellValue('F'.$f2, '')
                    ->setCellValue('G'.$f2, '')
                    ->setCellValue('H'.$f2, '')
                    ->setCellValue('I'.$f2, '');
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
      $sheet->getStyle("A".$fila.":I".($f2-1))->applyFromArray($border_style);
      $sheet->getStyle("A".$fila.":I".$fila)->applyFromArray($center_style)->getFont()->setBold(true);
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
      header('Content-Disposition: attachment;filename="01simple.xlsx"');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
      $objWriter->save('php://output');

    }
}
