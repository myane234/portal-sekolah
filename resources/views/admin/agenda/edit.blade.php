<x-app-layout>
    <x-slot name="header">Edit Agenda</x-slot>

    <div class="page-header">
        <div>
            <h2>Edit Agenda</h2>
            <p>{{ $item->title }}</p>
        </div>
        <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.agenda.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                @if($errors->any())
                <div class="alert alert-error" style="margin-bottom:20px">
                    <ul style="margin:0;padding-left:16px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <div class="form-section">
                    <div class="form-section-title">Detail Kegiatan</div>
                    <div class="form-group">
                        <label class="form-label">Judul Kegiatan <span class="required">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $item->title) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $item->description) }}</textarea>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Waktu & Tempat</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tanggal <span class="required">*</span></label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', $item->date?->format('Y-m-d')) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Waktu</label>
                            <input type="text" name="time" class="form-control" value="{{ old('time', $item->time) }}" placeholder="08:00 - 12:00 WIB">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location', $item->location) }}" placeholder="Aula Sekolah, Lapangan...">
                    </div>
                </div>

                <div style="display:flex;gap:10px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:8px">
                    <button type="submit" class="btn btn-primary">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
