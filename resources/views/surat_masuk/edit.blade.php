<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Surat Masuk</h2>
    </x-slot>

    <div class="flex justify-center py-6">
        <div class="w-full max-w-xl rounded bg-white p-6 shadow dark:bg-gray-700">
            <form method="POST" action="{{ route('surat_masuk.update', $surat->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="mb-1 block">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $surat->tanggal) }}"
                        class="w-full rounded border px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="mb-1 block">Tujuan</label>
                    <input type="text" name="tujuan" value="{{ old('tujuan', $surat->tujuan) }}"
                        class="w-full rounded border px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="mb-1 block">Asal</label>
                    <input type="text" name="asal" value="{{ old('asal', $surat->asal) }}"
                        class="w-full rounded border px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="mb-1 block">Nomor</label>
                    <input type="text" name="nomor" value="{{ old('nomor', $surat->nomor) }}"
                        class="w-full rounded border px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="mb-1 block">Perihal</label>
                    <input type="text" name="perihal" value="{{ old('perihal', $surat->perihal) }}"
                        class="w-full rounded border px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="mb-1 block">File (PDF/DOC/DOCX, max 5MB)</label>
                    <input type="file" name="file" class="w-full rounded border px-3 py-2">
                    @if ($surat->file)
                        <div class="mt-2">
                            <a href="{{ Storage::url($surat->file) }}" target="_blank"
                                class="text-blue-600 hover:underline">Lihat File Saat Ini</a>
                        </div>
                    @endif
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('surat_masuk.index') }}"
                        class="mr-4 rounded bg-gray-300 px-4 py-2 text-black dark:text-white">Batal</a>
                    <button type="submit"
                        class="rounded bg-blue-600 px-4 py-2 text-black dark:text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
