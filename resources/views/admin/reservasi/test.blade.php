<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Edit Reservasi</h1>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Reservasi</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.reservasi.update', $reservasi) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_depan" class="form-label">Nama Depan</label>
                            <input type="text" class="form-control @error('nama_depan') is-invalid @enderror"
                                id="nama_depan" name="nama_depan"
                                value="{{ old('nama_depan', $reservasi->nama_depan) }}" required>
                            @error('nama_depan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_belakang" class="form-label">Nama Belakang</label>
                            <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror"
                                id="nama_belakang" name="nama_belakang"
                                value="{{ old('nama_belakang', $reservasi->nama_belakang) }}" required>
                            @error('nama_belakang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $reservasi->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">No Telepon</label>
                            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                                id="no_telepon" name="no_telepon"
                                value="{{ old('no_telepon', $reservasi->no_telepon) }}" required>
                            @error('no_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idMeja" class="form-label">Meja</label>
                            <select class="form-control @error('idMeja') is-invalid @enderror" id="idMeja"
                                name="idMeja" required>
                                <option value="">Pilih Meja</option>
                                @foreach ($mejas as $meja)
                                    <option value="{{ $meja->idMeja }}"
                                        {{ old('idMeja', $reservasi->idMeja) == $meja->idMeja ? 'selected' : '' }}>
                                        Meja {{ $meja->idMeja }} (Kapasitas: {{ $meja->jumlahPengunjung }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idMeja')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="datetime-local" class="form-control @error('tanggal') is-invalid @enderror"
                                id="tanggal" name="tanggal" value="{{ old('tanggal', $reservasi->tanggal) }}"
                                required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jumlahPengunjung" class="form-label">Jumlah Pengunjung</label>
                            <input type="number" class="form-control @error('jumlahPengunjung') is-invalid @enderror"
                                id="jumlahPengunjung" name="jumlahPengunjung"
                                value="{{ old('jumlahPengunjung', $reservasi->jumlahPengunjung) }}" required>
                            @error('jumlahPengunjung')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status"
                                name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="pending"
                                    {{ old('status', $reservasi->status) == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="dikonfirmasi"
                                    {{ old('status', $reservasi->status) == 'dikonfirmasi' ? 'selected' : '' }}>
                                    Dikonfirmasi
                                </option>
                                <option value="selesai"
                                    {{ old('status', $reservasi->status) == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                                <option value="dibatalkan"
                                    {{ old('status', $reservasi->status) == 'dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.reservasi.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
