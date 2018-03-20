<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Libs_Function {

    private $_ci;

    public function __construct() {
        $this->_ci = & get_instance();
    }

    public function remove_image($image = null) {
      if($image != null) {
          if(file_exists($image)) {
            unlink($image);
          }
      }
    }
    
    public function upload_regex_character($url, $name_image) {
        $name               = str_replace(" ", "_", "$name_image");
        $names              = str_replace(",", "", "$name");
        $explode_string     = explode(".", $name);
        $name_old_original  = preg_replace("/^(.+?);.*$/", "\\1", $names);
        $name_original      = strtolower($name_old_original);
        $extension_unclear  = $explode_string[count($explode_string)-1];
        $file_type          = preg_replace("/^(.+?);.*$/", "\\1", $extension_unclear);
        $new_name_change    = $name_original;
        return $url . strtolower(str_replace(' ', '_', $new_name_change));
    }

    public function upload_single_image($url, $name_image,$varb = null) {
        $name               = str_replace(" ", "_", "$name_image");
        $names              = str_replace(",", "", "$name");
        $explode_string     = explode(".", $name);
        $name_old_original  = preg_replace("/^(.+?);.*$/", "\\1", $names);
        $name_original      = strtolower($name_old_original);
        $extension_unclear  = $explode_string[count($explode_string)-1];
        $file_type          = preg_replace("/^(.+?);.*$/", "\\1", $extension_unclear);
        $new_name_change    = $name_original;
        $original_src       = $url . strtolower(str_replace(' ', '_', $new_name_change));

        if (move_uploaded_file($_FILES[!empty($varb)?$varb:'userfile']['tmp_name'], $original_src)) :
            chmod("$original_src", 0777);
        else :
            $validate = "Gagal melakukan proses upload file.Hal ini biasanya disebabkan ukuran file yang terlalu besar atau koneksi jaringan anda sedang bermasalah";
            echo "<script type='text/javascript'> alert('" . $validate . "'); </script>";
            exit;
        endif;

        list($width, $height) = getimagesize($original_src);
        $x_height   = ($height >= 1024) ? 1024 : $height;
        $diff       = $height / $x_height;
        $x_width    = $width / $diff;

        if (($_FILES[!empty($varb)?$varb:'userfile']['type'] == "image/jpeg") ||
            ($_FILES[!empty($varb)?$varb:'userfile']['type'] == "image/png") ||
            ($_FILES[!empty($varb)?$varb:'userfile']['type'] == "image/gif")) :
            $im = @ImageCreateFromJPEG($original_src) or    // Read JPEG Image
            $im = @ImageCreateFromPNG($original_src) or     // or PNG Image
            $im = @ImageCreateFromGIF($original_src) or     // or GIF Image
            $im = false;                                    // If image is not JPEG, PNG, or GIF


            if (!$im) :
                $validate = "Gagal membuat thumbnail";
                echo "<script type='text/javascript'> alert('" . $validate . "'); </script>";
                exit;
            else :
                $newimage2 = @imagecreatetruecolor($x_width, $x_height);
                @imageCopyResized($newimage2, $im, 0, 0, 0, 0, $x_width, $x_height, $width, $height);
                @ImageJpeg($newimage2, $original_src);
                chmod("$original_src", 0777);
            endif;
        endif;
    }
}