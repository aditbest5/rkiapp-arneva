<?php
require_once 'tcpdf/tcpdf.php';
$barcode = $_GET['barcode'];
$no = $_GET['no'];
//Property
$fontsize=0;
if($barcode == "QR"){
	$fontsize=6;
}else{
	$fontsize=10;
}


$pdf = new TCPDF('P', 'mm', array(60, 55), true, 'UTF-8', false);

$pdf->setPrintFooter(false);
$pdf->setPrintHeader(false);
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetMargins(2, 2, 4, 0);
// $pdf->AddPage('');
$pdf->SetFont('');

$style = array(
	'position' => '',
	'align' => 'C',
	'stretch' => false,
	'fitwidth' => false,
	'cellfitalign' => '',
	'border' => false,
	'hpadding' => 'auto',
	'vpadding' => 'auto',
	'fgcolor' => array(0, 0, 0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => $fontsize,
	'stretchtext' => 0
);


//$data = array("cartNo" => "EOK12305001380302", "styleNo" => "37", "prodNm" => "43", "custPoNo" => "43", "poQty" => "43", "wosNo" => "43", "destNm" => "43", "midNm1" => "43", "packQty" => "43");
$pdf->AddPage();
$table ='';

if ($barcode == "QR") {
	$table = '<br><br><br><br><br><br><br><br><br><center>'.$no.'</center>';
	$pdf->writeHTML($table);
	$pdf->write2DBarcode($no, 'QRCODE,L', 5, 2, 100, 70, $style, 'N');
	//$pdf->Text(10, 42, 'QRCODE L');
} else {
	$pdf->write1DBarcode($no, 'C128', '5', '15', '45', 15, 0.3, $style, 'N');
	$pdf->writeHTML($table);
}







/*
	foreach($data as $row) {
	
		// $params = $pdf->serializeTCPDFtagParameters(array('K721010006133', 'C39', '', '', '', 12, 0.4, $style, 'N'));
		
				
		// $pdf->StartTransform();
		// $pdf->Rotate(90);
		// $pdf->write1DBarcode($row->cartNo, 'C128', '0', '0', '45', 12, 0.3, $style, 'N');
		// $pdf->StopTransform();

		$pdf->AddPage();
		$table ='
		<table id="test" border="1" style="font-size:7px;padding:1.5px;">
		<thead>
			<tr>
			<td style="width:75%; font-size:8px;" rowspan="2">
				<b style="font-size:7px;">CARTON :&nbsp;</b> <b style="font-size:10px;">'.$row->cartNo.'</b><br>
				<b style="font-size:7px;">STYLE : &nbsp;&nbsp;&nbsp;&nbsp;</b> <b style="font-size:10px;">'.$row->styleNo.'</b><br>
				<b style="font-size:7px;">MODEL :</b> &nbsp;&nbsp;&nbsp;'.substr($row->prodNm,0,21).'<br>
				<b style="font-size:7px;">PONO : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>  <b>'.$row->custPoNo.'&nbsp;&nbsp;&nbsp;</b><b style="font-size:7px;">POQTY :</b> <b>'.$row->poQty.'</b><br>
				<b style="font-size:7px;">WOSNO : &nbsp;&nbsp;&nbsp;</b><b>'.$row->wosNo.'</b><br>
				<b style="font-size:7px;">DEST : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <b>'.(($row->destNm == 'USA') ? $row->destNm.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : $row->destNm).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><b style="font-size:8px; font-weight:bold">'.$row->cartseq.'/'.$row->sum_carton.'</b>
			</td>
			<td style="width:25%" align="center">
				<span style="font-size:10px">SIZE</span>
			</td>
			</tr>
			<tr>
				<td align="center" style="font-size:12px; font-weight:bold" rowspan="2">
				'.$row->midNm1.'
				</td>
			</tr>
			<tr>
				<td>
					<br><br><br><br>
				</td>
			</tr>
			<tr>
			<td align="center" style="font-size:8px; font-weight:bold">PT. SHOENARY JAVANESIA INC.</td>
			<td align="center">
				<span style="font-size:10px;background-color:black;color:white;">&nbsp;&nbsp;'.$row->packQty.'&nbsp;&nbsp;</span>
			</td>
			</tr>

		</thead>
		</table>
		';
		$pdf->SetTopMargin(5);
		$pdf->SetLeftMargin(13);
		$pdf->writeHTML($table);
		$pdf->write1DBarcode($row->cartNo, 'C93', '15', '29', '45', 12, 0.3, $style, 'N');
		
		$pdf->StartTransform();
		$pdf->Rotate(-90);
		$pdf->write1DBarcode($row->cartNo, 'C93', '-24', '41', '45', 14, 0.3, $style, 'N');
		$pdf->StopTransform();
		 
		
		// Transform Barcode
		// $pdf->StartTransform();
		// $pdf->Rotate(-90);
		// $pdf->write1DBarcode($row->cartNo, 'C128', '1', '-9', '45', 12, 0.3, $style, 'N');
		// $pdf->StopTransform();
	}
	*/


$pdf->Output('QR-CODE.pdf', 'I');
