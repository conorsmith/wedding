<!doctype html>
<html class="no-js" lang="">
@inject('siteMode', 'ConorSmith\Wedding\SiteMode')
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{ $siteMode->getNames() }}'s Wedding</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/styles/3.css?t={{ time() }}">
</head>

<body>

<div>

  <div class="invite-top bg-paper" style="position: relative;">

    <div class="vine-border vine-border-top-left">
      <img src="/img/border@1x.png" srcset="/img/border@2x.png 2x, /img/border@3x.png 3x">
    </div>

    <div class="vine-border vine-border-top-right">
      <img src="/img/border@1x.png" srcset="/img/border@2x.png 2x, /img/border@3x.png 3x">
    </div>

    <div class="container container-heading">

      <div class="invite-heading">

        <hr class="rule">

        <div class="hero">
          <p class="intro">The Wedding of</p>
          <p class="name">Stephanie Fleming</p>
          <p class="and">and</p>
          <p class="name">Conor Smith</p>
        </div>

        <hr class="rule">

      </div>

    </div>
  </div>

  <div class="bg-photo bg-manor-house">

    <div class="container details">

      <div class="when-and-where clearfix">

        <div class="time-and-date">
          <div class="day">Sunday</div>
          <div class="date">
            <span class="date-day">18</span> August <span class="date-year">2019</span>
          </div>
          <div class="time">
            3.00 pm
          </div>
        </div>

        <div class="location">
          <div class="building">The Manor House</div>
          <div class="venue">Palmerstown House Estate</div>
          <div class="county">Kildare</div>
        </div>

      </div>

      <hr class="rule">

      <div class="rsvp">
        RSVP before {{ config("wedding.rsvpDate")->format("d F Y") }}
      </div>

    </div>

  </div>

  <div class="bg-paper bg-flush">

    <div class="container">

      <form method="POST" class="rsvp-form" id="rsvp-form" style="width: 16rem;">

        {{ csrf_field() }}

        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="text-input">

          <label>Enter the invite code that we gave you to log in and RSVP:</label>

          <input type="text" name="code">

        </div>

        <div class="submit-container clearfix" style="width: 100%;">

          <a href="#" class="button" id="submit">Login</a>

        </div>

      </form>

      <hr class="rule" style="margin-bottom: 0;">

    </div>

  </div>

  <div class="invite-footer">
    <img src="/img/root@1x.png" srcset="/img/root@2x.png 2x, /img/root@3x.png 3x">
  </div>

</div>

<script>

    document.getElementById("submit").onclick = function (e) {
        e.preventDefault();
        document.getElementById("rsvp-form").submit();
    };

</script>

</body>
</html>
