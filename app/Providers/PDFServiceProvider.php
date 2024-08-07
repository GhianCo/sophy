<?php

namespace App\Providers;

use Mpdf\Mpdf;
use Sophy\Providers\IServiceProvider;

class PDFServiceProvider implements IServiceProvider
{
    public function registerServices()
    {
        $paper = "A4";
        $or = "P";
        $margin_left = 10;
        $margin_right = 10;
        $margin_top = 10;
        $margin_bottom = 10;

        if (isset($_GET["paper"])) {
            $paper = $_GET["paper"];
        }

        if(array_key_exists("or",$_GET))
            $or = $_GET["or"];

        if (isset($_GET["or"])) {
            switch ($_GET["or"]) {
                case "P":
                    $or = "P";
                    break;
                case "L":
                    $or = "L";
                    break;
                default:
                    $or = "P";
                    break;
            }
        }

        if(isset($_GET["margen"])){
            $margin_left = $_GET["margen"];
            $margin_right = $_GET["margen"];
        }

        singleton('PDF', function () use ($paper, $or, $margin_left, $margin_right, $margin_top, $margin_bottom) {
            $pdf = new Mpdf(array(
                'mode' => 'c',
                'format' => "$paper-$or",
                'default_font_size' => 0,
                'default_font' => 'Arial',
                'margin_left' => $margin_left,
                'margin_right' => $margin_right,
                'margin_top' => $margin_top,
                'margin_bottom' => $margin_bottom,
                'tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mpdf'
            ));
            $pdf->SetDisplayMode('fullpage');
            $pdf->list_indent_first_level = 0;
            return $pdf;
        });
    }
}
