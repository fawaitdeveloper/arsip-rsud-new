<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Binafy\LaravelUserMonitoring\Traits\Actionable;

class LetterOut extends Model
{
    use HasFactory, \Staudenmeir\EloquentJsonRelations\HasJsonRelationships, Actionable;

    protected $guarded = ['id'];

    protected $casts = [
        'attachment_file_id' => 'json',
    ];

    public function urgency()
    {
        return $this->belongsTo(LetterUrgency::class, 'letter_urgency_id');
    }

    public function attribute()
    {
        return $this->belongsTo(LetterAttribute::class, 'letter_attribute_id');
    }

    public function attachments()
    {
        return $this->belongsToJson(AttachmentFile::class, 'attachment_file_id');
    }

    public function category()
    {
        return $this->belongsTo(LetterCategory::class, 'letter_category_id');
    }

    public function histories()
    {
        return $this->hasMany(LetterOutHistory::class, 'letter_out_id');
    }

    public function details()
    {
        return $this->hasMany(LetterOutDetail::class, 'letter_out_id');
    }


    public function scopeFilter($query, $value)
    {
        return $query->where('complete', $value);
    }

    public function scopeStatus($query, $value)
    {
        $replies = LetterReply::pluck('code')->toArray();

        if ($value == "selesai") {
            return $query->whereIn("code", $replies);
        } else {
            return $query->whereNotIn("code", $replies);
        }
    }
}
