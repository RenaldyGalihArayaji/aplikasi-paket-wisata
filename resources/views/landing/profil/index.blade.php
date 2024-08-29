@extends('landing.layout.index')

@section('content')

  @php
  $setting = DB::table('settings')->where('id',1)->first();
  @endphp

  <section id="hero" style="background: url('{{ asset('storage/image_settings/' . $setting->image_hero) }}') no-repeat center center; background-size: cover;">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="mb-4 pb-0">Profil <br><span>{{ Auth::user()->name }}</span></h1>
    </div>
  </section>

  <main id="main">
    <section id="tour-details" class="py-5 bg-light">
        <div class="container">      
          <div class="row">

            
            <div class="col-md-6 mb-3">
              <img src="{{ asset('storage/image_profil/'. Auth::user()->image )}}" alt="Speaker 1" class="img-fluid rounded shadow-sm" style="width: 100%; height: 60vh; object-fit: cover;">
            </div>
            
            <div class="col-md-6">
              
              <form action="{{ route('profilUpdate')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ Auth::user()->phone }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea name="address" id="address" class="form-control">{{ Auth::user()->address }}</textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </div>
              </form>
    
            </div>

          </div>
        </div>
    </section>
  </main>

@endsection