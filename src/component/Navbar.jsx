import { Search } from "lucide-react";
import logo from "../assets/school.png";


export default function Navbar() {
return (
<nav className="w-full bg-white shadow-sm">
<div className="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
{/* Left */}
<div className="flex items-center gap-10">
{/* Logo */}
<div className="flex items-center gap-2">
<img 
  src={logo} 
  alt="Sekolah Kita Logo" 
  className="w-10 h-10"
/>
<span className="font-semibold text-lg">SMKN 2 Jakarta</span>
</div>


{/* Menu */}
<ul className="hidden md:flex items-center gap-6 text-gray-700 font-medium">
<li className="text-blue-600 cursor-pointer">Home</li>
<li className="hover:text-blue-600 cursor-pointer">Eskul</li>
<li className="hover:text-blue-600 cursor-pointer">Berita</li>
<li className="hover:text-blue-600 cursor-pointer">Agenda</li>
</ul>
</div>


{/* Search */}
<div className="flex items-center gap-2 border rounded-full px-3 py-1.5 bg-gray-50">
<Search size={18} className="text-gray-500" />
<input
type="text"
placeholder="Cari..."
className="bg-transparent outline-none text-sm"
/>
</div>
</div>
</nav>
);
}