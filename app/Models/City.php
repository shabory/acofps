<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'cities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'countryid_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cityCourses()
    {
        return $this->hasMany(Course::class, 'city_id', 'id');
    }

    public function cityDiplomas()
    {
        return $this->hasMany(Diploma::class, 'city_id', 'id');
    }

    public function countryid()
    {
        return $this->belongsTo(Country::class, 'countryid_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
