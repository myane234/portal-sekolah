import useSEO from "../hooks/useSEO";
import { useRef, useEffect } from "react";

export default function Home() {
  useSEO(
    "Beranda",
    "Portal resmi SMK Negeri 2 Jakarta. Temukan berita terbaru, agenda sekolah, ekstrakurikuler, dan prestasi siswa SMKN 2 Jakarta – Gambir, Jakarta Pusat."
  );


  return (
    <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pb-16 space-y-14">

      <div className="rounded-[2rem] overflow-hidden shadow-2xl ring-1 ring-slate-200">
        <img
          src="/HomeKeluargaBesar.webp"
          alt="Keluarga Besar SMK Negeri 2 Jakarta"
          className="w-full h-80 object-cover sm:h-[420px]"
          width="1400"
          height="510"
          loading="eager"
          fetchpriority="high"
        />
      </div>

      <section className="grid gap-10 lg:grid-cols-[1.7fr_.3fr] items-center">
        <div className="space-y-6">
          <span className="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">
            SMKN 2 Jakarta • SEKOLAH ADIWIYATA • BERPRESTASI • JUARA
          </span>

          <div className="space-y-4">
            <h1 className="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-slate-900">
              Selamat datang di portal resmi SMKN 2 Jakarta
            </h1>
            <p className="text-base sm:text-lg text-slate-600 leading-8">
              SMKN 2 JAKARTA merupakan salah satu sekolah jenjang SMK berstatus Negeri yang berada di wilayah Kec. Gambir, Kota Jakarta Pusat, D.K.I. Jakarta. SMKN 2 JAKARTA didirikan pada tanggal 1 Januari 1970 dengan Nomor SK Pendirian 23532-58 yang berada dalam naungan Kementerian Pendidikan dan Kebudayaan. Dalam kegiatan pembelajaran, sekolah yang memiliki 693 siswa ini dibimbing oleh 38 guru yang profesional di bidangnya. Kepala Sekolah SMKN 2 JAKARTA saat ini adalah Murni Astuti. Operator yang bertanggung jawab adalah Bambang Hermawan.SMKN 2 JAKARTA merupakan salah satu sekolah jenjang SMK di wilayah Kota Jakarta Pusat yang menawarkan pendidikan berkualitas dengan terakreditasi A dan sertifikasi ISO 9001:2008. Dengan adanya keberadaan SMKN 2 JAKARTA, diharapkan dapat memberikan kontribusi dalam mencerdaskan anak bangsa di wilayah Kec. Gambir, Kota Jakarta Pusat.
            </p>
          </div>

          <div className="flex flex-col sm:flex-row gap-3">
            <a
              href="/berita"
              className="inline-flex items-center justify-center rounded-full bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >
              Baca Berita Terbaru
            </a>
            <a
              href="/agenda"
              className="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-900 transition hover:border-blue-400 hover:text-blue-600"
            >
              Lihat Agenda Sekolah
            </a>
          </div>
        </div>
      </section>


      <section className="rounded-3xl bg-gradient-to-br from-blue-600 to-blue-800 p-8 sm:p-10 shadow-xl">
        <div className="flex flex-col sm:flex-row gap-8 items-center sm:items-start">

          {/* Foto kepala sekolah */}
          <div className="flex-shrink-0 flex flex-col items-center gap-3">
            <div className="w-36 h-44 sm:w-40 sm:h-52 rounded-2xl overflow-hidden ring-4 ring-white/30 shadow-lg bg-blue-500">
              <img
                src="/Kepsek2030.jpeg"
                alt="Foto Kepala Sekolah SMKN 2 Jakarta 2030"
                className="w-full h-full object-cover object-top"
                width="160"
                height="208"
                loading="lazy"
                onError={(e) => {

                  e.currentTarget.style.display = "none";
                  e.currentTarget.parentElement.innerHTML = `
                    <div class="w-full h-full flex flex-col items-center justify-center gap-2 text-white/60">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                      </svg>
                      <span class="text-xs font-medium">Foto Kepala Sekolah</span>
                    </div>`;
                }}
              />
            </div>
            <div className="text-center">
              <p className="text-white font-semibold text-sm leading-tight">Sukastriyo, M.Kom</p>
              <p className="text-blue-200 text-xs mt-0.5">NIP. 197308031995121003</p>
            </div>
          </div>

          <div className="flex-1 space-y-4">
            <div>
              <p className="text-blue-200 text-sm font-semibold uppercase tracking-widest">Sambutan</p>
              <h2 className="text-white text-2xl sm:text-3xl font-bold mt-1">Kepala Sekolah</h2>
            </div>
            <p className="text-blue-100 leading-relaxed text-sm sm:text-base">
              Selamat datang di portal resmi SMK Negeri 2 Jakarta. Kami berkomitmen untuk mencetak
              generasi penerus bangsa yang kompeten, berkarakter, dan siap bersaing di era global.
              Dengan dukungan fasilitas modern dan tenaga pendidik profesional, SMKN 2 Jakarta
              terus berinovasi demi masa depan siswa yang lebih cerah.
            </p>
            <p className="text-white font-semibold text-sm italic">
              — Kepala Sekolah SMK Negeri 2 Jakarta
            </p>
          </div>
        </div>
      </section>

    
      <section className="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">

        {/* Card 1
        <div className="group relative rounded-3xl border border-slate-200 bg-white p-6 shadow-sm overflow-hidden transition hover:shadow-md hover:-translate-y-0.5">
          <div className="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity" />
          <div className="relative space-y-3">
            <div className="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
              </svg>
            </div>
            <h2 className="text-lg font-bold text-slate-900">Profil & Jurusan</h2>
            <p className="text-slate-500 text-sm leading-relaxed">
              Kenali lebih dekat SMKN 2 Jakarta — dari sejarah berdirinya, program keahlian unggulan,
              hingga akreditasi dan prestasi yang telah diraih selama puluhan tahun.
            </p>
            <a href="/profil" className="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
              Selengkapnya
              <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
              </svg>
            </a>
          </div>
        </div> */}

        {/* Card 2 - Agenda & Kegiatan */}
<div className="group relative rounded-3xl bg-slate-50 p-7 transition-all duration-300 hover:bg-white hover:shadow-xl hover:shadow-emerald-100/50 border border-transparent hover:border-slate-100 overflow-hidden">
  {/* Aksen Garis Desainer di Pojok Kanan Atas */}
  <div className="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-emerald-200/40 to-transparent rounded-bl-full transition-all duration-500 group-hover:scale-150" />
  
  <div className="relative flex flex-col h-full justify-between space-y-6">
    <div>
      
      <h2 className="text-xl font-extrabold text-slate-900 tracking-tight group-hover:text-emerald-700 transition-colors">
        Agenda & Kegiatan
      </h2>
      
      <p className="mt-2.5 text-slate-500 text-sm leading-relaxed font-medium">
        Pantau jadwal kegiatan sekolah, acara ekstrakurikuler, ujian, dan hari libur nasional.
      </p>
    </div>
    <a href="/agenda" className="inline-flex items-center justify-between w-full pt-4 border-t border-slate-200/60 text-sm font-bold text-slate-800 hover:text-emerald-600 transition group/btn">
      <span>Eksplor Kalender</span>
      <div className="w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center border border-slate-100 transition-all group-hover/btn:bg-emerald-600 group-hover/btn:text-white group-hover/btn:scale-110">
        <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4 transition-transform group-hover/btn:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2.5}>
          <path strokeLinecap="round" strokeLinejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
        </svg>
      </div>
    </a>
  </div>
</div>


<div className="group relative rounded-3xl bg-slate-50 p-7 transition-all duration-300 hover:bg-white hover:shadow-xl hover:shadow-amber-100/50 border border-transparent hover:border-slate-100 overflow-hidden sm:col-span-2 xl:col-span-1">
  <div className="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-amber-200/40 to-transparent rounded-bl-full transition-all duration-500 group-hover:scale-150" />
  
  <div className="relative flex flex-col h-full justify-between space-y-6">
    <div>
      
      <h2 className="text-xl font-extrabold text-slate-900 tracking-tight group-hover:text-amber-700 transition-colors">
        Berita Terkini
      </h2>
      
      <p className="mt-2.5 text-slate-500 text-sm leading-relaxed font-medium">
        Dapatkan liputan terbaru seputar prestasi siswa, pengumuman penting, dan informasi penerimaan murid baru.
      </p>
    </div>

    <a href="/berita" className="inline-flex items-center justify-between w-full pt-4 border-t border-slate-200/60 text-sm font-bold text-slate-800 hover:text-amber-600 transition group/btn">
      <span>Baca Artikel</span>
      <div className="w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center border border-slate-100 transition-all group-hover/btn:bg-amber-600 group-hover/btn:text-white group-hover/btn:scale-110">
        <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4 transition-transform group-hover/btn:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2.5}>
          <path strokeLinecap="round" strokeLinejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
        </svg>
      </div>
    </a>
  </div>
</div>

      </section>

    </main>
  );
}