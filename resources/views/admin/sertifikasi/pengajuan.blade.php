@extends('layouts.backend.admin')

@section('content')
    <a href="{{ route('home') }}" class="btn btn-secondary mb-3"><span class="bx bx-left-arrow-alt"></span> Kembali</a>
    @include('layouts.backend.alert')
    <div class="my-4">
        <div class="alert alert-primary" role="alert">Silahkan isi formulir dibawah dengan benar dan teliti..</div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            {{ $title }}
        </div>
        <form action="{{ route('sertifikasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                <div class="mb-3">
                    <label for="komoditas" class="form-label">Komoditas</label>
                    <input type="text" class="form-control" id="komoditas" name="komoditas" value="Padi" readonly>
                </div>
                <hr>
                <h3>1. Identitas Pemohon</h3>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pemohon</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat"
                        value="{{ App\Models\Penangkar::where('id_user', Auth::user()->id)->first()->alamat }}" readonly>
                </div>
                <hr>
                <h3>2. Sertifikasi benih untuk</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Luas Pertanaman</label>
                            <input type="text" class="form-control" value="{{ old('luas_pertanaman') }}"
                                name="luas_pertanaman" pattern="[0-9]+(\.[0-9]{1,2})?">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Varietas</label>
                            <select class="form-select" name="id_varietas">
                                @foreach (App\Models\varietas::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas_benih" class="form-label">Kelas Benih</label>
                            <select class="form-select" name="id_kelas_benih">
                                @foreach (App\Models\kelasBenih::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name . ' - ' . $item->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Tanggal Sebar</label>
                            <input type="date" class="form-control" name="tanggal_sebar"
                                value="{{ old('tanggal_sebar') }}">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Tanggal Tanam</label>
                            <input type="date" class="form-control" name="tanggal_tanam" {{ old('tanggal_tanam') }}>
                        </div>
                    </div>
                </div>
                <hr>
                <h3>3. Letak Tanah **)</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Blok</label>
                            <input type="text" class="form-control" name="blok" value="0">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Desa/Kampung</label>
                            <select class="form-select" name="id_desa">
                                @foreach (App\Models\Desa::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Kecamatan</label>
                            <select class="form-select" name="id_kecamatan">
                                @foreach (App\Models\Kecamatan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Kabupaten</label>
                            <input type="text" class="form-control" name="kabupaten" value="Merauke" readonly>
                        </div>
                    </div>
                </div>
                <hr>
                <h3>4. Tanaman Sebelumnya</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Jenis Tanaman</label>
                            <input type="text" class="form-control" name="jenis_tanaman_sebelumnya" value="Padi">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Tanggal Panen</label>
                            <input type="date" class="form-control" name="tanggal_panen_sebelumnya"
                                {{ old('tanggal_tanam_sebelumnya') }}>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Pemeriksaan Lapangan</label>
                            <input type="date" class="form-control" name="pemeriksaan_lapangan_sebelumnya"
                                {{ old('pemeriksaan_lapangan_sebelumnya') }}>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Varietas</label>
                            <select class="form-select" name="id_varietas_sebelumnya">
                                @foreach (App\Models\varietas::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Kelas Benih</label>
                            <select class="form-select" name="id_kelas_benih_sebelumnya">
                                @foreach (App\Models\kelasBenih::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name . ' - ' . $item->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Disertifikasi</label>
                            <select class="form-select" name="disertifikasi_sebelumnya">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <h3>5. Asal Benih</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Produsen Benih</label>
                            <input type="text" class="form-control" name="produsen_asal" {{ old('produsen_asal') }}>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Asal Benih</label>
                            <input type="text" class="form-control" name="benih_asal" {{ old('benih_asal') }}>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Sumber/No. Kelas Benih</label>
                            <select class="form-select" name="id_kelas_benih_asal">
                                @foreach (App\Models\kelasBenih::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name . ' - ' . $item->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">No. Kelompok Benih</label>
                            <input type="text" class="form-control" name="no_kelompok_benih"
                                {{ old('no_kelompok_benih') }}>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Jumlah Benih</label>
                            <input type="number" class="form-control" name="jumlah_benih" {{ old('jumlah_benih') }}>
                        </div>
                    </div>
                </div>
                <div class="mt-3 p-4 border border-info">

                    <strong>Kami menyadari sepenuhnya bahwa :</strong>
                    <p> a) Pertanaman kami tidak akan diterima sepenuhnya apabila tidak mengikuti prosedur sertifikasi benih
                        bina
                        tanaman pangan dan dibersihkan dari tanaman/varietas lain untuk memenuhi standar lapangan.
                    </p>
                    <p>
                        b) Kami wajib memberitahukan kepada Pengawas Benih Tanaman untuk pemeriksaan lapangan
                        selambat-lambatnya
                        7 (tujuh) hari sebelum pelaksanaan pemeriksaan.
                    </p>
                    <p>
                        c) Kami tidak diperkenankan memindahkan letak pertanaman tanpa memberitahukan Pengawas Benih
                        Tanaman.
                    </p>
                    <p>
                        d) Pengolahan benih harus mendapat bimbingan dari Pengawas Benih Tanaman.
                    </p>
                    <p>
                        e) Sertifikat benih bina tanaman pangan akan diberikan apabila telah lulus pemeriksaan lapangan dan
                        pengujian/ analisis mutu benih di laboratorium
                    </p>
                    <p>
                        f) Pemerintah tidak mempunyai kewajiban untuk membeli benih yang disertifikasi.
                    </p>
                    <p>
                        g) Kami bersedia membayar biaya jasa pemeriksaan lapangan dan pengujian/analisis mutu benih di
                        laboratorium sesuai dengan ketentuan yang berlaku
                    </p>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-lg">Ajukan Permohonan</button>
            </div>
        </form>
    </div>
@endsection
