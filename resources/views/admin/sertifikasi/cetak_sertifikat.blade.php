<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sertifikat</title>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <link rel="stylesheet" href="{{ public_path('css') }}/pdf/bootstrap.min.css" media="all" />
    <style>
        body {
            font-family: 'times new roman';
            font-size: 14px;
        }

        tr,
        td {
            margin: 0;
            padding: 0;
        }
    </style>

</head>

<body>
    <main>
        <table class="table table-borderless" style="margin-bottom: 0; padding-bottom:0;">
            <tr>
                <td style="width: 20%; padding:0;">
                    <img style="height: 80px;" src="{{ public_path('img') }}/logo_papua.png">
                </td>
                <td class="text-center" style="width: 80%;  padding:0;"><b>PEMERINTAH PROVINSI PAPUA</b><br>
                    DINAS PERTANIAN DAN PANGAN<br>
                    <b>BALAI PENGAWASAN DAN SERTIFIKASI BENIH TANAMAN PANGAN<br>
                        DAN HORTIKULTURA</b>
                </td>
                <td style="width: 20%; padding:0;"></td>
            </tr>
        </table>
        <hr style="border: 1px solid black;">
        <table class="table table-borderless">
            <tr>
                <td class="text-center" style="width: 80%;margin-bottom: 0px; padding:0;"><b>SERTIFIKAT BENIH
                        UNGGUL</b><br>
                    Nomor : {{ $data->nomor_sertifikat }}
                </td>
            </tr>
        </table>
        <p>
            Berdasarkan hasil pemeriksaan lapangan/pertanaman dan pengujian/analisis mutu benih di laboratorium / <br>
            <del>pemeriksaan umbi atau katak di gudang / pemeriksaan stek di lapangan / planlet di laboratorium kultur
                jaringan /</del><br>
            <del>plane kompot atau anakan tunggal di rumah kasa *)</del> terhadap :<br>
        </p>
        <table class="table table-borderless ">
            <tr>
                <td style="width: 30%; padding:0;">Jenis Tanaman</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;">Padi</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;">Varietas</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;">{{ $data->sertifikasi->varietas->name }}</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;">Kelas Benih</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;">{{ $data->sertifikasi->kelas_benih->code }}</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;">Nomor Induk</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;">{{ $data->nomor_induk }}</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;">Musim Tanam</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;">{{ $data->musim_tanam }}</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;">Nomor Lot/ Kelompok</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;">{{ $data->nomor_kelompok }}</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;">Tanggal Panen</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;">{{ $data->tanggal_panen }}</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;" colspan="2">Tanggal Selesai Pengujian</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;">Mutu Benih *)</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;">{{ $data->tanggal_selesai_pengujian }}</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;" colspan="2">Tanggal Pemeriksaan</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;">di Gudang *)</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;">{{ $data->tanggal_pemeriksaan }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center" style=" padding:0;"><b>ATAS NAMA</b></td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;" colspan="2">Produsen Benih</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;">Tanaman Pangan</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;">{{ $data->sertifikasi->penangkar->nama }}</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;">Alamat</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;">{{ $data->sertifikasi->alamat }}</td>
            </tr>
            <tr>
                <td style="width: 30%; padding:0;">Dengan Data Mutu Benih</td>
                <td style="width: 10px; padding:0;">:</td>
                <td style=" padding:0;"></td>
            </tr>
        </table>
        <div class="p-2 " style="border: 0.5px solid black;">
            <table class="table table-borderless">
                <tr>
                    <td style="width: 30%; padding:0;">Campuran Varietas Lain</td>
                    <td style="width: 10px; padding:0;">:</td>
                    <td style=" padding:0;">{{ $data->campuran_varietas_lain }} %</td>
                    <td style="width: 30%; padding:0;">Daya Berkecambah</td>
                    <td style="width: 10px; padding:0;">:</td>
                    <td style=" padding:0;">{{ $data->daya_berkecambah }} %</td>
                </tr>
                <tr>
                    <td style="width: 30%; padding:0;">Kadar Air</td>
                    <td style="width: 10px; padding:0;">:</td>
                    <td style=" padding:0;">{{ $data->kadar_air }} %</td>
                    <td style="width: 30%; padding:0;">Biji Tanaman lain/</td>
                    <td style=" padding:0;" colspan="2"></td>
                </tr>
                <tr>
                    <td style="width: 30%; padding:0;">Benih Murni</td>
                    <td style="width: 10px; padding:0;">:</td>
                    <td style=" padding:0;">{{ $data->benih_murni }} %</td>
                    <td style="width: 30%; padding:0;">Biji Gulma</td>
                    <td style="width: 10px; padding:0;">:</td>
                    <td style=" padding:0;">{{ $data->biji_gulma }} %</td>
                </tr>
                <tr>
                    <td style="width: 30%; padding:0;">Kotoran Benih</td>
                    <td style="width: 10px; padding:0;">:</td>
                    <td style=" padding:0;">{{ $data->kotoran_benih }} %</td>
                    <td style="width: 30%; padding:0;">Kesehatan Benih</td>
                    <td style="width: 10px; padding:0;">:</td>
                    <td style=" padding:0;">{{ $data->kesehatan_benih }} %</td>
                </tr>
            </table>
        </div>
        <p>
            Telah memenuhi standar mutu sebagai <b>"Benih Unggul Bersertifikat".</b> <br>
            Dengan demikian dapat diberikan label berwarna <b>{{ $data->label }}</b> pada setiap kemasannya, dengan
            <br>
            tanggal akhir label : <b>{{ $data->tanggal_label }}</b>
        </p>
        <div class="mt-3 float-right text-left">
            Dikeluarkan di : Merauke<br>
            Tanggal : {{ date('d-m-Y') }}<br>
            a.n. Kepala Balai Pengawasan dan Sertifikasi Benih<br>
            Tanaman Pangan dan Hortikultura Provinsi Papua<br>
            Pengawas Benih Tanaman Kabupaten Merauke,<br>
            <div style="margin-top:60px;">
                <strong><u>Daniel Moya, SP</u></strong><br>
                <strong>NIP. 19740412 200003 1 005<strong>
            </div>
        </div>

    </main>

</body>

</html>
