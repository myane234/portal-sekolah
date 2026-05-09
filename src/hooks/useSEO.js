import { useEffect } from "react";

/**
 * Hook untuk mengatur <title> dan <meta description> secara dinamis per halaman.
 * Penting untuk SEO SPA agar setiap halaman punya identitas unik di mesin pencari.
 *
 * @param {string} title - Judul halaman
 * @param {string} description - Deskripsi halaman untuk meta description
 */
export default function useSEO(title, description) {
  useEffect(() => {
    // Update page title
    const fullTitle = title
      ? `${title} | SMKN 2 Jakarta`
      : "SMKN 2 Jakarta – Sekolah Menengah Kejuruan Negeri 2 Jakarta";
    document.title = fullTitle;

    // Update meta description
    let metaDesc = document.querySelector("meta[name='description']");
    if (metaDesc) {
      metaDesc.setAttribute(
        "content",
        description ||
          "Portal resmi SMK Negeri 2 Jakarta. Temukan informasi seputar berita terbaru, agenda kegiatan, ekstrakurikuler, dan prestasi siswa SMKN 2 Jakarta."
      );
    }

    // Update OG title
    let ogTitle = document.querySelector("meta[property='og:title']");
    if (ogTitle) ogTitle.setAttribute("content", fullTitle);

    // Update OG description
    let ogDesc = document.querySelector("meta[property='og:description']");
    if (ogDesc) {
      ogDesc.setAttribute(
        "content",
        description ||
          "Portal resmi SMK Negeri 2 Jakarta. Berita, agenda, dan ekstrakurikuler SMKN 2 Jakarta."
      );
    }

    // Update Twitter title
    let twTitle = document.querySelector("meta[name='twitter:title']");
    if (twTitle) twTitle.setAttribute("content", fullTitle);

    // Update Twitter description
    let twDesc = document.querySelector("meta[name='twitter:description']");
    if (twDesc) {
      twDesc.setAttribute(
        "content",
        description ||
          "Portal resmi SMK Negeri 2 Jakarta. Berita, agenda, dan ekstrakurikuler SMKN 2 Jakarta."
      );
    }

    // Restore default on unmount
    return () => {
      document.title =
        "SMKN 2 Jakarta – Sekolah Menengah Kejuruan Negeri 2 Jakarta";
    };
  }, [title, description]);
}
