<table class="table table-bordered table-sm">
    <tr>

        <td class="table-primary">Komoditas</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $Sertifikasi->komoditas }}</td>
    </tr>
    <tr>
        <td class="table-primary">Nama Pemohon</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $Sertifikasi->user->name ?? '-' }}</td>
    </tr>
    <tr>
        <td class="table-primary">Alamat</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $Sertifikasi->alamat }}</td>
    </tr>
    <tr>
        <td colspan="5">2. Sertifikasi Benih Untuk</td>
    </tr>
    <tr>
        <td class="table-primary">Luas Pertanaman</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->luas_pertanaman }}</td>
        <td class="table-primary">Tanggal Sebar</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->tanggal_sebar }}</td>
    </tr>
    <tr>
        <td class="table-primary">Varietas</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->varietas->name ?? '-' }}</td>
        <td class="table-primary">Tanggal Tanam</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->tanggal_tanam }}</td>
    </tr>
    <tr>
        <td class="table-primary">Kelas Benih</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">BD</td>
    </tr>
    <tr>
        <td colspan="5">3. Letak Tanah **)</td>
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
        <td colspan="5">4. Tanaman Sebelumnya</td>
    </tr>
    <tr>
        <td class="table-primary">Jenis Tanaman</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->jenis_tanaman_sebelumnya }}</td>
        <td class="table-primary">Varietas</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->varietas_sebelumnya->name ?? '-' }}</td>
    </tr>
    <tr>
        <td class="table-primary">Tanggal Panen</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->tanggal_panen_sebelumnya ?? '-' }}</td>
        <td class="table-primary">Kelas Benih</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->kelas_benih_sebelunya->name ?? '-' }}</td>
    </tr>
    <tr>
        <td class="table-primary">Pemeriksaan Lapangan</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->pemeriksaan_lapangan_sebelumnya ?? '-' }}</td>
        <td class="table-primary">Disertifikasi</td>
        <td style="width: 10px;">:</td>
        <td>{{ $Sertifikasi->disertifikasi_sebelumnya }}</td>
    </tr>
    <tr>
        <td colspan="5">5. Asal Benih</td>
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
</table>
