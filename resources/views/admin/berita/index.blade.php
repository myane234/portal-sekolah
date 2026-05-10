<x-app-layout>
    <x-slot name="header">Manajemen Berita</x-slot>

    <div class="page-header">
        <div>
            <h2>Berita</h2>
            <p>Kelola semua berita, prestasi, dan konten eskul</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Berita
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Daftar Berita ({{ $items->count() }} item)</h3>
        </div>
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:44px">#</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>
                            @if($item->image)
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="thumb">
                            @else
                                <div class="thumb" style="display:flex;align-items:center;justify-content:center;color:#cbd5e1">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:500;color:#111827">{{ $item->title }}</div>
                            @if($item->excerpt)
                            <div style="font-size:12px;color:#9ca3af;margin-top:2px">{{ Str::limit($item->excerpt, 60) }}</div>
                            @endif
                        </td>
                        <td>
                            @php
                                $map = ['berita'=>'badge-blue','prestasi'=>'badge-green','eskul'=>'badge-purple'];
                                $cls = $map[$item->category] ?? 'badge-blue';
                            @endphp
                            <span class="badge {{ $cls }}">{{ ucfirst($item->category) }}</span>
                            @if($item->sub_category)
                                <div style="font-size:11px;color:#9ca3af;margin-top:3px">{{ $item->sub_category }}</div>
                            @endif
                        </td>
                        <td style="color:#64748b;font-size:13px">{{ $item->date ? $item->date->format('d M Y') : '—' }}</td>
                        <td>
                            <div style="display:flex;gap:8px;align-items:center">
                                <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-secondary btn-sm">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" style="margin:0" onsubmit="return confirm('Yakin hapus berita ini?')">
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
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                <h3>Belum ada berita</h3>
                                <p>Klik "Tambah Berita" untuk membuat konten pertama</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
