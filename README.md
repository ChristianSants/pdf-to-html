# PdfToHtml

**PdfToHtml** é uma biblioteca PHP para converter arquivos PDF em HTML usando o Poppler Utils.

## Instalação

Você pode instalar a biblioteca via Composer. Execute o seguinte comando no terminal:

```bash
composer require christiansants/pdf-to-html
```

## Uso
A biblioteca oferece uma classe principal PdfToHtml com métodos simples para converter PDF em HTML. Veja um exemplo básico de uso:

```php
<?php

use ChristianSants\PdfToHtml\PdfToHtml;

// Defina o caminho para o arquivo PDF que deseja converter
$pdfPath = '/caminho/para/seu/arquivo.pdf';

// Instancie a classe PdfToHtml e defina o caminho para o binário do Poppler, se necessário
$pdfToHtml = new PdfToHtml('path/to/bin');

// Converta o PDF em HTML
$htmlContent = $pdfToHtml->setPdf($pdfPath)->html();

// Faça o que quiser com o conteúdo HTML
echo $htmlContent;
```

```php
<?php

use ChristianSants\PdfToHtml\PdfToHtml;

// Defina o caminho para o arquivo PDF que deseja converter
$pdfPath = '/caminho/para/seu/arquivo.pdf';

// Converta o PDF em HTML
$htmlContent = $PdfToHtml->getHtml($pdfPath);

// Faça o que quiser com o conteúdo HTML
echo $htmlContent;
```

## Dependências
Esta biblioteca requer o Poppler Utils para converter PDF em HTML. Certifique-se de que o Poppler Utils esteja instalado em seu sistema. Você pode instalá-lo no Ubuntu ou Debian executando:

```bash
sudo apt-get install poppler-utils
```

## Licença
Esta biblioteca é distribuída sob a licença MIT. Consulte o arquivo LICENSE para obter mais informações.

## Contribuição
Sinta-se à vontade para enviar problemas, solicitações de recursos ou contribuir para o projeto.