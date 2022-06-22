<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SMKN1 KOTA BIMA</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
            crossorigin="anonymous"
        />
        <link
            rel="icon"
            type="image/png"
            href="{{ asset('storage/smkn1.ico') }}"
        />
        <link rel="stylesheet" href="{{ asset('css/customStyle.css') }}">
    </head>
    <body style="width: 100%">
        <nav class="navbar navbar-expand-lg p-3 " style="background-color: rgb(153, 249, 201)">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('storage/smkn1.png') }}" alt="" width="30" height="30" class="d-inline-block align-text-top">
                    SMKN1
                  </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Beranda</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="https://www.smkn1kotabima.sch.id/" target="__blank">Profil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link btn btn-outline-info btn-sm" href="{{ route('login') }}">Login</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <div id="heroImage" style="background-image: url('{{ asset('storage/smkn1kobi.jpg') }}');">
              <div class="row">
                  <div  class="col-lg-12" >
                  </div>
              </div>
          </div>


        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
