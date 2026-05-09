import { useSearchParams, Link } from "react-router-dom";
import useSEO from "../hooks/useSEO";

// Mock data for news and events
const beritaList = [
  {
    id: "1",
    title: "",
    category: "prestasi",
    date: "12 Mei 2026",
    image: "",
    excerpt: "",
    content: ""
  },
  {
    id: "2",
    title: "",
    category: "berita",
    date: "10 Mei 2026",
    image: "",
    excerpt: "",
    content: ""
  },
  {
    id: "3",
    title: "",
    category: "eskul",
    subCategory: "pramuka",
    date: "05 Mei 2026",
    image: "",
    excerpt: "lorem ipsum dolor sit amet consectetur adipiscing elit",
    content: "lorem ipsum dolor sit amet consectetur adipiscing elit"
  },
  {
    id: "4",
    title: "Rapat Tahunan ",
    category: "agenda",
    date: "15 Mei 2026",
    image: "",
    excerpt: "Rapat ",
    content: "Rapat ."
  },
  {
    id: "5",
    title: "Ujian Akhir Semester Genap",
    category: "agenda",
    date: "20 Mei 2026",
    image: "",
    excerpt: "Ujian Akhir Semester Genap",
    content: "Ujian Akhir Semester Genap"
  },
  {
    id: "6",
    title: "",
    category: "agenda",
    date: "10 Juni 2026",
    image: "",
    excerpt: "",
    content: ""
  }
];

function BeritaContent({ title, filteredList }) {
  // SEO description dinamis berdasarkan konteks halaman
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

        {filteredList.length === 0 ? (
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
            {filteredList.map((item) => (
              <Link
                key={item.id}
                to={`/berita?id=${item.id}`}
                className="group flex flex-col border rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300 bg-white"
              >
                <div className="w-full h-48 overflow-hidden">
                  <img
                    src={item.image}
                    alt={item.title || "Berita SMKN 2 Jakarta"}
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                  />
                </div>
                <div className="p-5 flex-1 flex flex-col">
                  <div className="flex justify-between items-center mb-3">
                    <span className="text-xs font-semibold text-blue-600 uppercase tracking-wider">{item.category}</span>
                    <span className="text-xs text-gray-500">{item.date}</span>
                  </div>
                  <h2 className="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors mb-2 line-clamp-2">{item.title}</h2>
                  <p className="text-gray-600 text-sm line-clamp-3 mb-4">{item.excerpt}</p>
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

// Detail view dengan SEO per artikel
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
          <p>{detail.content}</p>
        </div>
      </article>
    </main>
  );
}

export default function Berita() {
  const [searchParams] = useSearchParams();

  const id = searchParams.get("id");
  const eskul = searchParams.get("eskul");
  const prestasi = searchParams.get("prestasi");
  const agenda = searchParams.get("agenda");
  const search = searchParams.get("search");

  // Jika ada ID, tampilkan detail
  if (id) {
    const detail = beritaList.find(b => b.id === id);
    if (!detail) return <div className="p-8 text-center">Berita tidak ditemukan</div>;
    return <BeritaDetail detail={detail} />;
  }

  // Jika tidak ada ID, tampilkan list
  let filteredList = beritaList;
  let title = "Berita Terbaru";

  if (search) {
    const query = search.toLowerCase();
    filteredList = beritaList.filter(
      b => b.title.toLowerCase().includes(query) || b.content.toLowerCase().includes(query)
    );
    title = `Hasil Pencarian: "${search}"`;
  } else if (eskul) {
    filteredList = beritaList.filter(b => b.category === "eskul" && b.subCategory === eskul);
    title = `Berita Ekstrakurikuler: ${eskul.toUpperCase()}`;
  } else if (prestasi !== null) {
    filteredList = beritaList.filter(b => b.category === "prestasi");
    title = "Kabar Prestasi";
  } else if (agenda !== null) {
    filteredList = beritaList.filter(b => b.category === "agenda");
    title = "Agenda Kegiatan";
  }

  return <BeritaContent title={title} filteredList={filteredList} />;
}

