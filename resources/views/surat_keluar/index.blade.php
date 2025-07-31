<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold dark:text-gray-200">Daftar Surat Keluar</h2>
    </x-slot>

    <a href="{{ route('surat_keluar.create') }}"
        class="bg-blue-600 px-4 py-2 text-black dark:bg-blue-600 dark:text-gray-200">+ Tambah Surat Keluar</a>

    <div class="flex justify-center py-6">


        <table class="mt-4 w-3/4 table-auto rounded bg-white text-center shadow dark:bg-gray-800 dark:text-gray-200">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Asal</th>
                    <th class="p-2">Nomor</th>
                    <th class="p-2">Perihal</th>
                    <th class="p-2">File</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surat as $item)
                    <tr class="text-center hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-700">
                        <td class="p-2">{{ $item->tanggal }}</td>
                        <td class="p-2">{{ $item->asal }}</td>
                        <td class="p-2">{{ $item->nomor }}</td>
                        <td class="p-2">{{ $item->perihal }}</td>
                        <td class="p-2">
                            <a href="{{ route('surat_keluar.preview', $item->id) }}" target="_blank"
                                class="mr-2 text-blue-600 hover:underline">Preview</a>
                        </td>
                        <td class="p-2">{{ $item->status }}</td>
                        <td><a href="{{ route('surat_keluar.edit', $item->id) }}"
                                class="mr-4 text-yellow-600 hover:underline">Edit</a>
                            <form method="POST" action="{{ route('surat_keluar.destroy', $item) }}"
                                style="display:inline">
                                @csrf @method('DELETE')
                                <button class="pl-4 text-red-600 hover:underline"
                                    onclick="return confirm('Hapus surat ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Script untuk SweetAlert --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
</x-app-layout>
