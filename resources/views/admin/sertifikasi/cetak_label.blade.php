<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Times New Roman', sans-serif;
            font-size: 10px;
        }

        tr,
        td {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body class="border border-dark p-2">
    <table style="width: 100%; height:100%;">
        <tr>
            <td style="margin:0; padding:0;"><strong>Jenis Tanaman</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->sertifikasi->komoditas }}</td>
            <td style="margin:0; padding:0;"><strong>Varietas</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->sertifikasi->varietas->name }}</td>
            <td rowspan="8" style="text-align: center; vertical-align: middle; margin:0; padding:5px;">
                <img src="data:image/png;base64, {!! $qr !!}">
            </td>
        </tr>

        <tr>
            <td style="margin:0; padding:0;"><strong>Kelas Benih</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->sertifikasi->kelas_benih->code }}</td>
            <td style="margin:0; padding:0;"><strong>Nomor Induk</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->nomor_induk }}</td>
        </tr>
        <tr>
            <td style="margin:0; padding:0;"><strong>Nomor Kelompok</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->nomor_kelompok }}</td>
            <td style="margin:0; padding:0;"><strong>Musim Tanam</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->musim_tanam }}</td>
        </tr>

        <tr>
            <td style="margin:0; padding:0;"><strong>Tanggal Pemeriksaan</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->tanggal_label }}</td>
        </tr>
        <tr>
            <td style="margin:0; padding:0; text-align: center;" colspan="6"><strong>Mutu Benih</strong></td>
        </tr>
        <tr>
            <td style="margin:0; padding:0;"><strong>Campuran</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->campuran_varietas_lain }} %</td>
            <td style="margin:0; padding:0;"><strong>Kadar Air</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->kadar_air }} %</td>
        </tr>
        <tr>
            <td style="margin:0; padding:0;"><strong>Benih Murni</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->benih_murni }} %</td>
            <td style="margin:0; padding:0;"><strong>Daya Berkecambah</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->daya_berkecambah }} %</td>
        </tr>
        <tr>
            <td style="margin:0; padding:0;"><strong>Buji Gulma/lain</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->biji_gulma }} %</td>
            <td style="margin:0; padding:0;"><strong>Kesehatan Benih</strong></td>
            <td style="margin:0; padding:0;">:</td>
            <td style="margin:0; padding:0;">{{ $data->kesehatan_benih }} %</td>
        </tr>



    </table>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
