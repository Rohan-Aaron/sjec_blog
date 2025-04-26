@extends('layouts.admin')
@section('title', 'Business Setup')

@section('content')
    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Setup Configuration</h5>

            <form>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Site Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                            value="{{ old('site_name') }}" placeholder="Enter site name">
                        @error('site_name')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="Enter email">
                        @error('email')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone') }}" placeholder="Enter phone no">
                        @error('phone')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                            value="{{ old('address') }}" placeholder="Enter address">
                        @error('address')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Description (SEO) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            value="{{ old('description') }}" placeholder="Enter description">
                        @error('description')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Seacrh Keywords (SEO) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('keywords') is-invalid @enderror"
                            value="{{ old('keywords') }}" placeholder="Enter keywords">
                        @error('keywords')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <h5 class="card-title fw-semibold mb-4">Appereance Customization</h5>
                    <!-- Color 1 -->
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Primary Color <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="rgbaInput1" name="primary_color"
                                placeholder="rgba(255, 0, 0, 1)" onchange="updateColorPreview(this)">
                        </div>
                        @error('primary_color')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Color 2 -->
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Secondary Color <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="rgbaInput2" name="secondary_color"
                                placeholder="rgba(255, 0, 0, 1)" onchange="updateColorPreview(this)">
                        </div>
                        @error('secondary_color')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Color 3 -->
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Body Color <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="rgbaInput3" name="body_color"
                                placeholder="rgba(255, 0, 0, 1)" onchange="updateColorPreview(this)">
                        </div>
                        @error('body_color')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Color 4 -->
                    <div class="col-md-2 mb-3">
                        <label class="form-label">White accent <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="rgbaInput4" name="white_accent"
                                placeholder="rgba(255, 0, 0, 1)" onchange="updateColorPreview(this)">
                        </div>
                        @error('white_accent')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Color 5 -->
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Copyright area <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="rgbaInput5" name="copyright_area"
                                placeholder="rgba(255, 0, 0, 1)" onchange="updateColorPreview(this)">
                        </div>
                        @error('copyright_area')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Color 6 -->
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Banner Overlay <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="rgbaInput6" name="banner_overlay"
                                placeholder="rgba(255, 0, 0, 1)" onchange="updateColorPreview(this)">
                        </div>
                        @error('banner_overlay')
                            <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">White Logo (290 X 70)<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control"  name="white_logo" id="white_logo"
                                    accept="image/*" onchange="previewImage(event, 'whiteLogoPreview')">
                            </div>
                            @error('white_logo')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Black Logo (290 X 70)<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control"  name="black_logo" id="black_logo"
                                    accept="image/*" onchange="previewImage(event, 'blackLogoPreview')">
                            </div>
                            @error('black_logo')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Favicon (32 X 32)<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control"  name="favicon" id="favicon"
                                    accept="image/*" onchange="previewImage(event, 'faiconPreview')">
                            </div>
                            @error('favicon')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Banner Image (1280 X720)<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control"  name="banner" id="banner"
                                    accept="image/*" onchange="previewImage(event, 'bannerPreview')">
                            </div>
                            @error('banner')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
@endsection

@section('js')
    <script>
        function isValidRgba(value) {
            const regex = /^rgba\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(0|1|0?\.\d+)\s*\)$/i;
            const match = value.match(regex);
            if (!match) return false;

            const [_, r, g, b, a] = match.map(Number);
            return r <= 255 && g <= 255 && b <= 255 && a >= 0 && a <= 1;
        }

        function updateColorPreview(inputElement) {
            const value = inputElement.value.trim();
            const index = inputElement.id.replace('rgbaInput', '');

            if (isValidRgba(value)) {
                inputElement.style.backgroundColor = value; // Change input background color
                inputElement.classList.remove('is-invalid');
            } else {
                inputElement.style.backgroundColor = ''; // Reset background if invalid
                inputElement.classList.add('is-invalid');
            }
        }
    </script>

@endsection
