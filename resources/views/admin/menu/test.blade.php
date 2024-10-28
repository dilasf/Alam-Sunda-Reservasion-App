<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="container">
            <h1>Edit Menu</h1>

            <form action="{{ route('admin.menu.update', $menu->idMenu) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama Menu</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" value="{{ old('nama', $menu->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Detail Menu</label>
                    @foreach ($detailMenus as $detail)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="detail_menus[]"
                                value="{{ $detail->idDetailMenu }}" id="detail{{ $detail->idDetailMenu }}"
                                {{ in_array($detail->idDetailMenu, $menu->detailMenus->pluck('idDetailMenu')->toArray()) ? 'checked' : '' }}>
                            <label class="form-check-label" for="detail{{ $detail->idDetailMenu }}">
                                {{ $detail->nama }} (Rp {{ number_format($detail->harga, 2) }})
                            </label>
                        </div>
                    @endforeach
                    @error('detail_menus')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</x-admin-layout>
