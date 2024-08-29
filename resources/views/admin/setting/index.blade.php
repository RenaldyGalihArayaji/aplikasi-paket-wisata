@extends('admin.layout.index')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengaturan | <span class="text-secondary fs-5">Layout</span></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Pengaturan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="row" action="{{ route('settingUpdate', $setting->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $setting->id }}">
                    <div class="row mt-3">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="name_app" class="form-label">Nama Aplikasi</label>
                                    <input type="text" name="name_app" id="name_app" class="form-control" value="{{ $setting->name_app }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="logo" class="form-label">Logo Aplikasi</label>
                                    <input type="file" name="logo" id="logo" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="image_hero" class="form-label">Gambar Hero Section</label>
                                    <input type="file" name="image_hero" id="image_hero" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $setting->phone }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ $setting->email }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="name_hero" class="form-label">Judul Hero Section</label>
                                    <input type="text" name="name_hero" id="name_hero" class="form-control" value="{{ $setting->name_hero }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="account_number" class="form-label">Nomor Rekening</label>
                                    <input type="text" name="account_number" id="account_number" class="form-control" value="{{ $setting->account_number }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="account_owner" class="form-label">Pemilik Rekening</label>
                                    <input type="text" name="account_owner" id="account_owner" class="form-control" value="{{ $setting->account_owner }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="bank_name" class="form-label">Nama Bank</label>
                                    <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ $setting->bank_name }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="link_youtube" class="form-label">Link Youtube</label>
                                    <input type="text" name="link_youtube" id="link_youtube" class="form-control" placeholder="https://" value="{{ $setting->link_youtube }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="link_instagram" class="form-label">Link Instagram</label>
                                    <input type="text" name="link_instagram" id="link_instagram" class="form-control" placeholder="https://" value="{{ $setting->link_instagram }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="short_description" class="form-label">Deskripsi Singkat</label>
                                    <textarea name="short_description" id="short_description" class="form-control">{{ $setting->short_description }}</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea name="address" id="address" class="form-control">{{ $setting->address }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-2">
                            <img src="{{ asset('storage/image_settings/' . $setting->logo) }}" alt="" class="img-thumbnail" style="width: 100%; height: 50vh; object-fit: cover;">
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mb-2">Perbarui</button>
                    </div>
                </form>
                <div class="mt-3">
                    <p class="text-muted">
                        Terakhir diperbarui oleh: <strong>{{ ucwords($setting->user->name) }}</strong> pada {{ $setting->updated_at->format('d-m-Y H:i:s') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
