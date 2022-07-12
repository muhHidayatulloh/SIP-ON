<?php

class dompdfimage
{
    function __construct()
    {
        include_once APPPATH . '/third_party/dompdf/autoload.inc.php';
    }

    function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='portrait'){

        $options = new Dompdf\Options();
        $options->setDefaultFont('courier');
        $options->setIsRemoteEnabled(true);

        $dompdf = new Dompdf\DOMPDF();
        $dompdf->setOptions($options);
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }
}