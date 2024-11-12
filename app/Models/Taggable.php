<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Log;

class Taggable extends Model
{
    use HasUuids;

    protected $table = 'taggables';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';


/*     public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    } */


}
