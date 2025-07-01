@extends('home')
@section('title', 'Site Settings')
@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid px-4">
        <div class="card my-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fa fa-cog me-1"></i>
                        Site Settings
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('general-settings.site-settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" 
                                       name="company_name" 
                                       class="form-control @error('company_name') is-invalid @enderror" 
                                       value="{{ old('company_name', $settings->company_name ?? '') }}" 
                                       required>
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mobile</label>
                                <input type="text" 
                                       name="mobile" 
                                       class="form-control @error('mobile') is-invalid @enderror" 
                                       value="{{ old('mobile', $settings->mobile ?? '') }}">
                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" 
                                       name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $settings->email ?? '') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" 
                                          class="form-control @error('address') is-invalid @enderror" 
                                          rows="3">{{ old('address', $settings->address ?? '') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Copyright Text</label>
                                <input type="text" 
                                       name="copy_right_text" 
                                       class="form-control @error('copy_right_text') is-invalid @enderror" 
                                       value="{{ old('copy_right_text', $settings->copy_right_text ?? '') }}" 
                                       required>
                                @error('copy_right_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Company Main Logo</label>
                                <input type="file" 
                                       name="company_main_logo" 
                                       class="form-control @error('company_main_logo') is-invalid @enderror" 
                                       accept="image/*"
                                       onchange="previewImage(this, 'mainLogoPreview')">
                                @error('company_main_logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <img id="mainLogoPreview" 
                                         src="{{ asset($settings->company_main_logo ?? 'images/no-image.png') }}" 
                                         alt="Main Logo Preview" 
                                         class="img-thumbnail"
                                         style="max-height: 100px;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Company Mini Logo</label>
                                <input type="file" 
                                       name="company_mini_logo" 
                                       class="form-control @error('company_mini_logo') is-invalid @enderror" 
                                       accept="image/*"
                                       onchange="previewImage(this, 'miniLogoPreview')">
                                @error('company_mini_logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <img id="miniLogoPreview" 
                                         src="{{ asset($settings->company_mini_logo ?? 'images/no-image.png') }}" 
                                         alt="Mini Logo Preview" 
                                         class="img-thumbnail"
                                         style="max-height: 100px;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Favicon (ICO or PNG, max 1MB)</label>
                                <input type="file" 
                                       name="favicon" 
                                       class="form-control @error('favicon') is-invalid @enderror" 
                                       accept=".ico,.png"
                                       onchange="previewImage(this, 'faviconPreview')">
                                @error('favicon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <img id="faviconPreview" 
                                         src="{{ asset($settings->favicon ?? 'images/no-image.png') }}" 
                                         alt="Favicon Preview" 
                                         class="img-thumbnail"
                                         style="max-height: 32px; width: 32px; object-fit: contain;">
                                </div>
                                <small class="text-muted">
                                    Recommended size: 32x32 pixels. Will be displayed in browser tab.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
