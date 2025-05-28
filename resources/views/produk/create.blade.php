<h2>Tambah Produk</h2>

<form action="{{ url('/produk') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Nama Produk</label><br>
    <input type="text" name="nama_produk"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi"></textarea><br><br>

    <label>Harga</label><br>
    <input type="number" step="0.01" name="harga"><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok"><br><br>

    <label>Gambar Produk</label><br>
    <input type="file" name="gambar"><br><br>


<div>
    <label for="is_grosir">Aktifkan Grosir:</label>
    <input type="checkbox" id="is_grosir" name="is_grosir" value="1" onchange="toggleDiskonGrosir()">
</div>

<div id="diskonGrosirContainer" style="display:none;">
    <h4>Diskon Grosir</h4>
    <table id="diskonTable">
        <thead>
            <tr>
                <th>Minimal Jumlah</th>
                <th>Diskon (%)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <button type="button" onclick="tambahBarisDiskon()">+ Tambah Diskon</button>
</div>



    <button type="submit">Tambahkan</button>
</form>

<script>
    function toggleDiskonGrosir() {
        const checkbox = document.getElementById('is_grosir');
        document.getElementById('diskonGrosirContainer').style.display = checkbox.checked ? 'block' : 'none';
    }

    function tambahBarisDiskon() {
        const tbody = document.querySelector("#diskonTable tbody");
        const row = document.createElement("tr");
        row.innerHTML = `
            <td><input type="number" name="diskon_grosir[minimal_jumlah][]" min="1" required></td>
            <td><input type="number" name="diskon_grosir[persentase_diskon][]" min="1" max="100" required></td>
            <td><button type="button" onclick="this.closest('tr').remove()">Hapus</button></td>
        `;
        tbody.appendChild(row);
    }
</script>

