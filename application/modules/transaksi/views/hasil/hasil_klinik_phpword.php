<?php
require_once 'vendor/autoload.php';
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\IOFactory;
// Data yang diperlukan (sesuaikan dengan data yang sebenarnya)
$header = (object) [
    'no_pendaftaran' => '12345',
    'tgl_lahir' => '1980-01-01',
    'tgl_input' => '2023-06-15',
    'nama' => 'John Doe',
    'alamat' => '1234 Main St',
    'dokter' => 'Dr. Smith',
    'tgl_spesimen' => '2023-06-10',
    'jns_kelamin' => 'W',
    'keterangan' => 'Test Keterangan'
];
$type_surat = 'surat';
$type_laporan = 'laporan';
$header_cetak = 'Ya';
$agreditasi = 'kan';
$ttn = 'kalab';
$ttd_kepala = (object) [
    'jabatan' => 'Kepala Lab',
    'nama' => 'Dr. Kepala',
    'nip' => '123456789'
];
$ttd_tu = (object) [
    'jabatan' => 'Kepala TU',
    'nama' => 'Dr. TU',
    'nip' => '987654321'
];
$napsa = 'ya';
$note = (object) [
    'keterangan' => 'Keterangan NAPSA',
    'catatan' => 'Catatan tambahan'
];
$ttl = 'matek';
$ttd_teknis = (object) [
    'jabatan' => 'Teknis',
    'nama' => 'Teknis',
    'nip' => '555555555'
];
$ttd_koor = (object) [
    'jabatan' => 'Koordinator',
    'nama' => 'Koordinator',
    'nip' => '444444444'
];
$detail_kdpar = [
    (object) [
        'kd_kategori_parameter' => '1',
        'nm_kategori_parameter' => 'Kategori 1'
    ],
    (object) [
        'kd_kategori_parameter' => '2',
        'nm_kategori_parameter' => 'Kategori 2'
    ]
];
$res_par = [
    '1' => [
        (object) [
            'nm_parameter' => 'Param 1',
            'nilai' => '5.0',
            'nilai_min' => '1.0',
            'nilai_max' => '10.0',
            'deskripsi_kadar' => 'Deskripsi 1',
            'satuan' => 'mg/dL',
            'hasil_analisa' => 'Metode 1'
        ],
        (object) [
            'nm_parameter' => 'Param 2',
            'nilai' => '2.5',
            'nilai_min' => '1.0',
            'nilai_max' => '5.0',
            'deskripsi_kadar' => 'Deskripsi 2',
            'satuan' => 'mg/dL',
            'hasil_analisa' => 'Metode 2'
        ]
    ],
    '2' => [
        (object) [
            'nm_parameter' => 'Param 3',
            'nilai' => '1.0',
            'nilai_min' => '0.5',
            'nilai_max' => '2.0',
            'deskripsi_kadar' => 'Deskripsi 3',
            'satuan' => 'g/L',
            'hasil_analisa' => 'Metode 3'
        ]
    ]
];
// Hitung umur
$tanggal_lahir = date('Y-m-d', strtotime($header->tgl_lahir));
$tgl_input = date('Y-m-d', strtotime($header->tgl_input));
$birthDate = new \DateTime($tanggal_lahir);
$tgl_input = new \DateTime($tgl_input);
$umur = 0;
if ($birthDate < $tgl_input) {
    $umur = $tgl_input->diff($birthDate)->y;
    $month = $tgl_input->diff($birthDate)->m;
    $day = $tgl_input->diff($birthDate)->d;
}
// Inisialisasi PHPWord
$phpWord = new PhpWord();
$section = $phpWord->addSection();
// HTML template
$html = <<<EOD
<style>
  /* Add your styles here */
</style>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body" style="page-break-before:always;">
          <table style="width:100%;font-family: initial;font-size: 13px">
            <tr>
              <td colspan="4">
                <table style='width:100%;font-family: initial;'> 
                  <tr>
                    <td width='15%' align="center">                    
                      <img src="assets/image/542px-Lambang_Kota_Tangerang.png" alt="" height="75" width='75'>
                    </td>
                    <td colspan="2" width='50%' align="center">
                      <strong style="font-size: 12px;">
                        PEMERINTAH KOTA TANGERANG<br/>
                        DINAS KESEHATAN<br/>
                        UPT LABORATORIUM KESEHATAN DAERAH<br/>
                      </strong>
                      <strong style="font-size: 12px;">
                        JL. TMP Taruna Suka Asih Telp/Fax : 021 - 5588737 Kota Tangerang 15111<br/>
                        Email : labkeskota.tangerang@gmail.com
                      </strong>
                    </td>
                    <td width='35%' align="center">
                      <img src="assets/image/kan-logo-D754581922-seeklogo.com.png" alt="" height="75" width='100'>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="center"><hr/></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td width="15%">No. Lab</td>
              <td width="35%">: {$header->no_pendaftaran}</td>
              <td width="25%" colspan="2" align="right">Tangerang, {date('d-m-Y')}</td>
            </tr>
            <tr>
              <td width="15%">Sifat</td>
              <td width="35%">: Rahasia</td>
              <td width="25%" colspan="2" align="right"></td>
            </tr>
            <tr>
              <td width="15%">Perihal</td>
              <td width="35%">: Hasil Pemeriksaan Laboratorium</td>
              <td width="25%" colspan="2" align="right"></td>
            </tr>
            <tr>
              <td width="15%"><br/><br/></td>
              <td width="35%"></td>
              <td width="25%" colspan="2" align="right"></td>
            </tr>
            <tr>
              <td width="15%" colspan="4">
                Kepada Yth,
              </td>
            </tr>
            <tr>
              <td width="15%" colspan="4" style="height:30">
                Bapak / Ibu {strtoupper($header->nama)}
              </td>
            </tr>
            <tr>
              <td colspan="4" align="left" style="height:30">
                {$header->alamat}
              </td>
            </tr>
            <tr>
              <td width="15%"><br/><br/></td>
              <td width="35%"></td>
              <td width="25%" colspan="2" align="right"></td>
            </tr>
            <tr>
              <td width="15%" colspan="4" style="text-align: justify" style="height:30">
                <p style="line-height:2">Bersama ini kami sampaikan hasil pemeriksaan pada Laboratorium Klinik. Atas perhatian dan kerjasamanya, kami sampaikan terimakasih. 
                </p>
              </td>
            </tr>
            <tr>
              <td width="15%"><br/><br/></td>
              <td width="35%"></td>
              <td width="25%" colspan="2" align="right"></td>
            </tr>
            <tr>
              <td width="15%"></td>
              <td width="35%"></td>
              <td width="25%" align="right"></td>
              <td width="25%" align="Center">Mengetahui, <br>{$ttd_kepala->jabatan} </td>
            </tr>
            <tr>
              <td width="15%" style="height:70"></td>
              <td width="35%"></td>
              <td width="25%" align="right"></td>
              <td width="25%" align="center" style="height:70"></td>
            </tr>
            <tr>
              <td width="15%"></td>
              <td width="35%"></td>
              <td width="25%" align="right"></td>
              <td width="25%" align="Center">{$ttd_kepala->nama} <br> NIP. {$ttd_kepala->nip} </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
EOD;
// Bersihkan HTML menggunakan DOMDocument
$dom = new \DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
libxml_clear_errors();
$cleanedHtml = $dom->saveHTML();
// Convert HTML to Word
Html::addHtml($section, $cleanedHtml, false, false);
// Simpan dokumen Word
$file = 'Laporan_Hasil_Pemeriksaan.docx';
$phpWord->save($file, 'Word2007');
echo "Dokumen berhasil dibuat: <a href='$file'>$file</a>";
?>
