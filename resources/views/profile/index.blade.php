@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-12 mb-4">
      <a href="/home" class="btn btn-primary btn-lg"><i class="bi bi-arrow-left-square"></i> Kembali ke home</a>
    </div>
    <div class="col-md-12 mb-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
      </nav>
    </div>
    <div class="col-md-12 mb-4">
      <div class="card">
        <div class="card-body">
          <h4><i class="bi bi-person-fill"></i> My Profile</h4>
          <table class="table">
            <tbody>
              <tr>
                <td>Nama</td>
                <td width="10">:</td>
                <td>{{ $user->name }}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $user->email }}</td>
              </tr>
              <tr>
                <td>No hp</td>
                <td>:</td>
                <td>{{ $user->nohp }}</td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $user->alamat }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-12 mb-4">
      <div class="card">
        <div class="card-body">
          <h4 class="mb-3"><i class="bi bi-pencil-square"></i> Edit Profile</h4>
          <form method="POST" action="/profile">
            @csrf
            <div class="form-group row">
              <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="nohp" class="col-md-2 col-form-label text-md-right">No hp</label>
              <div class="col-md-6">
                <input id="nohp" type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value="{{ $user->nohp }}" required autocomplete="nohp">
                @error('nohp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="alamat" class="col-md-2 col-form-label text-md-right">Alamat</label>
              <div class="col-md-6">
                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror" required autocomplete="alamat">{{ $user->alamat }}</textarea>
                @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-2">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
        </div>
      </div>
    </div>
</div>
@endsection
