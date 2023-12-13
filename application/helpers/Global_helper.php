<?php

if (!function_exists('isPlatExist')) {
    function isPlatExist($platNomor)
    {
        $ci = &get_instance();
        $res = $ci->db->query("SELECT count(id_bus) as res from master_bus where nomor_plat_kendaraan='$platNomor'")->row()->res;
        if ($res) {
            return true;
        }
        return false;
    }
}
if (!function_exists('isUsernameExist')) {
    function isUsernameExist($username)
    {
        $ci = &get_instance();
        $res = $ci->db->query("SELECT count(id_user) as res from user where username='$username'")->row()->res;
        if ($res) {
            return true;
        }
        return false;
    }
}
if (!function_exists('isAdminLeftOne')) {
    function isAdminLeftOne()
    {
        $ci = &get_instance();
        $res = $ci->db->query("SELECT count(id_user) as res from user where role=1")->row()->res;
        if ($res == 1) {
            return true;
        }
        return false;
    }
}
if (!function_exists('responseOK')) {
    function responseOK($message = null, $data = null)
    {
        $ci = &get_instance();
        return $ci->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'messages' => $message,
                'data' => $data
            )));
    }
}
if (!function_exists('responseBAD')) {
    function responseBAD($message = null)
    {
        $ci = &get_instance();
        return $ci->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode(array(
                'messages' => $message,
            )));
    }
}
function vigenereCipher($inputText,  $mode = 'encrypt')
{
    $key = VIGENERE_CIPHER_KEY;
    $result = '';
    $inputText = strtoupper($inputText);
    $key = strtoupper($key);
    $keyLength = strlen($key);
    $inputLength = strlen($inputText);

    for ($i = 0; $i < $inputLength; $i++) {
        $inputChar = ord($inputText[$i]);
        $keyChar = ord($key[$i % $keyLength]);

        if ($inputChar >= 65 && $inputChar <= 90) {
            if ($mode === 'encrypt') {
                $encryptedChar = ($inputChar + $keyChar - 130) % 26 + 65;
            } else {
                $encryptedChar = ($inputChar - $keyChar + 26) % 26 + 65;
            }
            $result .= chr($encryptedChar);
        } else {
            $result .= $inputText[$i];
        }
    }
    return removeNonAlphanumeric($result);
}
function removeNonAlphanumeric($inputString)
{
    $cleanedString = preg_replace('/[^a-zA-Z0-9]/', '', $inputString);
    return $cleanedString;
}
function calculateAge($birthdate)
{
    $birthDate = new DateTime($birthdate);
    $currentDate = new DateTime();
    $ageInterval = $currentDate->diff($birthDate);
    return $ageInterval->y;
}
if (!function_exists('getDetailBus')) {
    function getDetailBus($id_bus)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * from master_bus where id_bus='$id_bus'")->row();
    }
}
if (!function_exists('convertStatusRampcheck')) {
    function convertStatusRampcheck($status)
    {
        if ($status == 1) {
            return '<span class="badge badge-success">Laik Jalan</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-warning">Peringatan / Perbaiki</span>';
        }
        if ($status == 3) {
            return '<span class="badge badge-danger">Dilarang Operasional</span>';
        }
        if ($status == 4) {
            return '<span class="badge badge-danger">Tilang & Dilarang Operasional</span>';
        }
    }
}
if (!function_exists('convertStatusRampchecktoText')) {
    function convertStatusRampchecktoText($status)
    {
        if ($status == 1) {
            return 'Laik Jalan';
        }
        if ($status == 2) {
            return 'Peringatan / Perbaiki';
        }
        if ($status == 3) {
            return 'Dilarang Operasional';
        }
        if ($status == 4) {
            return 'Tilang & Dilarang Operasional';
        }
    }
}
if (!function_exists('limitText')) {
    function limitText($text)
    {
        $limit = 15;
        if (strlen($text) <= $limit) {
            return $text;
        } else {
            $text = substr($text, 0, $limit) . '...';
            return $text;
        }
    }
}
if (!function_exists('getTotalBus')) {
    function getTotalBus()
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT count(id_bus) as res from master_bus")->row()->res;
    }
}
if (!function_exists('getTotalSopir')) {
    function getTotalSopir()
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT count(id_sopir) as res from master_sopir")->row()->res;
    }
}
if (!function_exists('getTotalRampcheck')) {
    function getTotalRampcheck()
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT count(id_rampcheck) as res from rampcheck")->row()->res;
    }
}
if (!function_exists('getTotalCheckerAndroid')) {
    function getTotalCheckerAndroid()
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT count(id_user) as res from user where role=2")->row()->res;
    }
}
if (!function_exists('getGrafikDonat')) {
    function getGrafikDonat()
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS satu, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS dua, SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS tiga, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS empat FROM rampcheck;")->row();
    }
}
if (!function_exists('getGrafikChart')) {
    function getGrafikChart()
    {
        $ci = &get_instance();
        return $ci->db->query("
        SELECT
    date_range.date AS tanggal,
    COALESCE(COUNT(rampcheck.tanggal_pemeriksaan), 0) AS jumlah_data
FROM (
    SELECT CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS date
    FROM (
        SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
    ) AS a
    CROSS JOIN (
        SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
    ) AS b
    CROSS JOIN (
        SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
    ) AS c
) AS date_range
LEFT JOIN rampcheck ON DATE(rampcheck.tanggal_pemeriksaan) = date_range.date
WHERE date_range.date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
GROUP BY date_range.date
ORDER BY date_range.date;
        ")->result();
    }
}
if (!function_exists('convertStatusAdministrasi')) {
    function convertStatusAdministrasi($status)
    {
        if ($status == 1) {
            return '<span class="badge badge-success">Ada, Berlaku</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-danger">Tidak Berlaku</span>';
        }
        if ($status == 3) {
            return '<span class="badge badge-danger">Tidak Ada</span>';
        }
        if ($status == 4) {
            return '<span class="badge badge-danger">Tidak Sesuai Fisik</span>';
        }
        return '<span class="badge badge-secondary">Belum di isi</span>';
    }
}
if (!function_exists('convertStatusSim')) {
    function convertStatusSim($status)
    {
        if ($status == 11) {
            return '<span class="badge badge-success">A Umum</span>';
        }
        if ($status == 12) {
            return '<span class="badge badge-success">B1 Umum</span>';
        }
        if ($status == 13) {
            return '<span class="badge badge-success">B2 Umum</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-danger">SIM Tidak Sesuai</span>';
        }
        return '<span class="badge badge-secondary">Belum di isi</span>';
    }
}
if (!function_exists('convertLampu')) {
    function convertLampu($status)
    {
        if ($status == 1) {
            return '<span class="badge badge-success">Menyala</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-danger">Tidak Menyala</span>';
        }
        return '<span class="badge badge-secondary">Belum di isi</span>';
    }
}
if (!function_exists('convertRem')) {
    function convertRem($status)
    {
        if ($status == 1) {
            return '<span class="badge badge-success">Berfungsi</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-danger">Tidak Berfungsi</span>';
        }
        return '<span class="badge badge-secondary">Belum di isi</span>';
    }
}
if (!function_exists('convertKaca')) {
    function convertKaca($status)
    {
        if ($status == 1) {
            return '<span class="badge badge-success">Baik</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-danger">Buruk</span>';
        }
        return '<span class="badge badge-secondary">Belum di isi</span>';
    }
}
if (!function_exists('convertBan')) {
    function convertBan($status)
    {
        if ($status == 1) {
            return '<span class="badge badge-success">Laik</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-danger">Tidak Laik</span>';
        }
        return '<span class="badge badge-secondary">Belum di isi</span>';
    }
}
if (!function_exists('convertSabuk')) {
    function convertSabuk($status)
    {
        if ($status == 1) {
            return '<span class="badge badge-success">Ada dan Fungsi</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-danger">Tidak Fungsi</span>';
        }
        if ($status == 3) {
            return '<span class="badge badge-danger">Tidak Ada</span>';
        }
        return '<span class="badge badge-secondary">Belum di isi</span>';
    }
}
if (!function_exists('convertDarurat')) {
    function convertDarurat($status)
    {
        if ($status == 1) {
            return '<span class="badge badge-success">Ada</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-danger">Tidak Ada</span>';
        }
        return '<span class="badge badge-secondary">Belum di isi</span>';
    }
}
if (!function_exists('convertSpion')) {
    function convertSpion($status)
    {
        if ($status == 1) {
            return '<span class="badge badge-success">Sesuai</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-danger">Tidak Sesuai</span>';
        }
        return '<span class="badge badge-secondary">Belum di isi</span>';
    }
}

if (!function_exists('convertLantai')) {
    function convertLantai($status)
    {
        if ($status == 1) {
            return '<span class="badge badge-success">Baik</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-danger">Keropos/Berlubang</span>';
        }
        return '<span class="badge badge-secondary">Belum di isi</span>';
    }
}
if (!function_exists('convertBanCadangan')) {
    function convertBanCadangan($status)
    {
        if ($status == 1) {
            return '<span class="badge badge-success">Ada dan Laik</span>';
        }
        if ($status == 2) {
            return '<span class="badge badge-danger">Tidak Laik</span>';
        }
        if ($status == 3) {
            return '<span class="badge badge-danger">Tidak Ada</span>';
        }
        return '<span class="badge badge-secondary">Belum di isi</span>';
    }
}
if (!function_exists('getDashboardAndroid')) {
    function getDashboardAndroid()
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT 
        SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS satu, 
        SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS dua, 
        SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS tiga, 
        SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS empat,
        (SELECT COUNT(id_rampcheck) FROM rampcheck) AS res 
    FROM rampcheck;")->row();
    }
}
if (!function_exists('getUserById')) {
    function getUserById($id_user)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * FROM user where id_user=$id_user")->row();
    }
}
if (!function_exists('getPenyidik')) {
    function getPenyidik()
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * FROM master_struktural where id_struktural=1")->row();
    }
}
if (!function_exists('getBusById')) {
    function getBusById($id_bus)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * FROM master_bus where id_bus='$id_bus'")->row();
    }
}
if (!function_exists('getSopirById')) {
    function getSopirById($id_sopir)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * FROM master_sopir where id_sopir=$id_sopir")->row();
    }
}
if (!function_exists('generateStatusRampcheck')) {
    function generateStatusRampcheck($data)
    {
        if ($data['kartu_uji_stuk'] != 1 || $data['kp_reguler'] != 1 || $data['kp_cadangan'] != 1 || $data['sim_pengemudi'] == 2) {
            return 4;
        }
        if (
            $data['lampu_dekat_kanan'] != 1 ||
            $data['lampu_dekat_kiri'] != 1 ||
            $data['lampu_jauh_kanan'] != 1 ||
            $data['lampu_jauh_kiri'] != 1 ||
            $data['lampu_sein_depan_kanan'] != 1 ||
            $data['lampu_sein_depan_kiri'] != 1 ||
            $data['lampu_sein_belakang_kanan'] != 1 ||
            $data['lampu_sein_belakang_kiri'] != 1 ||
            $data['lampu_rem_kanan'] != 1 ||
            $data['lampu_rem_kiri'] != 1 ||
            $data['lampu_mundur_kanan'] != 1 ||
            $data['lampu_mundur_kiri'] != 1 ||
            $data['rem_utama'] != 1 ||
            $data['rem_parkir'] != 1 ||
            $data['kaca_depan'] != 1 ||
            $data['pintu_utama_depan'] != 1 ||
            $data['pintu_utama_belakang'] != 1 ||
            $data['ban_depan_kanan'] != 1 ||
            $data['ban_depan_kiri'] != 1 ||
            $data['ban_belakang_kanan'] != 1 ||
            $data['ban_belakang_kiri'] != 1 ||
            $data['sabuk_keselamatan'] != 1 ||
            $data['pengukur_kecepatan'] != 1 ||
            $data['penghapus_kaca'] != 1 ||
            $data['pintu_darurat'] != 1 ||
            $data['jendela_darurat'] != 1 ||
            $data['alat_pemecah_kaca'] != 1
        ) {
            return 3;
        }
        if (
            $data['lampu_posisi_depan_kanan'] != 1 ||
            $data['lampu_posisi_depan_kiri'] != 1 ||
            $data['lampu_posisi_belakang_kanan'] != 1 ||
            $data['lampu_posisi_belakang_kiri'] != 1 ||
            $data['kaca_spion'] != 1 ||
            $data['klakson'] != 1 ||
            $data['lantai_dan_tangga'] != 1 ||
            $data['jalan_tempat_duduk_penumpang'] != 1 ||
            $data['ban_cadangan'] != 1 ||
            $data['segitiga_pengaman'] != 1 ||
            $data['dongkrak'] != 1 ||
            $data['pembuka_roda'] != 1 ||
            $data['lampu_senter'] != 1
        ) {
            return 2;
        }
        return 1;
    }
}
if (!function_exists('getValueForStatusAdministrasi')) {
    function getValueForStatusAdministrasi($string)
    {
        $mapping = [
            'Ada, Berlaku' => 1,
            'Tidak Berlaku' => 2,
            'Tidak Ada' => 3,
            'Tidak Sesuai Fisik' => 4
        ];

        return $mapping[$string] ?? null;
    }
}
if (!function_exists('getValueForStatusSim')) {
    function getValueForStatusSim($string)
    {
        $mapping = [
            'A UMUM' => 11,
            'B1 UMUM' => 12,
            'B2 UMUM' => 13,
            'SIM Tidak Sesuai' => 2
        ];

        return $mapping[$string] ?? null;
    }
}
if (!function_exists('getValueForStatusLampu')) {
    function getValueForStatusLampu($string)
    {
        if ($string == 'Semua Menyala') {
            $result = [
                'kanan' => 1,
                'kiri' => 1
            ];
            return $result;
        }
        if ($string == 'Kanan Tidak Menyala') {
            $result = [
                'kanan' => 2,
                'kiri' => 1
            ];
            return $result;
        }
        if ($string == 'Kiri Tidak Menyala') {
            $result = [
                'kanan' => 1,
                'kiri' => 2
            ];
            return $result;
        }
        if ($string == 'Kiri dan Kanan Tidak Menyala') {
            $result = [
                'kanan' => 2,
                'kiri' => 2
            ];
            return $result;
        }
        $result = [
            'kanan' => null,
            'kiri' => null
        ];
        return $result;
    }
}
if (!function_exists('getValueForStatusPengereman')) {
    function getValueForStatusPengereman($string)
    {
        $mapping = [
            'Berfungsi' => 1,
            'Tidak Berfungsi' => 2,
        ];
        return $mapping[$string] ?? null;
    }
}
if (!function_exists('getValueForStatusKondisiKacaDepan')) {
    function getValueForStatusKondisiKacaDepan($string)
    {
        $mapping = [
            'Baik' => 1,
            'Buruk' => 2,
        ];
        return $mapping[$string] ?? null;
    }
}
if (!function_exists('getValueForStatusPintuUtama')) {
    function getValueForStatusPintuUtama($string)
    {
        if ($string == 'Semua Berfungsi') {
            $result = [
                'depan' => 1,
                'belakang' => 1
            ];
            return $result;
        }
        if ($string == 'Depan Tidak Berfungsi') {
            $result = [
                'depan' => 2,
                'belakang' => 1
            ];
            return $result;
        }
        if ($string == 'Belakang Tidak Berfungsi') {
            $result = [
                'depan' => 1,
                'belakang' => 2
            ];
            return $result;
        }
        if ($string == 'Depan dan Belakang Tidak Berfungsi') {
            $result = [
                'depan' => 2,
                'belakang' => 2
            ];
            return $result;
        }
        $result = [
            'depan' => null,
            'belakang' => null
        ];
        return $result;
    }
}
if (!function_exists('getValueForStatusKondisiBan')) {
    function getValueForStatusKondisiBan($string)
    {
        if ($string == 'Semua Laik') {
            $result = [
                'kanan' => 1,
                'kiri' => 1
            ];
            return $result;
        }
        if ($string == 'Kanan Tidak Laik') {
            $result = [
                'kanan' => 2,
                'kiri' => 1
            ];
            return $result;
        }
        if ($string == 'Kiri Tidak Laik') {
            $result = [
                'kanan' => 1,
                'kiri' => 2
            ];
            return $result;
        }
        if ($string == 'Kiri dan Kanan Tidak Laik') {
            $result = [
                'kanan' => 2,
                'kiri' => 2
            ];
            return $result;
        }
        $result = [
            'kanan' => null,
            'kiri' => null
        ];
        return $result;
    }
}
if (!function_exists('getValueForStatusPerlengkapan')) {
    function getValueForStatusPerlengkapan($string)
    {
        $mapping = [
            'Ada dan Fungsi' => 1,
            'Tidak Berfungsi' => 2,
            'Tidak Ada' => 3,
        ];
        return $mapping[$string] ?? null;
    }
}
if (!function_exists('getValueForStatusTanggapDarurat')) {
    function getValueForStatusTanggapDarurat($string)
    {
        $mapping = [
            'Ada' => 1,
            'Tidak Ada' => 2,
        ];
        return $mapping[$string] ?? null;
    }
}
if (!function_exists('getValueForStatusKacaSpion')) {
    function getValueForStatusKacaSpion($string)
    {
        $mapping = [
            'Sesuai' => 1,
            'Tidak Sesuai' => 2,
        ];
        return $mapping[$string] ?? null;
    }
}
if (!function_exists('getValueForStatusKlakson')) {
    function getValueForStatusKlakson($string)
    {
        $mapping = [
            'Ada' => 1,
            'Tidak Berfungsi' => 2,
            'Tidak Ada' => 3,
        ];
        return $mapping[$string] ?? null;
    }
}
if (!function_exists('getValueForStatusLantaiDanTangga')) {
    function getValueForStatusLantaiDanTangga($string)
    {
        $mapping = [
            'Baik' => 1,
            'Keropos/Berlubang' => 2,
        ];
        return $mapping[$string] ?? null;
    }
}
if (!function_exists('getValueForStatusBanCadangan')) {
    function getValueForStatusBanCadangan($string)
    {
        $mapping = [
            'Ada dan Laik' => 1,
            'Tidak Laik' => 2,
            'Tidak Ada' => 3
        ];
        return $mapping[$string] ?? null;
    }
}
if (!function_exists('getValueForStatusLampuSenter')) {
    function getValueForStatusLampuSenter($string)
    {
        $mapping = [
            'Ada' => 1,
            'Tidak Berfungsi' => 2,
            'Tidak Ada' => 3
        ];
        return $mapping[$string] ?? null;
    }
}
if (!function_exists('generateRampcheckId')) {
    function generateRampcheckId()
    {
        $ci = &get_instance();
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $result = $ci->db->query("SELECT * FROM rampcheck WHERE month(tanggal_pemeriksaan)=$month and YEAR(tanggal_pemeriksaan)=$year and DAY(tanggal_pemeriksaan)=$day ")->num_rows();
        if ($result == 0) {
            return date("Ymd") . "00001";
        }
        $result++;
        return date("Ymd") . sprintf("%05s", $result);
    }
}
if (!function_exists('hariIndo')) {
    function hariIndo($hari)
    {
        $dayList = array(
            'Sun' => 'MINGGU',
            'Mon' => 'SENIN',
            'Tue' => 'SELASA',
            'Wed' => 'RABU',
            'Thu' => 'KAMIS',
            'Fri' => 'JUMAT',
            'Sat' => 'SABTU'
        );
        return $dayList[$hari];
    }
}
if (!function_exists('ubahFormat')) {
    function ubahFormat($string)
    {
        $string = str_replace('_', ' ', $string);
        $string = ucwords($string);
        return $string;
    }
}

if (!function_exists('terbilangHari')) {
    function terbilangHari($date)
    {
        $day = date('D', strtotime($date));
        return hariIndo($day);
    }
}
if (!function_exists('getTanggal')) {
    function getTanggal($date)
    {
        $day = date('d', strtotime($date));
        return $day;
    }
}
if (!function_exists('getJam')) {
    function getJam($date)
    {
        $clock = date('h:m:s', strtotime($date));
        return $clock;
    }
}
if (!function_exists('getTahun')) {
    function getTahun($date)
    {
        $y = date('Y', strtotime($date));
        return $y;
    }
}
if (!function_exists('terbilangBulan')) {
    function terbilangBulan($date)
    {
        $month = date('m', strtotime($date));
        return strtoupper(bulan($month));
    }
}
if (!function_exists('terbilangTahun')) {
    function terbilangTahun($date)
    {
        $years = date('Y', strtotime($date));
        $angka = array(
            '2020' => 'DUA RIBU DUA PULUH',
            '2021' => 'DUA RIBU DUA PULUH SATU',
            '2022' => 'DUA RIBU DUA PULUH DUA',
            '2023' => 'DUA RIBU DUA PULUH TIGA',
            '2024' => 'DUA RIBU DUA PULUH EMPAT',
            '2025' => 'DUA RIBU DUA PULUH LIMA',
            '2026' => 'DUA RIBU DUA PULUH ENAM',
            '2027' => 'DUA RIBU DUA PULUH TUJUH',
            '2028' => 'DUA RIBU DUA PULUH DELAPAN',
            '2029' => 'DUA RIBU DUA PULUH SEMBILAN',
            '2030' => 'DUA RIBU TIGA PULUH',
            '2031' => 'DUA RIBU TIGA PULUH SATU',
            '2032' => 'DUA RIBU TIGA PULUH DUA',
            '2033' => 'DUA RIBU TIGA PULUH TIGA',
            '2034' => 'DUA RIBU TIGA PULUH EMPAT',
            '2035' => 'DUA RIBU TIGA PULUH LIMA',
            '2036' => 'DUA RIBU TIGA PULUH ENAM',
            '2037' => 'DUA RIBU TIGA PULUH TUJUH',
            '2038' => 'DUA RIBU TIGA PULUH DELAPAN',
            '2039' => 'DUA RIBU TIGA PULUH SEMBILAN',
            '2040' => 'DUA RIBU EMPAT PULUH',
            '2041' => 'DUA RIBU EMPAT PULUH SATU',
            '2042' => 'DUA RIBU EMPAT PULUH DUA',
            '2043' => 'DUA RIBU EMPAT PULUH TIGA',
            '2044' => 'DUA RIBU EMPAT PULUH EMPAT',
            '2045' => 'DUA RIBU EMPAT PULUH LIMA',
            '2046' => 'DUA RIBU EMPAT PULUH ENAM',
            '2047' => 'DUA RIBU EMPAT PULUH TUJUH',
            '2048' => 'DUA RIBU EMPAT PULUH DELAPAN',
            '2049' => 'DUA RIBU EMPAT PULUH SEMBILAN',
            '2050' => 'DUA RIBU LIMA PULUH',
        );
        return $angka[$years];
    }
}
if (!function_exists('bulan')) {
    function bulan($bulan)
    {
        switch ($bulan) {
            case 1:
                $bulan = "Januari";
                break;
            case 2:
                $bulan = "Februari";
                break;
            case 3:
                $bulan = "Maret";
                break;
            case 4:
                $bulan = "April";
                break;
            case 5:
                $bulan = "Mei";
                break;
            case 6:
                $bulan = "Juni";
                break;
            case 7:
                $bulan = "Juli";
                break;
            case 8:
                $bulan = "Agustus";
                break;
            case 9:
                $bulan = "September";
                break;
            case 10:
                $bulan = "Oktober";
                break;
            case 11:
                $bulan = "November";
                break;
            case 12:
                $bulan = "Desember";
                break;
            default:
                $bulan = Date('F');
                break;
        }
        return $bulan;
    }
}
if (!function_exists('terbilangTanggal')) {
    function terbilangTanggal($date)
    {
        $day = date('d', strtotime($date));
        $angka = array(
            '01' => 'SATU',
            '02' => 'DUA',
            '03' => 'TIGA',
            '04' => 'EMPAT',
            '05' => 'LIMA',
            '06' => 'ENAM',
            '07' => 'TUJUH',
            '08' => 'DELAPAN',
            '09' => 'SEMBILAN',
            '10' => 'SEPULUH',
            '11' => 'SEBELAS',
            '12' => 'DUA BELAS',
            '13' => 'TIGA BELAS',
            '14' => 'EMPAT BELAS',
            '15' => 'LIMA BELAS',
            '16' => 'ENAM BELAS',
            '17' => 'TUJUH BELAS',
            '18' => 'DELAPAN BELAS',
            '19' => 'SEMBILAN BELAS',
            '20' => 'DUA PULUH',
            '21' => 'DUA PULUH SATU',
            '22' => 'DUA PULUH DUA',
            '23' => 'DUA PULUH TIGA',
            '24' => 'DUA PULUH EMPAT',
            '25' => 'DUA PULUH LIMA',
            '26' => 'DUA PULUH ENAM',
            '27' => 'DUA PULUH TUJUH',
            '28' => 'DUA PULUH DELAPAN',
            '29' => 'DUA PULUH SEMBILAN',
            '30' => 'TIGA PULUH',
            '31' => 'TIGA PULUH SATU',
        );
        return $angka[$day];
    }
}
