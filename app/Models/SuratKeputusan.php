<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SuratKeputusan extends Model
{
    use HasFactory;
    protected $table = "surat_keputusan";
    protected $guarded =[];
    protected $primaryKey = "no_sk";
    public $timestamps = false;

    public function kaprodi():BelongsTo {
        return $this->belongsTo(Kaprodi::class, 'kaprodi_nip');
    }

}
