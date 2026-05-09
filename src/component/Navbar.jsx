import { useState } from "react";
import { Search, Menu, X } from "lucide-react";
import { Link, useNavigate } from "react-router-dom";
import logo from "../assets/school.png";

export default function Navbar() {
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  const [searchQuery, setSearchQuery] = useState("");
  const navigate = useNavigate();

  const handleSearch = (e) => {
    e.preventDefault();
    if (searchQuery.trim()) {
      navigate(`/berita?search=${encodeURIComponent(searchQuery)}`);
      setIsMobileMenuOpen(false); // Close mobile menu if open
    }
  };

  return (
    <nav className="w-full bg-white shadow-sm relative z-50">
      <div className="max-w-7xl mx-auto px-4 md:px-6 py-4 flex items-center justify-between">
        {/* Left */}
        <div className="flex items-center gap-10">
          {/* Logo */}
          <div className="flex items-center">
            <Link to="/" className="flex items-center gap-3">
              <img 
                src={logo} 
                alt="Sekolah Kita Logo" 
                className="w-8 h-8 md:w-10 md:h-10 object-contain"
              />
              <span className="font-semibold text-base md:text-lg">
                SMKN 2 Jakarta
              </span>
            </Link>
          </div>

          {/* Desktop Menu */}
          <ul className="hidden md:flex items-center gap-6 text-gray-700 font-medium">
            <li><Link to="/" className="hover:text-blue-600 cursor-pointer transition-colors duration-200">Home</Link></li>
            <li><Link to="/eskul" className="hover:text-blue-600 cursor-pointer transition-colors duration-200">Eskul</Link></li>
            <li><Link to="/berita" className="hover:text-blue-600 cursor-pointer transition-colors duration-200">Berita</Link></li>
            <li><Link to="/agenda" className="hover:text-blue-600 cursor-pointer transition-colors duration-200">Agenda</Link></li>
          </ul>
        </div>

        {/* Right side - Search and Mobile Toggle */}
        <div className="flex items-center gap-3 md:gap-4">
          {/* Desktop Search */}
          <form onSubmit={handleSearch} className="hidden md:flex items-center gap-2 border rounded-full px-3 py-1.5 bg-gray-50 focus-within:border-blue-400 focus-within:ring-1 focus-within:ring-blue-400 transition-all">
            <button type="submit" aria-label="Search">
              <Search size={18} className="text-gray-500 cursor-pointer hover:text-blue-600" />
            </button>
            <input
              type="text"
              placeholder="Cari berita atau agenda..."
              className="bg-transparent outline-none text-sm w-48"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
            />
          </form>

          {/* Mobile Menu Toggle */}
          <button 
            className="md:hidden text-gray-600 hover:text-blue-600 transition-colors"
            onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
            aria-label="Toggle mobile menu"
          >
            {isMobileMenuOpen ? <X size={24} /> : <Menu size={24} />}
          </button>
        </div>
      </div>

      {/* Mobile Menu Dropdown */}
      {isMobileMenuOpen && (
        <div className="md:hidden absolute top-full left-0 w-full bg-white border-t shadow-lg py-4 px-4 flex flex-col gap-4 animate-in slide-in-from-top-2">
          <form onSubmit={handleSearch} className="flex items-center gap-2 border rounded-full px-3 py-2 bg-gray-50 focus-within:border-blue-400 focus-within:ring-1 focus-within:ring-blue-400 transition-all w-full">
            <button type="submit" aria-label="Search">
              <Search size={18} className="text-gray-500 cursor-pointer" />
            </button>
            <input
              type="text"
              placeholder="Cari berita atau agenda..."
              className="bg-transparent outline-none text-sm w-full"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
            />
          </form>
          
          <ul className="flex flex-col text-gray-700 font-medium">
            <li>
              <Link to="/" className="block py-3 border-b hover:text-blue-600 transition-colors" onClick={() => setIsMobileMenuOpen(false)}>Home</Link>
            </li>
            <li>
              <Link to="/eskul" className="block py-3 border-b hover:text-blue-600 transition-colors" onClick={() => setIsMobileMenuOpen(false)}>Eskul</Link>
            </li>
            <li>
              <Link to="/berita" className="block py-3 border-b hover:text-blue-600 transition-colors" onClick={() => setIsMobileMenuOpen(false)}>Berita</Link>
            </li>
            <li>
              <Link to="/agenda" className="block py-3 hover:text-blue-600 transition-colors" onClick={() => setIsMobileMenuOpen(false)}>Agenda</Link>
            </li>
          </ul>
        </div>
      )}
    </nav>
  );
}