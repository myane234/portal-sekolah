import { MapPin, Phone, Mail, Instagram, Facebook, Youtube } from "lucide-react";
import logo from "../assets/school.webp";

export default function Footer() {
  return (
    <footer className="bg-gray-900 text-white pt-12 pb-8 mt-auto">
      <div className="max-w-7xl mx-auto px-6">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
          {/* Info Sekolah */}
          <div>
            <h3 className="text-xl font-bold mb-4 flex items-center gap-3">
              <div className="bg-white rounded-full p-1 w-10 h-10 flex items-center justify-center">
                <img src={logo} alt="Logo" className="w-8 h-8 object-contain" />
              </div>
              SMKN 2 Jakarta
            </h3>
            <div className="space-y-3">
              <p className="text-gray-400 flex items-start gap-3">
                <MapPin size={20} className="shrink-0 mt-1" />
                <span>Jl. Batu No.3, Gambir, Kota Jakarta Pusat, DKI Jakarta 10110</span>
              </p>
              <p className="text-gray-400 flex items-center gap-3">
                <Phone size={20} className="shrink-0" />
                <span>(021) 3844855</span>
              </p>
              <p className="text-gray-400 flex items-center gap-3">
                <Mail size={20} className="shrink-0" />
                <span>info@smkn2jkt.sch.id</span>
              </p>
              <p className="text-gray-400 flex items-center gap-3">
                <span className="font-bold flex items-center justify-center w-5 text-sm">ID</span>
                <span>NPSN: 20100140</span>
              </p>
            </div>
          </div>

          {/* Social Media */}
          <div>
            <h3 className="text-xl font-bold mb-4 border-b border-gray-700 pb-2 inline-block">Media Sosial</h3>
            <div className="flex flex-col gap-4 mt-2">
              <a href="#" className="flex items-center gap-3 text-gray-400 hover:text-white hover:text-blue-400 transition-colors">
                <Instagram size={22} />
                <span>@smkn2jakarta</span>
              </a>
              <a href="#" className="flex items-center gap-3 text-gray-400 hover:text-white transition-colors">
                {/* Custom TikTok SVG since it's not in standard lucide-react */}
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                  <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                </svg>
                <span>@smkn2jkt_official</span>
              </a>
              <a href="#" className="flex items-center gap-3 text-gray-400 hover:text-blue-500 transition-colors">
                <Facebook size={22} />
                <span>SMK Negeri 2 Jakarta</span>
              </a>
              <a href="#" className="flex items-center gap-3 text-gray-400 hover:text-red-500 transition-colors">
                <Youtube size={22} />
                <span>SMKN 2 Jakarta Official</span>
              </a>
            </div>
          </div>

          {/* Maps */}
          <div>
            <h3 className="text-xl font-bold mb-4 border-b border-gray-700 pb-2 inline-block">Lokasi Kami</h3>
            <div className="w-full h-48 rounded-lg overflow-hidden border-2 border-gray-700 shadow-lg mt-2">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11608.61615044059!2d106.82442083644858!3d-6.179429876426579!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4330fc1f097%3A0x380210b0f3ed4996!2sVocational%20High%20School%20State%202%20Of%20central%20Jakarta!5e1!3m2!1sen!2sid!4v1778331180258!5m2!1sen!2sid" width="100%" height="100%" style={{ border: 0 }} allowFullScreen="" loading="lazy" referrerPolicy="no-referrer-when-downgrade" title="Google Maps Lokasi SMKN 2 Jakarta"></iframe>
            </div>
          </div>
        </div>

        <div className="border-t border-gray-800 pt-8 mt-4 text-center text-gray-100 text-sm">
          <p>&copy; {new Date().getFullYear()} Portal SMKN 2 Jakarta.</p>
        </div>
      </div>
    </footer>
  );
}
