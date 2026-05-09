import { Link } from "react-router-dom";

const eskulList = [
  {
    id: "pramuka",
    name: "eskul",
    logo: "https://upload.wikimedia.org/wikipedia/commons/8/87/Gerakan_Pramuka_Indonesia.png",
    description: "afaaa",
  },
  {
    id: "paskibra",
    name: "eskul",
    logo: "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Logo_Paskibraka.png/480px-Logo_Paskibraka.png",
    description: "lorem",
  },
  {
    id: "pmr",
    name: "eskul",
    logo: "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4e/Logo_PMR_%28Palang_Merah_Remaja%29.png/600px-Logo_PMR_%28Palang_Merah_Remaja%29.png",
    description: "Palanhg pintu",
  },
  {
    id: "rohis",
    name: "eskul",
    logo: "https://cdn.pixabay.com/photo/2020/06/14/01/29/islam-5296205_1280.png",
    description: "SMKN2",
  },
];

export default function Eskul() {
  return (
    <main className="max-w-7xl mx-auto px-6 mt-8">
      <div className="bg-white rounded-2xl shadow-sm p-6">
        <h1 className="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">Ekstrakurikuler</h1>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {eskulList.map((eskul) => (
            <Link
              key={eskul.id}
              to={`/berita?eskul=${eskul.id}`}
              className="group flex flex-col items-center p-6 border rounded-xl hover:shadow-md transition-all duration-300 hover:border-blue-500 bg-gray-50 hover:bg-white"
            >
              <div className="w-24 h-24 mb-4 overflow-hidden flex items-center justify-center p-2 bg-white rounded-full shadow-sm group-hover:scale-110 transition-transform duration-300">
                <img
                  src={eskul.logo}
                  alt={eskul.name}
                  className="w-full h-full object-contain"
                />
              </div>
              <h2 className="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">{eskul.name}</h2>
              <p className="text-sm text-gray-500 text-center mt-2">{eskul.description}</p>
            </Link>
          ))}
        </div>
      </div>
    </main>
  );
}
