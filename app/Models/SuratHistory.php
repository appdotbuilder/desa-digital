<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\SuratHistory
 *
 * @property int $id
 * @property int $surat_id
 * @property string $status_from
 * @property string $status_to
 * @property int $changed_by_id
 * @property string|null $catatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Surat $surat
 * @property-read \App\Models\User $changedBy
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|SuratHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SuratHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SuratHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|SuratHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratHistory whereSuratId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratHistory whereStatusFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratHistory whereStatusTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratHistory whereChangedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratHistory whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratHistory whereUpdatedAt($value)
 * @method static \Database\Factories\SuratHistoryFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class SuratHistory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surat_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'surat_id',
        'status_from',
        'status_to',
        'changed_by_id',
        'catatan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'surat_id' => 'integer',
        'changed_by_id' => 'integer',
    ];

    /**
     * Get the letter that owns this history.
     */
    public function surat(): BelongsTo
    {
        return $this->belongsTo(Surat::class);
    }

    /**
     * Get the user who made this change.
     */
    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by_id');
    }
}