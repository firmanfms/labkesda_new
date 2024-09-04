<?php
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Table;
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Paragraph;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\SimpleType\Jc;
/**
 * Function to generate a Word document using PhpWord library
 *
 * @param object $header Header information for the document
 * @param array $detail Detailed information for the document
 * @param array $detail_kdpar Additional details for the document
 * @param object $note Notes to be added to the document
 * @param string $type_surat Type of the document
 * @param string $type_laporan Type of the report
 * @param string $header_cetak Header print option
 * @param string $agreditasi Accreditation information
 * @param string $ttn Signature type
 * @param object $ttd_kepala Head signature information
 * @param object $ttd_tu TU signature information
 * @param string $napsa Napsa information
 * @param string $ttl TTL information
 * @param object $ttd_teknis Technical signature information
 * @param object $ttd_koor Coordinator signature information
 */
 function generateWordDocumentmaknum_versi1($header, $detail, $detail_kdpar, $ttd_kepala, $ttd_tu, $ttd_teknis, $ttd_koor, $type_surat, $type_laporan, $header_cetak, $agreditasi, $napsa, $note, $ttl, $ttn) {
    $tanggal_lahir  = date('Y-m-d', strtotime($header->tgl_lahir));
    $tgl_input      = date('Y-m-d', strtotime($header->tgl_input));
    $birthDate      = new \DateTime($tanggal_lahir);
    $tgl_input      = new \DateTime($tgl_input);
    $umur           = 0;
    if ($birthDate < $tgl_input) {
    $umur       = $tgl_input->diff($birthDate)->y;
    $month      = $tgl_input->diff($birthDate)->m;
    $day        = $tgl_input->diff($birthDate)->d;
    }
    $phpWord = new PhpWord();
     $section = $phpWord->addSection(array('paperSize' => 'Legal'));
    // Mengelompokkan hasil parameter berdasarkan kategori
    $res_par = array();
    foreach ($detail as $val1) {
        $res_par[$val1->kd_kategori_parameter][] = $val1;
    }
    // pre($header_cetak); exit();
        $header1 =  createHeader($section, $header_cetak, $agreditasi); 
            // goto cetak;
            if($type_surat=="surat"){
            $textrun = $section->addTextRun();
           $textrun->addText("No. Lab \t: " . $header->no_pendaftaran ." \t\t\t Tangerang :" . tgl_print(dbnow()), WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addText("Sifat   \t\t: Rahasia", WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addText("Perihal \t: Hasil Pemeriksaan Laboratorium", WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addTextBreak(1);
				$section->addText('Kepada Yth,', WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addText('Bapak / Ibu ' . strtoupper(escapeHtml($header->nama)), WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addText(escapeHtml($header->alamat), WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addTextBreak(1);
				$section->addText('Bersama ini kami sampaikan hasil pemeriksaan Sampel '. escapeHtml($header->nm_sampel).' pada Laboratorium Makanan Dan Minuman. Atas perhatian dan kerjasamanya, kami sampaikan terimakasih.', WordSuratBodyStyle::getBody(), ['alignment' => 'both']);
				$section->addTextBreak(2);
				$table = $section->addTable();
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addText('Mengetahui,', WordSuratBodyStyle::getBody(), ['alignment' => 'center']);
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addText(($ttn == "kalab") ? escapeHtml($ttd_kepala->jabatan) : escapeHtml($ttd_tu->jabatan), WordSuratBodyStyle::getBody(), ['alignment' => 'center']);
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addText('Dinas Kesehatan Kota Tangerang', WordSuratBodyStyle::getBody(), ['alignment' => 'center']);
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addTextBreak(3);
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addText(($ttn == "kalab") ? escapeHtml($ttd_kepala->nama) : escapeHtml($ttd_tu->nama), WordSuratBodyStyle::getBodyUnderline(), ['alignment' => 'center', 'underline' => 'single']);
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addText('NIP. ' . (($ttn == "kalab") ? escapeHtml($ttd_kepala->nip) : escapeHtml($ttd_tu->nip)), WordSuratBodyStyle::getBody(), ['alignment' => 'center']);
				$section->addTextBreak(2);
				// $section->addText('FSOP.LKT-15.1', WordSuratBodyStyle::getBody(), ['alignment' => 'right']);
            // $headerTable = $section->addHeader()->addTable();
        $footer1 = createFooterSelainKlinik($section,$header_cetak ,  $agreditasi);
            }
    // goto cetak;
      if($type_laporan=='laporan'){
        if($type_surat=='surat'){
              $section->addPageBreak();
        }
        // goto y;
    // echo $type_laporan; exit();
    $section = $phpWord->addSection(array('paperSize' => 'Legal'));
            // <strong style="font-size: 16px;">Laporan Hasil Uji Lab Klinik</strong>
        $section->addText('Laporan Hasil Uji Lab Makanan Dan Minuman', WordHasilBodyStyle::getBodyBold(), ['alignment' => 'center']);
        $section->addText('NOMOR : ' . $header->no_pendaftaran, WordHasilBodyStyle::getBodyBold(), ['alignment' => 'center']);
        $table = $section->addTable();
        //   goto xx; 
        // $table->addRow();
        // $table->addRow();
        // $table->addCell(3000)->addText('No. Lab', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . $header->no_pendaftaran, ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Pemilik', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . strtoupper($header->nama), ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Nama Sampel', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . $header->uraian_sampel, ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();      
        // $table->addCell(3000)->addText('Banyak Sampel', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . escapeHtml($header->banyak), ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Alamat', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000, ['gridSpan' => 2])->addText(': ' . escapeHtml($header->alamat), ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Jenis Sampel', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . $header->nm_sampel, ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Keterangan Sampel', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000, ['gridSpan' => 2])->addText(': ' . $header->ket_sampel . '/' . $header->kondisi, ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Tanggal Penerimaan', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . tgl_singkat($header->tgl_diterima), ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(1500)->addText('No. Lab',  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . $header->no_pendaftaran,  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(1500)->addText('Volume',  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml($header->banyak),  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(2000)->addText('Pemilik',  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml(strtoupper($header->nama)),  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(2000)->addText('Jenis Sampel',  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . $header->nm_sampel,  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(2000)->addText('Alamat',  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml($header->alamat),  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(2000)->addText('Tanggal Penerimaan',  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . tgl_singkat($header->tgl_diterima),  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(2000)->addText('Nama Sampel',  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . $header->uraian_sampel,  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(2000)->addText('Keterangan Sampel',  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . $header->ket_sampel . '/' . $header->kondisi,  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        // $table->addRow();
        $section->addText(($napsa == 'ya') ? 'Berdasarkan pemeriksaan saat ini, hasil untuk URINE SCREENING TEST, adalah sebagai berikut :' : '',  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
        //  goto cetak;
    xax:
    $section->addTextBreak();
    $table = $section->addTable(['borderSize' => 6, 'borderColor' => 'black', 'cellMargin' => 50]);
    $table->addRow();
    $table->addCell(2500, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Pemeriksaan',  WordHasilTableStyle::getNormalBold(), ['alignment' => 'center']);
    $table->addCell(2500, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Hasil Pemeriksaan',  WordHasilTableStyle::getNormalBold(), ['alignment' => 'center']);
    $table->addCell(2500, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Kadar Maksimum yang Diperbolehkan',  WordHasilTableStyle::getNormalBold(), ['alignment' => 'center']);
    $table->addCell(2500, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Metode Uji',  WordHasilTableStyle::getNormalBold(), ['alignment' => 'center']);
//      $t1 = $section->addTable(['borderSize' => 6, 'borderColor' => 'black', 'cellMargin' => 50]);
//     $t1->addRow();
//    $t1->addCell(2000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Jenis Pemeriksaan', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
//     $t1->addCell(3000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Hasil', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
//     $t1->addCell(2000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Nilai Rujukan', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
//     $t1->addCell(3000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Satuan', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
//    goto cetak;
//    y:
    $res_par = array();
foreach ($detail as $key => $val1) {
  $res_par[$val1->kd_kategori_parameter][]=$val1;
}
    // pre($detail);exit();
    $total = 0;
    foreach ($detail_kdpar as $key => $value) {
        $nm_kategori_parameter = $value->nm_kategori_parameter;
        // echo $nm_kategori_parameter;
        $table->addRow();
        $table->addCell(12000, ['gridSpan' => 4, 'bgColor' => 'adadad'])->addText("-- " .  ($nm_kategori_parameter) . " --",  WordHasilTableStyle::getNormalBold());
        foreach ($res_par[$value->kd_kategori_parameter] as $key => $val) {
            $total += $val->harga;
            $bold = $val->nilai;
            if ($val->nilai_min != '0.00' && $val->nilai_max != '0.00') {
                if ((int)$val->nilai < $val->nilai_min || (int)$val->nilai > $val->nilai_max) {
                    $bold = replaceSymbolKadar($val->nilai);
                }
            }
            $table->addRow();
            $table->addCell(3000)->addText($val->nm_parameter);
            $table->addCell(3000, ['alignment' => 'center'])->addText(convertHtmlToPlainText("$bold - $val->nilai_min - $val->nilai_max") ,  WordHasilTableStyle::getNormal() );
            $table->addCell(3000, ['alignment' => 'center'])->addText(convertHtmlToPlainText($val->kadar) ,  WordHasilTableStyle::getNormal());
            $table->addCell(3000, ['alignment' => 'center'])->addText(convertHtmlToPlainText($val->hasil_analisa) , WordHasilTableStyle::getNormal());
        }
    }
 $section->addTextBreak();
$table2 = $section->addTable();
$table2->addRow();
$table2->addCell(6000); 
$table2->addCell(4000)->addText('Tangerang, ' . tgl_print(dbnow()), WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
// $table2->addCell(6000);
// $table2->addRow()4
// $table2->addCell(6000);
// $table2->addCell(4000)->addText('', WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
// $table2->addCell(2000);
$table2->addRow();
$table2->addCell(6000);
$table2->addCell(4000)->addText('Mengetahui,', WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
$table2->addRow();
$table2->addCell(6000);
$table2->addCell(4000)->addText(($ttl == 'matek') ? $ttd_teknis->jabatan : $ttd_koor->jabatan, WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
$table2->addRow();
$table2->addCell(6000);
$table2->addCell(4000)->addText('', WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
$table2->addRow();
$table2->addCell(6000);
$table2->addCell(4000)->addText('' . (($ttl == 'matek') ? $ttd_teknis->nama : $ttd_koor->nama) . '', WordHasilBodyStyle::getBodyUnderline() , ['alignment' => 'center']);
$table2->addRow();
$table2->addCell(6000);
$table2->addCell(4000)->addText('NIP. ' . (($ttl == 'matek') ? $ttd_teknis->nip : $ttd_koor->nip), WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
 $section->addTextBreak();
//  goto cetak;
// $table3 = $section->addTable();
// $table3->addRow();
//if ($napsa =='ya')
//{
$html = $note->keterangan2 ;
// Html::addHtml($section, $html);
$htmlex= explode("#",$html);
// pre($note);
// pre($html);
//  pre($htmlex);exit();
if (count($htmlex) > 1) {
//  $textrun = $section->addTextRun();
 $section->addText(escapeHtml($htmlex[0]) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
//  $section->addTextBreak();
    array_shift($htmlex);
            foreach ($htmlex as $ket) {
                if ($ket == "") {
                    continue;
                }
                // pre($ket);
                 $section->addText( escapeHtml($ket) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
                //   $section->addTextBreak();
            }
}
//}else{
//}
// exit();
// goto cetak;
$html = $note->catatan2 ;
$htmlex= explode("#",$html);
// pre($htmlex);exit();
if (count($htmlex) > 1) {
//  $textrun = $section->addTextRun();
 $section->addText(escapeHtml($htmlex[0]) , WordHasilBodyStyle::getBodycatatan(), ['alignment' => 'left' ,'spaceAfter' => 0]);
//  $section->addTextBreak();
    array_shift($htmlex);
            foreach ($htmlex as $ket) {
                if ($ket == "") {
                    continue;
                }
                 $section->addText( escapeHtml($ket) , WordHasilBodyStyle::getBodycatatan(), ['alignment' => 'left' ,'spaceAfter' => 0]);
                //   $section->addTextBreak();
            }
}
// if ($napsa=='ya')
// {
//     $table3->addCell(8000)->addText( $note->keterangan , WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
// }
// $table2->addCell(8000)->addText(($napsa == 'ya') ? ($note->keterangan) : '', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
// Html::addHtml($table3->addCell(10000), ($napsa == 'ya') ?  ($note->keterangan) : '' );
// convertHtmlToPhpWord($table2->addCell(2000), ($napsa == 'ya') ?  ($note->keterangan) : '');
// $table2->addCell(4000);
// $table2->addCell(2000);
// $table2->addCell(4000);
// $table4 = $section->addTable();
// $table4->addRow();
// $table4->addCell(5000)->addText( ($note->catatan),  WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
// Html::addHtml($table2->addCell(10000),   ($note->catatan)  );
// convertHtmlToPhpWord($table2->addCell(2000),  ($note->catatan));
// $table2->addCell(4000);
// $table2->addCell(2000);
// $table2->addCell(4000);
// $table4->addRow();
// $table4->addCell(5000);
// $table3->addCell(5000)->addText('FSOP.LKT-15.1',WordHasilBodyStyle::getBody() , ['alignment' => 'right']);
if ( $agreditasi == 'kalk') { 
createFooterHal2($section,$header_cetak   ,  $agreditasi);
}elseif ( $agreditasi == 'kan') {
// createFooterHal1($section,$header_cetak   ,  $agreditasi);
createFooterSelainKlinik($section,$header_cetak   ,  $agreditasi);
}
}
cetak:
   header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
   header('Content-Disposition: attachment; filename="' . str_replace("/", "", $header->no_pendaftaran) . '.docx"');
   // header('Content-Type: application/octet-stream');
   $writer = IOFactory::createWriter($phpWord, 'Word2007');
   $writer->save('php://output');
   exit();
}
 function generateWordDocumentmaknum_versi2($header, $detail, $detail_kdpar, $ttd_kepala, $ttd_tu, $ttd_teknis, $ttd_koor, $type_surat, $type_laporan, $header_cetak, $agreditasi, $napsa, $note, $ttl, $ttn) {
    // pre($header);
    // exit();
    try {
    // your code here
    $tanggal_lahir  = date('Y-m-d', strtotime($header->tgl_lahir));
    $tgl_input      = date('Y-m-d', strtotime($header->tgl_input));
    $birthDate      = new \DateTime($tanggal_lahir);
    $tgl_input      = new \DateTime($tgl_input);
    $umur           = 0;
    if ($birthDate < $tgl_input) {
    $umur       = $tgl_input->diff($birthDate)->y;
    $month      = $tgl_input->diff($birthDate)->m;
    $day        = $tgl_input->diff($birthDate)->d;
    }
    $phpWord = new PhpWord();
     $section = $phpWord->addSection(array('paperSize' => 'Legal'));
    // Mengelompokkan hasil parameter berdasarkan kategori
    $res_par = array();
    foreach ($detail as $val1) {
        $res_par[$val1->kd_kategori_parameter][] = $val1;
    }
    // pre($header_cetak); exit();
        $header1 =  createHeader($section, $header_cetak, $agreditasi); 
            // goto cetak;
            if($type_surat=="surat"){
            $textrun = $section->addTextRun();
           $textrun->addText("No. Lab \t: " . $header->no_pendaftaran ." \t\t\t Tangerang :" . tgl_print(dbnow()),WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addText("Sifat   \t\t: Rahasia",WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addText("Perihal \t: Hasil Pemeriksaan Laboratorium",WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addTextBreak(1);
				$section->addText('Kepada Yth,',WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addText('Bapak / Ibu ' . strtoupper(escapeHtml($header->nama)),WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addText(escapeHtml($header->alamat),WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
				$section->addTextBreak(1);
				$section->addText('Bersama ini kami sampaikan hasil pemeriksaan Sampel '. escapeHtml($header->nm_sampel).' pada Laboratorium Makanan Dan Minuman. Atas perhatian dan kerjasamanya, kami sampaikan terimakasih.',WordSuratBodyStyle::getBody(), ['alignment' => 'both']);
				$section->addTextBreak(2);
				$table = $section->addTable();
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addText('Mengetahui,',WordSuratBodyStyle::getBody(), ['alignment' => 'center']);
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addText(($ttn == "kalab") ? escapeHtml($ttd_kepala->jabatan) : escapeHtml($ttd_tu->jabatan),WordSuratBodyStyle::getBody(), ['alignment' => 'center']);
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addText('Dinas Kesehatan Kota Tangerang',WordSuratBodyStyle::getBody(), ['alignment' => 'center']);
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addTextBreak(3);
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addText(($ttn == "kalab") ? escapeHtml($ttd_kepala->nama) : escapeHtml($ttd_tu->nama), WordSuratBodyStyle::getBodyUnderline(), ['alignment' => 'center', 'underline' => 'single']);
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addText('NIP. ' . (($ttn == "kalab") ? escapeHtml($ttd_kepala->nip) : escapeHtml($ttd_tu->nip)),WordSuratBodyStyle::getBody(), ['alignment' => 'center']);
				$section->addTextBreak(2);
				// $section->addText('FSOP.LKT-15.1',WordSuratBodyStyle::getBody(), ['alignment' => 'right']);
            // $headerTable = $section->addHeader()->addTable();
        // $footer1 = createFooterHal1($section,$header_cetak ,  $agreditasi);
        createFooterSelainKlinik($section,$header_cetak ,  $agreditasi);
            }
    // goto cetak;
      if($type_laporan=='laporan'){
        if($type_surat=='surat'){
              $section->addPageBreak();
        }
        // goto y;
    // echo $type_laporan; exit();
    $section = $phpWord->addSection(array('paperSize' => 'Legal'));
            // <strong style="font-size: 16px;">Laporan Hasil Uji Lab Klinik</strong>
        $section->addText('Laporan Hasil Uji Lab Makanan Dan Minuman', WordHasilBodyStyle::getBodyBold(), ['alignment' => 'center']);
        $section->addText('NOMOR : ' . $header->no_pendaftaran, WordHasilBodyStyle::getBodyBold(), ['alignment' => 'center']);
        $table = $section->addTable();
        //   goto xx; 
        // $table->addRow();
        // $table->addRow();
        // $table->addCell(3000)->addText('No. Lab', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . $header->no_pendaftaran, ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Pemilik', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . strtoupper($header->nama), ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Nama Sampel', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . $header->uraian_sampel, ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();      
        // $table->addCell(3000)->addText('Banyak Sampel', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . escapeHtml($header->banyak), ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Alamat', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000, ['gridSpan' => 2])->addText(': ' . escapeHtml($header->alamat), ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Jenis Sampel', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . $header->nm_sampel, ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Keterangan Sampel', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000, ['gridSpan' => 2])->addText(': ' . $header->ket_sampel . '/' . $header->kondisi, ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addRow();
        // $table->addCell(3000)->addText('Tanggal Penerimaan', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        // $table->addCell(7000)->addText(': ' . tgl_singkat($header->tgl_diterima), ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(1500)->addText('No. Lab', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . $header->no_pendaftaran, WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(2000)->addText('Alamat', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml($header->alamat), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(2000)->addText('Pemilik', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml(strtoupper($header->nama)), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(2000)->addText('Jenis Sampel', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . $header->nm_sampel, WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(2000)->addText('Nama Sampel', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . $header->uraian_sampel, WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(2000)->addText('Tanggal Penerimaan', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . tgl_singkat($header->tgl_diterima), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(1500)->addText('Banyak Sampel', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml($header->banyak), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(2000)->addText('Keterangan Sampel', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . $header->ket_sampel . '/' . $header->kondisi, WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        // $table->addRow();
        $section->addText(($napsa == 'ya') ? 'Berdasarkan pemeriksaan saat ini, hasil untuk URINE SCREENING TEST, adalah sebagai berikut :' : '', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        //  goto cetak;
    xax:
    $section->addTextBreak();
 $tableStyle = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);
$firstRowStyle = array('bgColor' => 'adadad', 'bold' => true);
$cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
$cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
$cellHCentered = array('alignment' => Jc::CENTER);
$cellVCentered = array('valign' => 'center');
// Add table style
$phpWord->addTableStyle('Colspan Rowspan', $tableStyle, $firstRowStyle);
// Add table
$table = $section->addTable('Colspan Rowspan');
// Add header row
$table->addRow();
$table->addCell(1750, array_merge($cellColSpan, $firstRowStyle))->addText('JENIS PEMERIKSAAN', WordHasilTableStyle::getNormalBold(), $cellHCentered);
$table->addCell(1750, array_merge($cellRowSpan, $firstRowStyle))->addText('HASIL', WordHasilTableStyle::getNormalBold(), $cellHCentered);
$table->addCell(null, $firstRowStyle)->addText('Maksimum Range (*)', WordHasilTableStyle::getNormalBold(), $cellHCentered);
$table->addCell(null, $firstRowStyle);
$table->addCell(null, $firstRowStyle);
$table->addCell(null, $firstRowStyle);
$table->addCell(1750, array_merge($cellRowSpan, $firstRowStyle))->addText('METODE UJI', WordHasilTableStyle::getNormalBold(), $cellHCentered);
$table->addCell(1750, array_merge($cellRowSpan, $firstRowStyle))->addText('KET', WordHasilTableStyle::getNormalBold(), $cellHCentered);
// Add second header row
$table->addRow();
$table->addCell(1750, array_merge($cellColSpan, $firstRowStyle))->addText('');
$table->addCell(1750, array('vMerge' => 'continue'));
$table->addCell(null, array_merge($firstRowStyle, $cellHCentered))->addText('n', WordHasilTableStyle::getNormalBold() , $cellHCentered);
$table->addCell(null, array_merge($firstRowStyle, $cellHCentered))->addText('c', WordHasilTableStyle::getNormalBold() , $cellHCentered);
$table->addCell(null, array_merge($firstRowStyle, $cellHCentered))->addText('m', WordHasilTableStyle::getNormalBold() , $cellHCentered);
$table->addCell(null, array_merge($firstRowStyle, $cellHCentered))->addText('M', WordHasilTableStyle::getNormalBold() , $cellHCentered);
$table->addCell(1750, array('vMerge' => 'continue'));
$table->addCell(1750, array('vMerge' => 'continue'));
    $res_par = array();
foreach ($detail as $key => $val1) {
  $res_par[$val1->kd_kategori_parameter][]=$val1;
}
    // pre($detail);exit();
  foreach ($detail_kdpar as $key => $value) {
    $nm_kategori_parameter = $value->nm_kategori_parameter;
    $kd_kategori_parameter = $value->kd_kategori_parameter;
    // Add category row
    $table->addRow();
    $table->addCell(null, array('gridSpan' => 9, 'bgColor' => 'adadad', 'bold' => true))
        ->addText('--  ' . $nm_kategori_parameter . '  --', null, $cellHCentered);
    // Iterate over parameters
    foreach ($res_par[$kd_kategori_parameter] as $key => $param) {
        // $total += $param->harga;
        $nilai = str_replace("|", "\n", $param->nilai);
        $nilai_ex = explode("|", $param->nilai);
        $nilai_leng = count($nilai_ex);
        $kadar = explode("|", $param->kadar);
        $bold = $nilai_ex[0];
        $is_bold = false;
        if ($param->nilai_min != '0.00' && $param->nilai_max != '0.00') {
            if ((int)$nilai_ex[0] < $param->nilai_min || (int)$nilai_ex[0] > $param->nilai_max) {
                if ($nilai_ex[0] > $param->nilai_min && $param->nilai_max > $nilai_ex[0]) {
                    $bold = $nilai_ex[0];
                    $is_bold = false;
                } else {
                    $bold = "<strong><u>" . $nilai_ex[0] . "</u></strong>";
                     $is_bold = true;
                }
            }
        }
        // Add parameter row
        $table->addRow();
        // $table->addCell(null, array('vMerge' => 'restart'))->addText($param->nm_parameter, null);
        // $table->addCell(null, array('vMerge' => 'continue'));
        // $table->addCell(null)->addText($bold);
        // $table->addCell(null, array('vMerge' => 'restart', 'alignment' => Jc::CENTER))->addText($kadar[0], null, $cellHCentered);
        // $table->addCell(null, array('vMerge' => 'restart', 'alignment' => Jc::CENTER))->addText($kadar[1], null, $cellHCentered);
        // $table->addCell(null, array('vMerge' => 'restart', 'alignment' => Jc::CENTER))->addText($kadar[2], null, $cellHCentered);
        // $table->addCell(null, array('vMerge' => 'restart', 'alignment' => Jc::CENTER))->addText($kadar[3], null, $cellHCentered);
        // $table->addCell(null, array('vMerge' => 'restart'))->addText($param->hasil_analisa);
        // $table->addCell(null, array('vMerge' => 'restart'))->addText($param->ket);
        // Add additional rows for multiple values
        $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
        $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
        $table->addCell(2000,$cellColSpan)->addText($param->nm_parameter, WordHasilTableStyle::getNormal() );
            if($is_bold)
            {
                $table->addCell(2000, ['bold' => true])->addText($nilai_ex[0], WordHasilTableStyle::getNormal() );
            }else
            {
                $table->addCell(2000, ['bold' => false])->addText($nilai_ex[0], WordHasilTableStyle::getNormal() );
            }
         $table->addCell(null, array('vMerge' => 'restart', 'alignment' => Jc::CENTER))->addText( escapeHtml ( @$kadar[0] ), WordHasilTableStyle::getNormal() , $cellHCentered);
         $table->addCell(null, array('vMerge' => 'restart', 'alignment' => Jc::CENTER))->addText( escapeHtml (@$kadar[1]) , WordHasilTableStyle::getNormal() , $cellHCentered);
        $table->addCell(null, array('vMerge' => 'restart', 'alignment' => Jc::CENTER))->addText( escapeHtml (@$kadar[2]) , WordHasilTableStyle::getNormal() , $cellHCentered);
        $table->addCell(null, array('vMerge' => 'restart', 'alignment' => Jc::CENTER))->addText( escapeHtml (@$kadar[3]) , WordHasilTableStyle::getNormal() , $cellHCentered);
          $table->addCell(null, array('vMerge' => 'restart'))->addText($param->hasil_analisa);
        $table->addCell(null, array('vMerge' => 'restart'))->addText($param->ket);
        for ($i = 1; $i < $nilai_leng; $i++) {
            $table->addRow();
            $table->addCell(null,  $cellColSpan)->addText('');
            // $table->addCell(null)->addText('');
            $table->addCell(null)->addText( escapeHtml ( $nilai_ex[$i]) );
            $table->addCell(2000,  array('vMerge' => 'continue') );
            $table->addCell(2000,  array('vMerge' => 'continue') );
            $table->addCell(2000,  array('vMerge' => 'continue') );
            $table->addCell(2000,  array('vMerge' => 'continue') );
              $table->addCell(2000,  array('vMerge' => 'continue') );
                $table->addCell(2000,  array('vMerge' => 'continue') );
        }
    }
}
// goto cetak;
 $section->addTextBreak(); 
// $table2->addCell(5000)->addText(($napsa == 'ya') ? convertHtmlToPlainText($note->keterangan) : '', ['bold' => false, 'size' => 12], ['alignment' => 'left']);
// Html::addHtml($table2->addCell(10000), ($napsa == 'ya') ?  ($note->keterangan) : '' );
// goto jump;
//if ($napsa =='ya')
//{
$html = $note->keterangan2 ;
// Html::addHtml($section, $html);
$htmlex= explode("#",$html);
// pre($note);
// pre($html);
//  pre($htmlex);exit();
// echo count($htmlex); exit();
    if (count($htmlex) > 1) {
    //  pre($htmlex);exit();
    //  $textrun = $section->addTextRun();
    $section->addText(escapeHtml($htmlex[0]) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
    //  $section->addTextBreak();
        array_shift($htmlex);
                foreach ($htmlex as $ket) {
                    if ($ket == "") {
                        continue;
                    }
                    // pre($ket);
                    $section->addText( escapeHtml($ket) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
                    //   $section->addTextBreak();
                }
    }
   // else{
    //  $section->addText('lalala');
    //    $section->addText(($html) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
   // }
//}
// goto cetak;
// jump:
 $section->addTextBreak();
$table2 = $section->addTable();
$table2->addRow();
$table2->addCell(6000); 
$table2->addCell(4000)->addText('Tangerang, ' . tgl_print(dbnow()), WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
// $table2->addCell(6000);
// $table2->addRow()4
// $table2->addCell(6000);
// $table2->addCell(4000)->addText('', WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
// $table2->addCell(2000);
$table2->addRow();
$table2->addCell(6000);
$table2->addCell(4000)->addText('Mengetahui,', WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
$table2->addRow();
$table2->addCell(6000);
$table2->addCell(4000)->addText(($ttl == 'matek') ? $ttd_teknis->jabatan : $ttd_koor->jabatan, WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
$table2->addRow();
$table2->addCell(6000);
$table2->addCell(4000)->addText('', WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
$table2->addRow();
$table2->addCell(6000);
$table2->addCell(4000)->addText('' . (($ttl == 'matek') ? $ttd_teknis->nama : $ttd_koor->nama) . '', WordHasilBodyStyle::getBodyUnderline() , ['alignment' => 'center']);
$table2->addRow();
$table2->addCell(6000);
$table2->addCell(4000)->addText('NIP. ' . (($ttl == 'matek') ? $ttd_teknis->nip : $ttd_koor->nip), WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
 $section->addTextBreak();
$html = $note->catatan2 ;
$htmlex= explode("#",$html);
// pre($htmlex);exit();
if (count($htmlex) > 1) {
//  $textrun = $section->addTextRun();
 $section->addText(escapeHtml($htmlex[0]) , WordHasilBodyStyle::getBodycatatan(), ['alignment' => 'left' ,'spaceAfter' => 0]);
//  $section->addTextBreak();
    array_shift($htmlex);
            foreach ($htmlex as $ket) {
                if ($ket == "") {
                    continue;
                }
                 $section->addText( escapeHtml($ket) , WordHasilBodyStyle::getBodycatatan(), ['alignment' => 'left' ,'spaceAfter' => 0]);
                //   $section->addTextBreak();
            }
}else {
        $section->addText(($html) , WordHasilBodyStyle::getBodycatatan(), ['alignment' => 'left' ,'spaceAfter' => 0]);
}
// convertHtmlToPhpWord($table2->addCell(2000),  ($note->catatan));
// $table2->addCell(4000);
// $table2->addCell(2000);
// $table2->addCell(4000);
// $table2->addRow();
// $table2->addCell(5000);
// $table2->addCell(5000)->addText('FSOP.LKT-15.1',WordHasilBodyStyle::getBody() , ['alignment' => 'right']);
    if ( $agreditasi == 'kalk') { 
    createFooterHal2($section,$header_cetak   ,  $agreditasi);
    }elseif ( $agreditasi == 'kan') {
    // createFooterHal1($section,$header_cetak   ,  $agreditasi);
    }
}
cetak:
   header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
   header('Content-Disposition: attachment; filename="' . str_replace("/", "", $header->no_pendaftaran) . '.docx"');
   // header('Content-Type: application/octet-stream');
   $writer = IOFactory::createWriter($phpWord, 'Word2007');
   $writer->save('php://output');
   exit();
   } catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine();
}
}
function hasil_maknum_word_v1($header, $detail, $detail_kdpar, $note, $type_surat, $type_laporan, $header_cetak, $agreditasi, $ttn, $ttd_kepala, $ttd_tu, $napsa, $ttl, $ttd_teknis, $ttd_koor) {
    $phpWord = new PhpWord();
    $section = $phpWord->addSection();
    // Add header
    if ($header_cetak == 'Ya') {
        $headerTable = $section->addTable();
        $headerTable->addRow();
        $headerTable->addCell(1500, ['align' => 'center'])->addImage('assets/image/542px-Lambang_Kota_Tangerang.png', ['height' => 75, 'width' => 75]);
        $headerText = "PEMERINTAH KOTA TANGERANG\nDINAS KESEHATAN\nUPT LABORATORIUM KESEHATAN DAERAH\nJL. TMP Taruna Suka Asih Telp/Fax : 021 - 5588737 Kota Tangerang 15111\nEmail : labkeskota.tangerang@gmail.com";
        $headerTable->addCell(3500, ['align' => 'center'])->addText($headerText, ['name' => 'Times New Roman', 'size' => 12, 'bold' => true], ['align' => 'center']);
        if ($agreditasi == "kan") {
            $headerTable->addCell(2000, ['align' => 'center'])->addImage('assets/image/kan-logo-D754581922-seeklogo.com.png', ['height' => 75, 'width' => 100]);
        } elseif ($agreditasi == "kalk") {
            $headerTable->addCell(2000, ['align' => 'center'])->addImage('assets/image/logo-KALK.jpg', ['height' => 125, 'width' => 175]);
        } elseif ($agreditasi == "kankalk") {
            $cell = $headerTable->addCell(2000, ['align' => 'center']);
            $cell->addImage('assets/image/kan-logo-D754581922-seeklogo.com.png', ['height' => 75, 'width' => 100]);
            $cell->addImage('assets/image/logo-KALK.jpg', ['height' => 75, 'width' => 100]);
        }
    }
    // Add lab details
    $section->addText("No. Lab: " . $header->no_pendaftaran);
    $section->addText("Sifat: Rahasia");
    $section->addText("Perihal: Hasil Pemeriksaan Laboratorium");
    $section->addText("Kepada Yth,");
    $section->addText("Bapak / Ibu " . strtoupper($header->nama));
    $section->addText(ucfirst($header->alamat));
    // Add report body
    if ($type_laporan == 'laporan') {
        $section->addText("Laporan Hasil Uji Lab Makanan Dan Minuman", ['bold' => true]);
        $section->addText("NOMOR : " . $header->no_pendaftaran, ['bold' => true]);
        $section->addText("No. Lab: " . $header->no_pendaftaran);
        $section->addText("Pemilik: " . strtoupper($header->nama));
        $section->addText("Nama Sampel: " . $header->uraian_sampel);
        $section->addText("Banyak Sampel: " . $header->banyak);
        $section->addText("Alamat: " . $header->alamat);
        $section->addText("Jenis Sampel: " . $header->nm_sampel);
        $section->addText("Keterangan Sampel: " . $header->ket_sampel . '/' . $header->kondisi);
        $section->addText("Tanggal Penerimaan: " . tgl_singkat($header->tgl_diterima));
        if ($napsa == 'ya') {
            $section->addText("Berdasarkan pemeriksaan saat ini, hasil untuk URINE SCREENING TEST, adalah sebagai berikut:");
        }
        // Add test results table
        $table = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80]);
        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText("Pemeriksaan", ['bold' => true], ['align' => 'center']);
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText("Hasil Pemeriksaan", ['bold' => true], ['align' => 'center']);
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText("Kadar Maksimum yang Diperbolehkan", ['bold' => true], ['align' => 'center']);
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText("Metode Uji", ['bold' => true], ['align' => 'center']);
        foreach ($detail_kdpar as $key => $value) {
            $table->addRow();
            $table->addCell(12000, ['bgColor' => 'CCCCCC', 'gridSpan' => 4])->addText("-- " . $value->nm_kategori_parameter . " --", ['bold' => true], ['align' => 'left']);
            foreach ($res_par[$value->kd_kategori_parameter] as $val) {
                $bold = str_replace("|", "\n", $val->nilai);
                if ($val->nilai_min != '0.00' && $val->nilai_max != '0.00') {
                    if ((int)$val->nilai < $val->nilai_min || (int)$val->nilai > $val->nilai_max) {
                        $bold = $val->nilai;
                    } else {
                        $bold = "<strong><u>" . $val->nilai . "</u></strong>";
                    }
                }
                $table->addRow();
                $table->addCell(3000)->addText($val->nm_parameter);
                $table->addCell(3000)->addText($val->ket);
                $table->addCell(3000)->addText($bold);
                $table->addCell(3000)->addText($val->kadar);
                $table->addCell(3000)->addText($val->hasil_analisa);
            }
        }
        // Add note and signature
        $section->addText($note->keterangan);
        $section->addText($note->catatan);
        $section->addText("Tangerang, " . tgl_print(dbnow()));
        $section->addText("Mengetahui,");
        $section->addText(($ttn == "kalab") ? $ttd_kepala->jabatan : $ttd_tu->jabatan);
        $section->addText("Dinas Kesehatan Kota Tangerang");
        $section->addText("\n\n\n");
        $section->addText("<u>" . (($ttn == "kalab") ? $ttd_kepala->nama : $ttd_tu->nama) . "</u>");
        $section->addText("NIP. " . (($ttn == "kalab") ? $ttd_kepala->nip : $ttd_tu->nip));
    }
    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename="' . str_replace("/", "", $header->no_pendaftaran) . '.docx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    $writer = IOFactory::createWriter($phpWord, 'Word2007');
    $writer->save('php://output');
    exit();
}
function hasil_maknum_word_versi2($header, $detail, $detail_kdpar, $note, $type_surat, $type_laporan, $header_cetak, $agreditasi, $ttn, $ttd_kepala, $ttd_tu, $napsa, $ttl, $ttd_teknis, $ttd_koor)
{
    $phpWord = new PhpWord();
    $section = $phpWord->addSection();
    // Add header
    if ($header_cetak == 'Ya') {
        $headerTable = $section->addTable();
        $headerTable->addRow();
        $headerTable->addCell(1500, ['align' => 'center'])->addImage('assets/image/542px-Lambang_Kota_Tangerang.png', ['height' => 75, 'width' => 75]);
        $headerText = "PEMERINTAH KOTA TANGERANG\nDINAS KESEHATAN\nUPT LABORATORIUM KESEHATAN DAERAH\nJL. TMP Taruna Suka Asih Telp/Fax : 021 - 5588737 Kota Tangerang 15111\nEmail : labkeskota.tangerang@gmail.com";
        $headerTable->addCell(3500, ['align' => 'center'])->addText($headerText, ['name' => 'Times New Roman', 'size' => 12, 'bold' => true], ['align' => 'center']);
        if ($agreditasi == "kan") {
            $headerTable->addCell(2000, ['align' => 'center'])->addImage('assets/image/kan-logo-D754581922-seeklogo.com.png', ['height' => 75, 'width' => 100]);
        } elseif ($agreditasi == "kalk") {
            $headerTable->addCell(2000, ['align' => 'center'])->addImage('assets/image/logo-KALK.jpg', ['height' => 125, 'width' => 175]);
        } elseif ($agreditasi == "kankalk") {
            $cell = $headerTable->addCell(2000, ['align' => 'center']);
            $cell->addImage('assets/image/kan-logo-D754581922-seeklogo.com.png', ['height' => 75, 'width' => 100]);
            $cell->addImage('assets/image/logo-KALK.jpg', ['height' => 75, 'width' => 100]);
        }
    }
    // Add lab details
    $section->addText("No. Lab: " . $header->no_pendaftaran);
    $section->addText("Sifat: Rahasia");
    $section->addText("Perihal: Hasil Pemeriksaan Laboratorium");
    $section->addText("Kepada Yth,");
    $section->addText("Bapak / Ibu " . strtoupper($header->nama));
    $section->addText(ucfirst($header->alamat));
    // Add report body
    if ($type_laporan == 'laporan') {
        $section->addText("Laporan Hasil Uji Lab Makanan Dan Minuman", ['bold' => true]);
        $section->addText("NOMOR : " . $header->no_pendaftaran, ['bold' => true]);
        $section->addText("No. Lab: " . $header->no_pendaftaran);
        $section->addText("Pemilik: " . strtoupper($header->nama));
        $section->addText("Nama Sampel: " . $header->uraian_sampel);
        $section->addText("Banyak Sampel: " . $header->banyak);
        $section->addText("Alamat: " . $header->alamat);
        $section->addText("Jenis Sampel: " . $header->nm_sampel);
        $section->addText("Keterangan Sampel: " . $header->ket_sampel . '/' . $header->kondisi);
        $section->addText("Tanggal Penerimaan: " . tgl_singkat($header->tgl_diterima));
        if ($napsa == 'ya') {
            $section->addText("Berdasarkan pemeriksaan saat ini, hasil untuk URINE SCREENING TEST, adalah sebagai berikut:");
        }
        // Add test results table
        $table = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80]);
        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText("Pemeriksaan", ['bold' => true], ['align' => 'center']);
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText("Hasil Pemeriksaan", ['bold' => true], ['align' => 'center']);
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText("Kadar Maksimum yang Diperbolehkan", ['bold' => true], ['align' => 'center']);
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText("Metode Uji", ['bold' => true], ['align' => 'center']);
        foreach ($detail_kdpar as $key => $value) {
            $table->addRow();
            $table->addCell(12000, ['bgColor' => 'CCCCCC', 'gridSpan' => 4])->addText("-- " . $value->nm_kategori_parameter . " --", ['bold' => true], ['align' => 'left']);
            foreach ($res_par[$value->kd_kategori_parameter] as $val) {
                $bold = str_replace("|", "\n", $val->nilai);
                if ($val->nilai_min != '0.00' && $val->nilai_max != '0.00') {
                    if ((int)$val->nilai < $val->nilai_min || (int)$val->nilai > $val->nilai_max) {
                        $bold = $val->nilai;
                    } else {
                        $bold = "<strong><u>" . $val->nilai . "</u></strong>";
                    }
                }
                $table->addRow();
                $table->addCell(3000)->addText($val->nm_parameter);
                $table->addCell(3000)->addText($val->ket);
                $table->addCell(3000)->addText($bold);
                $table->addCell(3000)->addText($val->kadar);
                $table->addCell(3000)->addText($val->hasil_analisa);
            }
        }
        // Add note and signature
        $section->addText($note->keterangan);
        $section->addText($note->catatan);
        $section->addText("Tangerang, " . tgl_print(dbnow()));
        $section->addText("Mengetahui,");
        $section->addText(($ttn == "kalab") ? $ttd_kepala->jabatan : $ttd_tu->jabatan);
        $section->addText("Dinas Kesehatan Kota Tangerang");
        $section->addText("\n\n\n");
        $section->addText("<u>" . (($ttn == "kalab") ? $ttd_kepala->nama : $ttd_tu->nama) . "</u>");
        $section->addText("NIP. " . (($ttn == "kalab") ? $ttd_kepala->nip : $ttd_tu->nip));
    }
    // Set headers for file download
    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename="' . str_replace("/", "", $header->no_pendaftaran) . '.docx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    $writer = IOFactory::createWriter($phpWord, 'Word2007');
    $writer->save('php://output');
    exit();
}
function hasil_maknum_word_versi1($header, $detail, $detail_kdpar, $note, $type_surat, $type_laporan, $header_cetak, $agreditasi, $ttn, $ttd_kepala, $ttd_tu, $napsa, $ttl, $ttd_teknis, $ttd_koor) {
    $phpWord = new PhpWord();
    $section = $phpWord->addSection();
    // Headers
    if ($header_cetak == 'Ya') {
            $table = $section->addTable();
            $table->addRow();
            $cell1 = $table->addCell(2000, ['alignment' => 'center']);
        if ($header_cetak == 'Ya') {
            $cell1->addImage('assets/image/542px-Lambang_Kota_Tangerang.png', ['width' => 75, 'height' => 75, 'alignment' => 'center']);
        }
        // Baris pertama, kolom kedua untuk teks
        $cell2 = $table->addCell(6000, ['alignment' => 'center']);
        $cell2->addText('PEMERINTAH KOTA TANGERANG', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
        $cell2->addText('DINAS KESEHATAN', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
        $cell2->addText('UPT LABORATORIUM KESEHATAN DAERAH', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
        $cell2->addText('JL. TMP Taruna Suka Asih Telp/Fax : 021 - 5588737 Kota Tangerang 15111', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
        $cell2->addText('Email : labkeskota.tangerang@gmail.com', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
        // Baris pertama, kolom ketiga untuk logo agreditasi
        $cell3 = $table->addCell(2000, ['alignment' => 'center']);
        if ($agreditasi == 'kan') {
            $cell3->addImage('assets/image/kan-logo-D754581922-seeklogo.com.png', ['width' => 100, 'height' => 75, 'alignment' => 'center']);
        } elseif ($agreditasi == 'kalk') {
            $cell3->addImage('assets/image/logo-KALK.jpg', ['width' => 175, 'height' => 125, 'alignment' => 'center']);
        } elseif ($agreditasi == 'kankalk') {
            $cell3->addImage('assets/image/kan-logo-D754581922-seeklogo.com.png', ['width' => 100, 'height' => 75, 'alignment' => 'center']);
            $cell3->addImage('assets/image/logo-KALK.jpg', ['width' => 100, 'height' => 75, 'alignment' => 'center']);
        }
            $section->addTextBreak();
            $section->addTextBreak();
    }
    // No. Lab, Sifat, Perihal
    $table = $section->addTable();
    $table->addRow();
    $table->addCell(2000)->addText('No. Lab');
    $table->addCell(4000)->addText(': ' . $header->no_pendaftaran);
    $table->addCell(4000)->addText('Tangerang, ' . tgl_print(dbnow()), ['alignment' => 'right']);
    $table->addRow();
    $table->addCell(2000)->addText('Sifat');
    $table->addCell(4000)->addText(': Rahasia');
    $table->addCell(4000)->addText('', ['alignment' => 'right']);
    $table->addRow();
    $table->addCell(2000)->addText('Perihal');
    $table->addCell(4000)->addText(': Hasil Pemeriksaan Laboratorium');
    $table->addCell(4000)->addText('', ['alignment' => 'right']);
    // Address Section
    $section->addTextBreak(2);
    $section->addText('Kepada Yth,');
    $section->addText('Bapak / Ibu ' . strtoupper($header->nama));
    $section->addText(ucfirst($header->alamat));
    $section->addTextBreak(2);
    $section->addText('Bersama ini kami sampaikan hasil pemeriksaan Sampel ' . $header->nm_sampel . ' pada Laboratorium Lingkungan. Atas perhatian dan kerjasamanya, kami sampaikan terimakasih.', null, ['alignment' => 'justify']);
    // Signatures
    $section->addTextBreak(2);
    $table = $section->addTable();
$table->addRow();
$leftCell = $table->addCell(5000); // Kolom kiri, dibiarkan kosong
$rightCell = $table->addCell(5000, array('valign' => 'center')); // Kolom kanan, diisi dengan teks
$cellHCentered = array('align' => 'center');
$cellVCentered = array('valign' => 'center');
$rightCell->addText('Mengetahui,', null, $cellHCentered);
$rightCell->addText(($ttn == "kalab") ? $ttd_kepala->jabatan : $ttd_tu->jabatan, null, $cellHCentered);
$rightCell->addText('Dinas Kesehatan Kota Tangerang', null, $cellHCentered);
$rightCell->addTextBreak(2);
$rightCell->addText('<u>' . (($ttn == "kalab") ? $ttd_kepala->nama : $ttd_tu->nama) . '</u>', null, $cellHCentered);
$rightCell->addText('NIP. ' . (($ttn == "kalab") ? $ttd_kepala->nip : $ttd_tu->nip), null, $cellHCentered);
    // Report Details
    if ($type_laporan == 'laporan') {
        $section->addPageBreak();
            if ($header_cetak == 'Ya') {
                $table = $section->addTable();
                $table->addRow();
                $cell1 = $table->addCell(2000, ['alignment' => 'center']);
            if ($header_cetak == 'Ya') {
                $cell1->addImage('assets/image/542px-Lambang_Kota_Tangerang.png', ['width' => 75, 'height' => 75, 'alignment' => 'center']);
            }
            // Baris pertama, kolom kedua untuk teks
            $cell2 = $table->addCell(6000, ['alignment' => 'center']);
            $cell2->addText('PEMERINTAH KOTA TANGERANG', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
            $cell2->addText('DINAS KESEHATAN', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
            $cell2->addText('UPT LABORATORIUM KESEHATAN DAERAH', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
            $cell2->addText('JL. TMP Taruna Suka Asih Telp/Fax : 021 - 5588737 Kota Tangerang 15111', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
            $cell2->addText('Email : labkeskota.tangerang@gmail.com', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
            // Baris pertama, kolom ketiga untuk logo agreditasi
            $cell3 = $table->addCell(2000, ['alignment' => 'center']);
            if ($agreditasi == 'kan') {
                $cell3->addImage('assets/image/kan-logo-D754581922-seeklogo.com.png', ['width' => 100, 'height' => 75, 'alignment' => 'center']);
            } elseif ($agreditasi == 'kalk') {
                $cell3->addImage('assets/image/logo-KALK.jpg', ['width' => 175, 'height' => 125, 'alignment' => 'center']);
            } elseif ($agreditasi == 'kankalk') {
                $cell3->addImage('assets/image/kan-logo-D754581922-seeklogo.com.png', ['width' => 100, 'height' => 75, 'alignment' => 'center']);
                $cell3->addImage('assets/image/logo-KALK.jpg', ['width' => 100, 'height' => 75, 'alignment' => 'center']);
            }
            $section->addTextBreak();
            $section->addTextBreak();
        }
        $section->addText('Laporan Hasil Uji Lab Lingkungan', ['bold' => true, 'size' => 13], ['alignment' => 'center']);
        $section->addText('NOMOR : ' . $header->no_pendaftaran, ['bold' => true, 'size' => 13], ['alignment' => 'center']);
        // Sample Information
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(3000)->addText('Nama Pelanggan');
        $table->addCell(9000)->addText(': ' . strtoupper($header->nama));
        $table->addRow();
        $table->addCell(3000)->addText('No. Lab');
        $table->addCell(9000)->addText(': ' . $header->no_pendaftaran);
        $table->addRow();
        $table->addCell(3000)->addText('Jenis Sampel');
        $table->addCell(9000)->addText(': ' . $header->nm_sampel);
        $table->addRow();
        $table->addCell(3000)->addText('Jenis Analisa');
        $table->addCell(9000)->addText(': ' . $header->jns_analisa);
        $table->addRow();
        $table->addCell(3000)->addText('Keterangan / Kondisi Sampel');
        $table->addCell(9000)->addText(': ' . $header->ket_sampel . '/' . $header->kondisi);
        $table->addRow();
        $table->addCell(3000)->addText('Lokasi Pengambilan Sampel');
        $table->addCell(9000)->addText(': ' . $header->lokasi);
        $table->addRow();
        $table->addCell(3000)->addText('Tanggal Penerimaan');
        $table->addCell(9000)->addText(': ' . tgl_singkat($header->tgl_diterima));
        // Analysis Results
        $section->addTextBreak(2);
        if ($napsa == 'ya') {
            $section->addText('Berdasarkan pemeriksaan saat ini, hasil untuk URINE SCREENING TEST, adalah sebagai berikut : ');
        }
        $section->addTextBreak();
        $table = $section->addTable(['borderSize' => 1, 'borderColor' => 'black']);
        $table->addRow();
         // Menambahkan tabel dengan hasil pemeriksaan
    $table = $section->addTable(['borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 50]);
    $table->addRow();
    $table->addCell(1500, ['bgColor' => 'adadad'])->addText('Jenis Pemeriksaan', ['bold' => true], ['alignment' => 'center']);
    $table->addCell(1500, ['bgColor' => 'adadad'])->addText('Hasil', ['bold' => true], ['alignment' => 'center']);
    $table->addCell(1500, ['bgColor' => 'adadad'])->addText('Nilai Rujukan', ['bold' => true], ['alignment' => 'center']);
    $table->addCell(1000, ['bgColor' => 'adadad'])->addText('Satuan', ['bold' => true], ['alignment' => 'center']);
    $table->addCell(3500, ['bgColor' => 'adadad'])->addText('Metode Uji', ['bold' => true], ['alignment' => 'center']);
    // pre($detail_kdpar);exit();
        $res_par = [];
        foreach ($detail as $key => $val1) {
            $res_par[$val1->kd_kategori_parameter][] = $val1;
        }
        $total = 0;
        foreach ($detail_kdpar as $key => $value) {
            // pre($value);exit();
            $nm_kategori_parameter = $value->nm_kategori_parameter;
            $table->addRow();
            $table->addCell(8000, ['gridSpan' => 5, 'bgColor' => 'adadad'])->addText("-- $nm_kategori_parameter --", ['bold' => true]);
            // goto akhir;
            foreach ($res_par[$value->kd_kategori_parameter] as $key => $val) {
                $total += $val->harga;
                $bold = $val->nilai;
                if ($val->nilai_min != '0.00' && $val->nilai_max != '0.00') {
                    if ((int)$val->nilai < $val->nilai_min || (int)$val->nilai > $val->nilai_max) {
                        $bold = replaceSymbolKadar(  $val->nilai );
                    }
                }
                // $table->addRow();
                // $table->addCell()->addText($val->nm_parameter);
                // $table->addCell(null, ['alignment' => 'center'])->addText("$bold - $val->nilai_min - $val->nilai_max");
                // $table->addCell(null, ['alignment' => 'center'])->addText($val->kadar);
                // $table->addCell(null, ['alignment' => 'center'])->addText($val->satuan);
                // $table->addCell(null, ['alignment' => 'center'])->addText($val->hasil_analisa);
            }
        }
        // pre($note);exit();
        $keterangan =  $note->keterangan;
  // Note
  if($header->sampel_ket!=''){
    $keterangan = $header->sampel_ket;
  }else{
    $keterangan = $note->keterangan;
  }
        $section->addTextBreak(2);
//         $table = $section->addTable();
//         $table->addRow();
// Html::addHtml($table->addCell(5000),  ($note->keterangan)  );
// $table->addCell(4000);
// $table->addRow();
// Html::addHtml($table->addCell(5000),   ($note->catatan)  );
if ($napsa =='ya')
{
$html = $note->keterangan2 ;
// Html::addHtml($section, $html);
$htmlex= explode("#",$html);
// pre($note);
// pre($html);
//  pre($htmlex);exit();
if (count($htmlex) > 1) {
//  $textrun = $section->addTextRun();
 $section->addText(escapeHtml($htmlex[0]) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
//  $section->addTextBreak();
    array_shift($htmlex);
            foreach ($htmlex as $ket) {
                if ($ket == "") {
                    continue;
                }
                // pre($ket);
                 $section->addText( escapeHtml($ket) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
                //   $section->addTextBreak();
            }
}
}else{
}
// exit();
// goto cetak;
$html = $note->catatan2 ;
$htmlex= explode("#",$html);
// pre($htmlex);exit();
if (count($htmlex) > 1) {
//  $textrun = $section->addTextRun();
 $section->addText(escapeHtml($htmlex[0]) , WordHasilBodyStyle::getBodycatatan(), ['alignment' => 'left' ,'spaceAfter' => 0]);
//  $section->addTextBreak();
    array_shift($htmlex);
            foreach ($htmlex as $ket) {
                if ($ket == "") {
                    continue;
                }
                 $section->addText( escapeHtml($ket) , WordHasilBodyStyle::getBodycatatan(), ['alignment' => 'left' ,'spaceAfter' => 0]);
                //   $section->addTextBreak();
            }
}
$table = $section->addTable();
    $table->addRow();
    $leftCell = $table->addCell(5000); // Kolom kiri, dibiarkan kosong
    $rightCell = $table->addCell(5000, array('valign' => 'center')); // Kolom kanan, diisi dengan teks
    $cellHCentered = array('align' => 'center');
    $cellVCentered = array('valign' => 'center');
    $rightCell->addText('Tangerang, ' . tgl_print(dbnow()), null, $cellHCentered);
    $rightCell->addText('Mengetahui,', null, $cellHCentered);
    $rightCell->addText( ($ttl=='matek')? $ttd_teknis->jabatan:$ttd_koor->jabatan , null, $cellHCentered);
    $rightCell->addTextBreak(2);
    $rightCell->addText($ttl == 'matek' ? $ttd_teknis->nama : $ttd_koor->nama, ['underline' => 'single', 'size' => 12], ['alignment' => 'center']);
    $rightCell->addText('NIP. ' . (($ttl=='matek')? $ttd_teknis->nip:$ttd_koor->nip), null, $cellHCentered);
    }
    // echo $ttd_teknis->nama; 
    // echo $ttl=='matek' ? 'true':'false';
    // exit();
    // Save Document
    // $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    // $fileName = 'Laporan_Laboratorium_' . $header->no_pendaftaran . '.docx';
    // $objWriter->save($fileName);
    // return $fileName;
    akhir:
    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename="' . str_replace("/", "", $header->no_pendaftaran) . '.docx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save('php://output');
    exit();
} 
?>
