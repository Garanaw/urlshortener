<?php declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Url extends Model
{
    protected $fillable = [
        'url',
        'keyword',
        'private',
        'views',
        'description'
    ];
    
    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function setDescription(string $description): Url
    {
        $this->attributes['description'] = $description;
        return $this;
    }
    
    public function setPrivate(): Url
    {
        $this->attributes['private'] = true;
        return $this;
    }
    
    public function setPublic(): Url
    {
        $this->attributes['private'] = false;
        return $this;
    }
    
    public function setKeyword(string $keyword): Url
    {
        $this->attributes['keyword'] = $keyword;
        return $this;
    }
    
    public function hasKeyword(): bool
    {
        return array_key_exists('keyword', $this->attributes) &&
            (bool) $this->attributes['keyword'];
    }
}
