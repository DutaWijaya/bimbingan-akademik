<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Model;


class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = "mahasiswa";
    protected $guarded =[];
    protected $primaryKey = "nim";
    public $timestamps = false;

	public function dosen():BelongsTo {
		return $this->belongsTo(Dosen::class);
	}

	public function kaprodi():BelongsTo {
		return $this->belongsTo(Kaprodi::class);
	}

    public function formbimbingan():HasMany {
    return $this->hasMany(FormBimbingan::class, 'nim');
    }
}
