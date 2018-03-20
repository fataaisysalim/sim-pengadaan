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
            if ($i == 3) {
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            }
            if ($i == 8 || $i == 7) {
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
            }
            $this->Rect($x, $y, $w, $h);
            //Print the text

            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function tabelheada($data, $height) {
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
            if ($i == 0 || $i == 1) {
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
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

    function tabelnb($data, $height) {
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
            //$this->Rect($x, $y, $w, $h);
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
//            $this->Rect($x, $y, $w, $h);
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

    function tabelnbl($data, $height) {
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
            //$this->Rect($x, $y, $w, $h);
            //Print the text

            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
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
$fpdf = new PDF('L', 'cm', 'A4');
//$fpdf = new PDF('P', 'cm', "a4");
$fpdf->Open();
srand(microtime() * 1000000);
//$tanggal_indo = $cetak->set_cetak_tanggal;
//$tanggal_indo = $fpdf->indo_date($tanggal_indo);

$fpdf->AddPage();
$fpdf->SetWidths(array(16));

$fpdf->SetFont("Arial", "", 16);
$fpdf->SetXY(1, 0.5);
$fpdf->tabelnbl(array("$detail->apps_client"), 0.8);
$fpdf->SetFont("Arial", "B", 14);
$fpdf->tabelnbl(array(ucwords($project->project_name)), 0.5);
$fpdf->SetFont("Arial", "", 11);
$fpdf->tabelnbl(array("$detail->apps_address"), 0.8);
//$fpdf->SetXY(8.3, 2.5);
//$fpdf->tabel(array("lokasi"), 0.5);
$fpdf->SetWidths(array(12));
$fpdf->SetWidths(array(27.5));
$fpdf->SetX(8.3);
$fpdf->SetFont("Arial", "B", 18);
$fpdf->tabelnb(array("BAPB MONITORING SUPPLIER "), 1);
$fpdf->ln();
$fpdf->SetWidths(array(3, 8));
$fpdf->SetFont("Arial", "B", 11);
$fpdf->tabell(array("Kode Supplier", !empty($acc->actor_code) ? ": " . $acc->actor_code : ":  -"), 0.6);
$fpdf->tabell(array("Nama Supplier", ": " . ucwords($acc->actor_name)), 0.6);
$fpdf->Ln();
//$fpdf->SetWidths(array(3));
//$fpdf->SetXY(10.7, 4.3);
//$fpdf->tabel(array("Tanggal"), 0.5);
$fpdf->SetFont("Arial", "B", 11);
$fpdf->SetWidths(array(1.1, 4, 2, 8, 1.5, 3, 2, 3, 3));
$fpdf->tabelheada(array("NO", "TANGGAL", "NO BAPB", "URAIAN", "SAT", "KONVERSI", "VOLUME", "HARGA", "TOTAL"), 0.5);
$fpdf->SetWidths(array(3, 3, 3, 2.1, 2.1));
$fpdf->SetWidths(array(1.1, 4, 2, 8, 1.5, 3, 2, 3, 3));
$fpdf->SetFont("Arial", "", 10);
$total = 0;
$totala = 0;
foreach ($md as $i => $row) {

    $i++;
    if ($row->mog_dt_convertion == null OR $row->mog_dt_convertion == 0) {
        $conversi = 1;
        $convert = "-";
    } else {
        $conversi = $row->mog_dt_convertion;
        $convert = $row->mog_dt_convertion == 0?"-":  rupiah($row->mog_dt_convertion);
    }


    if ($row->mog_dt_price == null) {
        $price = 0;
    } else {
        $price = $row->mog_dt_price;
    }
    $total = ($row->mog_dt_volume * $conversi) * $price;
    $totala = $totala + $total;
    $fpdf->tabel(array("$i", indo_date($row->mog_date, 1, 1), "$row->mog_number", ucwords($row->material_sub_name), ucwords($row->material_unit_name), $convert, rupiah($row->mog_dt_volume), rupiah($price), rupiah($total)), 0.5);
}
$fpdf->SetWidths(array(24.6, 3));
$fpdf->tabelheada(array("Total Tagihan ", rupiah($totala)), 0.5);
$fpdf->Output();
?>

