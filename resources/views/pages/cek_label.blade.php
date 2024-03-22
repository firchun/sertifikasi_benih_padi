@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="container">
            <table class="table table-bordered table-sm text-black">
                <tr>
                    <td class="table-primary">Jenis Tanaman</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="3">{{ $data->sertifikasi->komoditas }}</td>
                </tr>
                <tr>
                    <td class="table-primary">Varietas</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="3">{{ $data->sertifikasi->varietas->name }}</td>
                </tr>
                <tr>
                    <td class="table-primary">Kelas Benih</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="3">{{ $data->sertifikasi->kelas_benih->code }}</td>
                </tr>
                <tr>
                    <td class="table-primary">Nomor Induk</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="3">{{ $data->nomor_induk }}</td>
                </tr>
                <tr>
                    <td class="table-primary">Musim Tanam</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="3">{{ $data->musim_tanam }}</td>
                </tr>
                <tr>
                    <td class="table-primary">Musim Kelompok</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="3">{{ $data->nomor_kelompok }}</td>
                </tr>
                <tr>
                    <td class="table-primary">Tanggal Panen</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="3">{{ $data->tanggal_panen }}</td>
                </tr>
                <tr>
                    <td class="table-primary">Tanggal Selesai Pengujian</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="3">{{ $data->tanggal_selesai_pengujian }}</td>
                </tr>
                <tr>
                    <td class="table-primary">Tanggal Pemeriksaan</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="3">{{ $data->tanggal_label }}</td>
                </tr>
                <tr>
                    <td class="table-primary">Volume</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="3">{{ $data->volume }} ton</td>
                </tr>
                <tr>
                    <td class="table-primary">Label</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="3">{{ $data->label }}</td>
                </tr>

            </table>
            <h3 class="text-center">Mutu Benih</h3>
            <table class="table table-bordered table-sm text-black">
                <tr>
                    <td class="table-primary">Campuran Varietas Lain</td>
                    <td style="width: 10px;">:</td>
                    <td>{{ $data->campuran_varietas_lain }} %</td>
                </tr>
                <tr>
                    <td class="table-primary">Kadar Air</td>
                    <td style="width: 10px;">:</td>
                    <td>{{ $data->kadar_air }} %</td>
                </tr>
                <tr>
                    <td class="table-primary">Benih Murni</td>
                    <td style="width: 10px;">:</td>
                    <td>{{ $data->benih_murni }} %</td>
                </tr>
                <tr>
                    <td class="table-primary">Daya Berkecambah</td>
                    <td style="width: 10px;">:</td>
                    <td>{{ $data->daya_berkecambah }} %</td>
                </tr>
                <tr>
                    <td class="table-primary">Biji tanaman lain/biji gulma</td>
                    <td style="width: 10px;">:</td>
                    <td>{{ $data->biji_gulma }} %</td>
                </tr>
                <tr>
                    <td class="table-primary">Kesehatan Benih</td>
                    <td style="width: 10px;">:</td>
                    <td>{{ $data->kesehatan_benih }} %</td>
                </tr>
            </table>

        </div>
    </section>
@endsection
