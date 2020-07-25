<?php
  global $mysqli;
    $host="localhost";
    $user="root";
    $pass="5piderm4n";
    $database="dbadminlte";
    $mysqli=new mysqli($host,$user,$pass,$database);
    if (mysqli_connect_errno()) {
    trigger_error('Koneksi ke database gagal: '  . mysqli_connect_error(), E_USER_ERROR); 
  }

	
  // Load librari PHPExcel nya
  require_once '../..\assets\PHPExcel3\PHPExcel.php';

    // Panggil class PHPExcel nya
    $excel = new PHPExcel();

// Settingan awal fil excel
$excel->getProperties()->setCreator('PT. adminlte')
					   ->setLastModifiedBy('PT. adminlte')
					   ->setTitle("datauser")
					   ->setSubject("user")
					   ->setDescription("Laporan datauser")
					   ->setKeywords("data user");
// styler
	$style_col = array(
		'font' => array('bold' => true), // Set font nya jadi bold
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		'fill' => array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array('rgb' => 'ffff00')
		)
    );

    $style_row = array(
		'alignment' => array(
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		
	);
	
// end styler

// header
	$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO"); 
	$excel->setActiveSheetIndex(0)->setCellValue('B1', "IDUSER"); 
	$excel->setActiveSheetIndex(0)->setCellValue('C1', "NAMAUSER"); 
	$excel->setActiveSheetIndex(0)->setCellValue('D1', "STATUS"); 

	$excel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($style_col);

	// Set height baris ke 1, 2 dan 3
	$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
	$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
	$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
	$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
// end header

// body
	// Buat query untuk menampilkan semua data
	$sql = $mysqli->query("SELECT * FROM tbuser ORDER BY iduser ASC");

	$no = 1; 
	$numrow = 2; 
	while($m = mysqli_fetch_array($sql)){ 
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $m['iduser']);
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $m['namauser']);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $m['setatus']);
		
		// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
	
		$no++; 
		$numrow++; 
	}

	// Set width kolom
	$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom no A
	$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom sub B
	$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20); // Set width kolom sub B
	$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom category C
// end body



// Set judul file excel page setup
	$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	$excel->getActiveSheet(0)->setTitle("data_user");
	$excel->setActiveSheetIndex(0);
// end judul

// Proses file excel
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="data_user.xlsx"'); // Set nama file excel nya
	header('Cache-Control: max-age=0');
// end proses file excel

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>
