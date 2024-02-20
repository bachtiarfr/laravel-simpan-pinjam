@extends('layouts.app')

@section('title', 'Tambah Pinjaman')

@section('content')

@if ($message = Session::get('success'))
@push('scripts')
<script>
    swal({
        title: "Berhasil!",
        text: "{{ session('success') }}",
        icon: "success",
        button: false,
        timer: 3000
    });

</script>
@endpush
@endif

@if ($message = Session::get('error'))
@push('scripts')
<script>
    swal({
        title: "Gagal!",
        text: "{{ session('error') }}",
        icon: "error",
        button: false,
        timer: 3000
    });

</script>
@endpush
@endif

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-lg-4 col-sm-6">
                        <form action="{{ route('pinjaman.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="id_kelompok">ID Kelompok</label>
                                {{-- <input type="text"
                                    class="form-control {{ $errors->first('id_kelompok') ? 'is-invalid' : '' }}"
                                    id="id_kelompok" name="id_kelompok"> --}}
                                <select class="form-select {{ $errors->first('id_kelompok') ? 'is-invalid' : '' }}"
                                    name="id_kelompok" id="id_kelompok">
                                    <option value=""></option>
                                    @foreach ($data_kelompok as $kelompok)
                                    <option value="{{ $kelompok->id }}">{{ $kelompok->nama_kelompok }} - {{
                                        $kelompok->no_ktp }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{$errors->first('id_kelompok')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nama_kelompok">Nama Kelompok</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_kelompok') ? 'is-invalid' : '' }}"
                                    id="nama_kelompok" name="nama_kelompok">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_kelompok')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nominal">Jumlah</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nominal') ? 'is-invalid' : '' }}"
                                    id="nominal" name="nominal" autocomplete="off">
                                <div class="invalid-feedback">
                                    {{$errors->first('nominal')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jangka_waktu">Jangka Waktu</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('jangka_waktu') ? 'is-invalid' : '' }}"
                                    id="jangka_waktu" name="jangka_waktu" value="{{ $data_pengaturan->waktu_pinjaman }}"
                                    autocomplete="off">
                                <div class="invalid-feedback">
                                    {{$errors->first('jangka_waktu')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="bagi_hasil">Bagi Hasil (%)</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('bagi_hasil') ? 'is-invalid' : '' }}"
                                    id="bagi_hasil" name="bagi_hasil" value="{{ $data_pengaturan->jasa_pinjam }}"
                                    disabled readonly>
                                <div class="invalid-feedback">
                                    {{$errors->first('bagi_hasil')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="perbulan">Perbulan</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('perbulan') ? 'is-invalid' : '' }}"
                                    id="perbulan" name="perbulan">
                                <div class="invalid-feedback">
                                    {{$errors->first('perbulan')}}
                                </div>
                            </div>
                            <div class="my-4">
                                <label for="textarea">Keterangan</label>
                                <textarea class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}"
                                    placeholder="Tulis keterangan..." id="keterangan" name="keterangan"
                                    rows="4"></textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('keterangan')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary">Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById("id_kelompok").addEventListener("change", function(e) {
            let get_kelompok = this.options[this.selectedIndex].text.slice(0, -6); 
            document.getElementById("nama_kelompok").value = get_kelompok;
        });

        // On keyUp input jumlah        
        const nominal = document.getElementById('nominal');
        nominal.addEventListener('keyup', updateValue);

        jangka_waktu.addEventListener('keyup', updateValue);

        function updateValue(e) {
            const cek_attr = e.target.getAttribute('name');

            if (cek_attr === 'nominal') {
                const bagi_hasil = {{ $data_pengaturan->jasa_pinjam }}/100;
                const jangka_waktu = document.getElementById('jangka_waktu').value;

                const pinjam = e.target.value;
                const pokok = pinjam / jangka_waktu;
                const bagiHasil = bagi_hasil * pinjam;
                const total = pokok + bagiHasil;
                document.getElementById('perbulan').value = total;

            } else {
                const bagi_hasil = {{ $data_pengaturan->jasa_pinjam }}/100;
                const jangka_waktu = e.target.value;

                const pinjam = document.getElementById('nominal').value;
                const pokok = pinjam / jangka_waktu;
                const bagiHasil = bagi_hasil * pinjam;
                const total = pokok + bagiHasil;
                document.getElementById('perbulan').value = total;
            }
        }
</script>

@endpush