<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    use HasFactory;

    protected $table = "attachments";
    protected $fillable = [
        'product_assessment_id',
        'filepath_image',
    ];
    public function getIncrement()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    public function productAssessment()
    {
        return $this->belongsTo(ProductAssessment::class, 'product_assessment_id', 'id');
    }
}
