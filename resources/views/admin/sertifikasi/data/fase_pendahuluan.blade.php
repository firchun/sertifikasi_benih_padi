@if (Auth::user()->role == 'BPSB')
    <button type="button" onclick="editFasePendahuluan({{ $Sertifikasi->id }})" class="btn btn-warning mb-3"><i
            class="bx bx-edit"></i>
        Rubah Data</button>
@endif
<table class="table table-bordered table-sm">
    <tr>

        <td class="table-primary">Komoditas</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $Sertifikasi->komoditas }}</td>
    </tr>
    <tr>
        <td class="table-primary">Nama Produsen Benih</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $Sertifikasi->user->name ?? '-' }}</td>
    </tr>
    <tr>
        <td class="table-primary">Alamat</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $Sertifikasi->alamat }}</td>
    </tr>
    <tr>
        <td class="table-primary">Blok</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->blok }}</td>
        <td class="table-primary">Kecamatan</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->kecamatan->name ?? '-' }}</td>
    </tr>
    <tr>
        <td class="table-primary">Kampung</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->desa->name ?? '-' }}</td>
        <td class="table-primary">Kabupaten</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->kabupaten }}</td>
    </tr>
    <tr>
        <td class="table-primary">Desa</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $Sertifikasi->desa->name ?? '-' }}</td>
    </tr>
    <tr>
        <td class="table-primary">Produsen Benih</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->produsen_asal }}</td>
        <td class="table-primary">No. Kelompok Benih</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->no_kelompok_benih }}</td>
    </tr>
    <tr>
        <td class="table-primary">Asal Benih</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->benih_asal }}</td>
        <td class="table-primary">Jumlah Benih</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->jumlah_benih }}</td>
    </tr>
    <tr>
        <td class="table-primary">Sumber/No. Kelas Benih</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">BS</td>
    </tr>
    <tr>
        <td colspan="5">Isolasi Tanaman Sekitar</td>
    </tr>
    <tr>
        <td class="table-primary">Utara</td>
        <td style="width: 10px;">:</td>
        <td>{{ $pendahuluan->tanaman_utara }}</td>
        <td class="table-primary">Selatan</td>
        <td style="width: 10px;">:</td>
        <td>{{ $pendahuluan->tanaman_selatan }}</td>
    </tr>
    <tr>
        <td class="table-primary">Timur</td>
        <td style="width: 10px;">:</td>
        <td>{{ $pendahuluan->tanaman_timur }}</td>
        <td class="table-primary">Barat</td>
        <td style="width: 10px;">:</td>
        <td>{{ $pendahuluan->tanaman_barat }}</td>
    </tr>
    <tr>
        <td colspan="5">Sejarah Lapangan</td>
    </tr>
    <tr>
        <td class="table-primary">Bekas tanaman</td>
        <td style="width: 10px;">:</td>
        <td>{{ $pendahuluan->bekas_tanam }}</td>
        <td class="table-primary">Varietas</td>
        <td style="width: 10px;">:</td>
        <td>{{ $pendahuluan->varietas_sebelumnya->name ?? '-' }}</td>
    </tr>
    <tr>
        <td class="table-primary">Kelas *)</td>
        <td style="width: 10px;">:</td>
        <td>{{ $pendahuluan->kelas_benih_sebelunya->name ?? '-' }}</td>
        <td class="table-primary">Bekas Bero</td>
        <td style="width: 10px;">:</td>
        <td>{{ $pendahuluan->bekas_bero }}</td>
    </tr>
    <tr>
        <td>Kesimpulan/rekomendasi</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $pendahuluan->kesimpulan }} Syarat Areal Sertifikasi Benih **)</td>
    </tr>
    <tr>
        <td>Catatan</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $pendahuluan->catatan }}</td>
    </tr>
</table>
