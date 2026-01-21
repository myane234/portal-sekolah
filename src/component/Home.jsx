export default function Home() {
return (
<main className="max-w-7xl mx-auto px-6 mt-8">
{/* Hero Image */}
<div className="w-full h-[320px] rounded-2xl overflow-hidden shadow-md">
<img
src="https://smkn2jkt.sch.id/wp-content/uploads/2024/10/All-Keluarga-besar-1400x510.jpg"
alt="School"
className="w-full h-full object-cover"
/>
</div>


{/* Text */}
<div className="mt-8 bg-white rounded-2xl shadow-sm p-6">
<h1 className="text-2xl font-bold mb-4">Selamat Datang di Portal Sekolah</h1>
<p className="text-gray-700 leading-relaxed">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
commodo consequat.
</p>
</div>
</main>
);
}