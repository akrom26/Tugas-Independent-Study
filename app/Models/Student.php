<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Rfc4122\UuidV4;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id_student';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = UuidV4::uuid4()->toString();
        });
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'id_school_class', 'id_school_class');
    }

    public function originSchool()
    {
        return $this->belongsTo(OriginSchool::class, 'id_origin_school', 'id_origin_school');
    }

    public function studentParent()
    {
        return $this->belongsTo(StudentParent::class, 'id_parent', 'id_parent');
    }

    public function district()
    {
        return $this->belongsTo(IndonesiaDistrict::class, 'id_district', 'id');
    }

    public function village()
    {
        return $this->belongsTo(IndonesiaVillage::class, 'id_village', 'id');
    }

    public function city()
    {
        return $this->belongsTo(IndonesiaCitie::class, 'id_city', 'id');
    }

    public function province()
    {
        return $this->belongsTo(IndonesiaProvince::class, 'id_province', 'id');
    }

    public static function countNullColumns($id)
    {
        $columns = Schema::getColumnListing('students');
        $student = self::find($id);

        $nullCount = 0;
        foreach ($columns as $column) {
            if (is_null($student->$column)) {
                $nullCount++;
            }
        }

        return $nullCount;
    }
}
