<?php

use ChristianSants\PdfToHtml\PdfToHtml;

include './vendor/autoload.php';

echo PdfToHtml::getHtml(
    './tests/source/Profile.pdf',
    'C:\Users\Chris\Downloads\pdftohtml.exe'
);