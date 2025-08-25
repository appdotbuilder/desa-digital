import { AppShell } from '@/components/app-shell';
import Heading from '@/components/heading';
import { Head } from '@inertiajs/react';
import React from 'react';

interface DashboardProps {
    stats?: {
        total_villages?: number;
        active_villages?: number;
        total_users?: number;
        total_citizens?: number;
        total_letters?: number;
        pending_letters?: number;
        completed_letters?: number;
        total_news?: number;
        published_news?: number;
        total_gallery?: number;
    };
    demographics?: {
        male_citizens?: number;
        female_citizens?: number;
    };
    age_groups?: {
        anak?: number;
        dewasa?: number;
        lansia?: number;
    };
    rt_rw_stats?: Array<{
        nomor_rw: string;
        nomor_rt: string;
        jumlah_warga: number;
    }>;
    recent_letters?: Array<{
        id: number;
        jenis_surat: string;
        status: string;
        created_at: string;
        warga: {
            nama: string;
        };
        rt: {
            nomor_rt: string;
        };
        created_by: {
            name: string;
        };
    }>;
    recent_news?: Array<{
        id: number;
        judul: string;
        published_at: string;
        admin_input: {
            name: string;
        };
    }>;

    is_super_admin?: boolean;
    [key: string]: unknown;
}

export default function Dashboard({
    stats = {},
    demographics = {},
    age_groups,
    rt_rw_stats = [],
    recent_letters = [],
    recent_news = [],

    is_super_admin = false
}: DashboardProps) {
    const StatCard = ({ title, value, icon, color = 'bg-blue-500' }: {
        title: string;
        value: number | string;
        icon: string;
        color?: string;
    }) => (
        <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div className="flex items-center">
                <div className={`${color} p-3 rounded-full text-white text-xl mr-4`}>
                    {icon}
                </div>
                <div>
                    <h3 className="text-2xl font-bold text-gray-900 dark:text-white">{value}</h3>
                    <p className="text-gray-600 dark:text-gray-300">{title}</p>
                </div>
            </div>
        </div>
    );

    const getStatusColor = (status: string) => {
        switch (status) {
            case 'completed': return 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400';
            case 'pending': case 'draft': return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400';
            case 'rejected': return 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400';
            default: return 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400';
        }
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    };

    return (
        <AppShell>
            <Head title="Dashboard - Village Information System" />
            
            <div className="py-6">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {/* Header */}
                    <div className="mb-8">
                        <Heading 
                            title={`📊 ${is_super_admin ? 'System Overview' : 'Village Dashboard'}`}
                            description={is_super_admin 
                                ? 'Global system statistics and management'
                                : 'Real-time village statistics and recent activities'
                            }
                        />
                    </div>

                    {/* Main Statistics */}
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        {is_super_admin ? (
                            <>
                                <StatCard 
                                    title="Total Villages" 
                                    value={stats.total_villages || 0} 
                                    icon="🏘️"
                                    color="bg-blue-500"
                                />
                                <StatCard 
                                    title="Active Villages" 
                                    value={stats.active_villages || 0} 
                                    icon="✅"
                                    color="bg-green-500"
                                />
                                <StatCard 
                                    title="Total Users" 
                                    value={stats.total_users || 0} 
                                    icon="👥"
                                    color="bg-purple-500"
                                />
                                <StatCard 
                                    title="Total Citizens" 
                                    value={stats.total_citizens || 0} 
                                    icon="👤"
                                    color="bg-orange-500"
                                />
                            </>
                        ) : (
                            <>
                                <StatCard 
                                    title="Total Citizens" 
                                    value={stats.total_citizens || 0} 
                                    icon="👥"
                                    color="bg-blue-500"
                                />
                                <StatCard 
                                    title="Pending Letters" 
                                    value={stats.pending_letters || 0} 
                                    icon="📝"
                                    color="bg-yellow-500"
                                />
                                <StatCard 
                                    title="Completed Letters" 
                                    value={stats.completed_letters || 0} 
                                    icon="✅"
                                    color="bg-green-500"
                                />
                                <StatCard 
                                    title="Published News" 
                                    value={stats.published_news || 0} 
                                    icon="📰"
                                    color="bg-purple-500"
                                />
                            </>
                        )}
                    </div>

                    {!is_super_admin && (
                        <>
                            {/* Demographics and Age Groups */}
                            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                                {/* Demographics */}
                                <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                        👥 Demographics by Gender
                                    </h3>
                                    <div className="space-y-4">
                                        <div className="flex justify-between items-center">
                                            <span className="text-gray-600 dark:text-gray-300">👨 Male</span>
                                            <span className="font-semibold text-blue-600">
                                                {demographics.male_citizens || 0}
                                            </span>
                                        </div>
                                        <div className="flex justify-between items-center">
                                            <span className="text-gray-600 dark:text-gray-300">👩 Female</span>
                                            <span className="font-semibold text-pink-600">
                                                {demographics.female_citizens || 0}
                                            </span>
                                        </div>
                                        <div className="border-t pt-2">
                                            <div className="flex justify-between items-center">
                                                <span className="font-medium text-gray-900 dark:text-white">Total</span>
                                                <span className="font-bold text-gray-900 dark:text-white">
                                                    {(demographics.male_citizens || 0) + (demographics.female_citizens || 0)}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {/* Age Groups */}
                                {age_groups && (
                                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                            📊 Age Distribution
                                        </h3>
                                        <div className="space-y-4">
                                            <div className="flex justify-between items-center">
                                                <span className="text-gray-600 dark:text-gray-300">👶 Children (&lt;18)</span>
                                                <span className="font-semibold text-green-600">
                                                    {age_groups.anak || 0}
                                                </span>
                                            </div>
                                            <div className="flex justify-between items-center">
                                                <span className="text-gray-600 dark:text-gray-300">🧑 Adults (18-60)</span>
                                                <span className="font-semibold text-blue-600">
                                                    {age_groups.dewasa || 0}
                                                </span>
                                            </div>
                                            <div className="flex justify-between items-center">
                                                <span className="text-gray-600 dark:text-gray-300">👴 Elderly (&gt;60)</span>
                                                <span className="font-semibold text-orange-600">
                                                    {age_groups.lansia || 0}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                )}
                            </div>

                            {/* RT/RW Statistics */}
                            {rt_rw_stats.length > 0 && (
                                <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-8">
                                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                        🏘️ Population by RT/RW
                                    </h3>
                                    <div className="overflow-x-auto">
                                        <table className="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead className="bg-gray-50 dark:bg-gray-700">
                                                <tr>
                                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                        RW
                                                    </th>
                                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                        RT
                                                    </th>
                                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                        Citizens
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody className="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                                {rt_rw_stats.map((item, index) => (
                                                    <tr key={index}>
                                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                                            RW {item.nomor_rw}
                                                        </td>
                                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                                            RT {item.nomor_rt}
                                                        </td>
                                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                                            {item.jumlah_warga}
                                                        </td>
                                                    </tr>
                                                ))}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            )}

                            {/* Recent Activities */}
                            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                {/* Recent Letters */}
                                {recent_letters.length > 0 && (
                                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                            📝 Recent Letters
                                        </h3>
                                        <div className="space-y-4">
                                            {recent_letters.slice(0, 5).map((letter) => (
                                                <div key={letter.id} className="border-l-4 border-blue-500 pl-4">
                                                    <div className="flex justify-between items-start mb-1">
                                                        <h4 className="font-medium text-gray-900 dark:text-white">
                                                            {letter.jenis_surat}
                                                        </h4>
                                                        <span className={`px-2 py-1 rounded-full text-xs font-medium ${getStatusColor(letter.status)}`}>
                                                            {letter.status}
                                                        </span>
                                                    </div>
                                                    <p className="text-sm text-gray-600 dark:text-gray-300">
                                                        {letter.warga.nama} • RT {letter.rt.nomor_rt}
                                                    </p>
                                                    <p className="text-xs text-gray-500 dark:text-gray-400">
                                                        {formatDate(letter.created_at)}
                                                    </p>
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                )}

                                {/* Recent News */}
                                {recent_news.length > 0 && (
                                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                            📰 Recent News
                                        </h3>
                                        <div className="space-y-4">
                                            {recent_news.map((news) => (
                                                <div key={news.id} className="border-l-4 border-green-500 pl-4">
                                                    <h4 className="font-medium text-gray-900 dark:text-white mb-1">
                                                        {news.judul}
                                                    </h4>
                                                    <p className="text-sm text-gray-600 dark:text-gray-300">
                                                        By {news.admin_input.name}
                                                    </p>
                                                    <p className="text-xs text-gray-500 dark:text-gray-400">
                                                        {formatDate(news.published_at)}
                                                    </p>
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                )}
                            </div>
                        </>
                    )}
                </div>
            </div>
        </AppShell>
    );
}