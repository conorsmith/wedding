@extends('admin.layout')
@inject('siteMode', 'ConorSmith\Wedding\SiteMode')

@section('content')

  <h1 class="display-3">Manage Physical Invites</h1>

  <table class="table">
    <thead>
    <tr>
      <th>Guests</th>
      <th>Addresses</th>
      <th colspan="3"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($invites as $invite)
      <tr>

        <td>
          {{ $invite->guestA->first_name }} {{ $invite->guestA->last_name }}
          @if($invite->isForTwoGuests())
            + {{ $invite->guestB->first_name }} {{ $invite->guestB->last_name }}
          @endif
        </td>

        <td class="small">
          {{ $invite->guestA->address }}
        </td>

        <td class="small">
          <a href="http://www.{{ $siteMode->getDomainName() }}/rsvp/{{ $invite->short_code }}" target="_blank">http://www.{{ $siteMode->getDomainName() }}/rsvp/{{ $invite->short_code }}</a>
        </td>

        <td style="width: 120px;">
          <a href="#"
             class="btn btn-sm btn-success btn-block js-set-invite-not-sent"
             data-invite-id="{{ $invite->id }}"
             style="{{ $invite->sent ? "" : "display: none;" }}"
          >
            <i class="far fa-check-circle"></i> Sent
          </a>
          <a href="#"
             class="btn btn-sm btn-light btn-block js-set-invite-sent"
             data-invite-id="{{ $invite->id }}"
             style="{{ !$invite->sent ? "" : "display: none;" }} margin-top: 0;"
          >
            Not Sent
          </a>
        </td>

      </tr>
    @endforeach
    </tbody>
  </table>

@endsection

@section('scripts')
  <script>
      $(".js-set-invite-sent").on('click', function (e) {
          e.preventDefault();
          var button = this;
          var inviteId = this.dataset.inviteId;
          var originalHtml = this.innerHTML;
          this.innerHTML = "<i class=\"fas fa-spinner rotate\"></i>";
          $.post("/admin/invites/" + inviteId + "/set-sent", {}, function (data, status, xhr) {
              $(".js-set-invite-sent[data-invite-id='" + inviteId + "']").hide();
              $(".js-set-invite-not-sent[data-invite-id='" + inviteId + "']").show();
              button.innerHTML = originalHtml;
          });
      });

      $(".js-set-invite-not-sent").on('click', function (e) {
          e.preventDefault();
          var button = this;
          var inviteId = this.dataset.inviteId;
          var originalHtml = this.innerHTML;
          this.innerHTML = "<i class=\"fas fa-spinner rotate\"></i>";
          $.post("/admin/invites/" + inviteId + "/set-not-sent", {}, function (data, status, xhr) {
              $(".js-set-invite-not-sent[data-invite-id='" + inviteId + "']").hide();
              $(".js-set-invite-sent[data-invite-id='" + inviteId + "']").show();
              button.innerHTML = originalHtml;
          });
      });

  </script>
@endsection