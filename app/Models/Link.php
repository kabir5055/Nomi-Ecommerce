<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_type_id',
        'link_name',
        'url',
        'slug',
        'description',
    ];

    public function linkType(){
        return $this->belongsTo(LinkType::class);
    }
}
