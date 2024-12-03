<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class System extends Model
{
    use HasUuids, LogsActivity;

    protected $table = 'system';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name_site',
        'favicon',
        'logo',
        'enable_comments',
        'landing_image',
        'landing_title',
        'landing_body',
        'about',
        'about_title',
        'about_body',
        'contact',
        'contact_title',
        'contact_body',
        'linkedin',
        'linkedin_link',
        'facebook',
        'facebook_link',
        'x',
        'x_link',
        'youtube',
        'youtube_link',
        'instagram',
        'instagram_link',
        'has_email',
        'e_mail',
        'has_phone',
        'phone',
        'has_direction',
        'direction',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name_site',
                'favicon',
                'logo',
                'enable_comments',
                'landing_image',
                'landing_title',
                'landing_body',
                'about',
                'about_title',
                'about_body',
                'contact',
                'contact_title',
                'contact_body',
                'linkedin',
                'linkedin_link',
                'facebook',
                'facebook_link',
                'x',
                'x_link',
                'youtube',
                'youtube_link',
                'instagram',
                'instagram_link',
                'has_email',
                'e_mail',
                'has_phone',
                'phone',
                'has_direction',
                'direction',
            ]);
    }
}
