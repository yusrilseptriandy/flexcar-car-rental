<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type_id',
        'brand_id',
        'photos',
        'features',        
        'price',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function getThumbnailAttribute(){

        if ($this->photos) {
            return Storage::url(json_decode($this->photos)[0]);
        }

        return 'https://via.placeholder.com/800x600';
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
