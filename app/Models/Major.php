<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('majors')]
#[Fillable(['code', 'name', 'description'])]
class Major extends Model
{
    use HasFactory;

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'major_id', 'id');
    }

    public function schoolClasses(): HasMany
    {
        return $this->hasMany(SchoolClass::class);
    }
}
