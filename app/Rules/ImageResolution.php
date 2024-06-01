<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;

class ImageResolution implements Rule
{
    protected $width;
    protected $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function passes($attribute, $value)
    {
        if ($value->isValid()) {
            list($width, $height) = getimagesize($value->getRealPath());
            return $width == $this->width && $height == $this->height;
        }
        return false;
    }

    public function message()
    {
        return "The :attribute must be exactly {$this->width}x{$this->height} pixels.";
    }
}
