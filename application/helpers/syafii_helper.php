<?php 
/**
 * Execute a database query and return the result as an array of arrays.
 *
 * @param string $query The SQL query to execute.
 * @return array The result of the query as an array of arrays.
 */
function execute_query_result_array($query) {
    $ci =& get_instance();
    $ci->load->database();
    $result = $ci->db->query($query);
    return $result->result_array();
}
/**
 * Execute a database query and return the result as a single array.
 *
 * @param string $query The SQL query to execute.
 * @return array The result of the query as a single array.
 */
function execute_query_row_array($query) {
    $ci =& get_instance();
    $ci->load->database();
    $result = $ci->db->query($query);
    return $result->row_array();
}
/**
 * Get the left part of a string based on the number of characters specified.
 *
 * @param string $string The input string.
 * @param int $num The number of characters to return from the left.
 * @return string The left part of the string.
 */
function kiri($string, $num) {
    return substr($string, 0, $num);
}
/**
 * Get the right part of a string based on the number of characters specified.
 *
 * @param string $string The input string.
 * @param int $num The number of characters to return from the right.
 * @return string The right part of the string.
 */
function kanan($string, $num) {
    return substr($string, -$num);
}
/**
 * Get the middle part of a string based on the start position and length.
 *
 * @param string $string The input string.
 * @param int $start The start position for the substring.
 * @param int $length The number of characters to return.
 * @return string The middle part of the string.
 */
function tengah($string, $start, $length) {
    return substr($string, $start, $length);
}
/**
 * Filter an array based on a specific key and value.
 *
 * @param array $array The input array.
 * @param string $key The key to filter by.
 * @param mixed $value The value to filter for.
 * @return array The filtered array.
 */
function filter_array_by_value($array, $key, $value) {
    return array_filter($array, function($item) use ($key, $value) {
        return isset($item[$key]) && $item[$key] == $value;
    });
}
// Example usage:
// $data = [
//     ['id' => 1, 'status_cetak' => 1, 'name' => 'John'],
//     ['id' => 2, 'status_cetak' => 0, 'name' => 'Jane'],
//     ['id' => 3, 'status_cetak' => 1, 'name' => 'Doe']
// ];
// $filtered_data = filter_array_by_value($data, 'status_cetak', 1);
// This would return:
// [
//     ['id' => 1, 'status_cetak' => 1, 'name' => 'John'],
//     ['id' => 3, 'status_cetak' => 1, 'name' => 'Doe']
// ]
/**
 * Convert an array of data into an HTML table.
 *
 * @param array $array The input array of data.
 * @return string The generated HTML table.
 */
function array_to_table($array) {
    if (empty($array)) {
        return '<p>No data available.</p>';
    }
    $html = '<table border="1" style="width:100%; border-collapse: collapse;">';
    // Generate the header row
    $html .= '<tr>';
    foreach ($array[0] as $key => $value) {
        $html .= '<th>' . htmlspecialchars($key) . '</th>';
    }
    $html .= '</tr>';
    // Generate the data rows
    foreach ($array as $row) {
        $html .= '<tr>';
        foreach ($row as $cell) {
            $html .= '<td>' . htmlspecialchars($cell) . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</table>';
    return $html;
}
function pre($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
function headerkopsurat($agreditasi) {
    $html = '<table style="width:100%;font-family: \'Times New Roman\', Times, serif;font-size: 13px">';
    $html .= '<tr>';
    $html .= '<td width="15%" rowspan=5 align="left">';
    $html .= '<img src="' . base_url('assets/image/542px-Lambang_Kota_Tangerang.png') . '" alt="" height="110" width="105">';
    $html .= '</td>';
    $html .= '<td align="center" style="font-family: Arial; font-size: 16px;">PEMERINTAH KOTA TANGERANG</td>';
    $html .= '<td align="right" rowspan=5>';
    if ($agreditasi == "kan") {
        $html .= '<img src="' . base_url('assets/image/LogoLabkesda.png') . '" alt="" height="110" width="110">';
    } else if ($agreditasi == "kalk") {
        $html .= '<img src="' . base_url('assets/image/LogoLabkesda.png') . '" alt="" height="110" width="110">';
    } else if ($agreditasi == "kankalk") {
        $html .= '<img src="' . base_url('assets/image/LogoLabkesda.png') . '" alt="" height="110" width="110">';
    }
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td align="center" style="font-family: Arial; font-size: 16px;"><strong>DINAS KESEHATAN</strong></td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td align="center" style="font-family: Arial; font-size: 16px;"><strong>UPT LABORATORIUM KESEHATAN DAERAH</strong></td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td align="center" style="font-family: Arial; font-size: 10px;">JL. TMP Taruna Suka Asih Telp/Fax : 021 - 5588737 Kota Tangerang 15111</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td align="center" style="font-family: Arial; font-size: 10px;">Telp/Fax : 021-5588737   Email : labkeskota.tangerang@gmail.com</td>';
    $html .= '</tr>';
    $html .= '</table>';
    return $html;
}
function footersurat($agreditasi) {
    $html = '<table style="width:100%">';
    $html .= '<tr>';
    $html .= '<td width="29%"></td>';
    $html .= '<td align="center" width="20%">';
    if($agreditasi=="kan" || $agreditasi=="kalk"){
        $html .= '<strong style="font-size: 9px;">';
        $html .= '<img src="' . base_url('assets/image/kan-logo-D754581922-seeklogo.com.png') . '" alt="" height="40" width="90"></br></br></br></br>';
        $html .= '</strong>';
    }
    $html .= '</td>';
    $html .= '<td colspan="3" width="80%" align="left">';
	if($agreditasi=="kan" || $agreditasi=="kalk"){
		$html .= 'Terakreditasi Kemenkes RI No. YM.02.01/D/3995/2024';
	}
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="29%"></td>';
    $html .= '<td align="center" style="font-size: 9px;">';
    if($agreditasi=="kan" || $agreditasi=="kalk"){
        $html .= 'Laboratorium Penguji';
    }
    $html .= '</td>';
    $html .= '<td colspan="2" align="center">';
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="29%"></td>';
    $html .= '<td align="center" style="font-size: 9px;">';
    if($agreditasi=="kan" || $agreditasi=="kalk"){
        $html .= 'LP-1234-DN';
    }
    $html .= '</td>';
    $html .= '<td colspan="2" align="center">';
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '</table>';
    return $html;
}
function footerlaporan($agreditasi) {
    $html = '<table style="width:100%">';
    $html .= '<tr>';
    $html .= '<td width="29%"></td>';
    $html .= '<td align="center" width="20%">';
    if($agreditasi=="kan"){
        $html .= '<strong style="font-size: 9px;">';
        $html .= '<img src="' . base_url('assets/image/kan-logo-D754581922-seeklogo.com.png') . '" alt="" height="40" width="90"></br></br></br></br>';
        $html .= '</strong>';
    }
    $html .= '</td>';
    $html .= '<td colspan="3" width="80%" align="left">';
	if($agreditasi=="kan"){
		$html .= 'Terakreditasi Kemenkes RI No. YM.02.01/D/3995/2024';
	}
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="29%"></td>';
    $html .= '<td align="center" style="font-size: 9px;">';
    if($agreditasi=="kan"){
        $html .= 'Laboratorium Penguji';
    }
    $html .= '</td>';
    $html .= '<td colspan="2" align="center">';
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="29%"></td>';
    $html .= '<td align="center" style="font-size: 9px;">';
    if($agreditasi=="kan"){
        $html .= 'LP-1234-DN';
    }
    $html .= '</td>';
    $html .= '<td colspan="2" align="center">';
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '</table>';
    return $html;
}
// Fungsi untuk mengonversi HTML ke elemen PHPWord dalam tabel
function convertHtmlToPhpWord($cell, $html) {
    // Ubah paragraf
    $html = preg_replace('/<p>(.*?)<\/p>/is', '<div>\1</div>', $html);
    // Escape HTML
    $html = escapeHtml($html);
    // Ubah strong/bold tags menjadi format teks tebal
    $html = preg_replace('/<strong>(.*?)<\/strong>/is', '<b>\1</b>', $html);
    // Ubah ul/li tags menjadi list bullet
    $html = preg_replace('/<ul>(.*?)<\/ul>/is', '<bullet>\1</bullet>', $html);
    $html = preg_replace('/<li>(.*?)<\/li>/is', '<li>\1</li>', $html);
    // Split HTML into lines for processing
    $lines = explode("\n", strip_tags($html, '<div><b><bullet><li>'));
    foreach ($lines as $line) {
        if (preg_match('/<div>(.*?)<\/div>/is', $line, $matches)) {
            $cell->addText($matches[1], ['bold' => false, 'size' => 12], ['alignment' => 'left']);
        } elseif (preg_match('/<b>(.*?)<\/b>/is', $line, $matches)) {
            $cell->addText($matches[1], ['bold' => true, 'size' => 12], ['alignment' => 'left']);
        } elseif (preg_match('/<bullet>(.*?)<\/bullet>/is', $line, $matches)) {
            $cell->addListItem($matches[1], 0, null, 'type1');
        } elseif (preg_match('/<li>(.*?)<\/li>/is', $line, $matches)) {
            $cell->addListItem($matches[1], 1, null, 'type1');
        }
    }
}
function convertHtmlToPlainText($html) {
     // Remove <p> tags and any tags within ckeditor
     $html = preg_replace('/<p>(.*?)<\/p>/is', '\1', $html);
     // Remove ul and li tags
     $html = preg_replace('/<\/?ul>/i', '', $html);
     $html = preg_replace('/<\/?li>/i', '', $html);
     $cleanedString = preg_replace_callback('/[^A-Za-z0-9]/', function($match) {
         // Additional logic can be added here
         return '';
     }, $html);
     $html = str_replace('&nbsp;', ' ', $html);
    $html = str_replace(['&ensp;', '&emsp;', '&thinsp;'], ' ', $html);
    // Menghapus semua tag HTML dan hanya menyisakan teks
    $html = strip_tags($html);
    // Menghapus karakter khusus HTML
    $html = htmlspecialchars_decode($html, ENT_QUOTES | ENT_XML1);
    // Mengganti entitas HTML dengan karakter yang sesuai
    $html = html_entity_decode($html);
    // Menghapus spasi berlebihan
    // Menghapus karakter non-breaking space dan karakter whitespace lainnya
    $html = trim(preg_replace('/\s+/', ' ', $html));
    return $html;
}
function update_symbol_hasil() {
    $CI =& get_instance();
    $CI->db->query("UPDATE t_pendaftaran_detail SET nilai = REPLACE(nilai, '&lt;', '< ') , kadar  = REPLACE(kadar, '&lt;', '< ') ");
    $CI->db->query("UPDATE t_pendaftaran_detail SET nilai = REPLACE(nilai, '&le;', '≤ ') , kadar  = REPLACE(kadar, '&le;', '≤ ') ");
    $CI->db->query("UPDATE t_pendaftaran_detail SET nilai = REPLACE(nilai, '&gt;', '> ') , kadar  = REPLACE(kadar, '&gt;', '> ' ) ");
    $CI->db->query("UPDATE t_pendaftaran_detail SET nilai = REPLACE(nilai, '&ge;', '≥ ') , kadar  = REPLACE(kadar, '&ge;', '≥ ') ");
}
?>
