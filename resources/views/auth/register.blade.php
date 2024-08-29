@extends('auth.layout.index')

@section('content')
    
<div class="authentication-wrapper authentication-basic container-p-y">
  <div class="authentication-inner">
    <div class="card">
      <div class="card-body">
        <div class="img text-center">
            @php
              $setting = DB::table('settings')->where('id',1)->first();
            @endphp
            <img src="{{ asset('storage/image_settings/' . $setting->logo) }}" alt="" class="img-fluid rounded-circle" style="width: 10vh; height: 10vh; object-fit: cover;">
        </div>
        <form id="formAuthentication" class="mb-3 row g-3" action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data">
          @csrf
          
          <div class="col-md-6">
            <label for="name" class="form-label">Username</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" autofocus />
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}"  />
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="col-md-6 form-password-toggle">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">Password</label>
            </div>
            <div class="input-group input-group-merge">
              <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="col-md-6">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Masukkan nomor telepon Anda" />
            @error('phone')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="image" class="form-label">Unggah Foto</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" />
            @error('image')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">Jenis Kelamin</label>
            <div class="form-check">
              <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
              <label class="form-check-label" for="male">
                Laki-laki
              </label>
              @error('gender')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-check">
              <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
              <label class="form-check-label" for="female">
                Perempuan
              </label>
              @error('gender')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>          

          <div class="col-md-12">
            <label for="address" class="form-label">Alamat</label>
            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"></textarea>
            @error('address')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Daftar</button>
          </div>
        </form>

        <p class="text-center">
          <span>Sudah Punya Akun?</span>
          <a href="{{ route('login') }}">
            <span>Login</span>
          </a>
        </p>
      </div>
    </div>
  </div>
</div>

@endsection


