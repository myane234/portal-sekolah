const BACKEND_URL = import.meta.env.VITE_BACKEND_URL || "https://api.faaruq.com/api";

export async function askGroq(prompt) {
  const response = await fetch(`${BACKEND_URL}/api/chat`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ message: prompt }),
  });

  if (!response.ok) {
    const payload = await response.json().catch(() => null);
    const message = payload?.message || payload?.error || `Server mengembalikan status ${response.status}`;
    throw new Error(message);
  }

  const data = await response.json();
  return data.text;
}

export function getGroqBotStatus() {
  return {
    apiUrl: BACKEND_URL,
    model: import.meta.env.VITE_GROQ_MODEL || "llama-3.3-70b-versatile",
    keys: [],
  };
}
