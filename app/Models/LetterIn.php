<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Binafy\LaravelUserMonitoring\Traits\Actionable;

class LetterIn extends Model
{
    use HasFactory, \Staudenmeir\EloquentJsonRelations\HasJsonRelationships, Actionable;

    protected $guarded = ['id'];

    protected $casts = [
        'user_id' => 'json',
        'translucent_id' => 'json',
        'attachment_file_id' => 'json',
        'group_purpose_id' => 'json',
    ];


    public function urgency()
    {
        return $this->belongsTo(LetterUrgency::class, 'letter_urgency_id');
    }

    public function users()
    {
        return $this->belongsToJson(User::class, 'user_id');
    }

    public function translucents()
    {
        return $this->belongsToJson(Translucent::class, 'translucent_id');
    }

    public function attachments()
    {
        return $this->belongsToJson(AttachmentFile::class, 'attachment_file_id');
    }

    public function groupPurpose()
    {
        return $this->belongsTo(GroupPurpose::class, 'group_purpose_id');
    }

    public function attribute()
    {
        return $this->belongsTo(LetterAttribute::class, 'letter_attribute_id');
    }

    public function category()
    {
        return $this->belongsTo(LetterCategory::class, 'letter_category_id');
    }

    public function history()
    {
        return $this->hasMany(LetterInHistory::class, 'letter_in_id');
    }


    public function scopeFilter($query, $value)
    {
        return $query->where('complete', $value);
    }

    public function flows()
    {
        return $this->hasMany(Flow::class, 'code', 'code');
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
