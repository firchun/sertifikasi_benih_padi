@if (Auth::user()->role == 'BPSB')
    <button type="button" onclick="editFaseVegetatif({{ $Sertifikasi->id }})" class="btn btn-warning mb-3"><i
            class="bx bx-edit"></i>
        Rubah Data</button>
@endif
<table class="table table-bordered table-sm">
    <tr>
        <td class="table-primary">Sifat-sifat tanaman sesuai dengan varietasnya</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $vegetatif->sesuai_varietas }}</td>
    </tr>
    <tr>
        <td class="table-primary">Keadaan hama dan penyakit</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $vegetatif->hama_penyakit }}</td>
    </tr>
    <tr>
        <td class="table-primary">Tingkat kemurnian di lapangan</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $vegetatif->kemurnian }}</td>
    </tr>
    <tr>
        <td class="table-primary">Populasi pertanaman tiap contoh pemeriksaan</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $vegetatif->pemeriksaan }}</td>
    </tr>

    <tr>
        <td class="table-primary">Keadaan rerumputan</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $vegetatif->keadaan_rumput }}</td>
    </tr>
    <tr>
        <td class="table-primary">Taksiran hasil</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $vegetatif->taksiran_hasil ?? '-' }} Ton/ha</td>
    </tr>
    <tr>
        <td colspan="5">Campuran varietas lain/tipe simpang</td>
    </tr>
    @foreach (json_decode($vegetatif->campuran_varietas) as $item)
        <tr>
            <td class="table-primary">{{ $item->no }}</td>
            <td style="width: 10px;">:</td>
            <td colspan="3">{{ $item->jumlah }}</td>
        </tr>
    @endforeach
    <tr>
        <td class="table-primary">Kesimpulan</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $vegetatif->kesimpulan }}</td>
    </tr>
    <tr>
        <td class="table-primary">Catatan</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $vegetatif->catatan }}</td>
    </tr>
</table>
