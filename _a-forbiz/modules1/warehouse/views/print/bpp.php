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

            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'l';

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
  if($i==3){
                $h=$h/2;
                 $height=0.5;
            }
             if($i==4){
                $h=1;
                $height=1;
            }
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




    function tabelheadr($data, $height, $xa, $ya, $angle) {

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
//
//            if($i==5){
//                $h= $h*0.5;
//            }
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

function tabel2($data, $height) {

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
if ($i == 1) {
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
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

$fpdf = new PDF('L', 'cm', array(20.15, 14.5));

//$fpdf = new PDF('P', 'cm', "a4");

$fpdf->Open();

srand(microtime() * 1000000);

//$tanggal_indo = $cetak->set_cetak_tanggal;

//$tanggal_indo = $fpdf->indo_date($tanggal_indo);

$page=0;



$fpdf->AddPage();

$fpdf->SetWidths(array(12));
$fpdf->SetFont("Times", "", 9);
$page=$page+1;
$fpdf->SetXY(19.5, 0.2);
$fpdf->tabelbb(array($page), 0.5);
$fpdf->SetWidths(array(2,3.5));
$fpdf->SetXY(13.8,0.5);
$fpdf->tabell(array("Lembar 1","Danlat"), 0.4);
$fpdf->SetX(13.8);
$fpdf->tabell(array("Lembar 2","Gudang"), 0.4);
$fpdf->SetX(13.8);
$fpdf->tabell(array("Lembar 3","Pengadaan"), 0.4);
$fpdf->SetX(13.8);
$fpdf->tabell(array("Lembar 4","Pengirim"), 0.4);
$fpdf->SetFont("ARIAL", "", 8);

//$fpdf->SetXY(8.3, 2.5);

//$fpdf->tabel(array("lokasi"), 0.5);

$fpdf->SetWidths(array(6));

$fpdf->SetXY(0.5,1.8);

$fpdf->tabelbb(array(strtoupper($tdet->project_name)), 0.3);
$fpdf->SetX(0.5);
//$fpdf->tabelbb(array(strtoupper($tdet->project_address)), 0.3);
$fpdf->SetWidths(array(11));
$fpdf->SetFont("ARIAL", "", 11);
$fpdf->SetXY(5, 2.13);
$fpdf->tabelbbc(array("SURAT PENGELUARAN BARANG ALAT"), 1);

$fpdf->SetWidths(array(1,2,1.4,1.6,1.3,2));
$month=  date('m');
$month= number_format_romawi($month);
$year= date('Y');
$fpdf->SetXY(6, 3);

$fpdf->tabelbb(array("NO :","  $tdet->equipt_transaction_number","/   WG","/   UTR","/    ".$month,"/    ".$year), 0.5);

//$fpdf->SetWidths(array(3));

//$fpdf->SetXY(10.7, 4.3);

//$fpdf->tabel(array("Tanggal"), 0.5);
$fpdf->SetFont("ARIAL", "B", 9);
$fpdf->SetWidths(array(4,7));

$fpdf->SetXY(12,3.45);
if (!empty($detail->apps_logo)) {
    $fpdf->Image(base_url() . 'assets/img/apps/' . $detail->apps_logo, 0.5, 0.6, 4.6, 1);
//    $fpdf->Image(base_url() . 'assets/img/apps/' . $detail->apps_logo,0.5,0.5,-120,-150);
}

$tanggal=$tdet->equipt_transaction_date;
$clock=date('h:m:s', strtotime($tanggal));
$date=date('d-m-Y', strtotime($tanggal));
$fpdf->SetXY(0.5,3.82);
$fpdf->tabelbb(array("Dikirim Oleh Proyek",": $tdet->actor_name"), 0.5);
$fpdf->SetXY(12,3.82);
$fpdf->tabelbb(array("Jam",": $clock /"), 0.5);
$fpdf->SetX(0.5,4.25);
$fpdf->tabelbb(array("Surat Jalan No",": $tdet->equipt_transaction_letter"), 0.5);
$fpdf->SetXY(12,4.25);
$fpdf->tabelbb(array("Tanggal",": $date  / "), 0.5);
$fpdf->SetX(0.5,4.25);
$fpdf->tabelbb(array("No Kendaraan",": $tdet->equipt_transaction_car"), 0.5);

$fpdf->SetXY(12,4.75);
$fpdf->tabelbb(array("Nama Supir",": ". ucwords($tdet->equipt_transaction_driver)), 0.5);
$fpdf->SetX(12,4.75);
$fpdf->tabelbb(array("KTP/SIM",": $tdet->equipt_transaction_driver_identity"), 0.5);

$fpdf->Ln(0.1);
$fpdf->SetWidths(array(1,5,2,6.5,4.7));
$fpdf->SetX(0.5);
$fpdf->tabelheada(array("No","Nama / Jenis Barang","Type", "Penerimaan","Keterangan"), 1  );

$fpdf->SetWidths(array(3,1.5,2));
$fpdf->SetXY(8.5,6.35);
$fpdf->tabel(array("Kondisi","Volume","Satuan"), 0.5);

foreach ($transaction as $i => $row) {
    $fpdf->SetFont("ARIAL", "", 8);
    $fpdf->SetWidths(array(1,5,2,3,1.5,2,4.7));
    $fpdf->SetX(0.5);
$fpdf->tabel2(array(++$i,"$row->equipment_name","$row->equipment_type", "$row->equipt_transaction_dt_condition","$row->equipt_transaction_dt_volume","$row->equipment_unit_name","$row->equipt_transaction_dt_note"), 0.5  );

if($i%4==0){   
    if($i-  count($transaction)!=0){
    $fpdf->SetWidths(array(27.5));
$fpdf->Ln(0.5);
$fpdf->SetFont("ARIAL", "", 8);
$fpdf->SetX(0.5);
$fpdf->tabelbb(array("CATATAN : APABILA BARANG YANG DITERIMA TIDAK SESUAI MAKA SEGERA DI KONFIRMASI 1 X 24 JAM SETELAH ALAT DITERIMA 							
	MENYERTAI BERITA ACARA PENERIMAAN DARI PIHAK PENERIMA"), 0.5  );
$fpdf->SetWidths(array(2,4,2,4,2,5.1));
$fpdf->SetX(0.5);
$fpdf->tabel(array("Tanggal","Pengirim","Tanggal", "Ekspedisi","Tanggal","Diketahui"), 0.5  );
$fpdf->SetWidths(array(2,4,2,4,2,2.5,2.6));
$fpdf->SetX(0.5);
$fpdf->tabel(array("","","", "","","",""), 1  );
$fpdf->SetWidths(array(6,6,2,2.5,2.6));
$fpdf->SetX(0.5);
$fpdf->SetFont("Times", "B", 8);
$fpdf->tabel(array("DANLAT","DRIVER","","GUDANG","SECURITY"), 0.5  );

$fpdf->AddPage();
$fpdf->SetXY(12,3.45);
if (!empty($detail->apps_logo)) {
    $fpdf->Image(base_url() . 'assets/img/apps/' . $detail->apps_logo, 0.5, 0.6, 4.6, 1);
//    $fpdf->Image(base_url() . 'assets/img/apps/' . $detail->apps_logo,0.5,0.5,-120,-150);
}
$fpdf->SetWidths(array(12));
$fpdf->SetFont("Times", "", 9);
$page=$page+1;
$fpdf->SetXY(19.5, 0.2);
$fpdf->tabelbb(array($page), 0.5);
$fpdf->SetWidths(array(2,3.5));
$fpdf->SetXY(13.8,0.5);
$fpdf->tabell(array("Lembar 1","Danlat"), 0.4);
$fpdf->SetX(13.8);
$fpdf->tabell(array("Lembar 2","Gudang"), 0.4);
$fpdf->SetX(13.8);
$fpdf->tabell(array("Lembar 3","Pengadaan"), 0.4);
$fpdf->SetX(13.8);
$fpdf->tabell(array("Lembar 4","Pengirim"), 0.4);
$fpdf->SetFont("ARIAL", "", 8);

//$fpdf->SetXY(8.3, 2.5);

//$fpdf->tabel(array("lokasi"), 0.5);

$fpdf->SetWidths(array(6));

$fpdf->SetXY(0.5,1.8);

$fpdf->tabelbb(array(strtoupper($tdet->project_name)), 0.3);
$fpdf->SetX(0.5);
$fpdf->SetWidths(array(11));
$fpdf->SetFont("ARIAL", "", 11);
$fpdf->SetXY(5, 2.13);
$fpdf->tabelbbc(array("SURAT PENGELUARAN BARANG ALAT"), 1);

$fpdf->SetWidths(array(1,2,1.4,1.6,1.3,2));
$month=  date('m');
$month= number_format_romawi($month);
$year= date('Y');
$fpdf->SetXY(6, 3);

$fpdf->tabelbb(array("NO :","  $tdet->equipt_transaction_number","/   WG","/   UTR","/    ".$month,"/    ".$year), 0.5);

//$fpdf->SetWidths(array(3));

//$fpdf->SetXY(10.7, 4.3);

//$fpdf->tabel(array("Tanggal"), 0.5);
$fpdf->SetFont("ARIAL", "B", 9);
$fpdf->SetWidths(array(4,7));

$fpdf->SetXY(0.5,3.82);
$fpdf->tabelbb(array("Dikirim Oleh Proyek",": $tdet->actor_name"), 0.5);
$fpdf->SetXY(12,3.82);
$fpdf->tabelbb(array("Jam",": $clock /"), 0.5);
$fpdf->SetX(0.5,4.25);
$fpdf->tabelbb(array("Surat Jalan No",": $tdet->equipt_transaction_letter"), 0.5);
$fpdf->SetXY(12,4.25);
$fpdf->tabelbb(array("Tanggal",": $date  / "), 0.5);
$fpdf->SetX(0.5,4.25);
$fpdf->tabelbb(array("No Kendaraan",": $tdet->equipt_transaction_car"), 0.5);

$fpdf->SetXY(12,4.75);
$fpdf->tabelbb(array("Nama Supir",": ". ucwords($tdet->equipt_transaction_driver)), 0.5);
$fpdf->SetX(12,4.75);
$fpdf->tabelbb(array("KTP/SIM",": $tdet->equipt_transaction_driver_identity"), 0.5);

$fpdf->Ln(0.1);
$fpdf->SetWidths(array(1,5,2,6.5,4.7));
$fpdf->SetX(0.5);
$fpdf->tabelheada(array("No","Nama / Jenis Barang","Type", "Penerimaan","Keterangan"), 1  );

$fpdf->SetWidths(array(3,1.5,2));
$fpdf->SetXY(8.5,6.35);
$fpdf->tabel(array("Kondisi","Volume","Satuan"), 0.5);
    }
}
}

$fpdf->SetWidths(array(27.5));
$fpdf->Ln(0.5);
$fpdf->SetFont("ARIAL", "", 8);
$fpdf->SetX(0.5);
$fpdf->tabelbb(array("CATATAN : APABILA BARANG YANG DITERIMA TIDAK SESUAI MAKA SEGERA DI KONFIRMASI 1 X 24 JAM SETELAH ALAT DITERIMA 							
	MENYERTAI BERITA ACARA PENERIMAAN DARI PIHAK PENERIMA"), 0.5  );
$fpdf->SetWidths(array(2,4,2,4,2,5.1));
$fpdf->SetX(0.5);
$fpdf->tabel(array("Tanggal","Pengirim","Tanggal", "Ekspedisi","Tanggal","Diketahui"), 0.5  );
$fpdf->SetWidths(array(2,4,2,4,2,2.5,2.6));
$fpdf->SetX(0.5);
$fpdf->tabel(array("","","", "","","",""), 1  );
$fpdf->SetWidths(array(6,6,2,2.5,2.6));
$fpdf->SetX(0.5);
$fpdf->SetFont("Times", "B", 8);
$fpdf->tabel(array("DANLAT","DRIVER","","GUDANG","SECURITY"), 0.5  );

$fpdf->Output();

?>

