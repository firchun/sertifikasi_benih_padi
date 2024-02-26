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
                        <h4 class="has-line-end">Tahapan pengelolaan lahan sawah untuk tanaman padi</h4>
                        <nav id="TableOfContents">
                            <ul>
                                <li><a href="#Pembersihan" class="">Pembersihan</a>
                                </li>
                                <li><a href="#Pencangkulan" class="">Pencangkulan</a>
                                </li>
                                <li><a href="#Pembajakan" class="">Pembajakan</a>
                                </li>
                                <li><a href="#Perataan" class="">Perataan</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="content">
                        <h2 id="Pembersihan">Pembersihan</h2>
                        <p>Sebelum penggarapan tanah dimulai, Pematang/Galengan harus dibersihkan dari rerumputan,
                            diperbaiki, dan dibuat cukup tinggi. Fungsi utama untuk menahan air selama pengolahan tanah agar
                            tidak mengalir keluar petakan, sebab dalam penggarapan tanah air tidak boleh mengalir keluar.
                            Fungsi selanjutnya berkaitan erat dengan pengaturan kebutuhan air selama ada tanaman padi.
                        </p>
                        <p>
                            Saluran atau parit diperbaiki dan dibersihkan dari rumput-rumput. Kegiatan ini bertujuan agar
                            dapat memperlancar arus air serta menekan jumlah biji gulma yang terbawa masuk ke dalam petakan.
                            Sisa jerami dan sisa tanaman pada bidang olah dibersihkan sebelum tanah diolah.
                        </p>
                        <h2 id="Pencangkulan">Pencangkulan</h2>
                        <p>Setelah dilakukan perbaikan Pematang/Galengan dan Saluran, tahap berikutnya adalah pencangkulan.
                            Sudut–sudut petakan dicangkul untuk memperlancar pekerjaan bajak atau traktor. Pekerjaan
                            tersebut dilaksanakan bersamaan dengan saat pengolahan tanah.</p>
                        <h2 id="Pembajakan">Pembajakan</h2>
                        <p> Tanah dibalik dan dihaluskan. Pembajakan dan Penggaruan merupakan
                            kegiatan
                            yang berkaitan. Kedua kegiatan tersebut bertujuan agar tanah sawah melumpur dan siap ditanam
                            padi.</p>
                        <p>
                            Alirkan air pada petakan sawah seminggu sebelum pembajakan, untuk melunakan tanah dan
                            menghindarkan melekatnya tanah pada mata bajak. Terlebihdahulu dibuat alur ditepi dan ditengah
                            petakan sawah agar air cepat membasahi saluran petakan. Kedalaman dalam pembajakan ± 15-25 cm.
                            Hingga tanah benar-benar terbalikan dan hancur.
                        </p>
                        <p>
                            Adapun manfaat dari pembajakan adalah sebagai berikut :

                        <ol>
                            <li> Pemberantasan gulma, sebab dengan pembajakan tumbuhan dan biji gulma akan terbenam.
                            </li>
                            <li> Menambah unsur organik, karena pupuk hijau yang berasal dari rumput akan terbenam dan
                                tercampur dengan tanah.
                            </li>

                            <li> Mengurangi pertumbuhan hama penyakit.
                            </li>
                        </ol>
                        Setelah dibajak tanah segera harus digenangi, untuk mempercepat pembusukan sisa-sisa tanaman dan
                        menghindari hilangnya nitrogen juga melunakan bongkahan tanah yang disebabkan pembajakan.
                        Penggenangan dilakukan selama kira-kira seminggu.
                        </p>
                        <h4>Penggaruan</h4>
                        <p>
                            Sebelum penggaruan dimulai, terlebihdahulu air didalam petakan dibuang, ditinggalkan sedikit
                            untuk membasahi bongkahan bongkahan tanah. Selama penggaruan, saluran pemasukan dan pembuangan
                            air harus ditutup, untuk menjaga supaya sisa air jangan sampai habis keluar dari petakan.Dengan
                            cara menggaru tanah memanjang dan melintang, bongkahan-bongkahan tanah dapat dihancurkan. Dengan
                            penggaruan yang berulang-ulang :
                        </p>
                        <p>
                        <ol>
                            <li> Peresapan air ke bawah dikurangi</li>
                            <li>Tanah menjadi rata</li>
                            <li>Penanaman bibit menjadi mudah</li>
                            <li>Rumput-rumput yang ada akan terbenam</li>

                        </ol>
                        Setelah penggaruan pertama, sawah digenangi lagi selama 7-10 hari
                        </p>
                        <h2 id="Perataan">Perataan</h2>
                        <p>Proses perataan sebenarnya adalah penggaruan yang kedua, yang dilakukan setelah lahan digenangi
                            7-10 hari. Pengaruan yang kedua ini dilakukan dengan maksud :
                        <ol>
                            <li>Meratakan tanah sebelum tanam pindah</li>
                            <li>Membenamkan pupuk dasar guna menghindari denitrifikasi</li>
                            <li>Melumpurkan tanah dengan sempurna</li>

                        </ol>
                        Tahapan pengolahan tanah mulai dari perbaikan pematang/galengan sampai perataan memerlukan waktu
                        ± 25 hari atau ± sama dengan umur bibit di persemaian.</p>
                        <a href="https://jombangkab.go.id/opd/pertanian/berita/pengolahan-tanah-tanaman-padi">Informasi
                            lengkap pengolahan
                            tanah tanaman
                            padi</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
