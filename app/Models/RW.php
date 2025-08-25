<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\RW
 *
 * @property int $id
 * @property int $desa_id
 * @property string $nomor_rw
 * @property string|null $nama_rw
 * @property int|null $ketua_rw_id
 * @property string|null $alamat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Desa $desa
 * @property-read \App\Models\User|null $ketuaRw
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RT> $rts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Warga> $wargas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Surat> $surats
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|RW newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RW newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RW query()
 * @method static \Illuminate\Database\Eloquent\Builder|RW whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RW whereDesaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RW whereNomorRw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RW whereNamaRw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RW whereKetuaRwId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RW whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RW whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RW whereUpdatedAt($value)
 * @method static \Database\Factories\RWFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class RW extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rw';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'nomor_rw',
        'nama_rw',
        'ketua_rw_id',
        'alamat',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'desa_id' => 'integer',
        'ketua_rw_id' => 'integer',
    ];

    /**
     * Get the village that owns this RW.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    /**
     * Get the RW chairman.
     */
    public function ketuaRw(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ketua_rw_id');
    }

    /**
     * Get all RTs in this RW.
     */
    public function rts(): HasMany
    {
        return $this->hasMany(RT::class);
    }

    /**
     * Get all citizens in this RW (through RTs).
     */
    public function wargas(): HasMany
    {
        return $this->hasMany(Warga::class, 'rt_id');
    }

    /**
     * Get all letters in this RW.
     */
    public function surats(): HasMany
    {
        return $this->hasMany(Surat::class);
    }
}