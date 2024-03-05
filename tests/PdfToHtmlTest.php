<?php

namespace Tests\ChristianSants\PdfToHtml;

use ChristianSants\PdfToHtml\PdfToHtml;
use PHPUnit\Framework\TestCase;

class PdfToHtmlTest extends TestCase
{
    protected PdfToHtml $pdfToHtml;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pdfToHtml = new PdfToHtml();
    }

    public function testPdfToHtmlConversion()
    {
        $pdfPath = __DIR__.'/source/Profile.pdf';
        $htmlContent = $this->pdfToHtml->setPdf($pdfPath)->html();
        
        // Verifique se a conversão foi bem-sucedida e se o conteúdo HTML foi gerado corretamente
        $this->assertNotEmpty($htmlContent);
        $this->assertStringContainsString('<html>', $htmlContent);
        $this->assertStringContainsString('<body>', $htmlContent);
        $this->assertStringContainsString('</html>', $htmlContent);
        $this->assertStringContainsString('</body>', $htmlContent);
    }
}
