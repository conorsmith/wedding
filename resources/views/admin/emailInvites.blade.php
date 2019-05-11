@extends('admin.layout')

@section('content')

  <h1 class="display-3">Manage Email Invites</h1>

  <table class="table">
    <thead>
    <tr>
      <th colspan="2">Guests</th>
      <th>Email Addresses</th>
      <th colspan="3"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($invites as $invite)
      <tr>

        <td>{{ $invite->guestA->first_name }} {{ $invite->guestA->last_name }}</td>
        @if($invite->isForTwoGuests())
          <td>+ {{ $invite->guestB->first_name }} {{ $invite->guestB->last_name }}</td>
        @else
          <td></td>
        @endif

        <td>
          {{ $invite->displayEmailAddresses() }}
        </td>

        <td style="width: 140px; text-align: right;">
          <a href="/preview-invite/{{ $invite->id }}" class="btn btn-sm btn-link" target="_blank">Preview Invite</a>
        </td>

        <td style="width: 140px; text-align: right;">
          <a href="/preview-email/{{ $invite->id }}" class="btn btn-sm btn-link" target="_blank">Preview Email</a>
        </td>

        <td>
          <a href="#"
             class="btn btn-sm btn-block btn-success disabled js-invite-sent"
             style="{{ $invite->sent ? "" : "display: none;" }}"
             data-invite-id="{{ $invite->id }}"
             >
            <i class="far fa-check-circle"></i> Sent
          </a>
          <a href="#"
             class="btn btn-sm btn-block btn-primary js-invite-send"
             style="{{ !$invite->sent ? "" : "display: none;" }} margin-top: 0;"
             data-toggle="modal"
             data-target="#email-modal"
             data-invite-id="{{ $invite->id }}"
             data-invite-message="<p>{{ $invite->guestA->first_name }}{{ $invite->isForTwoGuests() ? " and " . $invite->guestB->first_name : "" }}</p><p>{{ $invite->note ? nl2br($invite->note) : "Please join us for" }}</p>"
          >
            <i class="far fa-envelope"></i> Send
          </a>
        </td>

      </tr>
    @endforeach
    </tbody>
  </table>

  <div class="modal" tabindex="-1" role="dialog" id="email-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Send Invite</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger js-error-message" style="display: none;"></div>
          <p><strong>This is the message that will be sent</strong></p>
          <div class="invite-message" style="text-align: center;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary js-send-email"><i class="far fa-envelope"></i> Send Now</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script>

    $("#email-modal").on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $(this).find(".invite-message").html(button.data('invite-message'));
        $(this).find(".js-send-email").data('invite-id', button.data('invite-id'));
        $("#email-modal").find(".js-error-message").hide();
    });

    $(".js-send-email").on('click', function (event) {
        event.preventDefault();
        var button = $(this);
        var inviteId = button.data('invite-id');
        var originalHtml = this.innerHTML;
        this.innerHTML = "<i class=\"fas fa-spinner rotate\"></i>";
        $("#email-modal").find(".js-error-message").hide();
        $.post("/admin/invites/" + inviteId + "/send", function (data) {
            $(".js-invite-send[data-invite-id='" + inviteId + "']").hide();
            $(".js-invite-sent[data-invite-id='" + inviteId + "']").show();
            $("#email-modal").modal('hide');
            button.html(originalHtml);
        })
            .fail(function (xhr) {
                $("#email-modal").find(".js-error-message").text(xhr.responseText).show();
                button.html(originalHtml);
            });
    });

  </script>
@endsection
