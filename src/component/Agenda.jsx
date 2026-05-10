import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import useSEO from "../hooks/useSEO";
import { fetchAgenda } from "../utils/api";

export default function Agenda() {
  const [agendaList, setAgendaList] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);

  useSEO(
    "Agenda Sekolah",
    "Jadwal dan agenda kegiatan resmi SMK Negeri 2 Jakarta. Informasi rapat, ujian, dan acara sekolah terkini."
  );

  useEffect(() => {
    fetchAgenda()
      .then((data) => setAgendaList(data))
      .catch((err) => setError(err.message || "Gagal memuat agenda."))
      .finally(() => setIsLoading(false));
  }, []);

  const renderDateBadge = (date) => {
    const [day, month] = (date || "").split(" ");
    return (
      <div className="flex flex-col items-center justify-center bg-blue-50 border border-blue-100 text-blue-700 rounded-lg p-4 min-w-[120px] shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
        <span className="text-sm font-semibold uppercase">{month || "TBA"}</span>
        <span className="text-3xl font-bold">{day || "--"}</span>
      </div>
    );
  };

  return (
    <main className="max-w-7xl mx-auto px-6 mt-8 mb-12">
      <div className="bg-white rounded-2xl shadow-sm p-6">
        <h1 className="text-2xl font-bold mb-8 text-gray-800 border-b pb-4">Agenda Sekolah</h1>

        {isLoading ? (
          <div className="text-center py-16 text-gray-500">Memuat agenda...</div>
        ) : error ? (
          <div className="text-center py-16 text-red-600">{error}</div>
        ) : agendaList.length === 0 ? (
          <div className="text-center py-16 text-gray-500">Tidak ada agenda tersedia.</div>
        ) : (
          <div className="space-y-6">
            {agendaList.map((agenda) => (
              <Link
                key={agenda.id}
                to={`/berita?id=${agenda.id}`}
                className="group block border rounded-xl p-6 hover:shadow-md transition-all duration-300 hover:border-blue-500 bg-white"
              >
                <div className="flex flex-col md:flex-row gap-6 items-start md:items-center">
                  {renderDateBadge(agenda.date)}

                  <div className="flex-1">
                    <h2 className="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors mb-2">{agenda.title}</h2>
                    <div className="flex flex-col sm:flex-row gap-2 sm:gap-6 text-sm text-gray-600 mb-3">
                      <span className="flex items-center gap-1">
                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {agenda.time}
                      </span>
                      <span className="flex items-center gap-1">
                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {agenda.location || "Lokasi belum tersedia"}
                      </span>
                    </div>
                    <p className="text-gray-600 line-clamp-2">{agenda.description || "Tidak ada deskripsi tambahan."}</p>
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
