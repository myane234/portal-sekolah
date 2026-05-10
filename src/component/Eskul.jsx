import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import useSEO from "../hooks/useSEO";
import { fetchEskul } from "../utils/api";

export default function Eskul() {
  const [eskulList, setEskulList] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);

  useSEO(
    "Ekstrakurikuler",
    "Daftar kegiatan ekstrakurikuler SMK Negeri 2 Jakarta: Pramuka, Paskibra, PMR, Rohis, dan lainnya. Kembangkan minat dan bakat bersama SMKN 2 Jakarta."
  );

  useEffect(() => {
    fetchEskul()
      .then((data) => setEskulList(data))
      .catch((err) => setError(err.message || "Gagal memuat daftar ekstrakurikuler."))
      .finally(() => setIsLoading(false));
  }, []);

  return (
    <main className="max-w-7xl mx-auto px-6 mt-8 mb-12">
      <div className="bg-white rounded-2xl shadow-sm p-6">
        <h1 className="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">
          Ekstrakurikuler SMKN 2 Jakarta
        </h1>

        {isLoading ? (
          <div className="text-center py-16 text-gray-500">Memuat ekstrakurikuler...</div>
        ) : error ? (
          <div className="text-center py-16 text-red-600">{error}</div>
        ) : eskulList.length === 0 ? (
          <div className="text-center py-16 text-gray-500">Tidak ada ekstrakurikuler tersedia.</div>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {eskulList.map((item) => (
              <Link
                key={item.id}
                to={`/berita?eskul=${item.slug || item.id}`}
                className="group flex flex-col items-center p-6 border rounded-xl hover:shadow-md transition-all duration-300 hover:border-blue-500 bg-gray-50 hover:bg-white"
                aria-label={`Lihat berita ekstrakurikuler ${item.name}`}
              >
                <div className="w-24 h-24 mb-4 overflow-hidden flex items-center justify-center p-2 bg-white rounded-full shadow-sm group-hover:scale-110 transition-transform duration-300">
                  <img
                    src={item.logo}
                    alt={`Logo ${item.name} SMKN 2 Jakarta`}
                    className="w-full h-full object-contain"
                    loading="lazy"
                    width="96"
                    height="96"
                  />
                </div>
                <h2 className="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                  {item.name}
                </h2>
                <p className="text-sm text-gray-500 text-center mt-2">{item.description}</p>
              </Link>
            ))}
          </div>
        )}
      </div>
    </main>
  );
}
