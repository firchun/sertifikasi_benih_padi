<button type="button" onclick="editUjiLab({{ $Sertifikasi->id }})" class="btn btn-warning mb-3"><i class="bx bx-edit"></i>
    Rubah Data</button>
<table class="table table-bordered table-sm">
    <tr>
        <td class="table-primary">Jenis Tanaman</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $Sertifikasi->komoditas }}</td>
    </tr>
    <tr>
        <td class="table-primary">Varietas</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $Sertifikasi->varietas->name }}</td>
    </tr>
    <tr>
        <td class="table-primary">Kelas Benih</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">BD</td>
    </tr>
    <tr>
        <td class="table-primary">Nomor Induk</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $uji_lab->nomor_induk }}</td>
    </tr>
    <tr>
        <td class="table-primary">Musim Tanam</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $uji_lab->musim_tanam }}</td>
    </tr>
    <tr>
        <td class="table-primary">Musim Kelompok</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $uji_lab->nomor_kelompok }}</td>
    </tr>
    <tr>
        <td class="table-primary">Tanggal Panen</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $uji_lab->tanggal_panen }}</td>
    </tr>
    <tr>
        <td class="table-primary">Tanggal Selesai Pengujian</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $uji_lab->tanggal_selesai_pengujian }}</td>
    </tr>
    <tr>
        <td class="table-primary">Tanggal Pemeriksaan</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $uji_lab->tanggal_label }}</td>
    </tr>
    <tr>
        <td class="table-primary">Volume</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $uji_lab->volume }} ton</td>
    </tr>
    <tr>
        <td class="table-primary">Label</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $uji_lab->label }}</td>
    </tr>
    <tr>
        <td class="table-primary">Kesimpulan</td>
        <td style="width: 10px;">:</td>
        <td colspan="3" class="{{ $uji_lab->kesimpulan == 'Lulus' ? 'text-success' : 'text-danger' }}">
            {{ $uji_lab->kesimpulan == 'Lulus' ? 'Lulus sertifikasi' : 'Tidak lulus sertifikasi' }}</td>
    </tr>
</table>
<h3 class="text-center">Mutu Benih</h3>
<table class="table table-bordered table-sm">
    <tr>
        <td class="table-primary">Campuran Varietas Lain</td>
        <td style="width: 10px;">:</td>
        <td>{{ $uji_lab->campuran_varietas_lain }} %</td>
    </tr>
    <tr>
        <td class="table-primary">Kadar Air</td>
        <td style="width: 10px;">:</td>
        <td>{{ $uji_lab->kadar_air }} %</td>
    </tr>
    <tr>
        <td class="table-primary">Benih Murni</td>
        <td style="width: 10px;">:</td>
        <td>{{ $uji_lab->benih_murni }} %</td>
    </tr>
    <tr>
        <td class="table-primary">Daya Berkecambah</td>
        <td style="width: 10px;">:</td>
        <td>{{ $uji_lab->daya_berkecambah }} %</td>
    </tr>
    <tr>
        <td class="table-primary">Biji tanaman lain/biji gulma</td>
        <td style="width: 10px;">:</td>
        <td>{{ $uji_lab->biji_gulma }} %</td>
    </tr>
    <tr>
        <td class="table-primary">Kesehatan Benih</td>
        <td style="width: 10px;">:</td>
        <td>{{ $uji_lab->kesehatan_benih }} %</td>
    </tr>
</table>
