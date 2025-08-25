<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Surat;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with village statistics.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $desaId = $user->desa_id;

        if (!$desaId && !$user->isSuperAdmin()) {
            return Inertia::render('error', [
                'message' => 'You are not assigned to any village. Please contact administrator.'
            ]);
        }

        // Super admin gets global statistics
        if ($user->isSuperAdmin()) {
            return $this->getSuperAdminStats();
        }

        // Village-specific statistics
        return $this->getVillageStats($desaId, $user);
    }

    /**
     * Get statistics for super admin.
     */
    protected function getSuperAdminStats()
    {
        $stats = [
            'total_villages' => \App\Models\Desa::count(),
            'active_villages' => \App\Models\Desa::where('is_active', true)->count(),
            'total_users' => \App\Models\User::count(),
            'total_citizens' => Warga::count(),
            'total_letters' => Surat::count(),
            'pending_letters' => Surat::whereNotIn('status', ['completed', 'rejected'])->count(),
        ];

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'is_super_admin' => true,
        ]);
    }

    /**
     * Get statistics for village users.
     */
    protected function getVillageStats($desaId, $user)
    {
        // Basic village statistics
        $stats = [
            'total_citizens' => Warga::where('desa_id', $desaId)->where('is_active', true)->count(),
            'total_letters' => Surat::where('desa_id', $desaId)->count(),
            'pending_letters' => Surat::where('desa_id', $desaId)->whereNotIn('status', ['completed', 'rejected'])->count(),
            'completed_letters' => Surat::where('desa_id', $desaId)->where('status', 'completed')->count(),
            'total_news' => Berita::where('desa_id', $desaId)->count(),
            'published_news' => Berita::where('desa_id', $desaId)->where('is_published', true)->count(),
            'total_gallery' => Galeri::where('desa_id', $desaId)->where('is_active', true)->count(),
        ];

        // Demographics by gender
        $demographics = [
            'male_citizens' => Warga::where('desa_id', $desaId)->where('jenis_kelamin', 'L')->where('is_active', true)->count(),
            'female_citizens' => Warga::where('desa_id', $desaId)->where('jenis_kelamin', 'P')->where('is_active', true)->count(),
        ];

        // Age group statistics - SQLite compatible
        $ageGroups = DB::table('warga')
            ->select(
                DB::raw("SUM(CASE WHEN (strftime('%Y', 'now') - strftime('%Y', tanggal_lahir)) < 18 THEN 1 ELSE 0 END) as anak"),
                DB::raw("SUM(CASE WHEN (strftime('%Y', 'now') - strftime('%Y', tanggal_lahir)) BETWEEN 18 AND 60 THEN 1 ELSE 0 END) as dewasa"),
                DB::raw("SUM(CASE WHEN (strftime('%Y', 'now') - strftime('%Y', tanggal_lahir)) > 60 THEN 1 ELSE 0 END) as lansia")
            )
            ->where('desa_id', $desaId)
            ->where('is_active', true)
            ->first();

        // RT/RW statistics
        $rtRwStats = DB::table('rt')
            ->join('rw', 'rt.rw_id', '=', 'rw.id')
            ->leftJoin('warga', 'rt.id', '=', 'warga.rt_id')
            ->select(
                'rw.nomor_rw',
                'rt.nomor_rt',
                DB::raw('COUNT(warga.id) as jumlah_warga')
            )
            ->where('rw.desa_id', $desaId)
            ->where(function($query) {
                $query->whereNull('warga.is_active')->orWhere('warga.is_active', true);
            })
            ->groupBy('rw.id', 'rt.id', 'rw.nomor_rw', 'rt.nomor_rt')
            ->get();

        // Recent letters
        $recentLetters = Surat::where('desa_id', $desaId)
            ->with(['warga', 'rt', 'createdBy'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Recent news
        $recentNews = Berita::where('desa_id', $desaId)
            ->where('is_published', true)
            ->with(['adminInput'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'demographics' => $demographics,
            'age_groups' => $ageGroups,
            'rt_rw_stats' => $rtRwStats,
            'recent_letters' => $recentLetters,
            'recent_news' => $recentNews,
            'user_role' => $user->role,
            'is_super_admin' => false,
        ]);
    }
}