<?php
$pdf = new Spatie\PdfToImage\Pdf('file.pdf');
foreach (range(1, $pdf->getNumberOfPages()) as $pageNumber) {
    $pdf->setPage($pageNumber)
        ->saveImage('page'.$pageNumber.'jpg');
}