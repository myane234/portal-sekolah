import { useEffect, useState } from "react";
import { useSearchParams, Link } from "react-router-dom";
import useSEO from "../hooks/useSEO";
import { fetchBerita, fetchBeritaDetail } from "../utils/api";

function BeritaContent({ title, beritaList }) {
  const seoDescMap = {
    "Berita Terbaru": "Berita terbaru dari SMK Negeri 2 Jakarta. Informasi kegiatan, pengumuman, dan prestasi siswa SMKN 2 Jakarta.",
    "Kabar Prestasi": "Prestasi terkini siswa SMK Negeri 2 Jakarta di tingkat kota, provinsi, dan nasional.",
    "Agenda Kegiatan": "Agenda dan jadwal kegiatan resmi SMK Negeri 2 Jakarta.",
  };
  const seoDesc = seoDescMap[title] || `${title} – Portal SMKN 2 Jakarta`;
  useSEO(title, seoDesc);

  return (
    <main className="max-w-7xl mx-auto px-6 mt-8 mb-12">
      <div className="bg-white rounded-2xl shadow-sm p-6">
        <h1 className="text-2xl font-bold mb-8 text-gray-800 border-b pb-4">{title}</h1>

        {beritaList.length === 0 ? (
          <div className="text-center py-12">
            <div className="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
              <svg className="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
            <h3 className="text-lg font-medium text-gray-900 mb-1">Pencarian Tidak Ditemukan</h3>
            <p className="text-gray-500">Tidak ada berita atau agenda yang sesuai dengan filter/pencarian Anda.</p>
          </div>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {beritaList.map((item) => (
              <Link
                key={item.id}
                to={`/berita?id=${item.id}`}
                className="group flex flex-col border rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300 bg-white"
              >
                <div className="w-full h-48 overflow-hidden bg-gray-100">
                  {item.image ? (
                    <img
                      src={item.image}
                      alt={item.title || "Berita SMKN 2 Jakarta"}
                      className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                      loading="lazy"
                    />
                  ) : (
                    <div className="w-full h-full flex items-center justify-center text-gray-400">
                      Tidak ada gambar
                    </div>
                  )}
                </div>
                <div className="p-5 flex-1 flex flex-col">
                  <div className="flex justify-between items-center mb-3">
                    <span className="text-xs font-semibold text-blue-600 uppercase tracking-wider">{item.category}</span>
                    <span className="text-xs text-gray-500">{item.date}</span>
                  </div>
                  <h2 className="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors mb-2 line-clamp-2">{item.title}</h2>
                  <p className="text-gray-600 text-sm line-clamp-3 mb-4">{item.excerpt || "Tidak ada ringkasan tersedia."}</p>
                  <div className="mt-auto pt-4 border-t border-gray-100">
                    <span className="text-blue-600 text-sm font-medium group-hover:underline">Baca selengkapnya &rarr;</span>
                  </div>
                </div>
              </Link>
            ))}
          </div>
        )}
      </div>
    </main>
  );
}

function BeritaDetail({ detail }) {
  useSEO(
    detail.title || "Detail Berita",
    detail.excerpt || `Baca selengkapnya tentang ${detail.title} di portal SMKN 2 Jakarta.`
  );

  return (
    <main className="max-w-4xl mx-auto px-6 mt-8 mb-12">
      <article className="bg-white rounded-2xl shadow-sm p-8">
        <Link to={-1} className="text-blue-600 hover:underline mb-6 inline-block text-sm font-medium">
          &larr; Kembali
        </Link>
        <span className="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold mb-4 uppercase tracking-wider">
          {detail.category}
        </span>
        <h1 className="text-3xl md:text-4xl font-bold mb-4 text-gray-900 leading-tight">{detail.title}</h1>
        <time className="text-gray-500 mb-8 text-sm block" dateTime={detail.date}>{detail.date}</time>
        {detail.image && (
          <div className="w-full h-[400px] mb-8 rounded-xl overflow-hidden shadow-sm">
            <img
              src={detail.image}
              alt={detail.title}
              className="w-full h-full object-cover"
              width="800"
              height="400"
            />
          </div>
        )}
        <div className="prose max-w-none text-gray-700 leading-relaxed text-lg">
          <p>{detail.content || "Konten belum tersedia."}</p>
        </div>
      </article>
    </main>
  );
}

export default function Berita() {
  const [searchParams] = useSearchParams();
  const [beritaList, setBeritaList] = useState([]);
  const [detail, setDetail] = useState(null);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);

  const id = searchParams.get("id");
  const eskul = searchParams.get("eskul");
  const prestasi = searchParams.get("prestasi");
  const agenda = searchParams.get("agenda");
  const search = searchParams.get("search");

  useEffect(() => {
    setError(null);
    setIsLoading(true);

    if (id) {
      fetchBeritaDetail(id)
        .then((data) => {
          setDetail(data);
          setBeritaList([]);
        })
        .catch((err) => setError(err.message || "Berita tidak dapat dimuat."))
        .finally(() => setIsLoading(false));
      return;
    }

    const params = {};
    if (search) params.search = search;
    else if (eskul) {
      params.category = "eskul";
      params.sub_category = eskul;
    } else if (prestasi !== null) {
      params.category = "prestasi";
    } else if (agenda !== null) {
      params.category = "agenda";
    }

    fetchBerita(params)
      .then((data) => {
        setBeritaList(data);
        setDetail(null);
      })
      .catch((err) => setError(err.message || "Berita tidak dapat dimuat."))
      .finally(() => setIsLoading(false));
  }, [id, eskul, prestasi, agenda, search]);

  if (isLoading) {
    return (
      <main className="max-w-7xl mx-auto px-6 mt-8 mb-12">
        <div className="bg-white rounded-2xl shadow-sm p-6 text-center text-gray-500">Memuat berita...</div>
      </main>
    );
  }

  if (error) {
    return (
      <main className="max-w-7xl mx-auto px-6 mt-8 mb-12">
        <div className="bg-white rounded-2xl shadow-sm p-6 text-center text-red-600">{error}</div>
      </main>
    );
  }

  if (id) {
    return detail ? <BeritaDetail detail={detail} /> : <div className="p-8 text-center">Berita tidak ditemukan</div>;
  }

  const title = search
    ? `Hasil Pencarian: "${search}"`
    : eskul
    ? `Berita Ekstrakurikuler: ${eskul.toUpperCase()}`
    : prestasi !== null
    ? "Kabar Prestasi"
    : agenda !== null
    ? "Agenda Kegiatan"
    : "Berita Terbaru";

  return <BeritaContent title={title} beritaList={beritaList} />;
}

