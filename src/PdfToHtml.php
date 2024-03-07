<?php

namespace ChristianSants\PdfToHtml;

use Symfony\Component\Process\Process;

class PdfToHtml {
    protected string $pdfPath;

    protected string $binPath;

    protected int $timeout = 60;

    protected array $options = [];
    
    protected string $defaultPath;

    public function __construct(?string $binPath = null)
    {
        $this->binPath = $binPath ?? '/usr/bin/pdftohtml';
        $this->defaultPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'pdf_html';
    }

    public function setPdf(string $pdfPath): self
    {
        if (!is_readable($pdfPath)) {
            throw new \Exception("Could not read `{$pdfPath}`");
        }

        $this->pdfPath = $pdfPath;

        return $this;
    }

    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;
        
        return $this;
    }

    public function setOptions(array $options): self
    {
        $this->options = $options;
        
        return $this;
    }

    public function html(): string
    {
        $process = new Process( array_merge([$this->binPath], $this->options, [$this->pdfPath, $this->defaultPath]));
        $process->setTimeout($this->timeout);
        $process->start();
        $process->wait();

        $dir = dir($this->defaultPath);

        $content = '';
        while ($archive = $dir->read()){
            if (pathinfo($archive, PATHINFO_EXTENSION) == 'html' && strpos($archive, 'page') === 0) {
                $content .= file_get_contents($dir->path . DIRECTORY_SEPARATOR . $archive);
            }
        }

        $dir->close();

        $this->deleteDirectory($this->defaultPath);

        return $content;
    }

    public static function getHtml(string $pdf, ?string $binPath = null, array $options = [], int $timeout = 60): string
    {
        return (new static($binPath))
            ->setTimeout($timeout)
            ->setPdf($pdf)
            ->setOptions($options)
            ->html();
    }

    protected function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
    
        if (!is_dir($dir)) {
            return unlink($dir);
        }
    
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
    
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
    
        return rmdir($dir);
    }
}