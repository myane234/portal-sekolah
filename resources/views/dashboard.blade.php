<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background:#eff6ff">
                <svg fill="none" stroke="#3b82f6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ \App\Models\Berita::count() }}</div>
                <div class="stat-label">Total Berita</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4">
                <svg fill="none" stroke="#16a34a" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ \App\Models\Eskul::count() }}</div>
                <div class="stat-label">Ekstrakurikuler</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fffbeb">
                <svg fill="none" stroke="#d97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ \App\Models\Agenda::count() }}</div>
                <div class="stat-label">Agenda Aktif</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#f5f3ff">
                <svg fill="none" stroke="#7c3aed" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ \App\Models\Berita::where('category','prestasi')->count() }}</div>
                <div class="stat-label">Prestasi</div>
            </div>
        </div>
    </div>

    <!-- Recent Content -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
        <!-- Recent Berita -->
        <div class="card">
            <div class="card-header">
                <h3>Berita Terbaru</h3>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
            </div>
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Berita::latest()->take(5)->get() as $b)
                        <tr>
                            <td style="max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $b->title }}</td>
                            <td>
                                @php
                                    $badgeMap = ['berita'=>'badge-blue','prestasi'=>'badge-green','eskul'=>'badge-purple'];
                                    $bc = $badgeMap[$b->category] ?? 'badge-blue';
                                @endphp
                                <span class="badge {{ $bc }}">{{ ucfirst($b->category) }}</span>
                            </td>
                            <td style="color:#64748b;font-size:12px">{{ $b->date ? $b->date->format('d M Y') : '—' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" style="text-align:center;color:#9ca3af;padding:24px">Belum ada berita</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Upcoming Agenda -->
        <div class="card">
            <div class="card-header">
                <h3>Agenda Mendatang</h3>
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
            </div>
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Agenda::orderBy('date','asc')->take(5)->get() as $a)
                        <tr>
                            <td style="max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $a->title }}</td>
                            <td style="color:#64748b;font-size:12px">{{ $a->date ? $a->date->format('d M Y') : '—' }}</td>
                            <td style="color:#64748b;font-size:12px">{{ $a->location ?? '—' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" style="text-align:center;color:#9ca3af;padding:24px">Belum ada agenda</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
