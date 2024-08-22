<?php
require_once 'tcpdf/tcpdf.php';
$data = $_GET["arrData"];
//print($arrData); 

$pdf = new TCPDF('L', 'mm', array(95, 48), true, 'UTF-8', false);

$pdf->setPrintFooter(false);
$pdf->setPrintHeader(false);
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetMargins(1, 1, 0, 0);

$pdf->SetFont('');
$pdf->SetFont('helvetica', '', 8);
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
	'fontsize' => 6,
	'stretchtext' => 0
);

$dpono = "";
$query = "";


$arrData = json_decode($data, true);

//   foreach($data as $arrData) {
for ($i = 0; $i < count($arrData); $i++) {
	$pdf->SetFont('helvetica', 'B', 8);
	if ($i % 2 == 0) {
		$pdf->AddPage('');
		$table = "
	 			<table cellpadding=\"2\">
	 			<tr>
	 			<td><span style='font-size:6px;'>" . $arrData[$i]['nama_barang'] . "</span></td>
	 			</tr>

	 			</table>
	 			";
		$pdf->SetFont('helvetica', '', 8);
		$pdf->setXY(1, 15, false);
		// $pdf->writeHTML($table);
		$pdf->writeHTMLCell(45, 0, '', '', $table, 0, 1, 0, true, 'L', true);
		$table = "
	 			<table cellpadding=\"2\">
	 			<tr>
	 			<td>Packing Qty</td>
	 			<td>". $arrData[$i]['packing_qty']."</td>
	 			</tr>
	 			<tr>
	 			<td>Tgl Produksi</td>
	 			<td>" . $arrData[$i]['tanggal_produksi'] . "</td>
	 			</tr>
	 			<tr>
	 			<td>Tgl Expired</td>
	 			<td>" . $arrData[$i]['tanggal_kadaluarsa'] . "</td>
	 			</tr>
				<tr>
	 			<td>Harga</td>
	 			<td>" . $arrData[$i]['harga'] . "</td>
	 			</tr>

	 			</table>
	 			";
		$pdf->Ln(2);
		$pdf->writeHTMLCell(45, 0, '', '', $table, 0, 1, 0, true, 'L', true);
		// $pdf->writeHTML($table);
		$pdf->write1DBarcode($arrData[$i]['generate_barcode'], 'C128', '1', '2', '40', 12, 2, $style, 'N');
	} else {
		$table = "
			<table cellpadding=\"2\">
				<tr>
                <td><span style='font-size:6px;'>" . $arrData[$i]['nama_barang'] . "</span></td>
				</tr>

			</table>
			";
		$pdf->SetFont('helvetica', '', 8);
		$pdf->setXY(52, 15, false);
		// $pdf->writeHTML($table);
		$pdf->writeHTMLCell(45, 0, '', '', $table, 0, 1, 0, true, 'L', true);
		$table = "
		<table cellpadding=\"2\">
		<tr>
		<td>Packing Qty</td>
		<td>". $arrData[$i]['packing_qty']."</td>
		</tr>
		<tr>
		<td>Tgl Produksi</td>
		<td>" . $arrData[$i]['tanggal_produksi'] . "</td>
		</tr>
		<tr>
		<td>Tgl Expired</td>
		<td>" . $arrData[$i]['tanggal_kadaluarsa'] . "</td>
		</tr>
	    <tr>
		<td>Harga</td>
		<td>" . $arrData[$i]['harga'] . "</td>
		</tr>

		</table>
			";
		$pdf->Ln(2);
		$y = $pdf->GetY();
		$pdf->setXY(50, $y, false);
		$pdf->writeHTMLCell(45, 0, '', '', $table, 0, 1, 0, true, 'L', true);
		// $pdf->writeHTML($table);

		$pdf->write1DBarcode($arrData[$i]['generate_barcode'], 'C128', '52', '2', '40', 11, 2, $style, 'N');
	}
}



$pdf->Output('QR-CODE.pdf', 'I');
