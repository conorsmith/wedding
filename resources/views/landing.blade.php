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

      <div class="clearfix">

        <div class="col-narrow clearfix">

          <div class="photo photo-left">
            <img src="/img/photo-engagement@1x.jpg" srcset="/img/photo-engagement@2x.jpg 2x, /img/photo-engagement@3x.jpg 3x">
          </div>

        </div>

        <div class="col-wide">

          <div class="align-with-rules">

            <p>Conor and Stephanie met through the Students' Union when they were both enrolled at Trinity College. Steph was studying physiotherapy and Conor was studying computer science. Steph remembers the day they first met, Conor doesn't. After five years of friendship Conor asked Steph to come for a drink in the Porterhouse and she said yes. The rest of the story of how they officially moved beyond friends involves a move to Cork, a taxi to Inchicore in late December, a photoshopped baby and an eventful night in Doyle's. Precisely seven and half years on from the Doyle's Donnybrook they're getting married and would like you to join them for what they're hoping will basically be a really good party at which Steph is wearing an especially nice dress and there's a whole bunch of free food.</p>

            <p>So please, join us at Palmerstown House Estate for a day of food, dancing, drink, love and (with a bit of luck and whatever the humanist equivalent of the child of prague is) some sun. We hope you have a wonderful day with us.</p>

          </div>

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

  <div class="bg-paper bg-stacked-photo">

    <div class="container clearfix">

      <div class="col-wide">

        <h3>Accommodation</h3>

        <p>Accommodation will not be available on site but there are many hotels in nearby Naas. Alternatively a taxi to Dublin city centre should cost approximately &euro;60-75.</p>

        <p>Lawlors Hotel, Naas<br><a href="https://www.lawlors.ie/" target="_blank">www.lawlors.ie</a> / 045-906444</p>

        <p>The Ospray, Naas<br><a href="https://www.ospreyhotel.ie/" target="_blank">www.ospreyhotel.ie</a> / 045-881111</p>

        <p>Killashee House, Naas<br><a href="https://www.killasheehotel.com/" target="_blank">www.killasheehotel.com</a> / 045-879277</p>

        <p>The Westgrove, Clane<br><a href="https://www.westgrovehotel.com/" target="_blank">www.westgrovehotel.com</a> / 045-989900</p>

      </div>

      <div class="col-narrow">

        <div class="photo photo-right">
          <img src="/img/photo-accommodation@1x.jpg" srcset="/img/photo-accommodation@2x.jpg 2x">
        </div>

      </div>

    </div>

  </div>

  <div class="bg-photo bg-estate">

    <div class="container clearfix">

      <div class="col-narrow">

        <div class="photo photo-left photo-desktop">
          <a href="https://goo.gl/maps/RDBCnHRFoAC2chnw5" target="_blank">
            <img src="/img/map.png">
          </a>
        </div>

      </div>

      <div class="col-wide">

        <h3>Getting to the Venue</h3>

        <div class="clearfix">

          <div class="subcol subcol-left">

            <p><strong>From Cork</strong><br>At the Dunkettle interchange join the M8 and continue onto the M7. Join the N7 at Naas, continue for 2km and take exit 8 for Johnstown/Kill South. Take the first exit off the roundabout and travel 500m along the boundary of Palmerstown House Estate until you reach the entrance on your right. The wedding will take place in the Manor House, please follow signage when you enter the estate. Please note that the M7 upgrade is expected to finish prior to the wedding but you may need to allow extra time for delays caused by these works.</p>

          </div>

          <div class="subcol">

            <p><strong>From the Red Cow, Dublin</strong><br>Take the N7 for Limerick/Cork/Waterford, travel south for 19km and take exit 8 for Johnstown/Kill South. Take the first exit off the roundabout and travel 500m along the boundary of Palmerstown House Estate until you reach the entrance on your right. The wedding will take place in the Manor House, please follow signage when you enter the estate.</p>

            <p class="map-link"><a href="https://goo.gl/maps/RDBCnHRFoAC2chnw5" target="_blank">View the venue on Google Maps</a></p>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="bg-paper bg-flush" style="position: relative;">

    <div class="vine-border vine-border-top-left vine-mobile-only">
      <img src="/img/border@1x.png" srcset="/img/border@2x.png 2x, /img/border@3x.png 3x">
    </div>

    <div class="vine-border vine-border-top-right">
      <img src="/img/border@1x.png" srcset="/img/border@2x.png 2x, /img/border@3x.png 3x">
    </div>

    <div class="vine-border vine-border-bottom-left">
      <img src="/img/border@1x.png" srcset="/img/border@2x.png 2x, /img/border@3x.png 3x">
    </div>

    <div class="vine-border vine-border-bottom-right vine-mobile-only">
      <img src="/img/border@1x.png" srcset="/img/border@2x.png 2x, /img/border@3x.png 3x">
    </div>

    <div class="photo photo-left photo-timeline-left">
      <img src="/img/photo-timeline-a@1x.jpg" srcset="/img/photo-timeline-a@2x.jpg 2x, /img/photo-timeline-a@3x.jpg 3x">
    </div>

    <div class="photo photo-right photo-timeline-right">
      <img src="/img/photo-timeline-b@1x.jpg" srcset="/img/photo-timeline-b@2x.jpg 2x, /img/photo-timeline-b@3x.jpg 3x">
    </div>

    <div class="timeline-wrapper">

      <ul class="timeline">

        <li>
          <div class="direction-r">
            <div class="flag-wrapper">
              <span class="flag">Ceremony</span>
              <span class="time-wrapper"><span class="time">3pm</span></span>
            </div>
          </div>
        </li>

        <li>
          <div class="direction-l">
            <div class="flag-wrapper">
              <span class="flag">Canap&eacute;s Reception</span>
              <span class="time-wrapper"><span class="time">3.30pm</span></span>
            </div>
          </div>
        </li>

        <li>
          <div class="direction-r">
            <div class="flag-wrapper">
              <span class="flag">Speeches</span>
              <span class="time-wrapper"><span class="time">5.30pm</span></span>
            </div>
          </div>
        </li>

        <li>
          <div class="direction-l">
            <div class="flag-wrapper">
              <span class="flag">Meal Call</span>
              <span class="time-wrapper"><span class="time">6pm</span></span>
            </div>
          </div>
        </li>

        <li>
          <div class="direction-r">
            <div class="flag-wrapper">
              <span class="flag">Dinner is Served</span>
              <span class="time-wrapper"><span class="time">6.30pm</span></span>
            </div>
          </div>
        </li>

        <li>
          <div class="direction-l">
            <div class="flag-wrapper">
              <span class="flag">Cake Cutting</span>
              <span class="time-wrapper"><span class="time">9pm</span></span>
            </div>
          </div>
        </li>

        <li>
          <div class="direction-r">
            <div class="flag-wrapper">
              <span class="flag">First Dance</span>
              <span class="time-wrapper"><span class="time">9.30pm</span></span>
            </div>
          </div>
        </li>

        <li>
          <div class="direction-l">
            <div class="flag-wrapper">
              <span class="flag">Midnight Feast</span>
              <span class="time-wrapper"><span class="time">12am</span></span>
            </div>
          </div>
        </li>

        <li>
          <div class="direction-r">
            <div class="flag-wrapper">
              <span class="flag">The Wee Hours</span>
              <span class="time-wrapper"><span class="time">12.30am</span></span>
            </div>
          </div>
        </li>

      </ul>

    </div>

  </div>

  <div class="bg-photo bg-hall misc-info">

    <div class="container clearfix">

      <div class="col-narrow col-stacked">

        <h3>Dress Code</h3>

        <p style="font-weight: 500; text-align: center;">Festive Attire</p>

        <p>Translation: The usual cocktail-style wedding attire but we encourage you to add a splash of colour, print or sparkle. <a href="https://www.racked.com/2017/6/9/15676848/wedding-dress-codes-black-tie-cocktail" target="_blank">See here for hints.</a></p>

      </div>

      <div class="col-narrow desktop-only">

        <div class="rsvp">
          RSVP before {{ $rsvpDate->format("d") }}&nbsp;{{ $rsvpDate->format("F") }}&nbsp;{{ $rsvpDate->format("Y") }}
        </div>

      </div>

      <div class="col-narrow col-stacked">

        <h3>Contact Details</h3>

        <p>If you need to get in touch with us about anything, you can email:</p>

        <p style="font-weight: 500; text-align: center;">wedding@conorandsteph.com</p>

      </div>

      <div class="col-narrow mobile-only">

        <div class="rsvp">
          RSVP before {{ $rsvpDate->format("d") }}&nbsp;{{ $rsvpDate->format("F") }}&nbsp;{{ $rsvpDate->format("Y") }}
        </div>

      </div>

    </div>

  </div>

  <div class="invite-footer">
    <img src="/img/root@1x.png" srcset="/img/root@2x.png 2x, /img/root@3x.png 3x">
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
