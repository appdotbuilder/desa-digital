<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Surat
 *
 * @property int $id
 * @property int $desa_id
 * @property int $warga_id
 * @property int $rt_id
 * @property int $rw_id
 * @property int $created_by_id
 * @property string|null $nomor_surat
 * @property string $jenis_surat
 * @property string $keperluan
 * @property string|null $keterangan
 * @property string $input_type
 * @property string $status
 * @property string|null $dokumen_file
 * @property \Illuminate\Support\Carbon|null $submitted_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Desa $desa
 * @property-read \App\Models\Warga $warga
 * @property-read \App\Models\RT $rt
 * @property-read \App\Models\RW $rw
 * @property-read \App\Models\User $createdBy
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SuratHistory> $histories
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Surat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Surat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Surat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereDesaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereWargaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereRtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereRwId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereNomorSurat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereJenisSurat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereKeperluan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereInputType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereDokumenFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereSubmittedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Surat whereUpdatedAt($value)
 * @method static \Database\Factories\SuratFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Surat extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surat';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'warga_id',
        'rt_id',
        'rw_id',
        'created_by_id',
        'nomor_surat',
        'jenis_surat',
        'keperluan',
        'keterangan',
        'input_type',
        'status',
        'dokumen_file',
        'submitted_at',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'desa_id' => 'integer',
        'warga_id' => 'integer',
        'rt_id' => 'integer',
        'rw_id' => 'integer',
        'created_by_id' => 'integer',
        'submitted_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the village that owns this letter.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    /**
     * Get the citizen that owns this letter.
     */
    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class);
    }

    /**
     * Get the RT that owns this letter.
     */
    public function rt(): BelongsTo
    {
        return $this->belongsTo(RT::class);
    }

    /**
     * Get the RW that owns this letter.
     */
    public function rw(): BelongsTo
    {
        return $this->belongsTo(RW::class);
    }

    /**
     * Get the user who created this letter.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * Get all histories for this letter.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(SuratHistory::class);
    }
}