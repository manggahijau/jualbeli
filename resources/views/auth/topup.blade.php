@extends('layouts.main')

@section('content')
    <body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Topup Saldo</h4>
                    </div>
                    <div class="card-body">
                        <!-- Tampilkan saldo saat ini -->
                        <div class="alert alert-info">
                            <strong>Saldo Saat Ini: </strong>
                            Rp {{ number_format(Auth::user()->saldo, 0, ',', '.') }}
                        </div>

                        <!-- Pesan sukses -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Pesan error -->
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Form topup -->
                        <form action="{{ route('topup.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah Topup</label>
                                <input type="number" 
                                       class="form-control @error('jumlah') is-invalid @enderror" 
                                       id="jumlah" 
                                       name="jumlah" 
                                       placeholder="Masukkan jumlah minimal Rp 1.000"
                                       min="1000"
                                       value="{{ old('jumlah') }}">
                                @error('jumlah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Quick amount buttons -->
                            <div class="mb-3">
                                <label class="form-label">Pilihan Cepat:</label>
                                <div class="btn-group d-flex" role="group">
                                    <button type="button" class="btn btn-outline-primary" onclick="setAmount(10000)">10K</button>
                                    <button type="button" class="btn btn-outline-primary" onclick="setAmount(25000)">25K</button>
                                    <button type="button" class="btn btn-outline-primary" onclick="setAmount(50000)">50K</button>
                                    <button type="button" class="btn btn-outline-primary" onclick="setAmount(100000)">100K</button>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Topup Sekarang</button>
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Kembali ke Home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setAmount(amount) {
            document.getElementById('jumlah').value = amount;
        }
    </script>
</body>
@endsection
