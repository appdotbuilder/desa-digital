import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    const features = [
        {
            icon: '👥',
            title: 'Citizen Management',
            description: 'Complete digital records of village citizens with demographics and family data'
        },
        {
            icon: '📝',
            title: 'Letter Services',
            description: 'Online letter submissions with approval workflow from RT to Village Head'
        },
        {
            icon: '📊',
            title: 'Analytics & Reports',
            description: 'Real-time statistics and detailed reports on population and administrative services'
        },
        {
            icon: '📰',
            title: 'News & Announcements',
            description: 'Village news management with approval system and public announcements'
        },
        {
            icon: '📸',
            title: 'Village Gallery',
            description: 'Document village activities, facilities, and development projects'
        },
        {
            icon: '🏘️',
            title: 'Multi-Tenant SaaS',
            description: 'Isolated data management for multiple villages with subscription management'
        }
    ];

    const roles = [
        { role: 'Super Admin', access: 'Global village management, subscription packages, billing' },
        { role: 'Village Admin', access: 'Citizen data entry, news management, manual letter input' },
        { role: 'Village Head', access: 'Final letter approvals, reports, news approval' },
        { role: 'RW Chairman', access: 'RW area citizen management, letter verification' },
        { role: 'RT Chairman', access: 'RT area citizen management, letter verification' },
        { role: 'Citizen', access: 'Online letter submission, status tracking, village news' }
    ];

    return (
        <>
            <Head title="Village Information System - Digital Village Management">
                <meta name="description" content="Comprehensive SaaS-based village information system for digital citizen and administrative data management with multi-tenancy support" />
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
                {/* Header */}
                <header className="bg-white/80 backdrop-blur-sm border-b border-gray-200 dark:bg-gray-900/80 dark:border-gray-700">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center h-16">
                            <div className="flex items-center">
                                <h1 className="text-xl font-bold text-gray-900 dark:text-white">🏘️ VillageHub</h1>
                            </div>
                            <nav className="flex items-center space-x-4">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium"
                                    >
                                        Go to Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route('login')}
                                            className="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors"
                                        >
                                            Log in
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium"
                                        >
                                            Register
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
                                🏘️ Digital Village Management System
                            </h1>
                            <p className="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                                Comprehensive SaaS platform for managing village and citizen data digitally. 
                                Support multi-tenancy with complete administrative workflows from RT to Village Head.
                            </p>
                        </div>

                        <div className="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                            {!auth.user && (
                                <>
                                    <Link
                                        href={route('register')}
                                        className="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 transition-all transform hover:scale-105 font-semibold text-lg shadow-lg"
                                    >
                                        🚀 Start Free Trial
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="bg-white text-blue-600 border-2 border-blue-600 px-8 py-4 rounded-xl hover:bg-blue-50 transition-all transform hover:scale-105 font-semibold text-lg shadow-lg dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                                    >
                                        📊 View Demo
                                    </Link>
                                </>
                            )}
                        </div>

                        {/* Stats */}
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="text-3xl font-bold text-blue-600 mb-2">100+</div>
                                <div className="text-gray-600 dark:text-gray-300">Villages Served</div>
                            </div>
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="text-3xl font-bold text-green-600 mb-2">50K+</div>
                                <div className="text-gray-600 dark:text-gray-300">Citizens Managed</div>
                            </div>
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="text-3xl font-bold text-purple-600 mb-2">25K+</div>
                                <div className="text-gray-600 dark:text-gray-300">Letters Processed</div>
                            </div>
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="text-3xl font-bold text-orange-600 mb-2">99.9%</div>
                                <div className="text-gray-600 dark:text-gray-300">Uptime</div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Features Section */}
                <section className="py-16 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
                    <div className="max-w-7xl mx-auto">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                                ✨ Comprehensive Features
                            </h2>
                            <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                                Everything you need to digitize and streamline village administration
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
                                🔄 Letter Processing Workflow
                            </h2>
                            <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                                Streamlined approval process from citizen request to completion
                            </p>
                        </div>

                        <div className="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-4">
                            <div className="bg-blue-100 dark:bg-blue-900/30 px-6 py-4 rounded-lg">
                                📝 Citizen Submit
                            </div>
                            <div className="text-2xl">→</div>
                            <div className="bg-yellow-100 dark:bg-yellow-900/30 px-6 py-4 rounded-lg">
                                ✅ RT Approval
                            </div>
                            <div className="text-2xl">→</div>
                            <div className="bg-orange-100 dark:bg-orange-900/30 px-6 py-4 rounded-lg">
                                🔄 Admin Process
                            </div>
                            <div className="text-2xl">→</div>
                            <div className="bg-green-100 dark:bg-green-900/30 px-6 py-4 rounded-lg">
                                👨‍💼 Village Head
                            </div>
                            <div className="text-2xl">→</div>
                            <div className="bg-purple-100 dark:bg-purple-900/30 px-6 py-4 rounded-lg">
                                ✨ Completed
                            </div>
                        </div>
                    </div>
                </section>

                {/* Roles Section */}
                <section className="py-16 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
                    <div className="max-w-7xl mx-auto">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                                👥 Role-Based Access Control
                            </h2>
                            <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                                Different access levels for each role in village administration
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
                            Ready to Digitize Your Village?
                        </h2>
                        <p className="text-blue-100 text-xl mb-8">
                            Join hundreds of villages already using our platform to streamline their administration
                        </p>
                        {!auth.user && (
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                <Link
                                    href={route('register')}
                                    className="bg-white text-blue-600 px-8 py-4 rounded-xl hover:bg-gray-100 transition-colors font-semibold text-lg shadow-lg"
                                >
                                    🚀 Start Your Free Trial
                                </Link>
                                <Link
                                    href={route('login')}
                                    className="bg-transparent text-white border-2 border-white px-8 py-4 rounded-xl hover:bg-white hover:text-blue-600 transition-colors font-semibold text-lg"
                                >
                                    📞 Contact Sales
                                </Link>
                            </div>
                        )}
                    </div>
                </section>

                {/* Footer */}
                <footer className="bg-gray-900 text-gray-300 py-12 px-4 sm:px-6 lg:px-8">
                    <div className="max-w-7xl mx-auto text-center">
                        <div className="mb-8">
                            <h3 className="text-2xl font-bold text-white mb-4">🏘️ VillageHub</h3>
                            <p className="text-gray-400 max-w-2xl mx-auto">
                                Empowering villages with digital transformation. Secure, scalable, and easy to use.
                            </p>
                        </div>
                        
                        <div className="border-t border-gray-700 pt-8">
                            <p className="text-gray-400">
                                Built with ❤️ for Indonesian villages. © 2024 VillageHub. All rights reserved.
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}