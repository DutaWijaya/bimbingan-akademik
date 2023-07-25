<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormEvaluasi extends Model
{
    use HasFactory;
    protected $table = "form_evaluasi";
    protected $guarded =[];
    protected $primaryKey = "id_evaluasi";
    public $timestamps = false;

        public function dosen():BelongsTo {
        return $this->belongsTo(Dosen::class);
    }
	public function formbimbingan():BelongsTo {
		return $this->belongsTo(FormBimbingan::class);
	}
}
