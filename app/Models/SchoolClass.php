<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Rfc4122\UuidV4;

class SchoolClass extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id_school_class';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = UuidV4::uuid4()->toString();
        });
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'id_school_class', 'id_school_class');
    }
}
