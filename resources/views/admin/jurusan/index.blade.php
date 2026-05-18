<x-app-layout>
    <x-slot name="header">Manajemen Jurusan</x-slot>

    <div class="page-header">
        <div>
            <h2>Jurusan</h2>
            <p>Kelola daftar jurusan sekolah</p>
        </div>
        <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Jurusan
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Daftar Jurusan ({{ $items->count() }} item)</h3>
        </div>
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:56px">Logo</th>
                        <th>Nama Jurusan</th>
                        <th>Dibuat</th>
                        <th>Terakhir diubah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>
                            @if($item->logo)
                                <img src="{{ $item->logo_url }}" alt="{{ $item->name }}" class="thumb" style="object-fit:contain;background:#f8fafc;padding:4px">
                            @else
                                <div class="thumb" style="display:flex;align-items:center;justify-content:center;background:#f1f5f9;color:#cbd5e1">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                            @endif
                        </td>
                        <td style="font-weight:600;color:#111827">{{ $item->name }}</td>
                        <td style="color:#64748b;font-size:13px">{{ $item->created_at->format('d M Y H:i') }}</td>
                        <td style="color:#64748b;font-size:13px">{{ $item->updated_at->format('d M Y H:i') }}</td>
                        <td>
                            <div style="display:flex;gap:8px;align-items:center">
                                <a href="{{ route('admin.jurusan.edit', $item->id) }}" class="btn btn-secondary btn-sm">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.jurusan.destroy', $item->id) }}" method="POST" style="margin:0" onsubmit="return confirm('Yakin hapus jurusan ini?')">
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
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <h3>Belum ada jurusan</h3>
                                <p>Tambahkan jurusan pertama untuk sekolah</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
