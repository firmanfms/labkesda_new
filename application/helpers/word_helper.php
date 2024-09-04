<?php
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Table;
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Paragraph;
use PhpOffice\PhpWord\Shared\Html;
function replaceSymbolKadar($symbol)
{
    $nilai = "";
    $symbol_replacements = [
        '&lt;' => '<',
        '&le;' => '≤',
        '&gt;' => '>',
        '&ge;' => '≥',
    ];
    $nilai = str_replace(array_keys($symbol_replacements), array_values($symbol_replacements), $nilai);
    return $nilai;
}
function escapeHtml($text) {
    return  htmlspecialchars($text, ENT_QUOTES | ENT_XML1 , 'UTF-8') ;
}
//Fungsi untuk mengatur KOP Surat (Header)
function createHeader($section, $header_cetak, $agreditasi) {
    $header1 = $section->createHeader();
    $headerTable = $header1->addTable();
    // Baris pertama, kolom pertama untuk logo
    $headerTable->addRow();
    if ($header_cetak == 'Ya') {
        $cell1 = $headerTable->addCell(1500, ['alignment' => 'center']);
        $cell1->addImage('assets/image/542px-Lambang_Kota_Tangerang.png', ['width' => 70, 'height' => 75, 'alignment' => 'center']);
        // Baris pertama, kolom kedua untuk teks
        $cell2 = $headerTable->addCell(7000, ['alignment' => 'center']);
        $cell2->addText('PEMERINTAH KOTA TANGERANG',  WordHeaderStyle::getHeaderBaris1()  , ['alignment' => 'center', 'spaceAfter' => 0]);
        $cell2->addText('DINAS KESEHATAN', WordHeaderStyle::getHeaderBaris2()  , ['alignment' => 'center', 'spaceAfter' => 0]);
        $cell2->addText('UPT LABORATORIUM KESEHATAN DAERAH',  WordHeaderStyle::getHeaderBaris2() , ['alignment' => 'center', 'spaceAfter' => 0]);
        $cell2->addText('Jl. TMP Taruna, Kel. Sukaasih  – Tangerang Telp. 021 - 5588737  Kota Tangerang, 15111', ['bold' => false, 'size' => 7], ['alignment' => 'center', 'spaceAfter' => 0]);
        $cell2->addText('Telp/Fax : 021-5588737 e-mail : labkeskota.tangerang@gmail.com', WordHeaderStyle::getHeaderBaris3(), ['alignment' => 'center', 'spaceAfter' => 0]);
        // Baris pertama, kolom ketiga untuk logo agreditasi
        $cell3 = $headerTable->addCell(1500, ['alignment' => 'center']);
          $cell3->addImage('assets/image/labkesda.png', ['width' => 80, 'height' => 80, 'alignment' => 'center', 'crop' => true]);
        $headerTable->addRow();
        $headerTable->addCell(9000, ['gridSpan' => 3, 'borderTopSize' => 12, 'borderTopColor' => '000000', 'borderTopStyle' => 'double', 'vMerge' => 'restart']);
    }
    else{
        $cell1 = $headerTable->addCell(1500, ['alignment' => 'center']);
        $cell1->addText(' ', WordHeaderStyle::getHeaderBaris1(), ['alignment' => 'center', 'spaceAfter' => 0]);
        // $cell1->addImage('assets/image/542px-Lambang_Kota_Tangerang.png', ['width' => 70, 'height' => 75, 'alignment' => 'center']);
        // Baris pertama, kolom kedua untuk teks
        $cell2 = $headerTable->addCell(7000, ['alignment' => 'center']);
        $cell2->addText(' ', WordHeaderStyle::getHeaderBaris1(), ['alignment' => 'center', 'spaceAfter' => 0]);
        $cell2->addText(' ',WordHeaderStyle::getHeaderBaris2(), ['alignment' => 'center', 'spaceAfter' => 0]);
        $cell2->addText(' ', WordHeaderStyle::getHeaderBaris2(), ['alignment' => 'center', 'spaceAfter' => 0]);
        $cell2->addText(' ', WordHeaderStyle::getHeaderBaris3(), ['alignment' => 'center', 'spaceAfter' => 0]);
        $cell2->addText(' ', WordHeaderStyle::getHeaderBaris3(), ['alignment' => 'center', 'spaceAfter' => 0]);
        // Baris pertama, kolom ketiga untuk logo agreditasi
        $cell3 = $headerTable->addCell(1500, ['alignment' => 'center']);
        $cell3->addText(' ', WordHeaderStyle::getHeaderBaris1(), ['alignment' => 'center', 'spaceAfter' => 0]);
        //   $cell3->addImage('assets/image/labkesda.png', ['width' => 80, 'height' => 80, 'alignment' => 'center', 'crop' => true]);
        $headerTable->addRow();
         $headerTable->addCell(9000)->addText(' ', WordHeaderStyle::getHeaderBaris1(), ['alignment' => 'center', 'spaceAfter' => 0]);
          $headerTable->addRow();
         $headerTable->addCell(9000)->addText(' ', WordHeaderStyle::getHeaderBaris1(), ['alignment' => 'center', 'spaceAfter' => 0]);
          $headerTable->addRow();
         $headerTable->addCell(9000)->addText(' ', WordHeaderStyle::getHeaderBaris1(), ['alignment' => 'center', 'spaceAfter' => 0]);
        // $headerTable->addCell(9000, ['gridSpan' => 3, 'borderTopSize' => 12, 'borderTopColor' => '000000', 'borderTopStyle' => 'double', 'vMerge' => 'restart']);
    }
    return $headerTable;
}
//Fungsi untuk mengatur Footer dan logo di footer
function createFooter($section,$header_cetak ,  $agreditasi) {
    $footerTable = $section->addFooter()->addTable();
    if ($header_cetak == 'Ya') {
     $footerTable->addRow();
    $footerTable->addCell(3000);
    $footerTable->addCell(7000, ['valign' => 'center' ,  'alignment' => 'right'])->addText('FSOP.LKT-15.1', WordFooterStyle::getFooter(), ['alignment' => 'right']);
    $footerTable->addRow();
    $footerTable->addCell(2000);
    $footerCell = $footerTable->addCell(2000, ['alignment' => 'right']);
    if ($agreditasi == 'kan' || $agreditasi == 'kalk') {
        $footerCell->addImage('assets/image/kanfooter.png', ['width' => 50, 'height' => 40, 'alignment' => 'right']);
        //    $footerCell->addText('Laboratorium Penguji', ['bold' => true, 'size' => 9], ['alignment' => 'center']);
        //    $footerCell->addText('LP-1234-DN', ['bold' => true, 'size' => 9], ['alignment' => 'center']);
    }
    // $footerTable->addCell(6000, ['valign' => 'center'])->addText('      Terakreditasi Kemenkes RI No. YM.02.01/D/3995/2024', WordFooterStyle::getFooter(), ['alignment' => 'left']);
    $footerTable->addCell(6000, ['valign' => 'center'])->addText('', WordFooterStyle::getFooter(), ['alignment' => 'left']);
    }
     return $footerTable;
}
function createFooterSelainKlinik($section,$header_cetak ,  $agreditasi) {
    $footerTable = $section->addFooter()->addTable();
    if ($header_cetak == 'Ya') {
    $footerTable->addRow();
    $footerTable->addCell(3000);
    $footerTable->addCell(7000, ['valign' => 'center' ,  'alignment' => 'right'])->addText('FSOP.LKT-15.1', WordFooterStyle::getFooter(), ['alignment' => 'right']);
    $footerTable->addRow();
    // $footerTable->addCell(2000);
    $footerCell = $footerTable->addCell(2000, ['alignment' => 'center']);
    if ($agreditasi == 'kan' || $agreditasi == 'kalk') {
        // $footerCell->addPreserveText('Footer Halaman 1', WordFooterStyle::getFooter(), ['alignment' => 'right']);
       $footerCell->addImage('assets/image/kanfooter.png', ['width' => 50, 'height' => 40, 'alignment' => 'right']);
    }
    $footerTable->addCell(7000, ['valign' => 'center' ,  'alignment' => 'left'])->addText('      Terakreditasi Kemenkes RI No. YM.02.01/D/3995/2024', WordFooterStyle::getFooter(), ['alignment' => 'left']);
    // $footerTable->addCell(7000, ['valign' => 'center' ,  'alignment' => 'left'])->addText('', WordFooterStyle::getFooter(), ['alignment' => 'left']);
}
    return $footerTable;
}
function createFooterHal1($section,$header_cetak ,  $agreditasi) {
    $footerTable = $section->addFooter()->addTable();
    if ($header_cetak == 'Ya') {
    $footerTable->addRow();
    $footerTable->addCell(3000);
    $footerTable->addCell(7000, ['valign' => 'center' ,  'alignment' => 'right'])->addText('FSOP.LKT-15.1', WordFooterStyle::getFooter(), ['alignment' => 'right']);
    $footerTable->addRow();
    // $footerTable->addCell(2000);
    $footerCell = $footerTable->addCell(10000, ['alignment' => 'center']);
    if ($agreditasi == 'kan' || $agreditasi == 'kalk') {
        // $footerCell->addPreserveText('Footer Halaman 1', WordFooterStyle::getFooter(), ['alignment' => 'right']);
       $footerCell->addImage('assets/image/kanfooter.png', ['width' => 50, 'height' => 40, 'alignment' => 'right']);
    }
    // $footerTable->addCell(7000, ['valign' => 'center' ,  'alignment' => 'left'])->addText('      Terakreditasi Kemenkes RI No. YM.02.01/D/3995/2024', WordFooterStyle::getFooter(), ['alignment' => 'left']);
    $footerTable->addCell(7000, ['valign' => 'center' ,  'alignment' => 'left'])->addText('', WordFooterStyle::getFooter(), ['alignment' => 'left']);
}
    return $footerTable;
}
function createFooterHal2($section,$header_cetak , $agreditasi) {
    $footerTable = $section->addFooter()->addTable();
    if ($header_cetak == 'Ya') {
    $footerTable->addRow();
    $footerTable->addCell(3000);
    $footerTable->addCell(7000, ['valign' => 'center' ,  'alignment' => 'right'])->addText('FSOP.LKT-15.1', WordFooterStyle::getFooter(), ['alignment' => 'right']);
    $footerTable->addRow();
    $footerCell = $footerTable->addCell(3000, ['alignment' => 'right']);
    if ( $agreditasi == 'kalk') {
        $footerCell->addText(' ', ['bold' => false, 'size' => 12, 'name' => 'Arial'], ['alignment' => 'center', 'spaceAfter' => 0]);
        // $footerCell->addPreserveText('Footer Halaman 2', WordFooterStyle::getFooter(), ['alignment' => 'right']);
        // $footerCell->addImage('assets/image/footer_halaman2.png', ['width' => 50, 'height' => 40, 'alignment' => 'right']);
    }
//    $footerTable->addCell(7000, ['valign' => 'center' ,  'alignment' => 'left'])->addText('      Terakreditasi Kemenkes RI No. YM.02.01/D/3995/2024', WordFooterStyle::getFooter(), ['alignment' => 'left']);
   $footerTable->addCell(7000, ['valign' => 'center' ,  'alignment' => 'left'])->addText('', WordFooterStyle::getFooter(), ['alignment' => 'left']);
    }
    return $footerTable;
}
function generateWordDocumentKlinik2($header, $detail, $detail_kdpar, $ttd_kepala, $ttd_tu, $ttd_teknis, $ttd_koor, $type_surat, $type_laporan, $header_cetak, $agreditasi, $napsa, $note, $ttl, $ttn) {
    // pre($header);exit();
    // echo convertHtmlToPlainText($note->keterangan);
    // echo convertHtmlToPlainText($note->catatan);
    // exit();
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
    // $section = $phpWord->addSection(array('paperSize' => 'Legal', 'marginLeft' => 200, 'marginRight' => 200, 'marginTop' => 200, 'marginBottom' => 200));
    $section = $phpWord->addSection(array('paperSize' => 'Legal'));
    // Mengelompokkan hasil parameter berdasarkan kategori
    $res_par = array();
    foreach ($detail as $val1) {
        $res_par[$val1->kd_kategori_parameter][] = $val1;
    }
    $header1 =  createHeader($section, $header_cetak, $agreditasi);
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
				$section->addText('Bersama ini kami sampaikan hasil pemeriksaan pada Laboratorium Klinik. Atas perhatian dan kerjasamanya, kami sampaikan terimakasih.', WordSuratBodyStyle::getBody(), ['alignment' => 'both']);
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
				$table->addCell(4500)->addText(($ttn == "kalab") ? escapeHtml($ttd_kepala->nama) : escapeHtml($ttd_tu->nama),WordSuratBodyStyle::getBodyUnderline() , ['alignment' => 'center', 'underline' => 'single']);
				$table->addRow();
				$table->addCell(5000);
				$table->addCell(4500)->addText('NIP. ' . (($ttn == "kalab") ? escapeHtml($ttd_kepala->nip) : escapeHtml($ttd_tu->nip)), WordSuratBodyStyle::getBody(), ['alignment' => 'center']);
				// $section->addTextBreak(2);
				// $section->addText('FSOP.LKT-15.1', WordSuratBodyStyle::getBody(), ['alignment' => 'right']);
            // $headerTable = $section->addHeader()->addTable();
        $footer1 = createFooterHal1 ($section, $header_cetak ,  $agreditasi);
    }
      if($type_laporan=='laporan'){
        if($type_surat=='surat'){
              $section->addPageBreak();
        }
    $section = $phpWord->addSection(array('paperSize' => 'Legal'));
            // <strong style="font-size: 16px;">Laporan Hasil Uji Lab Klinik</strong>
            $section->addText("Laporan Hasil Uji Lab Klinik", WordHasilBodyStyle::getBodyBold() , ['alignment' => 'center']);
            $section->addText("NOMOR : " . $header->no_pendaftaran, WordHasilBodyStyle::getBodyBold() , ['alignment' => 'center']);
             $table = $section->addTable();
            $table->addRow();
            $table->addCell(2000)->addText('No. Lab', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
            $table->addCell(3000)->addText(': ' . escapeHtml($header->no_pendaftaran), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
            $table->addCell(2000)->addText('Dokter', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
            $table->addCell(3000)->addText(': ' . escapeHtml($header->dokter), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(2000)->addText('Nama Pasien', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml(strtoupper($header->nama)), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(2000)->addText('Waktu Pengambilan Spesimen', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml(tgl_singkat_waktu($header->tgl_spesimen)), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(2000)->addText('Tanggal Lahir', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml(tgl_singkat($header->tgl_lahir)), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(2000)->addText('Jenis Kelamin', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . (($header->jns_kelamin == 'W') ? 'Wanita' : 'Pria'), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(2000)->addText('Umur', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . $umur . ' Tahun ' . $month . ' Bulan ' . $day . ' Hari', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(2000)->addText('Keterangan', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml($header->keterangan), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addRow();
        $table->addCell(2000)->addText('Alamat', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml(($header->alamat)), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        /*$table->addRow();
        $table->addCell(2000)->addText('Kondisi', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
        $table->addCell(3000)->addText(': ' . escapeHtml($header->kondisi), WordHasilBodyStyle::getBody() , ['alignment' => 'left']);*/
        $table->addCell(2000);
        $table->addCell(3000);
        $section->addText(($napsa == 'ya') ? 'Berdasarkan pemeriksaan saat ini, hasil untuk URINE SCREENING TEST, adalah sebagai berikut :' : '', WordHasilBodyStyle::getBody() , ['alignment' => 'left']);
    $section->addTextBreak();
    $table = $section->addTable(['borderSize' => 6, 'borderColor' => 'black', 'cellMargin' => 50]);
    $table->addRow();
    $table->addCell(2000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Jenis Pemeriksaan', WordHasilTableStyle::getNormalBold(), ['alignment' => 'center','spaceAfter' => 0]);
    $table->addCell(1500, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Hasil', WordHasilTableStyle::getNormalBold(), ['alignment' => 'center','spaceAfter' => 0]);
    $table->addCell(2000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Nilai Rujukan', WordHasilTableStyle::getNormalBold(), ['alignment' => 'center','spaceAfter' => 0]);
    $table->addCell(1500, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Satuan', WordHasilTableStyle::getNormalBold(), ['alignment' => 'center','spaceAfter' => 0]);
    $table->addCell(2000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Metode Uji', WordHasilTableStyle::getNormalBold(), ['alignment' => 'center','spaceAfter' => 0]);
    foreach ($detail_kdpar as $key => $value) {
        $nm_kategori_parameter = $value->nm_kategori_parameter;
        $table->addRow();
        $table->addCell(9000, ['gridSpan' => 5, 'bgColor' => 'adadad', 'valign' => 'center'])->addText('-- ' . $nm_kategori_parameter . ' --', WordHasilTableStyle::getNormalBold(), ['alignment' => 'left']);
        foreach ($res_par[$value->kd_kategori_parameter] as $key => $value) {
            $bold = $value->nilai;
            $nilai_min = $value->nilai_min;
            $nilai_max = $value->nilai_max;
            if ($value->nilai_min != '0.00' && $value->nilai_max != '0.00') {
                if ($value->nilai < $nilai_min || $value->nilai > $nilai_max) {
                    $bold = "<strong><u>" . $value->nilai . "</u></strong>";
                } else {
                    $bold = $value->nilai;
                }
            }
            $table->addRow();
            $table->addCell(2000)->addText($value->nm_parameter, WordHasilTableStyle::getNormal(), ['alignment' => 'left' , 'spaceAfter' => 0 ]);
            $table->addCell(1500, ['valign' => 'center'])->addText(escapeHtml($bold), WordHasilTableStyle::getNormal(), ['alignment' => 'center' , 'spaceAfter' => 0]);
            $table->addCell(2000, ['valign' => 'center'])->addText(escapeHtml($value->kadar2), WordHasilTableStyle::getNormal(), ['alignment' => 'center' , 'spaceAfter' => 0]);
            $table->addCell(1500, ['valign' => 'center'])->addText(escapeHtml($value->satuan), WordHasilTableStyle::getNormal(), ['alignment' => 'center' , 'spaceAfter' => 0]);
            $table->addCell(2000, ['valign' => 'center'])->addText(escapeHtml($value->hasil_analisa), WordHasilTableStyle::getNormal(), ['alignment' => 'center' , 'spaceAfter' => 0]);
        }
    }
 $section->addTextBreak();
$table2 = $section->addTable();
$table2->addRow();
$table2->addCell(5000)->addText('',  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]); 
$table2->addCell(4000)->addText('Tangerang, ' . tgl_print(dbnow()),  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]);
// $table2->addCell(4000);
// $table2->addRow();
// $table2->addCell(5000);
// $table2->addCell(4000)->addText('',  WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
// $table2->addCell(2000);
$table2->addRow();
$table2->addCell(5000)->addText('',  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]);
$table2->addCell(4000)->addText('Mengetahui,',  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]);
$table2->addRow();
$table2->addCell(5000)->addText('',  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]);
$table2->addCell(4000)->addText(($ttl == 'matek') ? $ttd_teknis->jabatan : $ttd_koor->jabatan,  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]);
$table2->addRow();
$table2->addCell(5000);
$table2->addCell(4000)->addText('',  WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
$table2->addRow();
$table2->addCell(5000);
$table2->addRow();
$table2->addCell(5000);
$table2->addCell(4000)->addText('' . (($ttl == 'matek') ? $ttd_teknis->nama : $ttd_koor->nama) . '', WordHasilBodyStyle::getBodyUnderline(), ['alignment' => 'center', 'underline' => 'single']);
$table2->addRow();
$table2->addCell(5000);
$table2->addCell(4000)->addText('NIP. ' . (($ttl == 'matek') ? $ttd_teknis->nip : $ttd_koor->nip),  WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
//$table2->addRow();
$section->addTextBreak();
$table3 = $section->addTable();
$table3->addRow();
// $table2->addCell(5000)->addText(($napsa == 'ya') ? convertHtmlToPlainText($note->keterangan) : '',  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
// Html::addHtml($table3->addCell(5000), ($napsa == 'ya') ?  ($note->keterangan) : '' );
if ($napsa =='ya')
{
$html = $note->keterangan2 ;
// Html::addHtml($section, $html);
$htmlex= explode("#",$html);
if (count($htmlex) > 1) {
//  $textrun = $section->addTextRun();
 $section->addText(escapeHtml($htmlex[0]) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
//  $section->addTextBreak();
    array_shift($htmlex);
            foreach ($htmlex as $ket) {
                if ($ket == "") {
                    continue;
                }
                 $section->addText( escapeHtml($ket) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
                //   $section->addTextBreak();
            }
}
}else{
}
// convertHtmlToPhpWord($table2->addCell(2000), ($napsa == 'ya') ?  ($note->keterangan) : '');
$table3->addCell(4000);
// $table2->addCell(2000);
// $table2->addCell(4000);
$table3->addRow();
// $table2->addCell(5000)->addText(convertHtmlToPlainText($note->catatan),  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
// Html::addHtml($table3->addCell(5000),   ($note->catatan)  );
$html = $note->catatan2 ;
// Html::addHtml($section, $html);
$htmlex= explode("#",$html);
if (count($htmlex) > 1) {
//  $textrun = $section->addTextRun();
 $section->addText(escapeHtml($htmlex[0]) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
//  $section->addTextBreak();
    array_shift($htmlex);
            foreach ($htmlex as $ket) {
                if ($ket == "") {
                    continue;
                }
                 $section->addText( escapeHtml($ket) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
                //   $section->addTextBreak();
            }
} 
// convertHtmlToPhpWord($table2->addCell(2000),  ($note->catatan));
$table3->addCell(4000);
// $table2->addCell(2000);
// $table2->addCell(4000);
$table3->addRow();
$table3->addCell(5000);
// $table3->addCell(4000)->addText('FSOP.LKT-15.1',  WordHasilBodyStyle::getBody(), ['alignment' => 'right']);
if ( $agreditasi == 'kalk') { 
createFooterHal2($section,$header_cetak   ,  $agreditasi);
}
}
   header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
   header('Content-Disposition: attachment; filename="' . str_replace("/", "", $header->no_pendaftaran) . '.docx"');
   // header('Content-Type: application/octet-stream');
   $writer = IOFactory::createWriter($phpWord, 'Word2007');
   $writer->save('php://output');
   exit();
}
// Fungsi untuk menghasilkan dokumen Word
function generateWordDocumentKlinik($header, $detail, $detail_kdpar, $ttd_kepala, $ttd_tu, $ttd_teknis, $ttd_koor, $type_surat, $type_laporan, $header_cetak, $agreditasi, $napsa, $note, $ttl, $ttn) {
    $phpWord = new PhpWord();
    $section = $phpWord->addSection();
    // Mengelompokkan hasil parameter berdasarkan kategori
    $res_par = array();
    foreach ($detail as $val1) {
        $res_par[$val1->kd_kategori_parameter][] = $val1;
    }
    $section->addTextBreak();
    $table = $section->addTable();
    // Baris pertama, kolom pertama untuk logo
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
    $section->addText('Laporan Hasil Uji Lab Klinik', ['bold' => true, 'size' => 16], ['alignment' => 'center']);
    $section->addText('NOMOR : ' . $header->no_pendaftaran, ['bold' => true, 'size' => 12], ['alignment' => 'center']);
    $section->addTextBreak();
    // Menambahkan tabel dengan detail informasi pasien
    $table = $section->addTable();
    $table->addRow();
    $table->addCell(2000)->addText('No. Lab');
    $table->addCell(3000)->addText(': ' . $header->no_pendaftaran);
    $table->addCell(3000)->addText('Dokter');
    $table->addCell(2000)->addText(': ' . $header->dokter);
    $table->addRow();
    $table->addCell(2000)->addText('Nama Pasien');
    $table->addCell(3000)->addText(': ' . strtoupper($header->nama));
    $table->addCell(3000)->addText('Waktu Pengambilan Spesimen');
    $table->addCell(2000)->addText(': ' . tgl_singkat_waktu($header->tgl_spesimen));
    $table->addRow();
    $table->addCell(2000)->addText('Tanggal Lahir');
    $table->addCell(3000)->addText(': ' . tgl_singkat($header->tgl_lahir));
    $table->addCell(3000)->addText('Jenis Kelamin');
    $table->addCell(2000)->addText(': ' . ($header->jns_kelamin == 'W' ? 'Wanita' : 'Pria'));
    // Menghitung umur pasien
    $birthDate = new DateTime($header->tgl_lahir);
    $tgl_input = new DateTime($header->tgl_input);
    $umur = 0;
    $month = 0;
    $day = 0;
    if ($birthDate < $tgl_input) {
        $umur = $tgl_input->diff($birthDate)->y;
        $month = $tgl_input->diff($birthDate)->m;
        $day = $tgl_input->diff($birthDate)->d;
    }
    $table->addRow();
    $table->addCell(2000)->addText('Umur');
    $table->addCell(4000)->addText(': ' . $umur . ' Tahun ' . $month . ' Bulan ' . $day . ' Hari');
    $table->addCell(2000)->addText('Keterangan');
    $table->addCell(2000)->addText(': ' . $header->keterangan);
    $table->addRow();
    $table->addCell(2000)->addText('Alamat');
    $table->addCell(4000)->addText(': ' . ucwords(strtolower($header->alamat)));
    if ($napsa == 'ya') {
        $section->addText('Berdasarkan pemeriksaan saat ini, hasil untuk URINE SCREENING TEST, adalah sebagai berikut:', ['size' => 12]);
    }
    $section->addTextBreak();
    // Menambahkan tabel dengan hasil pemeriksaan
    $table = $section->addTable(['borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 50]);
    $table->addRow();
    $table->addCell(1500, ['bgColor' => 'adadad'])->addText('Jenis Pemeriksaan', ['bold' => true], ['alignment' => 'center']);
    $table->addCell(1500, ['bgColor' => 'adadad'])->addText('Hasil', ['bold' => true], ['alignment' => 'center']);
    $table->addCell(1500, ['bgColor' => 'adadad'])->addText('Nilai Rujukan', ['bold' => true], ['alignment' => 'center']);
    $table->addCell(1000, ['bgColor' => 'adadad'])->addText('Satuan', ['bold' => true], ['alignment' => 'center']);
    $table->addCell(3500, ['bgColor' => 'adadad'])->addText('Metode Uji', ['bold' => true], ['alignment' => 'center']);
    foreach ($detail_kdpar as $kdpar) {
        $table->addRow();
        $table->addCell(8000, ['bgColor' => 'adadad'])->addText('-- ' . $kdpar->nm_kategori_parameter . ' --', ['bold' => true]);
        foreach ($res_par[$kdpar->kd_kategori_parameter] as $value) {
            $bold = $value->nilai;
            $nilai_min = $value->nilai_min;
            $nilai_max = $value->nilai_max;
            if ($value->nilai_min != '0.00' && $value->nilai_max != '0.00') {
                if ($value->nilai < $nilai_min || $value->nilai > $nilai_max) {
                    $bold = "<strong><u>" . $value->nilai . "</u></strong>";
                } else {
                    $bold = $value->nilai;
                }
            }
            $table->addRow();
            $table->addCell(1500)->addText($value->nm_parameter);
            $table->addCell(1500)->addText($bold, [], ['alignment' => 'center']);
            $table->addCell(1500)->addText($value->deskripsi_kadar, [], ['alignment' => 'center']);
            $table->addCell(1000)->addText($value->satuan, [], ['alignment' => 'center']);
            $table->addCell(3500)->addText($value->hasil_analisa, [], ['alignment' => 'center']);
        }
    }
    $section->addTextBreak();
    $table = $section->addTable();
    $table->addRow();
    $leftCell = $table->addCell(5000); // Kolom kiri, dibiarkan kosong
    $rightCell = $table->addCell(5000); // Kolom kanan, diisi dengan teks
    $rightCell->addText('Tangerang, ' . tgl_print(dbnow()), ['size' => 12], ['alignment' => 'center']);
    $rightCell->addTextBreak();
    $rightCell->addText('Mengetahui,', ['size' => 12], ['alignment' => 'center']);
    $rightCell->addText($ttl == 'matek' ? $ttd_teknis->jabatan : $ttd_koor->jabatan, ['size' => 12], ['alignment' => 'center']);
    $rightCell->addText('Dinas Kesehatan Kota Tangerang', ['size' => 12], ['alignment' => 'center']);
    $rightCell->addTextBreak();
    $rightCell->addText($ttl == 'matek' ? $ttd_teknis->nama : $ttd_koor->nama, ['underline' => 'single', 'size' => 12], ['alignment' => 'center']);
    $rightCell->addText('NIP. ' . ($ttl == 'matek' ? $ttd_teknis->nip : $ttd_koor->nip), ['size' => 12], ['alignment' => 'center']);
    $rightCell->addText('FSOP.LKT-15.1', ['size' => 12], ['alignment' => 'center']);
    if ($napsa == 'ya') {
        $leftCell->addTextBreak();
        $leftCell->addTextBreak();
        $leftCell->addTextBreak();
        $leftCell->addTextBreak();
        $leftCell->addTextBreak();
        $leftCell->addTextBreak();
        $leftCell->addTextBreak();
        $leftCell->addTextBreak();
        $leftCell->addTextBreak();
        $leftCell->addText($note->keterangan, ['size' => 12], ['alignment' => 'right']);
    }
   // header("Content-Description: File Transfer");
   header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
   header('Content-Disposition: attachment; filename="' . str_replace("/", "", $header->no_pendaftaran) . '.docx"');
   // header('Content-Type: application/octet-stream');
   $writer = IOFactory::createWriter($phpWord, 'Word2007');
   $writer->save('php://output');
   exit();
}
function generateWordDocumentLingkungan2($header, $detail, $detail_kdpar, $ttd_kepala, $ttd_tu, $ttd_teknis, $ttd_koor, $type_surat, $type_laporan, $header_cetak, $agreditasi, $napsa, $note, $ttl, $ttn) {
// pre($note);exit();
    // pre($header);exit();
    //  pre(convertHtmlToPlainText($note->keterangan));
    // pre($note);
    // exit();
    // echo "<br>";
    // echo pre(convertHtmlToPlainText($note->keterangan));
    // echo "<br>";
    // echo convertHtmlToPlainText($note->catatan);
    // exit();
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
    $section = $phpWord->addSection();
    // Mengelompokkan hasil parameter berdasarkan kategori
    $res_par = array();
    foreach ($detail as $val1) {
        $res_par[$val1->kd_kategori_parameter][] = $val1;
    }
            $header1 = $section->createHeader();
            $headerTable = $header1->addTable();
            // Baris pertama, kolom pertama untuk logo
             $header1 =  createHeader($section, $header_cetak, $agreditasi);
            if($type_surat=="surat"){
            $textrun = $section->addTextRun();
            $textrun->addText("No. Lab \t: " . $header->no_pendaftaran ." \t\t\t Tangerang :" . tgl_print(dbnow()), WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
            $section->addText("Sifat   \t\t: Rahasia", WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
            $section->addText("Perihal \t: Hasil Pemeriksaan Laboratorium", WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
            $section->addTextBreak(1);
            $section->addText('Kepada Yth,', WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
            $section->addText('Bapak / Ibu ' . strtoupper(convertHtmlToPlainText(escapeHtml($header->nama))), WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
            $section->addText(convertHtmlToPlainText(escapeHtml($header->alamat)), WordSuratBodyStyle::getBody(), ['alignment' => 'left']);
            $section->addTextBreak(1);
            $section->addText('Bersama ini kami sampaikan hasil pemeriksaan pada Laboratorium Klinik. Atas perhatian dan kerjasamanya, kami sampaikan terimakasih.', WordSuratBodyStyle::getBody(), ['alignment' => 'both']);
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
            $table->addCell(4500)->addText(($ttn == "kalab") ? escapeHtml($ttd_kepala->nama) : escapeHtml($ttd_tu->nama), WordSuratBodyStyle::getBodyUnderline(), ['alignment' => 'center']);
            $table->addRow();
            $table->addCell(5000);
            $table->addCell(4500)->addText('NIP. ' . (($ttn == "kalab") ? escapeHtml($ttd_kepala->nip) : escapeHtml($ttd_tu->nip)), WordSuratBodyStyle::getBody(), ['alignment' => 'center']);
            $section->addTextBreak(2);
            // $section->addText('FSOP.LKT-15.1', WordSuratBodyStyle::getBody(), ['alignment' => 'right']);
            // $headerTable = $section->addHeader()->addTable();
        $footer1 = createFooterSelainKlinik($section,$header_cetak ,  $agreditasi);
    }
      if($type_laporan=='laporan'){
        if($type_surat=='surat'){
              $section->addPageBreak();
        }
            // <strong style="font-size: 16px;">Laporan Hasil Uji Lab Klinik</strong>
          $section->addText('Laporan Hasil Uji Lab Lingkungan', WordHasilBodyStyle::getBodyBold(), ['alignment' => 'center']);
        $section->addText('NOMOR : ' . $header->no_pendaftaran, WordHasilBodyStyle::getBodyBold(), ['alignment' => 'center']);
        // Sample Information
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(3500)->addText('Nama Pelanggan' , WordHasilBodyStyle::getBody() );
        $table->addCell(6500)->addText(': ' . strtoupper(convertHtmlToPlainText($header->nama)) , WordHasilBodyStyle::getBody());
        $table->addRow();
        $table->addCell(3500)->addText('No. Lab' , WordHasilBodyStyle::getBody() );
        $table->addCell(6500)->addText(': ' . convertHtmlToPlainText($header->no_pendaftaran) , WordHasilBodyStyle::getBody());
        $table->addRow();
        $table->addCell(3500)->addText('Jenis Sampel' , WordHasilBodyStyle::getBody() );
        $table->addCell(6500)->addText(': ' . convertHtmlToPlainText($header->nm_sampel) , WordHasilBodyStyle::getBody());
        $table->addRow();
        $table->addCell(3500)->addText('Jenis Analisa' , WordHasilBodyStyle::getBody() );
        $table->addCell(6500)->addText(': ' . convertHtmlToPlainText($header->jns_analisa) , WordHasilBodyStyle::getBody());
        $table->addRow();
        $table->addCell(3500)->addText('Keterangan / Kondisi Sampel' , WordHasilBodyStyle::getBody() );
        $table->addCell(6500)->addText(': ' . convertHtmlToPlainText($header->ket_sampel) . '/' . convertHtmlToPlainText($header->kondisi) , WordHasilBodyStyle::getBody());
        $table->addRow();
        $table->addCell(3500)->addText('Lokasi Pengambilan Sampel' , WordHasilBodyStyle::getBody() );
        $table->addCell(6500)->addText(': ' . convertHtmlToPlainText($header->lokasi) , WordHasilBodyStyle::getBody());
        $table->addRow();
        $table->addCell(3500)->addText('Tanggal Penerimaan' , WordHasilBodyStyle::getBody() );
        $table->addCell(6500)->addText(': ' . tgl_singkat(convertHtmlToPlainText($header->tgl_diterima)) , WordHasilBodyStyle::getBody());
        // Analysis Results
        $section->addTextBreak(2);
        if ($napsa == 'ya') {
            $section->addText('Berdasarkan pemeriksaan saat ini, hasil untuk URINE SCREENING TEST, adalah sebagai berikut : ' , WordHasilBodyStyle::getBody());
        }
    $section->addTextBreak();
    $table = $section->addTable(['borderSize' => 6, 'borderColor' => 'black', 'cellMargin' => 50]);
    $table->addRow();
    $table->addCell(2000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Jenis Pemeriksaan', WordHasilTableStyle::getNormalBold(), ['alignment' => 'center', 'spaceAfter' => 0]);
    $table->addCell(1500, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Hasil', WordHasilTableStyle::getNormalBold(), ['alignment' => 'center', 'spaceAfter' => 0]);
    $table->addCell(2000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Kadar Maksimum', WordHasilTableStyle::getNormalBold(), ['alignment' => 'center', 'spaceAfter' => 0]);
    $table->addCell(1500, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Satuan', WordHasilTableStyle::getNormalBold(), ['alignment' => 'center', 'spaceAfter' => 0]);
    $table->addCell(3000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Metode Uji', WordHasilTableStyle::getNormalBold(), ['alignment' => 'center', 'spaceAfter' => 0]);
//     ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
// goto cetak2;
    $res_par = [];
        foreach ($detail as $key => $val1) {
            $res_par[$val1->kd_kategori_parameter][] = $val1;
        }
        $total = 0;
        foreach ($detail_kdpar as $key => $value) {
            // pre($value);exit();
            $nm_kategori_parameter = $value->nm_kategori_parameter;
            $table->addRow();
            $table->addCell(8000, ['gridSpan' => 5, 'bgColor' => 'adadad'])->addText("-- " . escapeHtml( convertHtmlToPlainText($nm_kategori_parameter) ) . " --", WordHasilTableStyle::getNormalBold());
            // goto akhir;
            $n = 0;
            foreach ($res_par[$value->kd_kategori_parameter] as $key => $val) {
                $total += $val->harga;
                $bold = escapeHtml(@$val->nilai);
                if ($val->nilai_min != '0.00' && $val->nilai_max != '0.00') {
                    if ((int)$val->nilai < $val->nilai_min || (int)$val->nilai > $val->nilai_max) {
                        // $bold = convertHtmlToPlainText("<u>" . $val->nilai . "</u>");
                        $bold = escapeHtml ( convertHtmlToPlainText( $val->nilai ));
                    }
                }
                $table->addRow();
                $table->addCell()->addText($val->nm_parameter);
                // $table->addCell(null, ['alignment' => 'center'])->addText(convertHtmlToPlainText ( escapeHtml ( ("$bold " . "- $val->nilai_min -". "$val->nilai_max"))) , WordHasilTableStyle::getNormal() , [ 'spaceAfter' => 0] );
                
		 $table->addCell(null, ['alignment' => 'center'])->addText(convertHtmlToPlainText ( escapeHtml ( ("$bold " ))) , WordHasilTableStyle::getNormal() , [ 'spaceAfter' => 0] );
                // $table->addCell(null, ['alignment' => 'center'])->addText(convertHtmlToPlainText ( escapeHtml ( ("" . "- $val->nilai_min -". "$val->nilai_max"))) , WordHasilTableStyle::getNormal() , [ 'spaceAfter' => 0] );
                $table->addCell(null, ['alignment' => 'center'])->addText(convertHtmlToPlainText( escapeHtml ($val->kadar)) , WordHasilTableStyle::getNormal() , [ 'spaceAfter' => 0] );
                $table->addCell(null, ['alignment' => 'center'])->addText(convertHtmlToPlainText($val->satuan) , WordHasilTableStyle::getNormal() , [ 'spaceAfter' => 0] );
                $table->addCell(null, ['alignment' => 'center'])->addText(convertHtmlToPlainText($val->hasil_analisa) , WordHasilTableStyle::getNormal() , [ 'spaceAfter' => 0] );
                if ($n == 4 )
                goto cetak2;
                $n++;
            }
        }
// pre($res_par);
//         pre($detail_kdpar);
// exit();
cetak2:
  $section->addTextBreak();
$table2 = $section->addTable();
$table2->addRow();
$table2->addCell(5000)->addText('',  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]); 
$table2->addCell(5000)->addText('Tangerang, ' . tgl_print(dbnow()),  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]);
// $table2->addCell(4000);
// $table2->addRow();
// $table2->addCell(5000);
// $table2->addCell(4000)->addText('',  WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
// $table2->addCell(2000);
$table2->addRow();
$table2->addCell(5000)->addText('',  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]);
$table2->addCell(5000)->addText('Mengetahui,',  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]);
$table2->addRow();
$table2->addCell(5000)->addText('',  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]);
// goto p; 
$table2->addCell(5000)->addText(($ttl == 'matek') ? $ttd_teknis->jabatan : $ttd_koor->jabatan,  WordHasilBodyStyle::getBody(), ['alignment' => 'center','spaceAfter' => 0]);
$table2->addRow();
$table2->addCell(5000);
$table2->addCell(5000)->addText('',  WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
$table2->addRow();
$table2->addCell(5000);
$table2->addRow();
$table2->addCell(5000);
// goto p; 
$table2->addCell(5000)->addText('' . (($ttl == 'matek') ? $ttd_teknis->nama : $ttd_koor->nama) . '', WordHasilBodyStyle::getBodyUnderline(), ['alignment' => 'center', 'underline' => 'single']);
$table2->addRow();
$table2->addCell(5000);
// goto p; 
$table2->addCell(5000)->addText('NIP. ' . (($ttl == 'matek') ? $ttd_teknis->nip : $ttd_koor->nip),  WordHasilBodyStyle::getBody(), ['alignment' => 'center']);
// $section->addTextBreak();
// $table3 = $section->addTable();
// $table3->addRow();
// $table2->addCell(5000)->addText(($napsa == 'ya') ? convertHtmlToPlainText($note->keterangan) : '',  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
// Html::addHtml($table3->addCell(5000), ($napsa == 'ya') ?  ($note->keterangan) : '' );
// goto x;
//if ($napsa =='ya')
//{
$html = $note->keterangan2 ;
// Html::addHtml($section, $html);
$htmlex= explode("#",$html);
if (count($htmlex) > 1) {
//  $textrun = $section->addTextRun();
 $section->addText(escapeHtml($htmlex[0]) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
//  $section->addTextBreak();
    array_shift($htmlex);
            foreach ($htmlex as $ket) {
                if ($ket == "") {
                    continue;
                }
                 $section->addText( escapeHtml($ket) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
                //   $section->addTextBreak();
            }
}
//}else{
//}
x:
// convertHtmlToPhpWord($table2->addCell(2000), ($napsa == 'ya') ?  ($note->keterangan) : '');
// $table2->addCell(10000);
// goto p; 
// $table2->addCell(2000);
// $table2->addCell(4000);
// $table3->addRow();
// $table2->addCell(5000)->addText(convertHtmlToPlainText($note->catatan),  WordHasilBodyStyle::getBody(), ['alignment' => 'left']);
// Html::addHtml($table3->addCell(5000),   ($note->catatan)  );
$html = $note->catatan2 ;
// Html::addHtml($section, $html);
$htmlex= explode("#",$html);
if (count($htmlex) > 1) {
//  $textrun = $section->addTextRun();
 $section->addText(escapeHtml($htmlex[0]) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
//  $section->addTextBreak();
    array_shift($htmlex);
            foreach ($htmlex as $ket) {
                if ($ket == "") {
                    continue;
                }
                 $section->addText( escapeHtml($ket) , WordHasilBodyStyle::getBody(), ['alignment' => 'left' ,'spaceAfter' => 0]);
                //   $section->addTextBreak();
            }
}
// convertHtmlToPhpWord($table3->addCell(2000),  ($note->catatan));
// $table3->addCell(4000);
// $table3->addCell(2000);
// $table3->addCell(4000);
// $table3->addRow();
// $table3->addCell(5000);
// $table2->addCell(5000)->addText('FSOP.LKT-15.1',  WordHasilBodyStyle::getBody(), ['alignment' => 'right']);
//  createFooterHal2($section,$header_cetak   ,  $agreditasi);
if ( $agreditasi == 'kalk') { 
// createFooterSelainKlinik($section,$header_cetak   ,  $agreditasi);
createFooterHal2($section,$header_cetak   ,  $agreditasi);
}
}
p:
   header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
   header('Content-Disposition: attachment; filename="' . str_replace("/", "", $header->no_pendaftaran) . '.docx"');
   // header('Content-Type: application/octet-stream');
   $writer = IOFactory::createWriter($phpWord, 'Word2007');
   $writer->save('php://output');
   exit();
}
function generateWordDocumentLingkungan($header, $detail, $detail_kdpar, $ttd_kepala, $ttd_tu, $ttd_teknis, $ttd_koor, $type_surat, $type_laporan, $header_cetak, $agreditasi, $napsa, $note, $ttl, $ttn) {
//    pre($header); exit();
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
        $section->addText('Laporan Hasil Uji Lab Lingkungan', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
        $section->addText('NOMOR : ' . $header->no_pendaftaran, ['bold' => true, 'size' => 12], ['alignment' => 'center']);
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
    $table = $section->addTable(['borderSize' => 1, 'borderColor' => 'black']);
    $table->addRow();
    $table->addCell(2000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Jenis Pemeriksaan', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
    $table->addCell(1500, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Hasil', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
    $table->addCell(2000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Nilai Rujukan', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
    $table->addCell(1500, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Satuan', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
    $table->addCell(2000, ['bgColor' => 'adadad', 'valign' => 'center'])->addText('Metode Uji', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
    $res_par = [];
    foreach ($detail as $key => $val1) {
        $res_par[$val1->kd_kategori_parameter][] = $val1;
    }
    $total = 0;
    foreach ($detail_kdpar as $key => $value) {
        $nm_kategori_parameter = $value->nm_kategori_parameter;
        $table->addRow();
        $table->addCell(8000, ['gridSpan' => 5, 'bgColor' => 'adadad'])->addText("-- $nm_kategori_parameter --", ['bold' => true]);
        foreach ($res_par[$value->kd_kategori_parameter] as $key => $val) {
            $total += $val->harga;
            $bold = $val->nilai;
            if ($val->nilai_min != '0.00' && $val->nilai_max != '0.00') {
                if ((int)$val->nilai < $val->nilai_min || (int)$val->nilai > $val->nilai_max) {
                                       $bold = convertHtmlToPlainText("<u>" . $val->nilai . "</u>");
                }
            }
            $table->addRow();
            $table->addCell()->addText($val->nm_parameter);
            $table->addCell(null, ['alignment' => 'center'])->addText("$bold - $val->nilai_min - $val->nilai_max");
            $table->addCell(null, ['alignment' => 'center'])->addText($val->kadar);
            $table->addCell(null, ['alignment' => 'center'])->addText($val->satuan);
            $table->addCell(null, ['alignment' => 'center'])->addText($val->hasil_analisa);
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
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(8000)->addText($keterangan);
        // goto akhir;
        // Closing Remarks and Signatures
        // $section->addTextBreak(2);
        // $section->addText('Tangerang, ' . tgl_print(dbnow()));
        // $section->addText('Kepala Laboratorium Kesehatan', null, ['alignment' => 'center']);
        // $section->addText('Dinas Kesehatan Kota Tangerang', null, ['alignment' => 'center']);
        // $section->addTextBreak(2);
        // $section->addText('<u>' . $ttd_kepala->nama . '</u>', null, ['alignment' => 'center']);
        // $section->addText('NIP. ' . $ttd_kepala->nip, null, ['alignment' => 'center']);
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
            $rightCell->addText('<u>' . (($ttl=='matek')? $ttd_teknis->nama:$ttd_koor->nama) . '</u>', null, $cellHCentered);
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
function groupDetailsByCategoryParameter($details) {
    $res_par = array();
    foreach ($details as $key => $val1) {
        $res_par[$val1->kd_kategori_parameter][] = $val1;
    }
    return $res_par;
}
class WordHeaderStyle {
    /**
     * Returns style for the first row of the header.
     *
     * @return array ['bold' => false, 'size' => 12, 'name' => 'Arial'];
     */
    public static function getHeaderBaris1() {
        return ['bold' => false, 'size' => 12, 'name' => 'Arial'];
    }
    /**
     * Returns style for the second row of the header.
     *
     * @return array ['bold' => true, 'size' => 14, 'name' => 'Arial'];
     */
    public static function getHeaderBaris2() {
        return ['bold' => true, 'size' => 14, 'name' => 'Arial'];
    }
    /**
     * Returns style for the third row of the header.
     *
     * @return array ['bold' => false, 'size' => 7, 'name' => 'Arial'];
     */
    public static function getHeaderBaris3() {
        return ['bold' => false, 'size' => 7, 'name' => 'Arial'];
    }
}
class WordFooterStyle 
{
     /**
     * Returns style for the footer text.
     *
     * @return array ['bold' => false, 'size' => 12, 'name' => 'Arial'];
     */
    public static function getFooter() {
        return ['bold' => true, 'size' => 9, 'name' => 'Arial'];
    }
}
class WordSuratBodyStyle 
{
  /**
     * Returns style for the body text.
     *
     * @return array ['bold' => false, 'size' => 12, 'name' => 'Arial'];
     */
    public static function getBody() {
        return ['bold' => false, 'size' => 11, 'name' => 'Arial'];
    } 
     /**
     * Returns style for the bold body text.
     *
     * @return array ['bold' => true, 'size' => 12, 'name' => 'Arial'];
     */     
    public static function getBodyBold() {
        return ['bold' => true, 'size' => 11, 'name' => 'Arial'];
    } 
    /**
     * Returns style for the underlined body text.
     *
     * @return array ['bold' => false, 'size' => 12, 'name' => 'Arial' ,  'underline' => 'single' ];
     */     
    public static function getBodyUnderline() {
        return ['bold' => false, 'size' => 11, 'name' => 'Arial' ,  'underline' => 'single' ];
    }     
}
class WordHasilBodyStyle 
{
  /**
     * Returns style for the body text.
     *
     * @return array ['bold' => false, 'size' => 12, 'name' => 'Arial'];
     */
    public static function getBody() {
        return ['bold' => false, 'size' => 10, 'name' => 'Arial'];
    } 
    /**
     * Returns style for the bold body text.
     *
     * @return array ['bold' => true, 'size' => 12, 'name' => 'Arial'];
     */     
    public static function getBodyBold() {
        return ['bold' => true, 'size' => 10, 'name' => 'Arial'];
    } 
    /**
     * Returns style for the underlined body text.
     *
     * @return array ['bold' => false, 'size' => 12, 'name' => 'Arial' ,  'underline' => 'single' ];
     */     
    public static function getBodyUnderline() {
        return ['bold' => false, 'size' => 10, 'name' => 'Arial' ,  'underline' => 'single' ];
    }
    /**
     * Returns style for the body catatan.
     *
     * @return array ['bold' => false, 'size' => 12, 'name' => 'Arial'];
     */
    public static function getBodycatatan() {
        return ['bold' => false, 'size' => 8, 'name' => 'Arial'];
    }
}
class WordHasilTableStyle 
{
  /**
     * Returns style for normal text.
     *
     * @return array ['bold' => false, 'size' => 12, 'name' => 'Arial'];
     */
    public static function getNormal() {
        return ['bold' => false, 'size' => 10, 'name' => 'Arial'];
    } 
    /**
     * Returns style for bold text.
     *
     * @return array ['bold' => true, 'size' => 12, 'name' => 'Arial'];
     */     
    public static function getNormalBold() {
        return ['bold' => true, 'size' => 10, 'name' => 'Arial'];
    } 
    /**
     * Returns style for underlined text.
     *
     * @return array ['bold' => false, 'size' => 12, 'name' => 'Arial', 'underline' => 'single'];
     */     
    public static function getNormalUnderline() {
        return ['bold' => false, 'size' => 11, 'name' => 'Arial' ,  'underline' => 'single' ];
    }     
}
?>
