import useSEO from "../hooks/useSEO";

export default function Home() {
  useSEO(
    "Beranda",
    "Portal resmi SMK Negeri 2 Jakarta. Temukan berita terbaru, agenda sekolah, ekstrakurikuler, dan prestasi siswa SMKN 2 Jakarta – Gambir, Jakarta Pusat."
  );

  return (
    <main className="max-w-7xl mx-auto px-6 mt-8">
      {/* Hero Image */}
      <div className="w-full h-[320px] rounded-2xl overflow-hidden shadow-md">
        <img
          src="/HomeKeluargaBesar.webp"
          alt="Keluarga Besar SMK Negeri 2 Jakarta"
          className="w-full h-full object-cover"
          width="1400"
          height="510"
          loading="eager"
          fetchpriority="high"
        />
      </div>

      {/* Tentang Sekolah */}
      <div className="mt-8 bg-white rounded-2xl shadow-sm p-6">
        <h1 className="text-2xl font-bold mb-4">
          Selamat Datang di Portal SMKN 2 Jakarta
        </h1>
        <p className="text-gray-700 leading-relaxed">
          SMK Negeri 2 Jakarta adalah sekolah menengah kejuruan negeri yang
          berlokasi di Jl. Batu No.3, Gambir, Jakarta Pusat. Dengan visi
          menghasilkan lulusan yang kompeten, berkarakter, dan siap memasuki
          dunia kerja, SMKN 2 Jakarta terus berinovasi dalam bidang pendidikan
          kejuruan. Sekolah ini menyediakan berbagai program keahlian serta
          kegiatan ekstrakurikuler yang mendukung pengembangan potensi seluruh
          siswa.
        </p>
      </div>

      {/* Info Ringkas */}
      <section
        className="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4 mb-12"
        aria-label="Informasi singkat SMKN 2 Jakarta"
      >
        <div className="bg-blue-50 rounded-2xl p-5 shadow-sm text-center">
          <p className="text-3xl font-bold text-blue-700">NPSN</p>
          <p className="text-gray-600 mt-1 font-medium">20100140</p>
        </div>
        <div className="bg-blue-50 rounded-2xl p-5 shadow-sm text-center">
          <p className="text-3xl font-bold text-blue-700">Akreditasi</p>
          <p className="text-gray-600 mt-1 font-medium">Unggul (A)</p>
        </div>
      </section>
    </main>
  );
}