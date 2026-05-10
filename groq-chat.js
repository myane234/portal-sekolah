import Groq from "groq-sdk";

const apiKey = process.env.GROQ_API_KEY || (process.env.GROQ_API_KEYS || "")
  .split(",")
  .map((key) => key.trim())
  .find(Boolean);
const apiUrl = process.env.GROQ_API_URL || "https://api.groq.dev/v1";
const defaultModel = process.env.GROQ_MODEL || "llama-3.3-70b";

if (!apiKey) {
  console.error(JSON.stringify({ error: "GROQ_API_KEY belum diset." }));
  process.exit(1);
}

const groq = new Groq({ apiKey, baseURL: apiUrl });

async function main() {
  let rawInput = "";
  for await (const chunk of process.stdin) {
    rawInput += chunk;
  }

  let payload;
  try {
    payload = JSON.parse(rawInput || "{}");
  } catch (error) {
    console.error(JSON.stringify({ error: "Invalid JSON input", detail: error.message }));
    process.exit(1);
  }

  const completion = await groq.chat.completions.create({
    model: payload.model || defaultModel,
    messages: payload.messages ?? [
      { role: "system", content: "You are a helpful assistant." },
      { role: "user", content: payload.message || "" },
    ],
  });

  process.stdout.write(JSON.stringify(completion));
}

main().catch((error) => {
  console.error(JSON.stringify({ error: error.message, stack: error.stack }));
  process.exit(1);
});
