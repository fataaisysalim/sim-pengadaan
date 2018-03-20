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
function tabelc($data, $height) {
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
    function tabelcontent($data, $height) {
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
            if($i==1){
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            }elseif($i==16){
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            }else{
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
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
    var $javascript; 
    var $n_js; 

    function IncludeJS($script) { 
        $this->javascript=$script; 
    } 

    function _putjavascript() { 
        $this->_newobj(); 
        $this->n_js=$this->n; 
        $this->_out('<<'); 
        $this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]'); 
        $this->_out('>>'); 
        $this->_out('endobj'); 
        $this->_newobj(); 
        $this->_out('<<'); 
        $this->_out('/S /JavaScript'); 
        $this->_out('/JS '.$this->_textstring($this->javascript)); 
        $this->_out('>>'); 
        $this->_out('endobj'); 
    } 

    function _putresources() { 
        parent::_putresources(); 
        if (!empty($this->javascript)) { 
            $this->_putjavascript(); 
        } 
    } 

    function _putcatalog() { 
        parent::_putcatalog(); 
        if (!empty($this->javascript)) { 
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>'); 
        } 
    } 

}

//Mengambil nilai dari query database
//pengaturan ukuran kertas P = Portrait
$fpdf = new PDF('L', 'cm', array(20, 17));
//$fpdf = new PDF('P', 'cm', "a4");
$fpdf->Open();
srand(microtime() * 1000000);
//$tanggal_indo = $cetak->set_cetak_tanggal;
//$tanggal_indo = $fpdf->indo_date($tanggal_indo);


$fpdf->AddPage();
$fpdf->SetWidths(array(12));
$fpdf->SetFont("TIMES", "B", 10);
//$fpdf->SetXY(8.3, 2.5);
//$fpdf->tabel(array("lokasi"), 0.5);
$fpdf->SetMargins(1.5, 0.05);
$fpdf->SetWidths(array(3.5));
$fpdf->tabelbb(array(""), 0.01);
$fpdf->SetXY(5.5,0.14);
$fpdf->SetWidths(array(10));
$fpdf->tabelbb(array(" "), 0.5);
$fpdf->SetX(5.5);
$fpdf->tabelbb(array(" "), 0.5);
$fpdf->SetFont("TIMES", "", 10);
$fpdf->SetX(5.5);
$fpdf->tabelbb(array(" "), 0.5);
$fpdf->Ln(0.5);
$fpdf->SetX(6.3);
$fpdf->SetFont("TIMES", "B", 14);
$fpdf->tabelbb(array(""), 0.7);
$fpdf->SetX(6.3);
$fpdf->SetFont("TIMES", "B", 10);
$fpdf->SetWidths(array(3.2,1.47,1.7,1.65));
$fpdf->tabelbb(array("","","",""), 0.5);
$fpdf->SetWidths(array(7.2));
$fpdf->SetX(7.5);
$fpdf->SetFont("TIMES", "", 10);
$fpdf->tabelbb(array(""), 0.5);
$fpdf->Ln(0.2);
$fpdf->SetWidths(array(1.1,5.6,2.5,2.5,1,2.5,2.9));
$fpdf->SetFont("TIMES", "B", 8);
$fpdf->tabelbb(array("","","","","","",""), 0.9);
$fpdf->SetWidths(array(1.1,5.6,0.5,0.5,0.5,0.5,0.5,0.5,0.5,0.5,0.5,0.5,1,2.5,2.9));
$fpdf->SetFont("TIMES", "B", 8);
foreach($mog as $i=>$row):
    if($row->mog_dt_convertion == null or $row->mog_dt_convertion == 0){
        $volume=$row->mog_dt_volume;
    }else{
        $volume=$row->mog_dt_volume * $row->mog_dt_convertion;
    }
    $fpdf->SetWidths(array(1.1,5.6,0.5,0.5,0.5,0.5,0.5,0.5,0.5,0.5,0.5,0.5,1,2.5,2.9));
$fpdf->tabelbbc(array("","","","","","","","","","","","","","",""), 0.5);
$y=$fpdf->GetY();
$fpdf->SetWidths(array(3));
$arr = str_split($row->code_name);
$strike="";
foreach ($arr as $i=>$word){
    $strike=$strike."".$word."     ";
}
$fpdf->SetXY(10.6, $y-0.5);
$fpdf->tabelbbc(array($strike), 0.5);
endforeach;
if($i<=7){
    $f=7-$i;
    for($j=0;$j<=$f;$j++){
        $fpdf->SetWidths(array(1.1,5.6,0.5,0.5,0.5,0.5,0.5,0.5,0.5,0.5,0.5,0.5,1,2.5,2.9));
        $fpdf->tabelbbc(array("","","","","","","","","","","","","","",""), 0.5);
    }
}
$fpdf->Ln(0.2);
//$fpdf->SetWidths(array(1.1,5.6));
//$fpdf->SetFont("TIMES", "B", 9);
//$fpdf->tabelbb(array("","DIPOTONG OPNAM"), 0.7);
//$fpdf->tabelbb(array("","TIDAK DIPOTONG OPNAM"), 0.7);
//$fpdf->SetWidths(array(4.5,4.5,4.5,4.5));
//$fpdf->tabelbbc(array("Yang Menyerahkan","Mengetahui","Menyetujui","Yang Menerima"), 0.5);
//$fpdf->Ln(1.5);
//$fpdf->tabelbbc(array("............................","............................","............................","............................"), 0.1);
//$fpdf->tabelbbc(array("Ka. Gudang","Ka. Enginering","Pelaksana Utama","Subkon/ Pelaksana"), 0.4);
//$fpdf->Rect(1.6, 10.7, 1, 0.5);
//$fpdf->Rect(1.6, 11.4, 1, 0.5);
//$fpdf->Rect(15.5, 0.12, 4, 0.4);
//$fpdf->Rect(15.5, 0.52, 4, 0.4);
//$fpdf->Rect(15.5, 0.92, 4, 0.4);
//$fpdf->SetFont("TIMES", "", 7);
//$fpdf->SetXY(15.55, 0.12);
//$fpdf->tabelbb(array("Tembusan Fungsi Akuntansi"), 0.4);
//$fpdf->SetXY(15.55, 0.52);
//$fpdf->tabelbb(array("Tembusan Fungsi Komersial"), 0.4);
//$fpdf->SetXY(15.55, 0.92);
//$fpdf->tabelbb(array("Tembusan Fungsi Gudang"), 0.4);
//$fpdf->Image(base_url() . 'assets/img/apps/' . $detail->apps_logo, 1.2, 0.1, 4, 1);
$fpdf->IncludeJS("print('true');"); 
$fpdf->Output();
?>

