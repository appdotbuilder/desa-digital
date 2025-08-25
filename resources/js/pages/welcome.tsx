import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    const features = [
        {
            icon: '👥',
            title: 'Manajemen Warga',
            description: 'Catatan digital lengkap warga desa dengan data demografi dan keluarga'
        },
        {
            icon: '📝',
            title: 'Layanan Surat',
            description: 'Pengajuan surat online dengan alur persetujuan dari RT hingga Kepala Desa'
        },
        {
            icon: '📊',
            title: 'Analitik & Laporan',
            description: 'Statistik real-time dan laporan detail mengenai populasi dan layanan administrasi'
        },
        {
            icon: '📰',
            title: 'Berita & Pengumuman',
            description: 'Manajemen berita desa dengan sistem persetujuan dan pengumuman publik'
        },
        {
            icon: '📸',
            title: 'Galeri Desa',
            description: 'Dokumentasi kegiatan desa, fasilitas, dan proyek pembangunan'
        },
        {
            icon: '🏘️',
            title: 'SaaS Multi-Tenant',
            description: 'Manajemen data terisolasi untuk banyak desa dengan manajemen langganan'
        }
    ];

    const roles = [
        { role: 'Super Admin', access: 'Manajemen desa global, paket langganan, penagihan' },
        { role: 'Admin Desa', access: 'Entry data warga, manajemen berita, input surat manual' },
        { role: 'Kepala Desa', access: 'Persetujuan akhir surat, laporan, persetujuan berita' },
        { role: 'Ketua RW', access: 'Manajemen warga area RW, verifikasi surat' },
        { role: 'Ketua RT', access: 'Manajemen warga area RT, verifikasi surat' },
        { role: 'Warga', access: 'Pengajuan surat online, pelacakan status, berita desa' }
    ];

    return (
        <>
            <Head title="Sistem Informasi Desa - Manajemen Desa Digital">
                <meta name="description" content="Platform SaaS komprehensif untuk sistem informasi desa dalam manajemen data warga dan administratif digital dengan dukungan multi-tenancy" />
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
                {/* Header */}
                <header className="bg-white/80 backdrop-blur-sm border-b border-gray-200 dark:bg-gray-900/80 dark:border-gray-700">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center h-16">
                            <div className="flex items-center">
                                <h1 className="text-xl font-bold text-gray-900 dark:text-white">🏘️ DesaHub</h1>
                            </div>
                            <nav className="flex items-center space-x-4">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium"
                                    >
                                        Ke Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route('login')}
                                            className="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors"
                                        >
                                            Masuk
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium"
                                        >
                                            Daftar
                                        </Link>
                                    </>
                                )}
                            </nav>
                        </div>
                    </div>
                </header>

                {/* Hero Section */}
                <section className="py-20 px-4 sm:px-6 lg:px-8">
                    <div className="max-w-7xl mx-auto text-center">
                        <div className="mb-8">
                            <h1 className="text-5xl font-bold text-gray-900 dark:text-white mb-6">
                                🏘️ Sistem Manajemen Desa Digital
                            </h1>
                            <p className="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                                Platform SaaS komprehensif untuk mengelola data desa dan warga secara digital. 
                                Mendukung multi-tenancy dengan alur administratif lengkap dari RT hingga Kepala Desa.
                            </p>
                        </div>

                        <div className="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                            {!auth.user && (
                                <>
                                    <Link
                                        href={route('register')}
                                        className="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 transition-all transform hover:scale-105 font-semibold text-lg shadow-lg"
                                    >
                                        🚀 Mulai Gratis
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="bg-white text-blue-600 border-2 border-blue-600 px-8 py-4 rounded-xl hover:bg-blue-50 transition-all transform hover:scale-105 font-semibold text-lg shadow-lg dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                                    >
                                        📊 Lihat Demo
                                    </Link>
                                </>
                            )}
                        </div>

                        {/* Stats */}
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="text-3xl font-bold text-blue-600 mb-2">100+</div>
                                <div className="text-gray-600 dark:text-gray-300">Desa Terlayani</div>
                            </div>
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="text-3xl font-bold text-green-600 mb-2">50K+</div>
                                <div className="text-gray-600 dark:text-gray-300">Warga Terkelola</div>
                            </div>
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="text-3xl font-bold text-purple-600 mb-2">25K+</div>
                                <div className="text-gray-600 dark:text-gray-300">Surat Diproses</div>
                            </div>
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="text-3xl font-bold text-orange-600 mb-2">99.9%</div>
                                <div className="text-gray-600 dark:text-gray-300">Waktu Aktif</div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Features Section */}
                <section className="py-16 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
                    <div className="max-w-7xl mx-auto">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                                ✨ Fitur Lengkap
                            </h2>
                            <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                                Semua yang Anda butuhkan untuk digitalisasi dan menyederhanakan administrasi desa
                            </p>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            {features.map((feature, index) => (
                                <div key={index} className="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl hover:shadow-lg transition-shadow">
                                    <div className="text-4xl mb-4">{feature.icon}</div>
                                    <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                        {feature.title}
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        {feature.description}
                                    </p>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>

                {/* Workflow Section */}
                <section className="py-16 px-4 sm:px-6 lg:px-8">
                    <div className="max-w-7xl mx-auto">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                                🔄 Alur Proses Surat
                            </h2>
                            <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                                Proses persetujuan yang disederhanakan dari pengajuan warga hingga selesai
                            </p>
                        </div>

                        <div className="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-4">
                            <div className="bg-blue-100 dark:bg-blue-900/30 px-6 py-4 rounded-lg">
                                📝 Warga Ajukan
                            </div>
                            <div className="text-2xl">→</div>
                            <div className="bg-yellow-100 dark:bg-yellow-900/30 px-6 py-4 rounded-lg">
                                ✅ Persetujuan RT
                            </div>
                            <div className="text-2xl">→</div>
                            <div className="bg-orange-100 dark:bg-orange-900/30 px-6 py-4 rounded-lg">
                                🔄 Proses Admin
                            </div>
                            <div className="text-2xl">→</div>
                            <div className="bg-green-100 dark:bg-green-900/30 px-6 py-4 rounded-lg">
                                👨‍💼 Kepala Desa
                            </div>
                            <div className="text-2xl">→</div>
                            <div className="bg-purple-100 dark:bg-purple-900/30 px-6 py-4 rounded-lg">
                                ✨ Selesai
                            </div>
                        </div>
                    </div>
                </section>

                {/* Roles Section */}
                <section className="py-16 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
                    <div className="max-w-7xl mx-auto">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                                👥 Kontrol Akses Berbasis Peran
                            </h2>
                            <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                                Level akses yang berbeda untuk setiap peran dalam administrasi desa
                            </p>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {roles.map((roleInfo, index) => (
                                <div key={index} className="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl">
                                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                        {roleInfo.role}
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300 text-sm">
                                        {roleInfo.access}
                                    </p>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>

                {/* CTA Section */}
                <section className="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-blue-600 to-purple-600">
                    <div className="max-w-4xl mx-auto text-center">
                        <h2 className="text-3xl font-bold text-white mb-4">
                            Siap Digitalkan Desa Anda?
                        </h2>
                        <p className="text-blue-100 text-xl mb-8">
                            Bergabunglah dengan ratusan desa yang sudah menggunakan platform kami untuk menyederhanakan administrasi mereka
                        </p>
                        {!auth.user && (
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                <Link
                                    href={route('register')}
                                    className="bg-white text-blue-600 px-8 py-4 rounded-xl hover:bg-gray-100 transition-colors font-semibold text-lg shadow-lg"
                                >
                                    🚀 Mulai Gratis Sekarang
                                </Link>
                                <Link
                                    href={route('login')}
                                    className="bg-transparent text-white border-2 border-white px-8 py-4 rounded-xl hover:bg-white hover:text-blue-600 transition-colors font-semibold text-lg"
                                >
                                    📞 Hubungi Sales
                                </Link>
                            </div>
                        )}
                    </div>
                </section>

                {/* Footer */}
                <footer className="bg-gray-900 text-gray-300 py-12 px-4 sm:px-6 lg:px-8">
                    <div className="max-w-7xl mx-auto text-center">
                        <div className="mb-8">
                            <h3 className="text-2xl font-bold text-white mb-4">🏘️ DesaHub</h3>
                            <p className="text-gray-400 max-w-2xl mx-auto">
                                Memberdayakan desa dengan transformasi digital. Aman, scalable, dan mudah digunakan.
                            </p>
                        </div>
                        
                        <div className="border-t border-gray-700 pt-8">
                            <p className="text-gray-400">
                                Dibuat dengan ❤️ untuk desa-desa Indonesia. © 2024 DesaHub. Hak cipta dilindungi.
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}