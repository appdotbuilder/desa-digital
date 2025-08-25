import { Head } from '@inertiajs/react';
import React from 'react';

interface ErrorProps {
    status: number;
    message?: string;
    [key: string]: unknown;
}

export default function Error({ status, message }: ErrorProps) {
    const title = {
        503: 'Layanan Tidak Tersedia',
        500: 'Kesalahan Server',
        404: 'Halaman Tidak Ditemukan',
        403: 'Akses Dilarang',
        401: 'Tidak Diotorisasi',
    }[status] || 'Terjadi Kesalahan';

    const description = {
        503: 'Maaf, kami sedang melakukan maintenance. Silakan coba lagi nanti.',
        500: 'Terjadi kesalahan pada server kami. Tim teknis telah diberitahu.',
        404: 'Halaman yang Anda cari tidak dapat ditemukan.',
        403: 'Anda tidak memiliki izin untuk mengakses halaman ini.',
        401: 'Silakan login terlebih dahulu untuk mengakses halaman ini.',
    }[status] || 'Terjadi kesalahan yang tidak terduga.';

    return (
        <>
            <Head title={`${status} - ${title}`} />
            
            <div className="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col justify-center">
                <div className="max-w-md mx-auto text-center px-4">
                    <div className="mb-8">
                        <h1 className="text-6xl font-bold text-gray-900 dark:text-white mb-4">
                            {status}
                        </h1>
                        <h2 className="text-2xl font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            {title}
                        </h2>
                        <p className="text-gray-600 dark:text-gray-400 mb-8">
                            {message || description}
                        </p>
                    </div>
                    
                    <div className="space-y-4">
                        <button
                            onClick={() => window.history.back()}
                            className="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium"
                        >
                            ← Kembali
                        </button>
                        
                        <a
                            href="/"
                            className="block w-full bg-gray-200 text-gray-900 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors font-medium dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600"
                        >
                            🏘️ Ke Halaman Utama
                        </a>
                    </div>
                </div>
            </div>
        </>
    );
}