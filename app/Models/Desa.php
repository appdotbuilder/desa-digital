<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Desa
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string|null $kode_pos
 * @property string|null $telepon
 * @property string|null $email
 * @property string $paket_langganan
 * @property int $max_users
 * @property int $max_letters
 * @property int $max_storage
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $subscription_expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RW> $rws
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Warga> $wargas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Surat> $surats
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Berita> $beritas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Galeri> $galeris
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Desa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereKodePos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa wherePaketLangganan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereMaxUsers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereMaxLetters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereMaxStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereSubscriptionExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa active()
 * @method static \Database\Factories\DesaFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Desa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'desa';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'alamat',
        'kode_pos',
        'telepon',
        'email',
        'paket_langganan',
        'max_users',
        'max_letters',
        'max_storage',
        'is_active',
        'subscription_expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'max_users' => 'integer',
        'max_letters' => 'integer',
        'max_storage' => 'integer',
        'subscription_expires_at' => 'datetime',
    ];

    /**
     * Get all users in this village.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all RWs in this village.
     */
    public function rws(): HasMany
    {
        return $this->hasMany(RW::class);
    }

    /**
     * Get all citizens in this village.
     */
    public function wargas(): HasMany
    {
        return $this->hasMany(Warga::class);
    }

    /**
     * Get all letters in this village.
     */
    public function surats(): HasMany
    {
        return $this->hasMany(Surat::class);
    }

    /**
     * Get all news in this village.
     */
    public function beritas(): HasMany
    {
        return $this->hasMany(Berita::class);
    }

    /**
     * Get all gallery items in this village.
     */
    public function galeris(): HasMany
    {
        return $this->hasMany(Galeri::class);
    }

    /**
     * Scope a query to only include active villages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}