<?php
require_once '../mpdf/mpdf.php';

 
function createPdf($fileName, $content) {
        try {
            $mpdf = new mPDF('c','A4', 0, '', 5, 5, 5, 5, 5, 5, 'P');
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->fonttrans = array_merge($mpdf->fonttrans, array(
                'arial' => 'chelvetica',
                'helvetica' => 'chelvetica',
                'timesnewroman' => 'ctimes',
                'times' => 'ctimes',
                'couriernew' => 'ccourier',
                'courier' => 'ccourier',
                'sans' => 'chelvetica',
                'sans-serif' => 'chelvetica',
                'serif' => 'ctimes',
                'mono' => 'ccourier',
            ));
            //$stylesheet = file_get_contents('mpdfstyleA4.css');
            //$mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($content);
            $mpdf->Output($fileName, 'D');
            $resultArray['execute'] = true;
        } catch (Exception $e) {
            $resultArray['error'] = $e->getMessage();
        }
        return $resultArray;
    }

	?>