<h2>Tambah Produk</h2>

<form action="{{ url('/produk') }}" method="POST">
    @csrf
    <label>Nama Produk</label><br>
    <input type="text" name="nama_produk"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi"></textarea><br><br>

    <label>Harga</label><br>
    <input type="number" step="0.01" name="harga"><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok"><br><br>

    <button type="submit">Tambahkan</button>
</form>
