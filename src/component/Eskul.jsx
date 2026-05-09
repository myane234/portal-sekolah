import { Link } from "react-router-dom";
import useSEO from "../hooks/useSEO";

const eskulList = [
  {
    id: "pramuka",
    name: "Pramuka",
    logo: "https://upload.wikimedia.org/wikipedia/commons/8/87/Gerakan_Pramuka_Indonesia.png",
    description: "Gerakan kepanduan nasional yang membentuk karakter dan jiwa kepemimpinan siswa.",
  },
  {
    id: "paskibra",
    name: "Paskibra",
    logo: "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Logo_Paskibraka.png/480px-Logo_Paskibraka.png",
    description: "Pasukan pengibar bendera yang melatih kedisiplinan dan rasa nasionalisme.",
  },
  {
    id: "pmr",
    name: "PMR",
    logo: "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4e/Logo_PMR_%28Palang_Merah_Remaja%29.png/600px-Logo_PMR_%28Palang_Merah_Remaja%29.png",
    description: "Palang Merah Remaja – ekstrakurikuler kemanusiaan dan pertolongan pertama.",
  },
  {
    id: "rohis",
    name: "Rohis",
    logo: "https://cdn.pixabay.com/photo/2020/06/14/01/29/islam-5296205_1280.png",
    description: "Rohani Islam – kegiatan keagamaan dan pembinaan akhlak siswa Muslim.",
  },
];

export default function Eskul() {
  useSEO(
    "Ekstrakurikuler",
    "Daftar kegiatan ekstrakurikuler SMK Negeri 2 Jakarta: Pramuka, Paskibra, PMR, Rohis, dan lainnya. Kembangkan minat dan bakat bersama SMKN 2 Jakarta."
  );

  return (
    <main className="max-w-7xl mx-auto px-6 mt-8 mb-12">
      <div className="bg-white rounded-2xl shadow-sm p-6">
        <h1 className="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">
          Ekstrakurikuler SMKN 2 Jakarta
        </h1>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {eskulList.map((item) => (
            <Link
              key={item.id}
              to={`/berita?eskul=${item.id}`}
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
      </div>
    </main>
  );
}
