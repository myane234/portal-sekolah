<x-app-layout>
    <x-slot name="header">Edit Eskul</x-slot>

    <div class="page-header">
        <div>
            <h2>Edit Ekstrakurikuler</h2>
            <p>{{ $item->name }}</p>
        </div>
        <a href="{{ route('admin.eskul.index') }}" class="btn btn-secondary">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.eskul.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if($errors->any())
                <div class="alert alert-error" style="margin-bottom:20px">
                    <ul style="margin:0;padding-left:16px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <div class="form-section">
                    <div class="form-section-title">Informasi Eskul</div>
                    <div class="form-group">
                        <label class="form-label">Nama Ekstrakurikuler <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $item->description) }}</textarea>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Logo / Ikon</div>
                    @if($item->logo)
                    <div style="margin-bottom:12px;display:flex;align-items:center;gap:12px;padding:12px;background:#f8fafc;border-radius:8px;border:1px solid #e2e8f0">
                        <img src="{{ $item->logo_url }}" alt="Logo saat ini" style="width:56px;height:56px;object-fit:contain;border-radius:6px;background:white;padding:4px">
                        <div>
                            <div style="font-size:13px;font-weight:500;color:#374151">Logo saat ini</div>
                            <div style="font-size:11px;color:#9ca3af;margin-top:2px">Upload baru untuk mengganti</div>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="file-upload-area" for="logoInput">
                            <input type="file" name="logo" id="logoInput" accept="image/*" onchange="previewImage(this,'logoPreview')">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p><span>Klik untuk upload</span> logo baru (opsional)</p>
                        </label>
                        <div id="logoPreview"><img id="logoPreviewImg" src="" alt="Preview"></div>
                    </div>
                </div>

                <div style="display:flex;gap:10px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:8px">
                    <button type="submit" class="btn btn-primary">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.eskul.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input, previewId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    const wrap = document.getElementById(previewId);
                    wrap.style.display = 'block';
                    wrap.querySelector('img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
