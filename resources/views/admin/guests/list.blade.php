@extends('admin.layout')

@section('content')

  <a href="/admin/guests/new" class="btn btn-light border" style="float: right;">Add Guest</a>

  <h1 class="display-3">Tentative Guestlist</h1>

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
        <td>{{ $guest->first_name }} {{  $guest->last_name }}</td>
        <td>{{ $guest->getPartner() ? "+ {$guest->getPartner()->first_name} {$guest->getPartner()->last_name}" : "" }}</td>
        <td style="color: {{ $guest->receive_email ? "#ffc107" : "#666" }}"><i class="fas {{ $guest->email ? "fa-envelope" : "fa-minus" }}" title="{{ $guest->receive_email ? "Will receive invite via email" : "" }}"></i></td>
        <td style="color: #666;"><i class="fas {{ $guest->phone ? "fa-phone" : "fa-minus" }}"></i></td>
        <td style="color: {{ $guest->receive_physical ? "#ffc107" : "#666" }};"><i class="fas {{ $guest->address ? "fa-home" : "fa-minus" }}" title="{{ $guest->receive_email ? "Will receive physical invite" : "" }}"></i></td>
        <td style="text-align: right;">
          <a href="/admin/guests/{{ $guest->id }}" class="btn btn-sm btn-light border">Edit</a>
        </td>
        <td style="width: 140px; text-align: right;">
          <a href="/preview-invite/{{ $guest->getInvite()->id }}" class="btn btn-sm btn-link" target="_blank">Preview Invite</a>
        </td>
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
          $.post("/admin/guests/" + this.dataset.guestId + "/invite", {}, function (data, status, xhr) {
              for (var i = 0; i < data.guests.length; i++) {
                  $(".js-invite[data-guest-id='" + data.guests[i] + "']").hide();
                  $(".js-uninvite[data-guest-id='" + data.guests[i] + "']").show();
              }
          });
      });

      $(".js-uninvite").on('click', function (e) {
          e.preventDefault();
          $.post("/admin/guests/" + this.dataset.guestId + "/uninvite", {}, function (data, status, xhr) {
              for (var i = 0; i < data.guests.length; i++) {
                  $(".js-uninvite[data-guest-id='" + data.guests[i] + "']").hide();
                  $(".js-invite[data-guest-id='" + data.guests[i] + "']").show();
              }
          });
      });
  </script>
@endsection
