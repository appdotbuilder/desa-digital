<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Warga
 *
 * @property int $id
 * @property int $desa_id
 * @property int $rt_id
 * @property string $nama
 * @property string $nik
 * @property string $alamat
 * @property string $tempat_lahir
 * @property \Illuminate\Support\Carbon $tanggal_lahir
 * @property string $jenis_kelamin
 * @property string $agama
 * @property string $pekerjaan
 * @property string $pendidikan
 * @property string $status_perkawinan
 * @property string $status_keluarga
 * @property string|null $no_kk
 * @property string|null $kk_file
 * @property string|null $ktp_file
 * @property string|null $telepon
 * @property string|null $email
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Desa $desa
 * @property-read \App\Models\RT $rt
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Surat> $surats
 * @property-read int|null $age
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Warga newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warga newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warga query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereDesaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereRtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereTempatLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereAgama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga wherePekerjaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga wherePendidikan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereStatusPerkawinan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereStatusKeluarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereNoKk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereKkFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereKtpFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warga active()
 * @method static \Database\Factories\WargaFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Warga extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'warga';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'rt_id',
        'nama',
        'nik',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'pendidikan',
        'status_perkawinan',
        'status_keluarga',
        'no_kk',
        'kk_file',
        'ktp_file',
        'telepon',
        'email',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'desa_id' => 'integer',
        'rt_id' => 'integer',
        'tanggal_lahir' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the village that owns this citizen.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    /**
     * Get the RT that owns this citizen.
     */
    public function rt(): BelongsTo
    {
        return $this->belongsTo(RT::class);
    }

    /**
     * Get all letters for this citizen.
     */
    public function surats(): HasMany
    {
        return $this->hasMany(Surat::class);
    }

    /**
     * Get the citizen's age.
     */
    public function getAgeAttribute(): int
    {
        return $this->tanggal_lahir->age;
    }

    /**
     * Scope a query to only include active citizens.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}