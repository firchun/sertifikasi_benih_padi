<button type="button" onclick="editAlatPanen({{ $Sertifikasi->id }})" class="btn btn-warning mb-3"><i
        class="bx bx-edit"></i>
    Rubah Data</button>
<table class="table table-bordered table-sm">
    <tr>
        <td class="table-primary">Luas pemeriksaan fase akhir</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $panen->luas_pemeriksaan }}</td>
    </tr>
    <tr>
        <td class="table-primary">Luas penguasaan lahan panen</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $panen->lahan_panen }}</td>
    </tr>
    <tr>
        <td class="table-primary">Penguasaan hasil panen</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $panen->hasil_panen }}</td>
    </tr>
    <tr>
        <td class="table-primary">Tercampurnya benih dengan varietas/ tanaman lain/areal non</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $panen->campuran }}</td>
    </tr>


    <tr>
        <td colspan="5">Peralatan Panen</td>
    </tr>
    <tr class="table-success">
        <td>No</td>
        <td>Jenis Alat</td>
        <td>Jumlah</td>
        <td>Pemeriksaan</td>
        <td>Keterangan</td>
    </tr>
    @foreach (json_decode($panen->peralatan_panen) as $item)
        <tr>
            <td>{{ $item->no }}</td>
            <td>{{ $item->jenis }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>{{ $item->pemeriksaan }}</td>
            <td>{{ $item->keterangan }}</td>
        </tr>
    @endforeach
    <tr>
        <td class="table-primary">Kesimpulan</td>
        <td style="width: 10px;">:</td>
        <td colspan="3">{{ $panen->kesimpulan }}</td>
    </tr>

</table>
