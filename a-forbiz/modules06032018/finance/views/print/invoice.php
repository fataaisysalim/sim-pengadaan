
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
            //$this->Rect($x, $y, $w, $h);
            //Print the texts
            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
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

    function tabelheadcustom($data, $height) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        if ($i = 1) {
            $height = 0.25;
        } elseif ($i = 2) {
            $height = 0.5;
        } elseif ($i = 3) {
            $height = 0.25;
        } elseif ($i = 4) {
            $height = 0.5;
        } else {
            $height = 0.5;
        }
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
            if ($i == 1) {
                $h = 0.5;
            } elseif ($i == 2) {
                $h = 1;
            } elseif ($i == 3) {
                $h = 0.5;
            } elseif ($i == 4) {
                $h = 1;
            } else {
                $h = 1;
            }
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text

            $this->MultiCell($w, 0.5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function tabelrr($data, $height) {
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
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
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

    function tabelbbcustom($data, $height) {
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
            if ($i == 2) {
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
            }
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

    function tabelbbr($data, $height) {
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
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
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
        $this->javascript = $script;
    }

    function _putjavascript() {
        $this->_newobj();
        $this->n_js = $this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) ' . ($this->n + 1) . ' 0 R ]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS ' . $this->_textstring($this->javascript));
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
        if (isset($this->javascript)) {
            $this->_out('/Names <</JavaScript ' . ($this->n_js) . ' 0 R>>');
        }
    }

    function AutoPrint($dialog = false) {
        //Embed some JavaScript to show the print dialog or start printing immediately
        $param = ($dialog ? 'true' : 'false');
        $script = "print($param);";
        $this->IncludeJS($script);
    }

    function convert_number_to_words($number) {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

}

//Mengambil nilai dari query database
//pengaturan ukuran kertas P = Portrait
$fpdf = new PDF('P', 'cm', 'a4half');
define("MAJOR", 'Rupiah');
define("MINOR", 'p');

class toWords  {
           var $pounds;
           var $pence;
           var $major;
           var $minor;
           var $words = '';
           var $number;
           var $magind;
           var $units = array('','satu','dua','tiga','empat','lima','enam','tujuh','delapan','sembilan');
           var $teens = array('sepuluh','sebelas','dua belas','tiga belas','empat belas','lima belas','enam belas','tujuh belas','delapan belas','sembilan belas');
           var $tens = array('','sepuluh','dua puluh','tiga puluh','empat puluh','lima puluh','enam puluh','tujuh puluh','delapan puluh','sembilan puluh');
           var $mag = array('','ribu','juta','miliar','triliun');

    function toWords($amount, $major=MAJOR, $minor=MINOR) {
             $this->major = $major;
             $this->minor = $minor;
             $this->number = number_format($amount,2);
             list($this->pounds,$this->pence) = explode('.',$this->number);
             $this->words = " $this->major ";
             if ($this->pounds==0){
                 $this->words = "Zero $this->words";
             }else {
                 $groups = explode(',',$this->pounds);
                 $groups = array_reverse($groups);
                 for ($this->magind=0; $this->magind<count($groups); $this->magind++) {
                      if (($this->magind==1)&&(strpos($this->words,'ratus') === false)&&($groups[0]!='000'))
                           $this->words = ' and ' . $this->words;
                      $this->words = $this->_build($groups[$this->magind]).$this->words;
                 }
             }
    }

    function _build($n) {

             $res = '';
             $na = str_pad("$n",3,"0",STR_PAD_LEFT);
             if ($na == '000') return '';
             if ($na{0} != 0)
                 $res =  'ratus';
             if ($na{0} == '100') 
                 $res = ' seratus';
             if (($na{1}=='0')&&($na{2}=='0'))
                  return $res . ' ' . $this->mag[$this->magind];
             $res .= $res==''? '' : ' and';
     
             $t = (int)$na{1}; $u = (int)$na{2};
             switch ($t) {
                     case 0: $res .= ' ' . $this->units[$u]; break;
                     case 1: $res .= ' ' . $this->teens[$u]; break;
                     default:$res .= ' ' . $this->tens[$t] . ' ' . $this->units[$u] ; break;
             }
             $res .= ' ' . $this->mag[$this->magind];
             return $res;

        $res = '';
        $na = str_pad("$n", 3, "0", STR_PAD_LEFT);
        if ($na == '000')
            return '';
        if ($na{0} != 0)
            $res = ' seratus';
        if ($na == '100')
            $res = ' seratus';
        if (($na{1} == '0') && ($na{2} == '0'))
            return $res . ' ' . $this->mag[$this->magind];
        $res .= $res == '' ? '' : '';

        $t = (int) $na{1};
        $u = (int) $na{2};
        switch ($t) {
            case 0: $res .= ' ' . $this->units[$u];
                break;
            case 1: $res .= ' ' . $this->teens[$u];
                break;
            default:$res .= ' ' . $this->tens[$t] . ' ' . $this->units[$u];
                break;
        }
        $res .= ' ' . $this->mag[$this->magind];
        return $res;

    }

}
class Terbilang
    {
        private $bil;
        
        public function __construct()
        {
            $this->bil = 0;
        }
        
        public function terbilang($n)
        {
            $this->bil = $n;
            $bilangan = array("nol","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas");
            
            if($this->bil < 12)             
            {                 
                return $bilangan[$this->bil];
            }
            else if($this->bil < 20)             
            {                 
                $b = $this->bil % 10;
                return $this->terbilang($b)." belas ";
            }
            else if($this->bil < 100)             
            {                 
                $b = $this->bil % 10;
                $c = $this->bil / 10;
                
                if($b == 0)
                {
                    return $this->terbilang($c). " puluh ";
                }
                else
                {
                    return $this->terbilang($c). " puluh ".$bilangan[$b];
                }
            }
            else if($this->bil < 200)             
           {                 
                $b = $this->bil % 100;
                $str = "";
                if($b == 0)
                {
                    return "seratus ";
                }
                else
                {
                    return "seratus ".$this->terbilang($b);
                }
            }
            else if($this->bil < 1000)             
            {                 
                $b = $this->bil % 100;
                $c = $this->bil / 100;
                
                if($b == 0)
                {
                    return $bilangan[$c]. " ratus ";
                }
                else
                {
                    return $bilangan[$c]. " ratus ".$this->terbilang($b);
                }
            }
            else if($this->bil < 2000)             
            {                 
                $b = $this->bil % 1000;
                $str = "";
                if($b == 0)
                {
                    return "seribu ";
                }
                else
                {
                    return "seribu ".$this->terbilang($b);
                }
            }
            else if($this->bil < 1000000)             
            {                 
                $b = $this->bil % 1000;
                $c = $this->bil / 1000;
                
                if($b == 0)
                {
                    return $this->terbilang($c). " ribu ";
                }
                else
                {
                    return $this->terbilang($c). " ribu ".$this->terbilang($b);
                }
            }
            else if($this->bil < 1000000000)             
            {                 
                $b = $this->bil % 1000000;
                $c = $this->bil / 1000000;
                
                if($b == 0)
                {
                    return $this->terbilang($c). " juta ";
                }
                else
                {
                    return $this->terbilang($c). " juta ".$this->terbilang($b);
                }
            }
            else if($this->bil == 1000000000)
            {
                return $this->terbilang($this->bil / 1000000000) . " milyar ";
            }
            else
            {
                return "Maksimal bilangan 1 milyar";
            }
        }
    }
    $a = new Terbilang();
$fpdf->Open();
srand(microtime() * 1000000);
//$tanggal_indo = $cetak->set_cetak_tanggal;
//$tanggal_indo = $fpdf->indo_date($tanggal_indo);
$page = 0;
$pages = 0;
$fpdf->AddPage();
$fpdf->Image(base_url() . 'assets/img/apps/' . $detail->apps_logo, 1.2, 1.3, 4.7, 1);
//$page=$page+1;
//$fpdf->SetXY(19.5, 0.2);
//$fpdf->SetWidths(array(0.5));
//$fpdf->tabel(array($page), 0.5);
$fpdf->SetWidths(array(4.7));
$fpdf->SetFont("Arial", "", 11);
$fpdf->tabelbb(array(""), 1.5);
$fpdf->SetXY(16, 1);
$fpdf->SetFont("Arial", "", 7);
$fpdf->tabelbb(array("$detail->apps_address"), 0.5);
$fpdf->SetX(16);

$fpdf->SetWidths(array(4.7));
$fpdf->tabelbb(array("Telp. $detail->apps_phone"), 0.5);
$fpdf->SetWidths(array(19));
$fpdf->Ln(0.1);
$fpdf->SetFont("Arial", "", 12);
$fpdf->tabelbbc(array("TANDA TERIMA BERKAS TAGIHAN"), 1);
$fpdf->SetFont("Arial", "", 10);
$fpdf->tabelbb(array("Telah diterima berkas tagihan dari : $invoice->actor_name"), 0.6);
$fpdf->tabelbb(array("Untuk Proyek : $invoice->project_name"), 0.6);
$fpdf->tabelbb(array("Yang terdiri dari : "), 0.6);
$fpdf->tabelbb(array(null), 0.1);
$fpdf->tabel(array(""), 0.05);
$y = $fpdf->GetY();
$fpdf->SetWidths(array(9));
$fpdf->SetFont("Arial", "B", 10);
$fpdf->SetXY(10.5, $y);
$fpdf->tabelbb(array("Catatan :"), 0.8);
$fpdf->SetX(10.5);
$fpdf->SetFont("Arial", "", 9);
$fpdf->tabelbb(array("Semua peraturan yang berlaku di perusahaan kami, maka Diberitahukan bahwa yang berhak mengambil tagihan tersebut di atas adalah :"), 0.5);
$fpdf->SetWidths(array(0.5, 9));
$fpdf->Ln(0.2);
$fpdf->SetX(10.5);
$fpdf->tabelbb(array("1.", "Mereka yang menandatangani kontrak, SP3, SPB, Kwitansi"), 0.5);
$fpdf->SetX(10.5);
$fpdf->tabelbb(array("2.", "Bila ada yang mengambil tagihan tersebut adalah orang lain, harus ada Surat Kuasa bermaterai Rp.6000,- dan "
    . "menandatangani Kontrak, SP3, SPB, Kwitansi"), 0.5);
$fpdf->SetX(10.5);
$fpdf->tabelbb(array("3.", "Pada saat pengambilan tagihan, tanda terimakasih asli harus di bawa"), 0.5);
$fpdf->SetWidths(array(0.01));
$fpdf->SetXY(10.3, $y);
$fpdf->tabel(array(""), 0.5);
$fpdf->SetX(10.3);
$fpdf->tabel(array(""), 0.5);
$fpdf->SetX(10.3);
$fpdf->tabel(array(""), 0.5);
$fpdf->SetX(10.3);
$fpdf->tabel(array(""), 0.5);
$fpdf->SetX(10.3);
$fpdf->tabel(array(""), 0.5);
$fpdf->SetX(10.3);
$fpdf->tabel(array(""), 0.5);
$fpdf->SetX(10.3);
$fpdf->tabel(array(""), 0.5);
$fpdf->SetX(10.3);
$fpdf->tabel(array(""), 0.5);
$fpdf->SetX(10.3);
$fpdf->tabel(array(""), 1.7);
$fpdf->SetWidths(array(0.5, 5.5, 7.5));
$fpdf->SetY($y);
$fpdf->tabelbb(array(""), 0.2);
$fpdf->tabelbb(array("1.", "Kwitansi No. " . strtoupper($invoice->invoice_number), ": Rp " . rupiah($invoice->invoice_total)), 0.5);
$fpdf->tabelbb(array("2.", "Faktur Tagihan", ": ada / tidak ada"), 0.5);
$fpdf->tabelbb(array("3.", "Faktur Pajak No.", ": ada / tidak ada"), 0.5);
$fpdf->tabelbb(array("4.", "SSP", ": ada / tidak ada"), 0.5);
$fpdf->tabelbb(array("5.", "Kontrak/SPB/SPK", ": ada / tidak ada"), 0.5);
$fpdf->tabelbb(array("6.", "B.A. Serah Terima/TTB Surat Jalan", ": ada / tidak ada"), 0.5);
$fpdf->tabelbb(array("7.", "B.A. Pembayaran", ": ada / tidak ada"), 0.5);
$fpdf->tabelbb(array("8.", "Lain-lain", ": ada / tidak ada"), 0.5);
$fpdf->SetWidths(array(19));
$fpdf->Ln(1.5);
$fpdf->tabel(array(""), 0.09);
$fpdf->Ln(0.2);
$fpdf->SetWidths(array(5, 7.5, 6));
$fpdf->tabelbbc(array("", "", ucfirst(strtolower($invoice->project_region)) . ", " . indo_date($invoice->invoice_date_kwt)), 0.5);
$fpdf->SetFont("Arial", "B", 9);
$fpdf->SetWidths(array(5, 8, 5));
$fpdf->tabelbbc(array("Penerima Pembayaran", "", "Penerima Berkas"), 0.5);
$fpdf->Ln(1.6);
$fpdf->tabelbbc(array("(.......................................)", "", "(................................)"), 0.5);


if (!empty($ppn)) {
//ppn
    for ($f = 1; $f <= 2; $f++) {
        $fpdf->AddPage();
        $fpdf->SetWidths(array(6.5));
        $fpdf->SetFont("Arial", "B", 9);
        $fpdf->SetY(0.5);
        $fpdf->tabel(array("PT. WIJAYA KARYA GEDUNG"), 0.5);
        $fpdf->SetFont("Arial", "", 9);
        $fpdf->tabel(array("$invoice->project_name"), 0.5);
        $fpdf->SetFont("Arial", "", 8);
        $fpdf->SetXY(16, 0.5);
        $fpdf->SetWidths(array(3));
        $fpdf->tabel(array("Untuk Akuntansi"), 0.5);
        $fpdf->SetXY(19.3, 0.5);
        $fpdf->SetWidths(array(0.7));
        $page = $page + 1;
        $fpdf->tabel(array($page), 0.5);
        $fpdf->SetXY(16, 1.2);
        $fpdf->SetWidths(array(4));
        $fpdf->SetFont("Arial", "", 8);
        $fpdf->tabel(array("VERIFIKATOR"), 0.5);
        $fpdf->SetWidths(array(1.6, 2.4));
        $fpdf->SetX(16);
        $fpdf->SetFont("Arial", "", 7);
        $fpdf->tabel(array("Tanda Tangan", ""), 0.45);
        $fpdf->SetX(16);
        $fpdf->tabel(array("Nama", ""), 0.4);
        $fpdf->SetWidths(array(7.4));
        $fpdf->SetXY(7.3, 2);
        $fpdf->SetFont("Arial", "B", 9);
        $fpdf->tabelbb(array("BUKTI PENGELUARAN          KAS          BANK"), 0.4);
        $fpdf->Rect(11.3, 1.96, 0.4, 0.4);
        $fpdf->Rect(12.85, 1.96, 0.4, 0.4);
        $fpdf->SetXY(6, 2.6);
        $fpdf->SetWidths(array(1.68, 0.55));
        $fpdf->SetFont("Arial", "", 9);
        $fpdf->tabelnsb(array("Nomor :", ""), 0.5);
        $fpdf->SetWidths(array(0.43));
        $fpdf->tabelns(array(""), 0.45);
        $fpdf->tabelns(array(""), 0.45);
        $fpdf->tabelnsb(array(""), 0.45);
        for ($i = 0; $i <= 10; $i++) {
            $fpdf->tabelns(array(""), 0.45);
        }
        $fpdf->tabel(array(""), 0.45);
        $fpdf->Ln(0.1);
        $fpdf->SetX(3.6);
        $fpdf->SetWidths(array(4, 0.2));
        $fpdf->tabelnsb(array("Kredit Nomor Perkiraan :", ""), 0.4);
        $fpdf->SetWidths(array(0.43));
        for ($i = 0; $i <= 4; $i++) {
            $fpdf->tabelns(array(""), 0.45);
        }
        $fpdf->tabelnsb(array(""), 0.45);

        $fpdf->SetWidths(array(2, 0.16));
        $fpdf->tabelnsb(array("Kode Bank :", ""), 0.4);
        $fpdf->SetWidths(array(0.43));
        for ($i = 0; $i <= 4; $i++) {
            $fpdf->tabelns(array(""), 0.45);
        }
        $fpdf->tabelbb(array(""), 0.45);
        $fpdf->Ln(0.1);
        $fpdf->SetX(3.6);
        $fpdf->SetWidths(array(4, 0.2));
        $fpdf->tabelnsb(array("Dibayar Kepada :", ""), 0.4);
        $fpdf->SetWidths(array(0.43));
        $actor_name = $ppn->actor_name;
        $arra = str_split($actor_name);
        $name = "";
        $fpdf->SetFont("Arial", "B", 7.5);
        foreach ($arra as $i => $word) {
            $fpdf->tabelns(array(str_replace(" ", "", $word)), 0.45);
        }
        if (count($arra) < 16) {
            for ($xc = 0; $xc <= (20 - count($arra)); $xc++) {
                $fpdf->tabelns(array(""), 0.45);
            }
        }
        $fpdf->tabelbb(array(""), 0.4);
        $fpdf->SetX(14);
        $fpdf->SetFont("Arial", "", 8);
        $fpdf->SetWidths(array(4));
        $fpdf->tabelbb(array("Nomor Faktur Pajak :"), 0.5);
        $fpdf->SetFont("Arial", "", 9);
        $fpdf->SetX(3.6);
        $fpdf->SetWidths(array(1.5, 1, 1, 0.5, 1.8, 0.5, 1.4, 2.5));
        $fpdf->tabelnsb(array("Dibayar :", "", "Tunai", "", "Cek/Giro", "", "Nomor :", '.......................'), 0.5);
        $fpdf->SetWidths(array(0.352));
        for ($i = 0; $i <= 16; $i++) {
            $fpdf->tabelns(array(""), 0.45);
        }
        $fpdf->tabelbb(array(""), 0.5);
        $fpdf->Rect(5.8, 4.7, 0.3, 0.3);
        $fpdf->Rect(7.3, 4.7, 0.3, 0.3);
        $fpdf->Ln(0.1);
        $fpdf->SetWidths(array(5, 2, 1.8, 3.6, 3, 3.8));
        $fpdf->tabelheadcustom(array("URAIAN", "SPK/SPP", "KODE NASABAH", 'SUMBER DAYA', "DEBET NOMOR PERKIRAAN", "RUPIAH"), 1);
        $fpdf->SetXY(6, 5.7);
        $fpdf->SetWidths(array(2));
        $fpdf->tabel(array("Nomor"), 0.5);
        $fpdf->SetXY(9.8, 5.7);
        $fpdf->SetWidths(array(2.13));
        $fpdf->tabel(array("Kode"), 0.5);
        $fpdf->SetXY(11.95, 5.7);
        $fpdf->SetWidths(array(1.44));
        $fpdf->tabel(array("Volume"), 0.5);
//$fpdf->Ln(0.5);   
        $fpdf->SetWidths(array(5, 0.334, 0.334, 0.334, 0.334, 0.334, 0.334, 0.45, 0.45, 0.45, 0.45, 0.355, 0.355, 0.355, 0.355, 0.355, 0.355, 1.47, 0.6, 0.6, 0.6, 0.6, 0.6, 3.8));

        for ($i = 0; $i <= 8; $i++):
            $fpdf->tabel(array("", "", "", "", "", "", "", "", "", "", "", '', '', '', '', '', '', "", "", "", "", "", "", ""), 0.5);
        endfor;

        $fpdf->SetWidths(array(3.8));
        $fpdf->SetX(16.4);
        $fpdf->tabelrr(array("Rp " . rupiah($ppn->invoice_bruto)), 0.75);
//nomor spk
        $strike = "";


        $fpdf->SetXY(8.1, 3.43);
        $fpdf->SetWidths(array(15));
        $fpdf->tabelbb(array(""), 0.5);
        $fpdf->SetWidths(array(15));
        $amount = $ppn->invoice_bruto;
        $obj = new toWords($amount);
        $nilai_terbilang = $obj->words;
        $fpdf->SetXY(1, 11.08);
        $fpdf->Image(base_url() . 'assets/img/bgBilangan.png', 3, 11, 12, 0.6);
        $fpdf->tabelbb(array("TERBILANG :        # " . $a->terbilang($amount). "  Rupiah#"), 0.5);
        $fpdf->SetWidths(array(2.2));
        $fpdf->SetFont("Arial", "", 7.5);
        $fpdf->SetXY(6.02, 6.15);
        $fpdf->SetWidths(array(0.31, 0.34, 0.32, 0.33, 0.34, 0.3));
        $fpdf->tabelbb(array(4, 'W', 'G', 'A', '0', 9), 0.75);
        $fpdf->SetXY(6.02, 6.62);
        $fpdf->SetWidths(array(0.23, 0.39, 0.32, 0.36, 0.34, 0.3));
        if (empty($ppn->invoice_tax_serial)) {
            $strike = "";
        } else {
            $ppn_number = '4WGA09';
            $arr = str_split($ppn_number);
            $strike = "";
            $datax = array();
            foreach ($arr as $i => $word) {
                $datax[$i] = $word;
            }
            $fpdf->tabelbb($datax, 0.75);
        }

        $fpdf->SetFont("Arial", "", 9);
        $fpdf->SetWidths(array(5, 10.4, 3.8));
        $fpdf->SetXY(1, 5.7);
        $fpdf->tabelbbcustom(array($ppn->invoice_note, "", ""), 0.5);
        $fpdf->SetX(1);
        $fpdf->tabelbbcustom(array("", "", "Rp " . rupiah($invoice->invoice_netto)), 0.5);

        $fpdf->SetWidths(array(5, 10.4, 3.8));
        $fpdf->SetXY(1, 6.2);
        $fpdf->tabelbbcustom(array($ppn->invoice_note, "", ""), 0.5);
        $fpdf->SetX(1);
        $fpdf->tabelbbcustom(array("$ppn->tax_name $ppn->tax_cuts%", "", "Rp " . rupiah($ppn->invoice_tax_nominal)), 0.5);
        $fpdf->SetWidths(array(19.4));
        $fpdf->SetY(12);
        if (empty($pph->invoice_date_pry)) {
            $invoice_date = "";
        } else {
            $invoice_date = $pph->invoice_date_pry;
            $invoice_date = indo_date($invoice_date);
        }
        $region = !empty($invoice->project_region) ? ucwords(strtolower($invoice->project_region)) : "______________";
        $fpdf->tabelbbr(array("$region, $invoice_date"), 0.4);

        $fpdf->SetWidths(array(2, 1.1, 1, 1.6));
        $fpdf->SetY(13.8);
        $fpdf->SetFont("Arial", "", 6);
//$fpdf->Ln(1.7);
        $fpdf->tabel(array("Diteliti dan Diuji", "Oleh", "Tanggal", "Tanda Tangan"), 0.5);
        $fpdf->tabell(array("Kebenaran Kelengkapan Keabsahan", "Kasie Adku PPU", "", ""), 0.3);
        $fpdf->tabell(array("Setuju Dibayar & Mengesahkan", "Man/Ka PPu", "", ""), 0.4);
        $fpdf->SetXY(6.9, 11.5);
        $fpdf->SetWidths(array(5));
        $fpdf->Ln(1);
        $fpdf->SetX(6.9);
        $fpdf->tabelbb(array("Kelengkapan :"), 0.5);
        $fpdf->SetWidths(array(5));
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Kontrak/SP3/SPK/PB/Konfirmasi Pesanan"), 0.3);
        $fpdf->Rect(7, 13, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Kuitansi/Faktur"), 0.3);
        $fpdf->Rect(7, 13.3, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("BAST/BAOP/BAPB"), 0.3);
        $fpdf->Rect(7, 13.6, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Faktur Pajak"), 0.3);
        $fpdf->Rect(7, 13.9, 0.4, 0.3);
        $fpdf->SetWidths(array(2.7, 0.01, 3));
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Surat Setoran Pajak", "", "Cap & Tanggal Lunas"), 0.3);
        $fpdf->Rect(7, 14.2, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Bukti Pemotongan Pajak"), 0.3);
        $fpdf->Rect(7, 14.5, 0.4, 0.3);
        $fpdf->SetWidths(array(5));
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Bukti Pemotongan Pph"), 0.3);
        $fpdf->Rect(7, 14.8, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("BAP"), 0.3);
        $fpdf->Rect(7, 15.1, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Lembar Kendali"), 0.3);
        $fpdf->Rect(7, 15.4, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Lain-lain"), 0.3);
        $fpdf->Rect(7, 15.7, 0.4, 0.3);
        $fpdf->Rect(10.5, 14.6, 1.5, 1.38);
        $fpdf->SetXY(12.5, 14);
        $fpdf->SetWidths(array(3.5));
        $fpdf->SetFont("Arial", "", 6);
        $fpdf->tabel(array("Pembayar"), 0.5);
        $fpdf->SetWidths(array(1.75, 1.75));
        $fpdf->SetX(12.5);
        $fpdf->tabel(array("Tanda Tangan", ""), 1);
        $fpdf->SetWidths(array(3.5));
        $fpdf->SetX(12.5);
        $fpdf->tabel(array("Pemegang Kas"), 0.5);
        $fpdf->SetXY(16.2, 13);
        $fpdf->SetWidths(array(1.5, 1, 1.5));
        $fpdf->SetFont("Arial", "", 6);
        $fpdf->tabel(array("Pemohon", "Tanda Tangan Nama", ""), 0.5);
        $fpdf->Rect(17.7, 14, 2.5, 0.5);
        $fpdf->SetXY(16.2, 14.5);
        $fpdf->SetWidths(array(1.5, 1, 1.5));
        $fpdf->SetFont("Arial", "", 6);
        $fpdf->tabel(array("Penerima", "Tanda Tangan Nama", ""), 0.5);
        $fpdf->Rect(17.7, 15.5, 2.5, 0.5);
//PT penerima
    }
}
if (!empty($pph)) {
// pph
    for ($f = 1; $f <= 2; $f++) {
        $fpdf->AddPage();
        $fpdf->SetWidths(array(6.5));
        $fpdf->SetFont("Arial", "B", 9);
        $fpdf->SetY(0.5);
        $fpdf->tabel(array("PT. WIJAYA KARYA GEDUNG"), 0.5);
        $fpdf->SetFont("Arial", "", 9);
        $fpdf->tabel(array("$invoice->project_name"), 0.5);
        $fpdf->SetFont("Arial", "", 8);
        $fpdf->SetXY(16, 0.5);
        $fpdf->SetWidths(array(3));
        $fpdf->tabel(array("Untuk Akuntansi"), 0.5);
        $fpdf->SetXY(19.3, 0.5);
        $fpdf->SetWidths(array(0.7));
        $pages = $pages + 1;
        $fpdf->tabel(array($pages), 0.5);
        $fpdf->SetXY(16, 1.2);
        $fpdf->SetWidths(array(4));
        $fpdf->SetFont("Arial", "", 8);
        $fpdf->tabel(array("VERIFIKATOR"), 0.5);
        $fpdf->SetWidths(array(1.6, 2.4));
        $fpdf->SetX(16);
        $fpdf->SetFont("Arial", "", 7);
        $fpdf->tabel(array("Tanda Tangan", ""), 0.45);
        $fpdf->SetX(16);
        $fpdf->tabel(array("Nama", ""), 0.4);
        $fpdf->SetWidths(array(7.4));
        $fpdf->SetXY(7.3, 2);
        $fpdf->SetFont("Arial", "B", 9);
        $fpdf->tabelbb(array("BUKTI PENERIMAAN              KAS          BANK"), 0.4);
        $fpdf->Rect(11.3, 1.96, 0.4, 0.4);
        $fpdf->Rect(12.85, 1.96, 0.4, 0.4);
        $fpdf->SetXY(6, 2.6);
        $fpdf->SetWidths(array(1.68, 0.55));
        $fpdf->SetFont("Arial", "", 9);
        $fpdf->tabelnsb(array("Nomor :", ""), 0.5);
        $fpdf->SetWidths(array(0.43));
        $fpdf->tabelns(array(""), 0.45);
        $fpdf->tabelns(array(""), 0.45);
        $fpdf->tabelnsb(array(""), 0.45);
        for ($i = 0; $i <= 10; $i++) {
            $fpdf->tabelns(array(""), 0.45);
        }
        $fpdf->tabel(array(""), 0.45);
        $fpdf->Ln(0.1);
        $fpdf->SetX(3.6);
        $fpdf->SetWidths(array(4, 0.2));
        $fpdf->tabelnsb(array("Debet Nomor Perkiraan :", ""), 0.4);
        $fpdf->SetWidths(array(0.43));
        for ($i = 0; $i <= 4; $i++) {
            $fpdf->tabelns(array(""), 0.45);
        }
        $fpdf->tabelnsb(array(""), 0.45);

        $fpdf->SetWidths(array(2, 0.16));
        $fpdf->tabelnsb(array("Kode Bank :", ""), 0.4);
        $fpdf->SetWidths(array(0.43));
        for ($i = 0; $i <= 4; $i++) {
            $fpdf->tabelns(array(""), 0.45);
        }
        $fpdf->tabelbb(array(""), 0.45);
        $fpdf->Ln(0.1);
        $fpdf->SetX(3.6);
        $fpdf->SetWidths(array(4, 0.2));
        $fpdf->tabelnsb(array("Diterima dari :", ""), 0.4);
        $fpdf->SetWidths(array(0.43));
        $actor_name = $ppn->actor_name;
        $arra = str_split($actor_name);
        $name = "";
        $fpdf->SetFont("Arial", "B", 7.5);
        foreach ($arra as $i => $word) {
            $fpdf->tabelns(array(str_replace(" ", "", $word)), 0.45);
        }
        if (count($arra) < 16) {
            for ($xc = 0; $xc <= (20 - count($arra)); $xc++) {
                $fpdf->tabelns(array(""), 0.45);
            }
        }
        $fpdf->tabelbb(array(""), 0.4);
        $fpdf->SetX(14);
        $fpdf->SetFont("Arial", "", 8);
        $fpdf->SetWidths(array(4));
        $fpdf->tabelbb(array("Nomor Faktur Pajak :"), 0.5);
        $fpdf->SetFont("Arial", "", 9);
        $fpdf->SetX(3.6);
        $fpdf->SetWidths(array(1.6, 1, 1, 0.5, 1.8, 0.5, 1.4, 2.5));
        $fpdf->tabelnsb(array("Diterima :", "", "Tunai", "", "Cek/Giro", "", "Nomor :", '.......................'), 0.5);
        $fpdf->SetWidths(array(0.352));
        for ($i = 0; $i <= 16; $i++) {
            $fpdf->tabelns(array(""), 0.45);
        }
        $fpdf->tabelbb(array(""), 0.5);
        $fpdf->Rect(5.9, 4.7, 0.3, 0.3);
        $fpdf->Rect(7.4, 4.7, 0.3, 0.3);
        $fpdf->Ln(0.1);
        $fpdf->SetWidths(array(5, 2, 1.8, 3.6, 3, 3.8));
        $fpdf->tabelheadcustom(array("URAIAN", "SPK/SPP", "KODE NASABAH", 'SUMBER DAYA', "DEBET NOMOR PERKIRAAN", "RUPIAH"), 1);
        $fpdf->SetXY(6, 5.7);
        $fpdf->SetWidths(array(2));
        $fpdf->tabel(array("Nomor"), 0.5);
        $fpdf->SetXY(9.8, 5.7);
        $fpdf->SetWidths(array(2.13));
        $fpdf->tabel(array("Kode"), 0.5);
        $fpdf->SetXY(11.95, 5.7);
        $fpdf->SetWidths(array(1.44));
        $fpdf->tabel(array("Volume"), 0.5);
//$fpdf->Ln(0.5);   
        $fpdf->SetWidths(array(5, 0.334, 0.334, 0.334, 0.334, 0.334, 0.334, 0.45, 0.45, 0.45, 0.45, 0.355, 0.355, 0.355, 0.355, 0.355, 0.355, 1.47, 0.6, 0.6, 0.6, 0.6, 0.6, 3.8));

        for ($i = 0; $i <= 8; $i++):
            $fpdf->tabel(array("", "", "", "", "", "", "", "", "", "", "", '', '', '', '', '', '', "", "", "", "", "", "", ""), 0.5);
        endfor;
        $fpdf->SetFont("Arial", "B", 9);
        $fpdf->SetWidths(array(3.8));
        $fpdf->SetX(16.4);
        $fpdf->tabelrr(array("Rp " . rupiah($pph->invoice_tax_nominal)), 0.75);
        if (empty($ppn_number)) {
            $strike = "";
        } else {
//nomor spk
            $arr = str_split($ppn_number);
            $strike = "";
            foreach ($arr as $i => $word) {
                $strike = $strike . "" . $word . " ";
            }
        }
        $actor_name = $pph->actor_name;
        $arra = str_split($actor_name);
        $name = "";
        foreach ($arra as $i => $word) {
            $name = $name . "" . $word . " ";
        }
        $fpdf->SetXY(8.1, 3.43);
        $fpdf->SetWidths(array(15));
        $fpdf->tabelbb(array(""), 0.5);
        $fpdf->SetWidths(array(15));
        $amount = $pph->invoice_tax_nominal;
        $obj = new toWords($amount);
        $nilai_terbilang2 = $obj->words;
        $fpdf->SetXY(1, 11.07);
        $fpdf->Image(base_url() . 'assets/img/bgBilangan.png', 3.2, 11, 12.5, 0.6);
        $fpdf->tabelbb(array("TERBILANG :        # " . $a->terbilang($amount) . " Rupiah #"), 0.5);

        $fpdf->SetWidths(array(2.2));
        $fpdf->SetFont("Arial", "", 7.5);
        $fpdf->SetXY(6.02, 6.15);
        $fpdf->SetWidths(array(0.31, 0.34, 0.32, 0.33, 0.34, 0.3));
        $fpdf->tabelbb(array(4, 'W', 'G', 'A', '0', 9), 0.75);
        $fpdf->SetXY(6.02, 6.62);
        $fpdf->SetWidths(array(0.23, 0.39, 0.32, 0.36, 0.34, 0.3));
        if (empty($ppn->invoice_tax_serial)) {
            $strike = "";
        } else {
            $ppn_number = '4WGA09';
            $arr = str_split($ppn_number);
            $strike = "";
            $datax = array();
            foreach ($arr as $i => $word) {
                $datax[$i] = $word;
            }
            $fpdf->tabelbb($datax, 0.75);
        }

        $fpdf->SetFont("Arial", "", 9);
        $fpdf->SetWidths(array(5, 10.4, 3.8));
        $fpdf->SetXY(1, 6.2);
        $fpdf->tabelbbcustom(array("", "", ""), 0.5);
        $fpdf->SetX(1);
        $fpdf->tabelbbcustom(array("$pph->tax_name ($pph->tax_cuts%)", "", "Rp " . rupiah($pph->invoice_tax_nominal)), 0.5);
        $fpdf->SetWidths(array(19.4));
        $fpdf->SetY(12.5);
        if (empty($pph->invoice_date_pry)) {
            $invoice_date = "";
        } else {
            $invoice_date = $pph->invoice_date_pry;
            $invoice_date = indo_date($invoice_date);
        }
        $region = !empty($invoice->project_region) ? ucwords(strtolower($invoice->project_region)) : "______________";
        $fpdf->tabelbbr(array("$region, $invoice_date"), 0.4);

        $fpdf->SetWidths(array(2, 1.1, 1, 1.6));
        $fpdf->SetY(13.8);
        $fpdf->SetFont("Arial", "", 6);
//$fpdf->Ln(1.7);
        $fpdf->tabel(array("Diteliti dan Diuji", "Oleh", "Tanggal", "Tanda Tangan"), 0.5);
        $fpdf->tabell(array("Kebenaran Kelengkapan Keabsahan", "Kasie Adku PPU", "", ""), 0.3);
        $fpdf->tabell(array("Setuju Dibayar & Mengesahkan", "Man/Ka PPu", "", ""), 0.4);
        $fpdf->SetXY(6.9, 11.5);
        $fpdf->SetWidths(array(5));
        $fpdf->Ln(1);
        $fpdf->SetX(6.9);
        $fpdf->tabelbb(array("Kelengkapan :"), 0.5);
        $fpdf->SetWidths(array(5));
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Kontrak/SP3/SPK/PB/Konfirmasi Pesanan"), 0.3);
        $fpdf->Rect(7, 13, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Kuitansi/Faktur"), 0.3);
        $fpdf->Rect(7, 13.3, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("BAST/BAOP/BAPB"), 0.3);
        $fpdf->Rect(7, 13.6, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Faktur Pajak"), 0.3);
        $fpdf->Rect(7, 13.9, 0.4, 0.3);
        $fpdf->SetWidths(array(2.7, 0.01, 3));
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Surat Setoran Pajak", "", "Cap & Tanggal Lunas"), 0.3);
        $fpdf->Rect(7, 14.2, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Bukti Pemotongan Pajak"), 0.3);
        $fpdf->Rect(7, 14.5, 0.4, 0.3);
        $fpdf->SetWidths(array(5));
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Bukti Pemotongan Pph"), 0.3);
        $fpdf->Rect(7, 14.8, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("BAP"), 0.3);
        $fpdf->Rect(7, 15.1, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Lembar Kendali"), 0.3);
        $fpdf->Rect(7, 15.4, 0.4, 0.3);
        $fpdf->SetX(7.4);
        $fpdf->tabelbb(array("Lain-lain"), 0.3);
        $fpdf->Rect(7, 15.7, 0.4, 0.3);
        $fpdf->Rect(10.5, 14.6, 1.5, 1.38);
        $fpdf->SetXY(12.5, 13.9);
        $fpdf->SetWidths(array(3.5));
        $fpdf->SetFont("Arial", "", 6);
        $fpdf->tabel(array("Penerima"), 0.6);
        $fpdf->SetWidths(array(1.75, 1.75));
        $fpdf->SetX(12.5);
        $fpdf->tabel(array("Tanda Tangan", ""), 1);
        $fpdf->SetWidths(array(3.5));
        $fpdf->SetX(12.5);
        $fpdf->tabel(array("Pemegang Kas"), 0.5);
        $fpdf->SetXY(16.2, 13.9);
        $fpdf->SetWidths(array(4));
        $fpdf->SetFont("Arial", "", 6);
        $fpdf->tabel(array("Permintaan untuk diterima dan dibukukan"), 0.3);
        $fpdf->SetWidths(array(1.75, 2.25));
        $fpdf->SetX(16.2);
        $fpdf->tabel(array("Tanda Tangan", ""), 1);
        $fpdf->SetX(16.2);
        $fpdf->tabel(array("Nama", ""), 0.5);
//PT penerima
    }
}
$fpdf->Output();
?>
