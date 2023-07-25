<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormBimbingan extends Model
{
    use HasFactory;
    protected $table = "form_bimbingan";
    protected $guarded =[];
    protected $primaryKey = "id_bimbingan";
    public $timestamps = false;

	public function mahasiswa():BelongsTo {
		return $this->belongsTo(Mahasiswa::class);
	}

	public function formevaluasi():HasMany {
		return $this->hasMany(FormEvaluasi::class, 'id_bimbingan');
	}
}
