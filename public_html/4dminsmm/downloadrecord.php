<?php require_once("class/download.class.php");
$admin=new downloads();
if(!isset($_SESSION['smmmebhaveshadmin'])){
header("location:index.php");
}
if($_GET['process']=="downloadexcel" && $_SERVER['REMOTE_ADDR']!="" && isset($_SESSION['smmmebhaveshadmin'])){
if (PHP_SAPI == 'cli')
die('This example should only be run from a Web Browser');
$searchquery=array();
$searchquery[0]=$_GET['orderno'];
$searchquery[1]=$_GET['from'];
$searchquery[2]=$_GET['to'];
$searchquery[3]=$_GET['type'];
$searchquery[4]=$_GET['user'];
$searchquery[5]=$_GET['status'];
$ress=$admin->downloadexcel($searchquery);
ob_clean();
require_once "excel/class/PHPExcel.php";
$objPHPExcel = new PHPExcel();
$headings = array('UserName','Order No','Service','Url','Count','Remain Count','Price','Before Balance','After Balance','Status','Date','Transaction No','Refund Transaction No'); 
$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword('secret');
$rowNumber = 1; 
$col = 'A'; 
foreach($headings as $heading) { 
$objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading); 
$col++; 
} 
$rowNumber = 2; 
foreach($ress as $row) {
$col = 'A'; 
foreach($row as $cell) { 
 $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$cell); 
if($col=="B"){
 $objPHPExcel->getActiveSheet()->getStyle($col.$rowNumber)->getNumberFormat()->setFormatCode('#');
}
$col++; 
 } 
$rowNumber++; 
}
$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="smme-excel '.date("d-m-y (h.i.s a)").'.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header ('Cache-Control: cache, must-revalidate');
header ('Pragma: public'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
}
else if($_GET['process']=="downloadtext" && $_SERVER['REMOTE_ADDR']!="" && isset($_SESSION['smmmebhaveshadmin'])){
$searchquery=array();
$searchquery[0]=$_GET['orderno'];
$searchquery[1]=$_GET['from'];
$searchquery[2]=$_GET['to'];
$searchquery[3]=$_GET['type'];
$searchquery[4]=$_GET['user'];
$searchquery[5]=$_GET['status'];
$ress=$admin->downloadtext($searchquery);
$content=array();
foreach ($ress as $row){ 
$content[]=$row['url'].",".$row['count'];
}
$handle = fopen("record ".date("d-m-y (h.i.s a)").".txt", "w");
foreach($content as $text){
fwrite($handle, $text);
fwrite($handle,"\r\n");
}
fclose($handle);
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename('record '.date("d-m-y (h.i.s a)").'.txt'));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize('record '.date("d-m-y (h.i.s a)").'.txt'));
readfile('record '.date("d-m-y (h.i.s a)").'.txt');
exit;
}
ob_end_flush();
?>