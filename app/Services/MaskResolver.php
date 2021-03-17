<?php

namespace App\Services;

use Carbon\Carbon;

class MaskResolver
{
    private function getMacros() {
        $macros = [
            '{d}' => Carbon::now()->format('d'),
            '{Y}' => Carbon::now()->format('Y')
        ];
        return $macros;
    }

    public function resolve($mask) {
        $macros = $this->getMacros();
        foreach ($macros as $macro => $value) {
            $mask = str_replace($macro, $value, $mask);
        }
        return $mask;
    }
}