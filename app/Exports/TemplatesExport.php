<?php

namespace App\Exports;

use DOMDocument;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\TemplateProcessor;

class TemplatesExport
{
    const STORAGE_PATH = 'app/public/';

    private $document_path, $document_name, $template_path;

    public function __construct($exportable, $template)
    {
        $this->template_path = storage_path('app/'.$template->path);

        $this->document_name = $exportable->getTable().'_'.$exportable->id.'_'.$template->id;
        $this->document_path = storage_path('app/'.$exportable::STORAGE_PATH);
    }

    public function exportDocx(array $values) {
        $templateProcessor = new TemplateProcessor($this->template_path);
        $templateProcessor->setValues($values);

        $temp_path = storage_path(self::STORAGE_PATH.'temp.docx');
        $templateProcessor->saveAs($temp_path);

        $phpWord = IOFactory::load($temp_path);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($this->document_path.$this->document_name.'.docx');

        return $this->document_name.'.docx';
    }

    public function exportPDF(array $values) {
        $content = file_get_contents($this->template_path);
        foreach ($values as $key => $value) {
            $content = str_replace('${'.$key.'}', $value, $content);
        }

//        $temp_path = storage_path(self::STORAGE_PATH.'temp.html');
//        file_put_contents($temp_path, $content);

        $dompdf = new DomPDF();
        $dompdf->loadHtml($content);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents($this->document_path.$this->document_name.'.pdf', $output);
        return $this->document_name.'.pdf';
    }

    public static function export(array $values, $template_path, $document_path, $document_name) {
        $content = file_get_contents($template_path);
        foreach ($values as $key => $value) {
            $content = str_replace('${'.$key.'}', $value, $content);
        }

        $dompdf = new DomPDF();
        $dompdf->loadHtml($content);
        $dompdf->render();
        $output = $dompdf->output();

        return file_put_contents($document_path.$document_name, $output);
    }
}