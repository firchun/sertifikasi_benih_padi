@extends('layouts.app')
@section('content')
    <section class="page-header bg-tertiary">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center">
                    <h2 class="mb-3 text-capitalize">{{ $title ?? 'Varietas Unggulan' }}</h2>
                    <ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
                        <li class="list-inline-item"><a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="list-inline-item">/ &nbsp; <a href="{{ url('/stoks') }}">{{ $title }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </section>
    <section class="section-sm">
        <div class="container">
            {{-- <div class="text-center">
                <img loading="lazy" decoding="async" class="w-50 mb-4" src="{{ asset('img/edukasi/lahan.jpeg') }}"
                    alt="placeholder image">
            </div> --}}
            <div class="row g-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="bg-white shadow rounded-lg p-4 sticky-top" style="top: 30px;">
                        <h4 class="has-line-end">Tahapan penanaman benih padi</h4>
                        <nav id="TableOfContents">
                            <ul>
                                <li><a href="#Pemilihan-benih-padi" class="">Pemilihan benih padi</a>
                                </li>
                                <li><a href="#Pembibitan-dan-penanaman" class="">Pembibitan dan penanaman</a>
                                </li>
                                <li><a href="#Perawatan" class="">Perawatan</a>
                                </li>
                                <li><a href="#Pengendalian-hama" class="">Pengendalian hama</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="content">
                        <h2 id="Pemilihan-benih-padi">Pemilihan benih padi</h2>
                        <p>Cara menanam padi yang baik dan menguntungkan perlu dilakukan sejak pemilihan benih. Benih padi
                            yang berkualitas merupakan hal yang penting jika ingin meningkatkan hasil panen padi. Selain
                            itu, kamu juga perlu memperhatikan kodisi lahan yang cocok dengan benih padi tersebut.</p>
                        <p>Beberapa ciri dari beras varietas unggulan adalah, tahan terhadap serangan hama dan penyakit,
                            toleran terhadap kondisi lingkungan, dapat menghasilkan panen yang berlimpah, dan saat direndam
                            dengan larutan ZA 20 gr, benih tenggelam alias tidak mengapung.</p>
                        <p><strong>Menyiapkan Lahan</strong></p>
                        <p>Menyiapkan lahan adalah salah satu komponen terpenting dalam cara menanam padi yang baik dan
                            menguntungkan ini. Sediakan lahan kosong yang subur yang sudah dibersihkan dari rumput liar dan
                            gulma yang mengganggu.&nbsp;</p>
                        <p>Untuk meningkatkan kesuburan tanah ketika ditanami. Tanah dialiri air hingga gembur dan lunak
                            kemudian bajak menggunakan traktor, lalu genangi air kembali setinggi 5-10 cm, dan biarkan air
                            menggenang dalam media tanam selama 2 minggu supaya racun racun dapat di netralisir oleh air.
                        </p>

                        <h2 id="Pembibitan-dan-penanaman">Pembibitan dan penanaman</h2>
                        <p>Cara menanam padi yang baik dan menguntungkan berikutnya adalah proses pembibitan. Setelah
                            menyiapkan lahan, sebar benih padi yang bagus yang sudah melalui tahap pengujian untuk
                            menentukan kualitasnya, rendam 2 hari hingga berkecambah.</p>
                        <p>Beri pupuk area persemaian tadi dengan pupuk urea dan tsp, masing masing 10 gram untuk setiap
                            semester lahan.</p>
                        <p><strong>Penanaman Padi</strong></p>
                        <p>Setelah persiapan benih dan lahan sudah selesai, maka cara menanam padi yang baik dan
                            menguntungkan selanjutnya adalah proses penanaman padi. Usia benih yang sudah dapat dipindahkan
                            adalah sekitar 20 hari, dengan ciri-ciri berdaun 5 &ndash; 6 helai, tinggi 22 &ndash; 25 cm,
                            batang bagian bawah besar dan keras, serta terbebas dari serangan hama. Satu lubang tanam hanya
                            untuk satu benih, dengan kedalaman tanam berkisar 2 cm.</p>

                        <h2 id="Perawatan">Perawatan</h2>
                        <p>Cara menanam padi yang baik dan menguntungkan selanjutnya tentu merawat dan memlihara tanaman
                            padi dengan baik. Pada saat perawatan dibutuhkan keteltian yang lebih karena jika kamu lalai
                            maka hasil panen akan kurang memuaskan.</p>
                        <p>Cara pertama, lakukan penyiangan dalam dua minggu sekali. Selanjutnya, lakukan pengairan yang
                            wajar supaya tidak kelebihan atau kekurangan. Selain itu, lakukan pemupukan setelah 7-15 hari
                            dengan munggunakan pupuk urea dan TSP dengan 100:50 per hektar. Pemupukan dilakukan setelah
                            25-30 hari dengan pupuk urea dan phonska dengan 50:100 per hektar.</p>
                        <p><strong>Pemupukan</strong></p>
                        <p>Cara menanam padi yang baik dan menguntungkan selanjutnya adalah dengan pemupukan seperti yang
                            telah disinggung sedikit sebelumnya. Tanah yang digunakan secara terus menerus untuk budidaya
                            tentu lambat laun akan kekurangan unsur hara. Salah satu solusi yang bisa kamu lakukan adalah
                            dengan pemberian pupuk, baik itu yang bersifat organik maunpun anorganik.</p>
                        <p>Agar pemakaian pupuk menjadi lebih efektif, maka kamu harus mampu menyesuaikan dengan kebutuhan
                            tanaman serta jumlah ketersediaan unsur hara dalam tanah. Kamu juga dapat menggunakan pupuk
                            alami yang dibuat sendiri.</p>

                        <h2 id="Pengendalian-hama">Pengendalian hama</h2>
                        <p>Hama dalam sawah biasanya meliputi walang sangit, belalang, wereng, dan tikus. Jadi, cara menanam
                            padi yang baik dan menguntungkan berikutnya adalah mengendalikan hama dan penyakit.</p>
                        <p>Untuk mengendalikan hama bisa digunakan pestisida tapi lebih baik jangan jika masih ada predator
                            alami bagi hama tersebut. Jika predator alami dari hama tersebut mulai mengganggu anda maka
                            musnahkanlah dan beralih pada pestisida organik.</p>
                        <p><strong>Proses Panen</strong></p>
                        <p>Panen padi tidak akan menghasilkan sesuatu yang menguntungkan apabila dilakukan dengan
                            sembarangan, dan hanya boleh dikerjakan saat bulir padi sudah cukup masak. Hal ini disebabkan
                            karena penen yang dilakukan terlalu dini akan menurunkan kuantitas serta kualitas panen. Berikut
                            ini ciri gabah yang sudah siap panen:</p>
                        <p>- Daun telah mengering dan 95% gabah sudah berwarna kuning</p>
                        <p>- Padi telah berusia 30 &ndash; 35 hari sejak hari sesudah berbunga, atau tergantung varietas
                            yang kamu tanam</p>
                        <p>- Gabah mudah rontok apabila diremas dengan tangan</p>
                        <p>- Kadar air pada gabah bersisa 16 &ndash; 30 %</p>
                        <p>Padi atau gabah yang sudah dipanen harus segera diletakkan pada tempat beralas terpal dengan
                            tujuan mengurangi atau menekan penyusutan hasil panen. Setelah itu, kamu dapat memulai proses
                            perontokan bulir padi.</p>
                        <p>Selepas itu, bulir-bulir gabah dijemur selama 2 &ndash; 3 hari agar kadar air semakin berkurang
                            atau mencapai 14 % saja. Setelah proses pengeringan selesai, gabah dapat disimpan di tempat yang
                            bersih dan kering.</p>
                        <p>Itulah beberapa cara menanam padai yang baik dan menguntungkan yang perlu kamu terapkan.
                            Sebaiknya mintalah bantuan pada orang yang berpengalaman agar mendapatkan hasil yang lebih baik.
                        </p>
                        <a
                            href="https://putatgede.kendalkab.go.id/kabardetail/ejJBcDhzUWF2SDNGcm53bUY2QmsyQT09/4-tahap-menanam-padi-yang-baik-dan-menguntungkan--mudah-dan-praktis.html">
                            4 Tahap Menanam Padi yang Baik dan Menguntungkan, Mudah dan Praktis</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
