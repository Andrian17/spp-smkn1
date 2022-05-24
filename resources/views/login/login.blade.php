@extends('student.template.main')
@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <main class="form-signin m-3 text-center">
              @if(session()->has('status'))
              <div class="alert alert-primary" role="alert">
                {{ session('status') }}
              </div>
              @endif

              @if(session()->has('loginError'))
              <div class="alert alert-danger" role="alert">
                {{ session('loginError') }}
              </div>
              @endif

                <h1 class="h3 mb-3 fw-normal">Mohon login</h1>
                <form method="POST" action="/login">
                  @csrf
                  <div class="form-floating m-2">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="12345678" name="email" value="{{ old('email') }}" autofocus>
                    <label for="floatingInput">Email</label>
                    @error('email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="form-floating m-2">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                    <label for="floatingPassword">Password</label>
                  </div>
                  <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

                </form>
              </main>
        </div>
    </div>
</div>
@endsection
