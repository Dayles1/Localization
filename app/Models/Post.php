<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class Post extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['name', 'description'];
    protected $fillable =
    [
        
        'price',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
