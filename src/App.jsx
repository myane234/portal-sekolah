import { BrowserRouter, Routes, Route } from "react-router-dom";
import Navbar from "./component/Navbar.jsx";
import Home from "./component/Home.jsx";
import Eskul from "./component/Eskul.jsx";
import Berita from "./component/Berita.jsx";
import Agenda from "./component/Agenda.jsx";
import CSBot from "./component/CSBot.jsx";
import Footer from "./component/Footer.jsx";

export default function App() {
  return (
    <BrowserRouter>
      <div className="min-h-screen bg-gray-50 flex flex-col">
        <Navbar />
        <div className="flex-grow">
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/eskul" element={<Eskul />} />
            <Route path="/berita" element={<Berita />} />
            <Route path="/agenda" element={<Agenda />} />
            <Route path="/cs" element={<CSBot />} />
          </Routes>
        </div>
        <Footer />
      </div>
    </BrowserRouter>
  );
}