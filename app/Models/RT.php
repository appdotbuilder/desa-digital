<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\RT
 *
 * @property int $id
 * @property int $rw_id
 * @property string $nomor_rt
 * @property string|null $nama_rt
 * @property int|null $ketua_rt_id
 * @property string|null $alamat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RW $rw
 * @property-read \App\Models\User|null $ketuaRt
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Warga> $wargas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Surat> $surats
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|RT newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RT newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RT query()
 * @method static \Illuminate\Database\Eloquent\Builder|RT whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RT whereRwId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RT whereNomorRt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RT whereNamaRt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RT whereKetuaRtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RT whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RT whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RT whereUpdatedAt($value)
 * @method static \Database\Factories\RTFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class RT extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rt';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'rw_id',
        'nomor_rt',
        'nama_rt',
        'ketua_rt_id',
        'alamat',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rw_id' => 'integer',
        'ketua_rt_id' => 'integer',
    ];

    /**
     * Get the RW that owns this RT.
     */
    public function rw(): BelongsTo
    {
        return $this->belongsTo(RW::class);
    }

    /**
     * Get the RT chairman.
     */
    public function ketuaRt(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ketua_rt_id');
    }

    /**
     * Get all citizens in this RT.
     */
    public function wargas(): HasMany
    {
        return $this->hasMany(Warga::class);
    }

    /**
     * Get all letters in this RT.
     */
    public function surats(): HasMany
    {
        return $this->hasMany(Surat::class);
    }

    /**
     * Get all users in this RT.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}