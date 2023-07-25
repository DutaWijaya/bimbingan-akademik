<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    use HasFactory;
	protected $table = "dosen";
	protected $guarded = [];
	protected $primaryKey = "nip";
	public $timestamps = false;

    public function mahasiswa():HasMany {
        return $this->hasMany(Mahasiswa::class);
    }
    public function form_evaluasi():HasMany {
        return $this->hasMany(FormEvaluasi::class);
    }
}
