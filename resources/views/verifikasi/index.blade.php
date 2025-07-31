<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold dark:text-gray-200">Verifikasi Surat Masuk dan Keluar</h2>
    </x-slot>

    <div class="py-6">
        {{-- Tombol Surat Masuk --}}
        <a href="#surat-masuk-section" class="rounded bg-blue-600 px-4 py-2 text-white dark:bg-blue-600">Surat Masuk</a>

        <div id="surat-masuk-section" class="mt-4 flex justify-center">
            <table class="mt-4 w-3/4 table-auto rounded bg-white text-center shadow dark:bg-gray-800 dark:text-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="w-[10%] p-2">Tanggal</th>
                        <th class="w-[15%] p-2">Asal</th>
                        <th class="w-[15%] p-2">Nomor</th>
                        <th class="w-[25%] p-2">Perihal</th>
                        <th class="w-[10%] p-2">File</th>
                        <th class="w-[25%] p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suratMasuk as $item)
                        <tr class="hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-700">
                            <td class="truncate p-2 text-center">{{ $item->tanggal }}</td>
                            <td class="truncate p-2 text-center">{{ $item->asal }}</td>
                            <td class="truncate p-2 text-center">{{ $item->nomor }}</td>
                            <td class="truncate p-2 text-center">{{ $item->perihal }}</td>
                            <td class="p-2 text-center">
                                <a href="{{ route('surat_masuk.preview', $item->id) }}" target="_blank"
                                    class="mr-2 text-blue-600 hover:underline">Preview</a>
                            </td>
                            <td class="p-2 text-center">
                                <div class="flex flex-wrap items-center justify-center space-x-2">
                                    <span
                                        class="badge badge-{{ $item->status === 'diajukan' ? 'warning' : ($item->status === 'diverifikasi' ? 'success' : 'danger') }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                    @if (auth()->user()->role === 'kepala' || (auth()->user()->role === 'admin' && $item->status !== 'selesai'))
                                        <form action="{{ route('verifikasi.surat_masuk', $item) }}" method="POST"
                                            class="mt-2 inline-flex items-center space-x-2">
                                            @csrf @method('PATCH')
                                            <select name="status"
                                                class="rounded bg-gray-200 p-2 text-sm dark:bg-gray-800">
                                                <option value="diajukan"
                                                    {{ $item->status == 'diajukan' ? 'selected' : '' }}>
                                                    Diajukan</option>
                                                <option value="diverifikasi"
                                                    {{ $item->status == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi
                                                </option>
                                                <option value="didisposisi"
                                                    {{ $item->status == 'didisposisi' ? 'selected' : '' }}>Didisposisi
                                                </option>
                                                <option value="selesai"
                                                    {{ $item->status == 'selesai' ? 'selected' : '' }}>
                                                    Selesai</option>
                                            </select>
                                            <button type="submit"
                                                class="ml-2 whitespace-nowrap rounded bg-blue-500 p-2 text-sm text-white">Ubah
                                                Status</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="h-5"></div>

        {{-- Tombol Surat Keluar --}}
        <a href="#surat-keluar-section" class="rounded bg-blue-600 px-4 py-2 text-white dark:bg-blue-600">Surat
            Keluar</a>

        <div id="surat-keluar-section" class="mt-4 flex justify-center">
            <table
                class="mt-4 w-3/4 table-auto rounded bg-white text-center shadow dark:bg-gray-800 dark:text-gray-200">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="w-[10%] p-2">Tanggal</th>
                        <th class="w-[15%] p-2">Asal</th>
                        <th class="w-[15%] p-2">Nomor</th>
                        <th class="w-[25%] p-2">Perihal</th>
                        <th class="w-[10%] p-2">File</th>
                        <th class="w-[25%] p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suratKeluar as $items)
                        <tr class="hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-700">
                            <td class="truncate p-2">{{ $items->tanggal }}</td>
                            <td class="truncate p-2">{{ $items->asal }}</td>
                            <td class="truncate p-2">{{ $items->nomor }}</td>
                            <td class="truncate p-2">{{ $items->perihal }}</td>
                            <td class="p-2">
                                <a href="{{ route('surat_keluar.preview', $items->id) }}" target="_blank"
                                    class="mr-2 text-blue-600 hover:underline">Preview</a>
                            </td>
                            <td class="p-2">
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="badge badge-{{ $items->status === 'diajukan' ? 'warning' : ($items->status === 'disetujui' ? 'success' : 'danger') }}">
                                        {{ ucfirst($items->status) }}
                                    </span>
                                    @if (auth()->user()->role === 'kepala' || (auth()->user()->role === 'admin' && $items->status !== 'selesai'))
                                        <form action="{{ route('verifikasi.surat_keluar', $items) }}" method="POST"
                                            class="flex items-center space-x-2">
                                            @csrf @method('PATCH')
                                            <select name="status"
                                                class="rounded bg-gray-200 p-2 text-sm dark:bg-gray-800">
                                                <option value="diajukan"
                                                    {{ $items->status == 'diajukan' ? 'selected' : '' }}>
                                                    Diajukan</option>
                                                <option value="disetujui"
                                                    {{ $items->status == 'disetujui' ? 'selected' : '' }}>
                                                    Disetujui</option>
                                                <option value="ditolak"
                                                    {{ $items->status == 'ditolak' ? 'selected' : '' }}>
                                                    Ditolak</option>
                                            </select>
                                            <button type="submit"
                                                class="ml-2 whitespace-nowrap rounded bg-blue-500 p-2 text-sm text-white">Ubah
                                                Status</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
