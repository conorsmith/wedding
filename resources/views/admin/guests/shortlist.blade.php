@extends('admin.layout')

@section('content')

  <a href="/admin/guests/new" class="btn btn-light border" style="float: right;">Add Guest</a>

  <h1 class="display-3">Shortlist</h1>

  <table class="table">
    <thead>
      <tr>
        <th colspan="2">Name</th>
        <th colspan="3">Contact Info</th>
        <th colspan="3"></th>
      </tr>
    </thead>
    <tbody>
    @foreach($guests as $guest)
      <tr>

        @include('admin.guests.basicRow')

        <td style="text-align: right; width: 130px;">
          <a href="#" class="btn btn-block btn-sm btn-light border js-invite" style="{{ $guest->is_invited ? "display: none;" : "" }}" data-guest-id="{{ $guest->id }}">Set as Invited</a>
          <a href="#" class="btn btn-block btn-sm btn-success border js-uninvite" style="margin-top: 0; {{ !$guest->is_invited ? "display: none" : "" }}" data-guest-id="{{ $guest->id }}"><i class="far fa-check-circle"></i> Invited</a>
        </td>

      </tr>
    @endforeach
    </tbody>
  </table>

@endsection

@section('scripts')
  <script>
      $(".js-invite").on('click', function (e) {
          e.preventDefault();
          var button = this;
          var originalHtml = this.innerHTML;
          this.innerHTML = "<i class=\"fas fa-spinner rotate\"></i>";
          $.post("/admin/guests/" + this.dataset.guestId + "/invite", {}, function (data, status, xhr) {
              for (var i = 0; i < data.guests.length; i++) {
                  $(".js-invite[data-guest-id='" + data.guests[i] + "']").hide();
                  $(".js-uninvite[data-guest-id='" + data.guests[i] + "']").show();
              }
              button.innerHTML = originalHtml;
          });
      });

      $(".js-uninvite").on('click', function (e) {
          e.preventDefault();
          var button = this;
          var originalHtml = this.innerHTML;
          this.innerHTML = "<i class=\"fas fa-spinner rotate\"></i>";
          $.post("/admin/guests/" + this.dataset.guestId + "/uninvite", {}, function (data, status, xhr) {
              for (var i = 0; i < data.guests.length; i++) {
                  $(".js-uninvite[data-guest-id='" + data.guests[i] + "']").hide();
                  $(".js-invite[data-guest-id='" + data.guests[i] + "']").show();
              }
              button.innerHTML = originalHtml;
          });
      });
  </script>
@endsection