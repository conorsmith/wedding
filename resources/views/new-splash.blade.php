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

      <div class="clearfix">

        <div class="col-narrow">

          <div class="photo photo-left">
            <img src="/img/splash-engagement.jpg" style="width: 300px;">
          </div>

        </div>

        <div class="col-wide">

          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sit amet laoreet neque, at convallis velit. Nam vestibulum eros in mauris commodo vehicula. Nullam aliquet vehicula enim in faucibus. Quisque eget mattis quam. Maecenas quis magna consequat, suscipit libero id, aliquam urna. Aliquam consectetur ultrices enim, vel pharetra lectus varius eget. Morbi in diam id nibh pretium sagittis. Nam in mi vehicula, mattis nibh ac, semper mi.</p>

          <p>Aenean facilisis ac neque non cursus. Aenean nisl tortor, elementum sed elementum at, condimentum non nulla. Nunc aliquet imperdiet iaculis. Duis accumsan, magna vel porttitor tempor, nisl nulla imperdiet mi, et cursus ligula sapien molestie libero.</p>

          <p>Curabitur finibus consequat magna, non pulvinar quam hendrerit condimentum. Etiam commodo at turpis non laoreet. Cras sed turpis ac arcu placerat rhoncus. Praesent commodo blandit odio. Curabitur eleifend gravida aliquam. Sed id lorem imperdiet, faucibus dui et, porttitor velit.</p>

        </div>

      </div>

      <hr class="rule">

      <div class="countdown clearfix" id="countdown" style="display: {{ $isCountdownActive ? "block" : "none" }}">

        <div class="segment">
          <div class="value" id="countdown-days">{{ $countdown['days'] }}</div>
          <div class="label">days</div>
        </div>

        <div class="segment">
          <div class="value" id="countdown-hours">{{ $countdown['hours'] }}</div>
          <div class="label">hours</div>
        </div>

        <div class="segment">
          <div class="value" id="countdown-minutes">{{ $countdown['minutes'] }}</div>
          <div class="label">minutes</div>
        </div>

        <div class="segment">
          <div class="value" id="countdown-seconds">{{ $countdown['seconds'] }}</div>
          <div class="label">seconds</div>
        </div>

      </div>

      <div id="post-countdown" style="display: {{ !$isCountdownActive ? "block" : "none" }};">
        We're getting married!
      </div>

    </div>

  </div>

  <div class="bg-paper">

    <div class="container clearfix">

      <div class="col-wide">

        <h3>Accommodation</h3>

        <p>Palmerstown House Estate is located outside Johnstown, Co Kildare. The venue is quite close to both Sallins and Naas.</p>

        <p>Contact such and such in the so and so hotel...</p>

      </div>

      <div class="col-narrow">

        <div class="photo photo-right">
          <img src="/img/splash-accommodation.jpg" style="width: 300px;">
        </div>

      </div>

    </div>

  </div>

  <div class="bg-photo bg-estate">

    <div class="container clearfix">

      <div class="col-narrow">

        <div class="photo photo-left">
          <a href="https://goo.gl/maps/RDBCnHRFoAC2chnw5" target="_blank">
            <img src="/img/map.png" style="width: 300px;">
          </a>
        </div>

      </div>

      <div class="col-wide">

        <h3>Getting to the Venue</h3>

        <p>Our wedding will be taking place in the <strong>Manor House</strong> of Palmerstown House Estate.</p>

        <p>To reach the venue, take exit 8 off the N7, following the signs for Sallins. After about 600 m, take a turn right into the estate. (Keep your eyes open, it's easy to miss. If you pass Johnstown Garden Centre you've gone too far.)</p>

        <p>In the grounds of the estate, follow the signs for the Manor House. Turn left into the car park behind the Manor House.</p>

        <p><a href="https://goo.gl/maps/RDBCnHRFoAC2chnw5" target="_blank">View the venue on Google Maps</a></p>

      </div>

    </div>

  </div>

  <div class="bg-paper">

    <div class="container clearfix">

      <div class="col-wide">

        <h3>The Big Day</h3>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sit amet laoreet neque, at convallis velit. Nam vestibulum eros in mauris commodo vehicula. Nullam aliquet vehicula enim in faucibus. Quisque eget mattis quam. Maecenas quis magna consequat, suscipit libero id, aliquam urna. Aliquam consectetur ultrices enim, vel pharetra lectus varius eget. Morbi in diam id nibh pretium sagittis. Nam in mi vehicula, mattis nibh ac, semper mi.</p>

        <p>Aenean facilisis ac neque non cursus. Aenean nisl tortor, elementum sed elementum at, condimentum non nulla. Nunc aliquet imperdiet iaculis. Duis accumsan, magna vel porttitor tempor, nisl nulla imperdiet mi, et cursus ligula sapien molestie libero. Curabitur finibus consequat magna, non pulvinar quam hendrerit condimentum. Etiam commodo at turpis non laoreet. Cras sed turpis ac arcu placerat rhoncus. Praesent commodo blandit odio. Curabitur eleifend gravida aliquam. Sed id lorem imperdiet, faucibus dui et, porttitor velit.</p>

      </div>

      <div class="col-narrow">

        <div class="photo photo-right">
          <img src="/img/splash-accommodation.jpg" style="width: 300px;">
        </div>

      </div>

    </div>

  </div>

  <div class="bg-photo bg-estate">

    <div class="container clearfix">

      <div class="col-narrow">

        <h3>Dress Code</h3>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sit amet laoreet neque, at convallis velit. Nam vestibulum eros in mauris commodo vehicula. Nullam aliquet vehicula enim in faucibus. Quisque eget mattis quam. Maecenas quis magna consequat, suscipit libero id, aliquam urna. Aliquam consectetur ultrices enim, vel pharetra lectus varius eget. Morbi in diam id nibh pretium sagittis. Nam in mi vehicula, mattis nibh ac, semper mi.</p>

      </div>

      <div class="col-narrow">

        <h3>Contact Details</h3>

        <p>If you need to get in touch with us about anything, you can email:</p>

        <p style="font-weight: 500; text-align: center;">wedding@conorandsteph.com</p>

      </div>

      <div class="col-narrow">

        <h3>Getting to the Venue</h3>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sit amet laoreet neque, at convallis velit. Nam vestibulum eros in mauris commodo vehicula. Nullam aliquet vehicula enim in faucibus. Quisque eget mattis quam. Maecenas quis magna consequat, suscipit libero id, aliquam urna. Aliquam consectetur ultrices enim, vel pharetra lectus varius eget. Morbi in diam id nibh pretium sagittis. Nam in mi vehicula, mattis nibh ac, semper mi.</p>

      </div>

    </div>

  </div>

  <div class="invite-footer">
    <img src="/img/lurcher.png">
  </div>

</div>

<script>

    if (document.getElementById("countdown").style.display === "block") {

        var days = document.getElementById("countdown-days").innerHTML;
        var hours = document.getElementById("countdown-hours").innerHTML;
        var minutes = document.getElementById("countdown-minutes").innerHTML;
        var seconds = document.getElementById("countdown-seconds").innerHTML;

        var countdownInterval = setInterval(function () {
            if (seconds > 0) {
                seconds = seconds - 1;
            } else {
                seconds = 59;
            }

            document.getElementById("countdown-seconds").innerHTML = seconds;

            if (seconds !== 59) {
                return;
            }

            if (minutes > 0) {
                minutes = minutes - 1;
            } else {
                minutes = 59;
            }

            document.getElementById("countdown-minutes").innerHTML = minutes;

            if (minutes !== 59) {
                return;
            }

            if (hours > 0) {
                hours = hours - 1;
            } else {
                hours = 23;
            }

            document.getElementById("countdown-hours").innerHTML = hours;

            if (hours !== 23) {
                return;
            }

            if (days > 0) {
                days = days - 1;
                document.getElementById("countdown-days").innerHTML = days;
            } else {
                clearInterval(countdownInterval);
                document.getElementById("countdown").style.display = "none";
                document.getElementById("post-countdown").style.display = "block";
            }
        }, 1000);
    }
</script>

</body>
</html>
