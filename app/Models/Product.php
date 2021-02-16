<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = ['product_name', 'description', 'price', 'user_id', 'image_name'];

    public function user()
    {
        return $this->belongsTo(User::Class);
    }
}