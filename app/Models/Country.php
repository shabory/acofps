<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'countries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function countryidCities()
    {
        return $this->hasMany(City::class, 'countryid_id', 'id');
    }

    public function countryCourses()
    {
        return $this->hasMany(Course::class, 'country_id', 'id');
    }

    public function countryDiplomas()
    {
        return $this->hasMany(Diploma::class, 'country_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
