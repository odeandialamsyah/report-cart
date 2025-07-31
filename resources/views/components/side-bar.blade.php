<aside id="sidebar"
    class="translate-x flex w-80 flex-col justify-between bg-white px-6 py-8 shadow-md transition-all duration-300 dark:bg-gray-800">
    <nav class="flex-grow">
        <ul class="mt-4 space-y-2 px-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="block rounded px-3 py-2 text-gray-800 hover:bg-gray-200 dark:text-gray-100 dark:hover:bg-gray-700">Dashboard</a>
            @if (in_array($role, ['admin', 'petugas']))
                <li>
                    <a href="{{ route('surat_masuk.index') }}"
                        class="block rounded px-3 py-2 text-gray-800 hover:bg-gray-200 dark:text-gray-100 dark:hover:bg-gray-700">Surat
                        Masuk</a>
                </li>
                <li>
                    <a href="{{ route('surat_keluar.index') }}"
                        class="block rounded px-3 py-2 text-gray-800 hover:bg-gray-200 dark:text-gray-100 dark:hover:bg-gray-700">Surat
                        Keluar</a>
                </li>
                <li>
                    <a href="{{ route('verifikasi.index') }}"
                        class="block rounded px-3 py-2 text-gray-800 hover:bg-gray-200 dark:text-gray-100 dark:hover:bg-gray-700">Verifikasi
                        Status</a>
                </li>
            @endif

            @if ($role === 'kepala')
                <li>
                    <a href="{{ route('surat_keluar.index') }}"
                        class="block rounded px-3 py-2 text-gray-800 hover:bg-gray-200 dark:text-gray-100 dark:hover:bg-gray-700">Surat
                        Keluar</a>
                </li>
                <li>
                    <a href="{{ route('verifikasi.index') }}"
                        class="block rounded px-3 py-2 text-gray-800 hover:bg-gray-200 dark:text-gray-100 dark:hover:bg-gray-700">Verifikasi
                        Status</a>
                </li>
            @endif

            @if ($role === 'pengirim')
                <li>
                    <a href="{{ route('surat_masuk.create') }}"
                        class="block rounded px-3 py-2 text-gray-800 hover:bg-gray-200 dark:text-gray-100 dark:hover:bg-gray-700">Buat
                        Surat</a>
                </li>
            @endif
        </ul>
    </nav>
</aside>
