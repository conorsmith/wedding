@extends('admin.layout')

@section('content')

  <h1 class="display-3">Invitees</h1>

  <table class="table">
    <thead>
    <tr>
      <th colspan="2">Name</th>
      <th colspan="3">Contact Info</th>
      <th colspan="2"></th>
      <th style="text-align: center;">Invite Sent</th>
      <th style="text-align: center;">RSVP</th>
      <th style="text-align: center;">Attending</th>
    </tr>
    </thead>
    <tbody>
    @foreach($guests as $guest)
      <tr>

        @include('admin.guests.basicRow')

        <td style="width: 120px;">
          <?php $enabled = $guest->receive_physical && !$guest->receive_email; ?>
          <a href="#"
             class="btn btn-sm btn-success btn-block {{ $enabled ? "js-set-invite-not-sent" : "disabled" }}"
             data-invite-id="{{ $guest->getInvite()->id }}"
             style="{{ $guest->getInvite()->sent ? "" : "display: none;" }}"
          >
            <i class="far fa-check-circle"></i> Sent
          </a>
          <a href="#"
             class="btn btn-sm btn-light btn-block {{ $enabled ? "js-set-invite-sent" : "disabled" }}"
             data-invite-id="{{ $guest->getInvite()->id }}"
             style="{{ !$guest->getInvite()->sent ? "" : "display: none;" }} margin-top: 0;"
          >
            Not Sent
          </a>
        </td>

        <td style="width: 120px;">
          @if($guest->getInvite()->response)
            @if($guest->getInvite()->response->attending)
              <a href="#" class="btn btn-sm btn-success btn-block disabled">
                <i class="far fa-check-circle"></i> Yes
              </a>
            @else
              <a href="#" class="btn btn-sm btn-danger btn-block disabled">
                No
              </a>
            @endif
          @else
            <a href="#" class="btn btn-sm btn-warning btn-block disabled">&nbsp;</a>
          @endif
        </td>

        <td style="width: 140px;">
          <a href="#"
             class="btn btn-sm btn-success btn-block js-set-not-attending"
             style="{{ $guest->is_attending ? "" : "display: none;" }}"
             data-guest-id="{{ $guest->id }}"
          >
            <i class="far fa-check-circle"></i> Attending
          </a>
          <a href="#"
             class="btn btn-sm btn-danger btn-block js-set-attending"
             style="{{ !$guest->is_attending ? "" : "display: none;" }} margin-top: 0;"
             data-guest-id="{{ $guest->id }}"
          >
            Not Attending
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
          $.post(
              "/admin/invites/" + inviteId + "/toggle-is-sent",
              {
                  isSent: 1
              },
              function (data, status, xhr) {
                  $(".js-set-invite-sent[data-invite-id='" + inviteId + "']").hide();
                  $(".js-set-invite-not-sent[data-invite-id='" + inviteId + "']").show();
                  button.innerHTML = originalHtml;
              }
          );
      });

      $(".js-set-invite-not-sent").on('click', function (e) {
          e.preventDefault();
          var button = this;
          var inviteId = this.dataset.inviteId;
          var originalHtml = this.innerHTML;
          this.innerHTML = "<i class=\"fas fa-spinner rotate\"></i>";
          $.post(
              "/admin/invites/" + inviteId + "/toggle-is-sent",
              {
                  isSent: 0
              },
              function (data, status, xhr) {
                  $(".js-set-invite-not-sent[data-invite-id='" + inviteId + "']").hide();
                  $(".js-set-invite-sent[data-invite-id='" + inviteId + "']").show();
                  button.innerHTML = originalHtml;
              }
          );
      });

      $(".js-set-attending").on('click', function (e) {
          e.preventDefault();
          var button = this;
          var guestId = this.dataset.guestId;
          var originalHtml = this.innerHTML;
          this.innerHTML = "<i class=\"fas fa-spinner rotate\"></i>";
          $.post(
              "/admin/guests/" + this.dataset.guestId + "/toggle-is-attending",
              {
                  isAttending: 1
              },
              function (data, status, xhr) {
                  $(".js-set-attending[data-guest-id='" + guestId + "']").hide();
                  $(".js-set-not-attending[data-guest-id='" + guestId + "']").show();
                  button.innerHTML = originalHtml;
              }
          );
      });

      $(".js-set-not-attending").on('click', function (e) {
          e.preventDefault();
          var button = this;
          var guestId = this.dataset.guestId;
          var originalHtml = this.innerHTML;
          this.innerHTML = "<i class=\"fas fa-spinner rotate\"></i>";
          $.post(
              "/admin/guests/" + this.dataset.guestId + "/toggle-is-attending",
              {
                  isAttending: 0
              },
              function (data, status, xhr) {
                  $(".js-set-not-attending[data-guest-id='" + guestId + "']").hide();
                  $(".js-set-attending[data-guest-id='" + guestId + "']").show();
                  button.innerHTML = originalHtml;
              }
          );
      });

  </script>
@endsection
