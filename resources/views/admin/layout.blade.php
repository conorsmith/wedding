<!doctype html>
<html class="no-js" lang="">
@inject('siteMode', 'ConorSmith\Wedding\SiteMode')
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{ $siteMode->getNames() }}'s Wedding Dashboard</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <style>
    @keyframes rotation {
      from {
        transform: rotate(0deg);
      }
      to {
        transform: rotate(359deg);
      }
    }

    .rotate {
      animation: rotation 2s infinite linear;
    }
  </style>

</head>
<body style="background: #fcfcfc; padding-top: 70px;">

<nav class="navbar fixed-top navbar-light bg-light navbar-expand-lg">
  <a class="navbar-brand" href="/admin">{{ $siteMode->getNames() }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/admin"><i class="fas fa-home"></i> Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/guests"><i class="fas fa-list-ol"></i> Shortlist</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/invitees"><i class="fas fa-envelope-open-text"></i> Guestlist</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/invites?type=email"><i class="fas fa-at"></i> Email Invites</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/invites?type=physical"><i class="fas fa-mail-bulk"></i> Physical Invites</a>
      </li>
    </ul>
  </div>
  <div class="collapse navbar-collapse flex-row-reverse">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="http://www.{{ $siteMode->switch()->getDomainName() }}/{{ Route::current()->uri() }}{{ strlen($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "" }}"><small>Switch Site Mode</small></a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">

  @yield('content')

</div>

<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@yield('scripts')

</body>
</html>
