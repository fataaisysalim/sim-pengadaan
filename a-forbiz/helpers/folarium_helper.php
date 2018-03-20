<?php

function shortext($value, $length) {
    $isi_berita = htmlentities(strip_tags($value));
    $isi1 = substr($isi_berita, 0, $length);
    $isi = substr($isi_berita, 0, strrpos($isi1, " "));
    if ($isi1 != $value) {
        $show = "$isi...";
    } else {
        $show = $value;
    }
    return $show;
}

function shortvar($value, $length) {
    $isi_berita = htmlentities(strip_tags($value));
    $isi = substr($isi_berita, 0, $length);
    if ($isi != $value) {
        $show = "$isi...";
    } else {
        $show = $value;
    }
    return $show;
}

function terbilang($x) {
    $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

    if ($x < 12) {
        return " " . $angka[$x];
    } elseif ($x < 20) {
        $x = substr($x, 1);
        return $angka[$x] . " belas";
    } elseif ($x < 100) {
        $z = substr($x, 1) == 0 ? null : $angka[substr($x, 1)];
        $y = $angka[substr($x, 0, 1)];
        return $y . " puluh " . $z;
    } elseif ($x < 1000) {
        $z = substr($x, 2) == 0 ? null : $angka[substr($x, 2)];
        $y = $angka[substr($x, 0, 1)];
        return $y . " ratus " . $z;
    } elseif ($x < 10000) {
        $z = substr($x, 3) == 0 ? null : $angka[substr($x, 3)];
        $y = $angka[substr($x, 0, 1)];
        return $y . " ribu " . $z;
    } elseif ($x < 100000) {
        $z = substr($x, 4) == 0 ? null : $angka[substr($x, 4)];
        $y = $angka[substr($x, 0, 1)];
        return $y . " puluh ribu" . $z;
    } elseif ($x < 1000000) {
        $z = substr($x, 5) == 0 ? null : $angka[substr($x, 5)];
        $y = $angka[substr($x, 0, 1)];
        return $y . " ratus ribu " . $z;
    } elseif ($x < 10000000) {
        $z = substr($x, 5) == 0 ? null : $angka[substr($x, 5)];
        $y = $angka[substr($x, 0, 1)];
        return $y . " juta " . $z;
    } elseif ($x < 100000000) {
        $z = substr($x, 6) == 0 ? null : $angka[substr($x, 6)];
        $y = $angka[substr($x, 0, 1)];
        return $y . " ratus juta " . $z;
    } elseif ($x < 1000000000) {
        $z = substr($x, 1) == 0 ? null : $angka[substr($x, 7)];
        $y = $angka[substr($x, 0, 1)];
        return $y . " miliar " . $z;
    } elseif ($x < 10000000000) {
        $z = substr($x, 1) == 0 ? null : $angka[substr($x, 8)];
        $y = $angka[substr($x, 0, 1)];
        return $y . "puluh miliar " . $z;
    } elseif ($x < 10000000000) {
        $z = substr($x, 1) == 0 ? null : $angka[substr($x, 9)];
        $y = $angka[substr($x, 0, 1)];
        return $y . "puluh miliar " . $z;
    }
}

function alphabet($number = null) {
    $result = null;
    if ($number == 0) {
        $result = "A";
    } elseif ($number == 1) {
        $result = "B";
    } elseif ($number == 2) {
        $result = "C";
    } elseif ($number == 3) {
        $result = "D";
    } elseif ($number == 4) {
        $result = "E";
    } elseif ($number == 5) {
        $result = "F";
    } elseif ($number == 6) {
        $result = "G";
    } elseif ($number == 7) {
        $result = "H";
    }
    return $result;
}

function url($s) {
    $c = array(' ');
    $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+');
    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}

function clearChar($s) {
    $d = array(' ', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+');
    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    return $s;
}

function serialDoc($value) {

    $jml = strlen($value);
    if ($jml == 1)
        $no = "000" . $value;
    if ($jml == 2)
        $no = "00" . $value;
    if ($jml == 3)
        $no = "0" . $value;
    if ($jml == 0)
        $no = "0001";

    return $no;
}

function serial_number($value) {

    $jml = strlen($value);
    if ($jml == 1)
        $no = "00000" . $value;
    if ($jml == 2)
        $no = "0000" . $value;
    if ($jml == 3)
        $no = "000" . $value;
    if ($jml == 4)
        $no = "00" . $value;
    if ($jml == 5)
        $no = "0" . $value;
    if ($jml == 6)
        $no = $value;
//    if ($jml == 7)
//        $no = $value;
    if ($jml == 0)
        $no = "000001";

    return $no;
}

function table_no($value) {

    $jml = strlen($value);
    if ($jml == 1)
        $no = "0" . $value;
    if ($jml == 2)
        $no = $value;
    if ($jml == 0)
        $no = "01";

    return "No. $no";
}

function table_no_cetak($value) {

    $jml = strlen($value);
    if ($jml == 1)
        $no = "0" . $value;
    if ($jml == 2)
        $no = $value;
    if ($jml == 0)
        $no = "01";

    return "$no";
}

function fin_code($value) {
    $jml = strlen($value);
    if ($jml == 1)
        $no = "000000" . $value;
    if ($jml == 2)
        $no = "00000" . $value;
    if ($jml == 3)
        $no = "0000" . $value;
    if ($jml == 4)
        $no = "000" . $value;
    if ($jml == 5)
        $no = "00" . $value;
    if ($jml == 6)
        $no = "0" . $value;
    if ($jml == 7)
        $no = $value;
    if ($jml == 0)
        $no = "0000001";

    return "NUP$no";
}

function fin_status($x) {
    if ($x != null) {
        if ($x == 1) {
            return '<div style="background : #d9534f; border-color: #d43f3a; color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-times mg-r-sm mg-l-md"></i> Cancel</div>';
        } else if ($x == 2) {
            return '<div style="background : #f0ad4e; border-color: #eea236;color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-minus-circle mg-r-sm mg-l-md"></i> Updated</div>';
        } else {
            return '<div style="background : #5cb85c; border-color: #4cae4c;color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-check mg-r-sm mg-l-md"></i> Verified</div>';
        }
    }
}

function status_table($x) {
    if ($x != null) {
        if ($x == 1) {
            return '<div style="background : #5cb85c; border-color: #4cae4c;color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-check mg-r-sm mg-l-md"></i>Digunakan</div>';
        } else {
            return '<div style="background : #d9534f; border-color: #d43f3a; color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-minus-circle mg-r-sm mg-l-md"></i>Kosong</div>';
        }
    } else {
        return '<div style="background : #5cb85c; border-color: #4cae4c;color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-check mg-r-sm mg-l-md"></i>Digunakan</div>';
    }
}

//
//function status_bayar($x) {
//    if ($x != null) {
//        if ($x == 0) {
//            return 'Belum Terbayar';
//        } else if ($x == 1) {
//            return 'Terbayar';
//        } else if ($x == 2) {
//            return 'Batal';
//        }
//    }
//}

function status_antar($x) {
    if ($x != null) {
        if ($x == 0) {
            return '<div style="background : #f0ad4e; border-color: #eea236;color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-minus-circle mg-r-sm mg-l-md"></i>Belum Diantar</div>';
        } else if ($x == 1) {
            return '<div style="background : #5cb85c; border-color: #4cae4c;color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-check mg-r-sm"></i>Sudah Diantar</div>';
        } else if ($x == 2) {
            return '<div style="background : #d9534f; border-color: #d43f3a; color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-minus-circle mg-r-sm"></i>Batal</div>';
        }
    }
}

function status_menu($x) {
    if ($x != null) {
        if ($x == 0) {
            return '<div style="background : #d9534f; border-color: #d43f3a; color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-minus-circle mg-r-sm"></i>Kosong</div>';
        } else if ($x == 1) {
            return '<div style="background : #5cb85c; border-color: #4cae4c;color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-check mg-r-sm"></i>Tersedia</div>';
        }
    }
}

function status_bayar($x) {
    if ($x != null) {
        if ($x == 0) {
            return '<div style="background : #d9534f; border-color: #d43f3a; color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-minus-circle mg-r-sm"></i>Belum dibayar</div>';
        } else if ($x == 1) {
            return '<div style="background : #5cb85c; border-color: #4cae4c;color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-check mg-r-sm"></i>Sudah dibayar</div>';
        } else if ($x == 3) {
            return '<div style="background : #5cb85c; border-color: #4cae4c;color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-check mg-r-sm"></i>Batal</div>';
        }
    }
}

function rupiah($jml, $dcm = null) {
    $nominal = isset($dcm) ? $dcm : 0;
    $int = empty($jml) ? 0 : number_format($jml, $nominal, ',', '.');
    return $int;
}

function timeToReal($time) {
    $y = date("H:i", strtotime($time));
    return $y;
}

function rounding($jml) {
    $int = number_format($jml, 2, ',', '.');
    $angka = explode('.', $jml);
    if ($angka[1] <= 25) {
        return $angka[0];
    } else if ($angka[1] <= 75) {
        return intval($angka[0]) + 0.5;
    } else {
        return intval($angka[0]) + 1;
    }
}

function date2mysql($dates, $time = null) {
    $date = explode('-', $dates);
    $show_time = isset($time) ? "00:00:00" : null;
    switch ($time):
        case null:
            return "$date[2]-$date[1]-$date[0]";
            break;
        default:
            return "$date[2]-$date[1]-$date[0] $show_time";
            break;
    endswitch;
}

function indo_date($date, $length = null, $show_hour = null) {
    $datetime = explode(' ', $date);

    if (empty($datetime[1])) {
        $get_hour = null;
    } else {
        if (isset($show_hour)) {
            $hour = explode(":", $datetime[1]);
            $get_hour = "/ $hour[0]:$hour[1]";
        } else {
            $get_hour = null;
        }
    }
    $tgl = explode("-", $datetime[0]);
    if ($tgl[1] == '01')
        $mo = empty($length) ? "Januari" : "Jan";
    if ($tgl[1] == '02')
        $mo = empty($length) ? "Februari" : "Feb";
    if ($tgl[1] == '03')
        $mo = empty($length) ? "Maret" : "Mar";
    if ($tgl[1] == '04')
        $mo = empty($length) ? "April" : "Apr";
    if ($tgl[1] == '05')
        $mo = "Mei";
    if ($tgl[1] == '06')
        $mo = empty($length) ? "Juni" : "Jun";
    if ($tgl[1] == '07')
        $mo = empty($length) ? "Juli" : "Jul";
    if ($tgl[1] == '08')
        $mo = empty($length) ? "Agustus" : "Agust";
    if ($tgl[1] == '09')
        $mo = empty($length) ? "September" : "Sept";
    if ($tgl[1] == '10')
        $mo = empty($length) ? "Oktober" : "Okt";
    if ($tgl[1] == '11')
        $mo = empty($length) ? "November" : "Nov";
    if ($tgl[1] == '12')
        $mo = empty($length) ? "Desember" : "Des";
    $convert = "$tgl[2] $mo $tgl[0] $get_hour";

    return $convert;
}

function calculate_date($tgl, $tgl1) {
    $tanggal = explode("-", $tgl);
    $tahun = $tanggal[0];
    $bulan = $tanggal[1];
    $hari = $tanggal[2];

    $tanggal1 = explode("-", $tgl1);
    $day = $tanggal1[2];
    $month = $tanggal1[1];
    $year = $tanggal1[0];

    $tahun = $year - $tahun;
    $bulan = $month - $bulan;
    $hari = $day - $hari;

    $jumlahHari = 0;
    $bulanTemp = ($month == 1) ? 12 : $month - 1;
    if ($bulanTemp == 1 || $bulanTemp == 3 || $bulanTemp == 5 || $bulanTemp == 7 || $bulanTemp == 8 || $bulanTemp == 10 || $bulanTemp == 12) {
        $jumlahHari = 31;
    } else if ($bulanTemp == 2) {
        if ($tahun % 4 == 0)
            $jumlahHari = 29;
        else
            $jumlahHari = 28;
    }else {
        $jumlahHari = 30;
    }

    if ($hari < 0) {
        $hari+=$jumlahHari;
        $bulan--;
    }
    if ($bulan < 0 || ($bulan == 0 && $tahun != 0)) {
        $bulan+=12;
        $tahun--;
    }
    if ($bulan == 12) {
        $bulan = 0;
        $tahun += 1;
    }
    if ($tahun == '0') {
        $tahunz = '';
    } else {
        $tahunz = $tahun . " Tahun ";
    }
    if ($bulan == '0') {
        $bulanx = null;
    } else {
        $bulanx = $bulan . " Bulan";
    }
    return $tahunz . $bulanx . $hari . " Hari";
}

function calculate_age($tgl) {
    $tanggal = explode("/", $tgl);
    $tahun = $tanggal[2];
    $bulan = $tanggal[1];
    $hari = $tanggal[0];

    $day = date('d');
    $month = date('m');
    $year = date('Y');

    $tahun = $year - $tahun;
    $bulan = $month - $bulan;
    $hari = $day - $hari;

    $jumlahHari = 0;
    $bulanTemp = ($month == 1) ? 12 : $month - 1;
    if ($bulanTemp == 1 || $bulanTemp == 3 || $bulanTemp == 5 || $bulanTemp == 7 || $bulanTemp == 8 || $bulanTemp == 10 || $bulanTemp == 12) {
        $jumlahHari = 31;
    } else if ($bulanTemp == 2) {
        if ($tahun % 4 == 0)
            $jumlahHari = 29;
        else
            $jumlahHari = 28;
    }else {
        $jumlahHari = 30;
    }

    if ($hari < 0) {
        $hari+=$jumlahHari;
        $bulan--;
    }
    if ($bulan < 0 || ($bulan == 0 && $tahun != 0)) {
        $bulan+=12;
        $tahun--;
    }
    if ($bulan == 12) {
        $bulan = 0;
        $tahun += 1;
    }
    if ($tahun == '0') {
        $tahunz = '';
    } else {
        $tahunz = $tahun . " Tahun ";
    }
    return $tahunz . $bulan . " Bulan " . $hari . " Hari";
}

function get_hour($jam) {
    $var = explode(" ", $jam);
    return $var[1];
}

function show_array($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function selisih_hari($startDate, $endDate) {
    $tgl1 = $startDate;  // 1 Oktober 2009
    $tgl2 = $endDate;  // 10 Oktober 2009
    // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
    // dari tanggal pertama
//    echo "$tgl1 $tgl2";
    $pecah1 = explode("-", $tgl1);
    $date1 = $pecah1[2];
    $month1 = $pecah1[1];
    $year1 = $pecah1[0];

    // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
    // dari tanggal kedua

    $pecah2 = explode("-", $tgl2);
    $date2 = $pecah2[2];
    $month2 = $pecah2[1];
    $year2 = $pecah2[0];

    // menghitung JDN dari masing-masing tanggal

    $jd1 = GregorianToJD($month1, $date1, $year1);
    $jd2 = GregorianToJD($month2, $date2, $year2);

    // hitung selisih hari kedua tanggal

    $selisih = $jd2 - $jd1;
    return $selisih;
}

function romawi($num) {
    switch ($num) {
        case 1:
            $romawi = 'I';
            break;
        case 2:
            $romawi = 'II';
            break;
        case 3:
            $romawi = 'III';
            break;
        case 4:
            $romawi = 'IV';
            break;
        case 5:
            $romawi = 'V';
            break;
        case 6:
            $romawi = 'VI';
            break;
        default:
            $romawi = '';
            break;
    }
    return $romawi;
}

function count_message() {
    $CI = & get_instance();
    $CI->load->model('crud_model');
    $count = $CI->crud_model->read_sg_data("message_td", array("message_status" => "0"))->num_rows();
    return $count;
}

function bold($str = NULL, $tag = NULL) {
    if (!empty($str)) {
        $tag = !empty($tag) ? $tag : "h4";
        return "<" . $tag . ">" . $str . "</" . $tag . ">";
    } else {
        return $str;
    }
}

function check_mog_inv($id = NULL) {
    if (!empty($id)) {
        $CI = & get_instance();
        $CI->load->model('crud_model');
        $data = $CI->crud_model->read_fordata(array("table" => "invoice_dt", "where" => array("md5(transaction_id)" => $id)))->num_rows();
        return $data;
    }
}

function check_wo_inv($id = NULL) {
    if (!empty($id)) {
        $CI = & get_instance();
        $CI->load->model('crud_model');
        $data = $CI->crud_model->read_fordata(array("table" => "invoice", "where" => array("md5(work_order_id)" => $id)))->num_rows();
        return $data;
    }
}

function check_inv_edit_button($inv = NULL, $wo = NULL) {
    if (!empty($inv) && !empty($wo)) {
        $CI = & get_instance();
        $CI->load->model('crud_model');
        $get_inv_wo = $CI->crud_model->read_fordata(array("table" => "invoice_wo iw", "join" => array("invoice i" => "i.invoice_id = iw.invoice_id", "work_order wo" => "wo.work_order_id = i.work_order_id"), "where" => array("i.invoice_id" => $inv)))->row();
        $inv_wo_ct = $get_inv_wo->invoice_wo_ct_id;
        $wo_status = $get_inv_wo->work_order_status;

        if ($inv_wo_ct == 1) {
            if ($wo_status == 3) {
                return 'disabled';
            }
        }

        if ($inv_wo_ct == 2) {
            $get_last_sequence = $CI->crud_model->read_fordata(array("table" => "invoice i", "join" => array("invoice_wo iw" => "iw.invoice_id = i.invoice_id"), "where" => array("work_order_id" => $wo)))->last_row();
            $inv_sequence = $get_inv_wo->invoice_wo_sequence;

            if ($wo_status === 3 OR $inv_sequence != $get_last_sequence->invoice_wo_sequence) {
                return 'disabled';
            }
        }
    }
}

function options($src, $id, $ref_val, $text_field){
	$options = '';
	foreach ($src->result() as $row) {
		$opt_value	= $row->$id;
		$text_value	= $row->$text_field;
		
		if ($row->$id == $ref_val) {
			$options .= '<option value="'.$opt_value.'" selected>'.$text_value.'</option>';
		}
		else {
			$options .= '<option value="'.$opt_value.'">'.$text_value.'</option>';
		}
	}
	return $options;
}

?>
