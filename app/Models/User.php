<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property int|null $desa_id
 * @property int|null $rt_id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $role
 * @property string|null $phone
 * @property string|null $address
 * @property mixed $password
 * @property bool $is_active
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Desa|null $desa
 * @property-read \App\Models\RT|null $rt
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Surat> $surats
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Berita> $beritas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Galeri> $galeris
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SuratHistory> $suratHistories
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDesaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User active()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'desa_id',
        'rt_id',
        'role',
        'phone',
        'address',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'desa_id' => 'integer',
            'rt_id' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the village that owns this user.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    /**
     * Get the RT that owns this user.
     */
    public function rt(): BelongsTo
    {
        return $this->belongsTo(RT::class);
    }

    /**
     * Get all letters created by this user.
     */
    public function surats(): HasMany
    {
        return $this->hasMany(Surat::class, 'created_by_id');
    }

    /**
     * Get all news created by this user.
     */
    public function beritas(): HasMany
    {
        return $this->hasMany(Berita::class, 'admin_input_id');
    }

    /**
     * Get all gallery items uploaded by this user.
     */
    public function galeris(): HasMany
    {
        return $this->hasMany(Galeri::class, 'uploaded_by_id');
    }

    /**
     * Get all letter status changes made by this user.
     */
    public function suratHistories(): HasMany
    {
        return $this->hasMany(SuratHistory::class, 'changed_by_id');
    }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if user has super admin role.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user has village admin role.
     */
    public function isVillageAdmin(): bool
    {
        return $this->role === 'village_admin';
    }

    /**
     * Check if user has village head role.
     */
    public function isVillageHead(): bool
    {
        return $this->role === 'village_head';
    }

    /**
     * Check if user has RW chairman role.
     */
    public function isRwChairman(): bool
    {
        return $this->role === 'rw_chairman';
    }

    /**
     * Check if user has RT chairman role.
     */
    public function isRtChairman(): bool
    {
        return $this->role === 'rt_chairman';
    }

    /**
     * Check if user has citizen role.
     */
    public function isCitizen(): bool
    {
        return $this->role === 'citizen';
    }
}