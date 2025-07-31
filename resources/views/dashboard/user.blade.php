<div class="flex justify-center py-10">
    <div class="w-full max-w-md rounded-xl bg-gray-200 p-8 text-center shadow-lg dark:bg-gray-800">
        <div class="mb-4 flex justify-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                <svg class="h-8 w-8 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
        <h3 class="mb-2 text-2xl font-bold text-gray-800 dark:text-gray-100">Selamat Datang, Pengirim!</h3>
        <p class="mb-6 text-gray-600 dark:text-gray-300">Kirim surat masuk dan pantau statusnya dengan mudah melalui
            dashboard ini.</p>
        <a href="{{ route('surat_masuk.index') }}"
            class="inline-block rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white shadow transition hover:bg-blue-700">📄
            Lihat Daftar Surat Masuk</a>
    </div>
</div>
