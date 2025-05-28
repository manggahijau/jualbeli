<h2>Edit Produk</h2>

<form action="{{ url('/produk/' . $produk->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Nama Produk</label><br>
    <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi">{{ $produk->deskripsi }}</textarea><br><br>

    <label>Harga</label><br>
    <input type="number" step="0.01" name="harga" value="{{ $produk->harga }}"><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" value="{{ $produk->stok }}"><br><br>

    <label>Gambar Produk</label><br>
    <input type="file" name="gambar"><br><br>

    <label>
        <input type="checkbox" name="is_grosir" id="is_grosir" value="1" {{ $produk->is_grosir ? 'checked' : '' }} onchange="toggleDiskonGrosir()">
        Aktifkan Harga Grosir
    </label>

    <div id="diskonGrosirContainer" style="{{ $produk->is_grosir ? '' : 'display:none;' }}">
        <h4>Diskon Grosir</h4>
        <table id="diskonTable">
            <thead>
                <tr>
                    <th>Minimal Jumlah</th>
                    <th>Diskon (%)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produk->diskonGrosir as $diskon)
                    <tr>
                        <td><input type="number" name="diskon_grosir[minimal_jumlah][]" value="{{ $diskon->minimal_jumlah }}" required></td>
                        <td><input type="number" name="diskon_grosir[persentase_diskon][]" value="{{ $diskon->persentase_diskon }}" required></td>
                        <td><button type="button" onclick="this.closest('tr').remove()">Hapus</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" onclick="tambahBarisDiskon()">+ Tambah Diskon</button>
    </div>

    <br><button type="submit">Update Produk</button>
</form>

<script>
    function toggleDiskonGrosir() {
        const isGrosir = document.getElementById('is_grosir').checked;
        document.getElementById('diskonGrosirContainer').style.display = isGrosir ? 'block' : 'none';
    }

    function tambahBarisDiskon() {
        const tbody = document.querySelector("#diskonTable tbody");
        const row = document.createElement("tr");
        row.innerHTML = `
            <td><input type="number" name="diskon_grosir[minimal_jumlah][]" required></td>
            <td><input type="number" name="diskon_grosir[persentase_diskon][]" required></td>
            <td><button type="button" onclick="this.closest('tr').remove()">Hapus</button></td>
        `;
        tbody.appendChild(row);
    }
</script>
