<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Galeri
 *
 * @property int $id
 * @property int $desa_id
 * @property string $judul
 * @property string|null $deskripsi
 * @property string $kategori
 * @property string $file
 * @property string $file_type
 * @property int $file_size
 * @property int $uploaded_by_id
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Desa $desa
 * @property-read \App\Models\User $uploadedBy
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri query()
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereDesaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereUploadedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri active()
 * @method static \Database\Factories\GaleriFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Galeri extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galeri';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'judul',
        'deskripsi',
        'kategori',
        'file',
        'file_type',
        'file_size',
        'uploaded_by_id',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'desa_id' => 'integer',
        'file_size' => 'integer',
        'uploaded_by_id' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the village that owns this gallery item.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    /**
     * Get the user who uploaded this gallery item.
     */
    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by_id');
    }

    /**
     * Scope a query to only include active gallery items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}