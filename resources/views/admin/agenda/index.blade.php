<x-app-layout>
    <x-slot name="header">Manajemen Agenda</x-slot>

    <div class="page-header">
        <div>
            <h2>Agenda Sekolah</h2>
            <p>Kelola jadwal dan agenda kegiatan resmi sekolah</p>
        </div>
        <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Agenda
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Daftar Agenda ({{ $items->count() }} item)</h3>
        </div>
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Judul Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>
                            <div style="font-weight:500;color:#111827">{{ $item->title }}</div>
                            @if($item->description)
                            <div style="font-size:12px;color:#9ca3af;margin-top:2px">{{ Str::limit($item->description, 60) }}</div>
                            @endif
                        </td>
                        <td>
                            @if($item->date)
                            <div style="display:flex;flex-direction:column;align-items:flex-start">
                                <span style="font-size:18px;font-weight:700;color:#111827;line-height:1">{{ $item->date->format('d') }}</span>
                                <span style="font-size:11px;color:#64748b;font-weight:500">{{ $item->date->format('M Y') }}</span>
                            </div>
                            @else
                            <span style="color:#9ca3af">—</span>
                            @endif
                        </td>
                        <td style="color:#64748b;font-size:13px">{{ $item->time ?? '—' }}</td>
                        <td style="color:#64748b;font-size:13px">{{ $item->location ?? '—' }}</td>
                        <td>
                            <div style="display:flex;gap:8px;align-items:center">
                                <a href="{{ route('admin.agenda.edit', $item->id) }}" class="btn btn-secondary btn-sm">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.agenda.destroy', $item->id) }}" method="POST" style="margin:0" onsubmit="return confirm('Yakin hapus agenda ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <h3>Belum ada agenda</h3>
                                <p>Tambah agenda kegiatan sekolah</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
