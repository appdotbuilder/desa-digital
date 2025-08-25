<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Berita
 *
 * @property int $id
 * @property int $desa_id
 * @property string $judul
 * @property string $konten
 * @property string|null $gambar
 * @property int $admin_input_id
 * @property string $status_approve
 * @property int|null $approved_by_id
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property string|null $rejection_reason
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Desa $desa
 * @property-read \App\Models\User $adminInput
 * @property-read \App\Models\User|null $approvedBy
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Berita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita query()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereDesaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereKonten($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereAdminInputId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereStatusApprove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereApprovedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereRejectionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita approved()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita published()
 * @method static \Database\Factories\BeritaFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Berita extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'berita';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'judul',
        'konten',
        'gambar',
        'admin_input_id',
        'status_approve',
        'approved_by_id',
        'approved_at',
        'rejection_reason',
        'is_published',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'desa_id' => 'integer',
        'admin_input_id' => 'integer',
        'approved_by_id' => 'integer',
        'is_published' => 'boolean',
        'approved_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    /**
     * Get the village that owns this news.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    /**
     * Get the admin who created this news.
     */
    public function adminInput(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_input_id');
    }

    /**
     * Get the user who approved this news.
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }

    /**
     * Scope a query to only include approved news.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('status_approve', 'approved');
    }

    /**
     * Scope a query to only include published news.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}