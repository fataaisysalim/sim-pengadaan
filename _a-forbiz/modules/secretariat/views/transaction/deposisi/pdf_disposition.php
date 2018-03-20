<?php

//memulai pengaturan output PDF
class PDF extends FPDF {

    //untuk pengaturan header halaman

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

    function Header() {
        //Pengaturan Font Header
        $this->SetFont('Times', 'B', 14); //jenis font : Times New Romans, Bold, ukuran 14
        //untuk warna background Header
        $this->SetFillColor(255, 255, 255);
        //untuk warna text
        // $this->Image("assets/img/smakolomboTRANS.png", 5.5, 8, 10, 10);
        $this->SetTextColor(0, 0, 0);
        //Menampilkan tulisan di
        //$this->Cell(3,1,'INVOICE','',0,'C',1);
        //$this->Image('image/logo2.jpg',9,3,3,0);
        //TBLR (untuk garis)=> B = Bottom,
        // L = Left, R = Right
        //untuk garis, C = center
    }

    var $widths;
    var $aligns;

    function SetWidths($w) {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a) {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    var $angle = 0;

    function Rotate($angle, $x = -1, $y = -1) {
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle*=M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    function RotatedCell($x, $y, $txt, $angle) {
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Multicell(2, 1, $txt, 1);
        $this->Rotate(0);
    }

    function tabel($data, $height) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();

            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text

            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function tabell($data, $height) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();

            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text

            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function tabel122($data, $height) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            if ($i == 0) {
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            }
            if ($i == 1) {
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            }
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text

            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function tabellc($data, $height) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            if ($i == 3) {
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            }
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text

            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function tabelr($data, $height, $xa, $ya, $angle) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rotate($angle);
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->Rotate($angle);
            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->Rotate(0);
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
    }

    function tabelrc($data, $height, $xa, $ya, $angle) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rotate($angle);
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->Rotate($angle);
            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->Rotate(0);
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
    }

    function tabelns($data, $height) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the texts
            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
    }

    function tabelnsb($data, $height) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
//            $this->Rect($x, $y, $w, $h);
            //Print the texts
            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
    }

    function tabelnsc($data, $height) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the texts
            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
    }

    function tabelbb($data, $height) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            // $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function tabelbbc($data, $height) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            // $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt) {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l+=$cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }

}

//Mengambil nilai dari query database
//pengaturan ukuran kertas P = Portrait
$fpdf = new PDF('L', 'cm', array(26, 20.5));
$fpdf->Open();
srand(microtime() * 100000);
$tanggal_indo = $md->doc_control_date;
$tanggal_indo = $fpdf->indo_date($tanggal_indo);
$fpdf->AddPage();
$fpdf->Rect(1, 1, 24, 2);
$fpdf->Rect(1, 3, 24, 14);
//$fpdf->Rect(1, 3.021, 24, 0.45);
$fpdf->SetWidths(array(3.2, 3, 19));
$fpdf->SetFont("Arial", "b", 18);
$fpdf->Image(base_url() . 'assets/img/apps/' . $detail->apps_logo, 1.2, 1.3, 5.7, 1.4);
$fpdf->tabelbb(array("", "", strtoupper($detail->apps_client)), 1.4);
$fpdf->SetFont("Arial", "b", 11);
$fpdf->tabelbb(array("", "", strtoupper($md->project_name)), 0.2);
$fpdf->Ln(1.2);
$fpdf->SetWidths(array(8.5, 8, 7.5));
$fpdf->SetFont("Arial", "b", 12);
$fpdf->tabel(array("IDENTITAS SURAT", "DISPOSISI", "CATATAN"), 0.7);
$fpdf->SetWidths(array(4, 4.5, 1.7, 6.3));
$fpdf->SetFont("Arial", "", 12);
$fpdf->tabellc(array("Kode Masalah", "No.Disposisi", "Urutan", "Diterima tanggal : " . date("d-m-Y", strtotime($md->doc_control_date))), 0.5);
$fpdf->SetWidths(array(2, 2, 4.5, 1.7, 2.2, 1.5, 2.6));
$fpdf->SetFont("Arial", "", 12);
$fpdf->tabel(array("", "", serialDoc($md->doc_control_id), "", "Jabatan", "Paraf", "Tanggal"), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->SetFont("Arial", "", 12);
$fpdf->tabelnsb(array(""), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("1", "MP", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabelnsb(array("No. Surat : $md->doc_control_number"), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("2", "SM", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabelnsb(array(""), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("3", "MK", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabelnsb(array("Tanggal   : $tanggal_indo"), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("4", "SE", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabelnsb(array(""), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("5", "KOM", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabel(array(""), 0.01);
$fpdf->SetFont("Arial", "", 12);
$fpdf->tabelnsb(array(""), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("6", "KSKA", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabelnsb(array("Pengirim  : " . ucwords($md->actor_name)), -0.3);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("7", "ENG", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabelnsb(array(""), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("8", "QC", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabelnsb(array(""), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("9", "PU STR", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabel(array(""), 0.01);
$fpdf->SetFont("Arial", "", 12);
$fpdf->tabelnsb(array("Perihal     : " . ucwords($md->doc_control_case)), 0.7);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("10", "PU ARS", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabelnsb(array(""), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("11", "PU MEP", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabelnsb(array(""), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("12", "DANLAT", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabelnsb(array(""), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("13", "GUDANG", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabelnsb(array(""), 0.5);
$fpdf->SetWidths(array(1.7, 2.2, 1.5, 2.6));
$fpdf->tabel122(array("14", "DLL", "", ""), 0.5);
$fpdf->SetWidths(array(8.5));
$fpdf->tabel(array(""), 0.01);
$fpdf->SetFont("Arial", "b", 12);
$fpdf->SetWidths(array(16.5));
$fpdf->tabelnsb(array("Catatan Sekretariat :"), 0.8);
$fpdf->SetWidths(array(0.01));
$fpdf->tabel(array(""), 1);
$fpdf->SetFont("Arial", "", 11);
$fpdf->SetWidths(array(16.5));
$fpdf->tabelnsb(array(!empty($md->doc_control_desc) ? $md->doc_control_desc : ""), 0.5);
$fpdf->SetWidths(array(0.01));
$fpdf->tabel(array(""), 3.45);
$fpdf->Output();
?>

