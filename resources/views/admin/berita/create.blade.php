<x-app-layout>
    <x-slot name="header">Tambah Berita</x-slot>

    <div class="page-header">
        <div>
            <h2>Tambah Berita Baru</h2>
            <p>Isi semua kolom yang diperlukan</p>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if($errors->any())
                <div class="alert alert-error" style="margin-bottom:20px">
                    <ul style="margin:0;padding-left:16px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <div class="form-section">
                    <div class="form-section-title">Informasi Utama</div>
                    <div class="form-group">
                        <label class="form-label">Judul <span class="required">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Masukkan judul berita..." value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ringkasan / Excerpt</label>
                        <textarea name="excerpt" class="form-control" rows="2" placeholder="Ringkasan singkat (opsional)...">{{ old('excerpt') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konten <span class="required">*</span></label>
                        <textarea name="content" class="form-control" rows="8" placeholder="Tulis konten berita di sini..." required>{{ old('content') }}</textarea>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Kategori & Tanggal</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Kategori <span class="required">*</span></label>
                            <select name="category" id="categorySelect" class="form-control" required onchange="toggleSubCategory()">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="berita" {{ old('category')=='berita'?'selected':'' }}>Berita Umum</option>
                                <option value="prestasi" {{ old('category')=='prestasi'?'selected':'' }}>Prestasi</option>
                                <option value="eskul" {{ old('category')=='eskul'?'selected':'' }}>Eskul</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', date('Y-m-d')) }}">
                        </div>
                    </div>
                    <div class="form-group" id="subCategoryGroup" style="{{ old('category')=='eskul' ? '' : 'display:none' }}">
                        <label class="form-label">Sub-Kategori Eskul</label>
                        <input type="text" name="sub_category" class="form-control" placeholder="Contoh: pramuka, paskibra, pmr..." value="{{ old('sub_category') }}">
                        <p style="font-size:12px;color:#9ca3af;margin:4px 0 0">Isi jika kategori adalah Eskul. Gunakan huruf kecil tanpa spasi.</p>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Foto / Gambar</div>
                    <div class="form-group">
                        <label class="file-upload-area" for="imageInput" ondragover="event.preventDefault()" ondrop="handleDrop(event,'imageInput','imagePreview')">
                            <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage(this,'imagePreview')">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p><span>Klik untuk upload</span> atau drag & drop</p>
                            <p style="margin-top:4px;font-size:11px;color:#d1d5db">JPG, PNG, WEBP – Maks 2MB</p>
                        </label>
                        <div id="imagePreview">
                            <img id="imagePreviewImg" src="" alt="Preview">
                        </div>
                    </div>
                </div>

                <div style="display:flex;gap:10px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:8px">
                    <button type="submit" class="btn btn-primary">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Berita
                    </button>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleSubCategory() {
            const cat = document.getElementById('categorySelect').value;
            document.getElementById('subCategoryGroup').style.display = cat === 'eskul' ? '' : 'none';
        }
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
        function handleDrop(e, inputId, previewId) {
            e.preventDefault();
            const input = document.getElementById(inputId);
            input.files = e.dataTransfer.files;
            previewImage(input, previewId);
        }
    </script>
</x-app-layout>
