const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || "https://api.faaruq.com";

async function fetchApi(path) {
  const response = await fetch(`${API_BASE_URL}${path}`);

  if (!response.ok) {
    const errorText = await response.text();
    throw new Error(`API fetch gagal: ${response.status} ${response.statusText} - ${errorText}`);
  }

  return response.json();
}

export function fetchEskul() {
  return fetchApi('/eskul');
}

export function fetchAgenda() {
  return fetchApi('/agenda');
}

export function fetchBerita(params = {}) {
  const queryString = new URLSearchParams(params).toString();
  return fetchApi(`/berita${queryString ? `?${queryString}` : ''}`);
}

export function fetchBeritaDetail(id) {
  return fetchApi(`/berita/${id}`);
}
