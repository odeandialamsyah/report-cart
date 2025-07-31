<div class="space-y-4">
  <h3 class="text-lg font-semibold">Admin Panel</h3>
  <p>Kelola user, kelola surat, dan laporan sistem.</p>
</div>


<div class="flex justify-center py-6">
    <table class="w-3/4 table-auto rounded bg-white text-center shadow dark:bg-gray-800">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-3 text-center">Nama</th>
                <th class="p-3 text-center">Email</th>
                <th class="p-3 text-center">Role</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="p-3 text-center">{{ $user->name }}</td>
                    <td class="p-3 text-center">{{ $user->email }}</td>
                    <td class="p-3 text-center">
                        <form action="{{ route('admin.updateRole', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="role" class="rounded bg-gray-200 p-2 dark:bg-gray-800" required>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas
                                </option>
                                <option value="kepala" {{ $user->role == 'kepala' ? 'selected' : '' }}>Kepala</option>
                                <option value="pengirim" {{ $user->role == 'pengirim' ? 'selected' : '' }}>Pengirim
                                </option>
                            </select>
                            <button type="submit" class="ml-2 rounded bg-blue-500 p-2 text-white">Perbarui </button>

                        </form>
                    </td>
                    <td class="p-3 text-center">
                        <form method="POST" action="{{ route('admin.deleteUser', $user) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
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
