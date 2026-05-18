import { useEffect, useState } from "react";
import useSEO from "../hooks/useSEO";
import { fetchJurusan } from "../utils/api";

export default function Jurusan() {
  const [jurusanList, setJurusanList] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);

  useSEO(
    "Jurusan SMKN 2 Jakarta",
    "Daftar jurusan SMKN 2 Jakarta. Temukan profil jurusan, logo, dan informasi dasar setiap program keahlian."
  );

  useEffect(() => {
    setError(null);
    setIsLoading(true);

    fetchJurusan()
      .then((data) => setJurusanList(Array.isArray(data) ? data : []))
      .catch((err) => setError(err.message || "Gagal memuat data jurusan."))
      .finally(() => setIsLoading(false));
  }, []);

  return (
    <main className="max-w-7xl mx-auto px-6 mt-8 mb-12">
      <div className="bg-white rounded-2xl shadow-sm p-6">
        <h1 className="text-2xl font-bold mb-4 text-gray-800 border-b pb-4">Jurusan SMKN 2 Jakarta</h1>

        {isLoading ? (
          <div className="text-center py-16 text-gray-500">Memuat jurusan...</div>
        ) : error ? (
          <div className="text-center py-16 text-red-600">{error}</div>
        ) : jurusanList.length === 0 ? (
          <div className="text-center py-16 text-gray-500">Belum ada data jurusan.</div>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {jurusanList.map((jurusan) => (
              <div key={jurusan.id} className="border rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 bg-white">
                <div className="h-48 bg-gray-100 overflow-hidden">
                  {jurusan.logo ? (
                    <img
                      src={jurusan.logo}
                      alt={jurusan.name}
                      className="w-full h-full object-cover"
                      loading="lazy"
                    />
                  ) : (
                    <div className="w-full h-full flex items-center justify-center text-gray-400">Logo tidak tersedia</div>
                  )}
                </div>
                <div className="p-6">
                  <h2 className="text-xl font-bold text-gray-900 mb-2">{jurusan.name}</h2>
                  <div className="text-sm text-gray-500 mb-4">
                    <p>{jurusan.created_at ? `Dibuat: ${jurusan.created_at}` : "Tanggal dibuat belum tersedia"}</p>
                    <p>{jurusan.updated_at ? `Terakhir diubah: ${jurusan.updated_at}` : "Tanggal update belum tersedia"}</p>
                  </div>
                  <div className="flex flex-wrap gap-2">
                    <span className="inline-flex items-center rounded-full bg-blue-50 text-blue-700 px-3 py-1 text-xs font-semibold uppercase tracking-wide">ID: {jurusan.id}</span>
                  </div>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </main>
  );
}
