<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Conor & Steph</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/styles/{{ $style }}.css?t={{ time() }}">
</head>

<body>

<div>

<div class="invite-top bg-paper">

  <div class="left-border-holder">
    <div class="left-border"></div>
  </div>

  <div class="right-border-holder">
    <div class="right-border"></div>
  </div>

  <div class="container container-heading">

    <div class="invite-heading">

      <div class="lead">

        @if($invite && $invite->isforOneGuest())
          <p><span class="name">{{ $invite->guestA->first_name }}</span></p>
        @elseif($invite && $invite->isForTwoGuests())
          <p><span class="name">{{ $invite->guestA->first_name }}</span> and <span class="name">{{ $invite->guestB->first_name }}</span></p>
        @else
          <p><span class="name">Guest</span></p>
        @endif

        @if($invite && $invite->note)
          <p class="note">{{ $invite->note }}</p>
        @else
          <p class="note">Please join us for</p>
        @endif

      </div>

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
    RSVP before 22 June 2019
  </div>

</div>

</div>

<div class="bg-paper bg-flush">

  <div class="container">

    <form method="POST" class="rsvp-form">

      <div class="attending-container clearfix">

        <a href="#" class="button">
          {{ $invite && $invite->isforOneGuest() ? "I" : "We" }} will be attending
        </a>

        <a href="#" class="button">
          {{ $invite && $invite->isforOneGuest() ? "I" : "We" }} will not be attending
        </a>

      </div>

      <div class="text-input">

        <label>If you have any dietary requirements, please let us know</label>

        <textarea rows="3" name="dietary-requirements"></textarea>

      </div>

      <div class="submit-container clearfix">

        <a href="#" class="button">R&eacute;spondez</a>

      </div>

    </form>

    <hr class="rule" style="margin-bottom: 0;">

  </div>

</div>

<div class="invite-footer">
  <img src="/img/lurcher.png">
</div>

</div>

<script> </script>

</body>
</html>
