<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Conor & Steph</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/styles/{{ $style }}.css">
</head>

<body>

<div>

<div class="invite-top">

  <div style="width: 100%; height: 300px; position: absolute; padding: 10px;">
    <div style="background-image: url('/img/tealborder1.png'); background-repeat: no-repeat; background-size: 320px; background-position: top left; width: 100%; height: 300px;"></div>
  </div>

  <div style="width: 100%; height: 300px; position: absolute; padding: 10px;">
    <div style="background-image: url('/img/tealborder2.png'); background-repeat: no-repeat; background-size: 320px; background-position: top right; width: 100%; height: 300px;"></div>
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

<div style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)), url('/img/palmerstown1.jpg'); background-size: cover; background-position: center; padding-top: 40px; padding-bottom: 40px; margin: 0 auto; height: 319px;">

<div class="container">
  <div class="invite-details">

    <!--

    <div class="clearfix" style="width: 330px; margin: 0 auto;">

      <div class="clearfix" style="float: left; text-align: left; margin-right: 40px;">
        <div style="float: left; padding-top: 7px; font-size: 21px; font-weight: 300; letter-spacing: 0.275em;">
          <div style="">SUN</div>
          <div style="letter-spacing: 0.25em;">DAY</div>
        </div>
      </div>

      <div style="float: left; text-align: left; margin-right: 50px;" class="clearfix">
        <div>
          <div style="float: left; font-size: 52px; font-weight: 500;">18</div>
          <div style="float: left; padding-top: 5px; padding-left: 2px;">
            <div style="font-size: 18px;">August</div>
            <div style="font-size: 26px;">2019</div>
          </div>
        </div>
      </div>

      <div class="clearfix" style="float: left; text-align: left;">
        <div style="float: left; font-size: 52px; font-weight: 500;">3</div>
        <div style="float: left; padding-top: 7px; font-size: 20px;">
          <div style="font-weight: 200;">00</div>
          <div style="text-transform: uppercase; font-weight: 400;">pm</div>
        </div>
      </div>

    </div>

    <br>

    <p class="location">Palmerstown House Estate, Co Kildare</p>
    <a href="#" class="kalam cta">RSVP</a>

    -->
  </div>
</div>

</div>

</div>

</body>
</html>
