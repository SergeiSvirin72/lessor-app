<?php

namespace App\Exports;

interface Exportable
{
    public function export($template);
}