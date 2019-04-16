<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Conor & Steph</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Kalam:300,400,700&amp;subset=latin-ext" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Mali:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext" rel="stylesheet">
</head>

<style>
  html, body, .mali {
    height: 100%;
  }

  .container-heading {
    max-width: 920px;
  }

  .invite-heading {
    text-align: center;
    padding: 80px 0 50px 0;
    line-height: 1;
    color: #fff;
    font-size: 42px;
    letter-spacing: -0.05em;
    line-height: 0.8;
    color: #00C9C9;
  }

  .invite-heading .lead {
    font-size: 20px;
    letter-spacing: normal;
    margin-bottom: 30px;
  }

  .invite-heading .rule {
    border-color: #00C9C9;
  }

  .invite-heading .name {
    font-size: 70px;
    color: #00BDBD;
  }

  .invite-details {
    text-align: center;
    line-height: 1;
    color: #fff;
  }

  .invite-details .time {
    font-size: 30px;
  }

  .invite-details .location {
    font-size: 35px;
    margin-bottom: 50px;
  }

  .invite-details .cta {
    color: #fafafa;
    font-size: 40px;
    background-color: #00C9C9;
    padding: 0 20px 0px 20px;
    border-radius: 8px;
  }

  .invite-details .cta:hover {
    text-decoration: none;
    background-color: #00BDBD;
  }

  .kalam {
    font-family: Kalam;
    font-weight: 300;
  }

  .kalam .name {
    font-weight: 400;
  }

  .kalam .time {
    font-weight: 400;
  }

  .kalam .location {
    font-weight: 300;
  }

  .mali .kalam.cta {
    font-weight: 800;
    padding: 5px 20px 0px 20px;
  }

  .mali {
    font-family: Mali;
    font-weight: 300;
  }

  .mali .invite-heading {
    font-style: italic;
    font-weight: 300;
  }

  .mali .lead {
    font-weight: 400;
    text-transform: uppercase;
    font-style: normal;
  }

  .mali .name {
    font-style: italic;
    font-weight: 200;
  }

  .mali .location {
    font-style: italic;
    font-weight: 200;
  }

  .mali .cta {
    font-weight: 500;
  }

  hr.rule {
    overflow: visible; /* For IE */
    padding: 0;
    border: none;
    border-top: medium double #333;
    color: #333;
    text-align: center;
    margin-top: 1.5rem;
    margin-bottom: 1.5rem;
  }
</style>

<body class="mali" style="background: url('/img/cream_dust.png') repeat;">

<div class="mali">

  <div style="background-color: #ffffebd0;">

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
            <p style="font-weight: 500; font-size: 24px;">{{ $invite->guestA->first_name }}</p>
          @elseif($invite && $invite->isForTwoGuests())
            <p style="font-weight: 500; font-size: 24px;">{{ $invite->guestA->first_name }} and {{ $invite->guestB->first_name }}</p>
          @endif
          @if($invite && $invite->note)
            <p>{{ $invite->note }}</p>
          @else
            <p>Please join us for</p>
          @endif
        </div>
        <hr class="rule">
        <div>
          <p>The Wedding of</p>
          <p class="name">Stephanie Fleming</p>
          <p>and</p>
          <p class="name">Conor Smith</p>
        </div>
        <hr class="rule">
      </div>

    </div>
  </div>

  <div style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)), url('/img/palmerstown1.jpg'); background-size: cover; background-position: center; padding-top: 40px; padding-bottom: 40px; margin: 0 auto; height: 319px;">

    <div class="container">
      <div class="invite-details">

        <div class="clearfix" style="width: 330px; margin: 0 auto;">

          <div class="clearfix" style="float: left; text-align: left; margin-right: 40px;">
            <div style="float: left; padding-top: 7px; font-size: 21px; font-weight: 300; letter-spacing: 0.275em;">
              <div style="">SUN</div>
              <div style="letter-spacing: 0.25em;">DAY</div>
            </div>
          </div>

          <div style="float: left; text-align: left; margin-right: 50px;" class="clearfix">
            <!--<div style="font-size: 23px; letter-spacing: 0.275em; text-transform: uppercase; font-weight: 200;">Sunday</div>-->
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

        <!--
        <table border="0" cellpadding="0" cellspacing="0">
          <tbody><tr style="
        font-size: 25px;
        letter-spacing: 0.2em;
        text-transform: uppercase;
    "><td colspan="2">Sunday</td></tr>
          <tr><td rowspan="2" style="
        font-size: 62px;
    ">18</td><td style="
        font-size: 19px;
    ">August</td></tr>
          <tr><td style="
        font-size: 27px;
        padding: 0;
    ">2019</td></tr>
          </tbody></table>
          -->

        <!--<p class="time">3pm, Sunday August 18<sup>th</sup> 2019</p>-->
        <p class="location">Palmerstown House, Co Kildare</p>
        <a href="#" class="kalam cta">RSVP</a>
      </div>
    </div>

  </div>

</div>

</body>
</html>
