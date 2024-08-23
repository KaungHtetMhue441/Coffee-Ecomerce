<?php

namespace App\PDF;

use Mpdf\Mpdf;
use Mpdf\Config\FontVariables;
use Mpdf\Config\ConfigVariables;

class PDF
{
    private $mpdf;
    public  function __construct()
    {
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig["fontDir"];
        $defaultFonts = (new FontVariables())->getDefaults();
        $fontData = $defaultFonts["fontdata"];

        $fontData["Pyidaungsu"] = [
            'R'  => 'Pyidaungsu-2.5.3_Regular.ttf',    // regular font
            'B'  => 'Pyidaungsu-2.5.3_Bold.ttf',       // optional: bold font
        ];

        $this->mpdf = new Mpdf([
            "mode" => "UTF-8",
            "autoScriptToLang" => true,
            "autoLangToFont" => true,
            "tempDir" => storage_path("app/mpdf"),
            "fontdir" => array_merge($fontDirs, [public_path("fonts")]),
            "fontData" => $fontData,
            'format' => [180, 250]
        ]);
    }
    public function getMpdf()
    {
        return $this->mpdf;
    }
}
