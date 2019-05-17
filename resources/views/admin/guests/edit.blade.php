@extends('admin.layout')

@section('content')

  <h1 class="display-4">{{ $edit ? "Edit" : "Create" }} Guest</h1>

  <hr>

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <form method="POST">
    @csrf

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">First Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="first_name" value="{{ $guest->first_name }}">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Last Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="last_name" value="{{ $guest->last_name }}">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="email" value="{{ $guest->email }}">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Phone</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="phone" value="{{ $guest->phone }}">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Address</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="address" value="{{ $guest->address }}">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Partner</label>
      <div class="col-sm-8">
        <select class="form-control" name="partner">
          <option value="null">N/A</option>
          @foreach($guests as $otherGuest)
            <option value="{{ $otherGuest->id }}"
                {{ $guest->partner && $guest->partner->id === $otherGuest->id ? "selected" : "" }}
            >
              {{ $otherGuest->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-2">
        @if($guest->partner)
          <a href="/admin/guests/{{ $guest->partner->id }}" class="btn btn-block btn-light">Edit Partner's Info</a>
        @endif
      </div>
    </div>

    <h3>Invite</h3>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Joint Invite</label>
      <div class="col-sm-1">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="invite_plus_partner" value="yes" {{ $guest->invite->is_for_two_guests ? 'checked="checked"' : '' }}>
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="invite_plus_partner" value="no" {{ $guest->invite->is_for_one_guest ? 'checked="checked"' : '' }}>
          <label class="form-check-label">No</label>
        </div>
      </div>
      @if($guest->invite->is_for_two_guests)
        <div class="col-sm-2">
          <input type="text" readonly class="form-control-plaintext" style="font-style: italic;" value="{{ $guest->invite->joint_invite_names }}">
        </div>
        <div class="col-sm-2">
          <a href="/admin/invites/{{ $guest->invite->id }}/switch?guest={{ $guest->id }}"
             class="btn btn-block btn-light"
          >Reverse Names</a>
        </div>
      @endif
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Send Invite via Email</label>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input"
                 type="radio"
                 name="receive_email"
                 value="1"
              {{ $guest->receive_email ? "checked" : "" }}
          >
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check">
          <input class="form-check-input"
                 type="radio"
                 name="receive_email"
                 value="0"
              {{ !$guest->receive_email ? "checked" : "" }}
          >
          <label class="form-check-label">No</label>
        </div>
        <small id="passwordHelpInline" class="text-muted">
          Email an invite to {{ $guest->first_name ?: "this guest" }} using {{ $guest->email ?? "an email address that is yet to be added" }}
        </small>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Send Physical Invite</label>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input"
                 type="radio"
                 name="receive_physical"
                 value="1"
              {{ $guest->receive_physical ? "checked" : "" }}
          >
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check">
          <input class="form-check-input"
                 type="radio"
                 name="receive_physical"
                 value="0"
              {{ !$guest->receive_physical ? "checked" : "" }}
          >
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Personal Note</label>
      <div class="col-sm-10">
        <textarea class="form-control js-invite-note" name="invite_note" rows="3">{{ $guest->invite->note }}</textarea>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-10 offset-2">
        <a href="/preview-invite/{{ $guest->invite->id }}?note={{ urlencode($guest->invite->note) }}"
           class="btn btn-light js-invite-link"
           target="_blank"
           data-base-url="/preview-invite/{{ $guest->invite->id }}?note=">Preview Invite with this Note</a>
      </div>
    </div>

    <h3>RSVP</h3>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Attending</label>
      <div class="col-sm-10">
        <span class="badge badge-{{ $guest->has_responded && $guest->invite->response->attending ? "success" : "secondary" }}">Yes</span>
        <span class="badge badge-{{ $guest->has_responded && !$guest->invite->response->attending ? "danger" : "secondary" }}">No</span>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Response Note</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="note" rows="3" disabled>{{ $guest->has_responded ? $guest->invite->response->note : "" }}</textarea>
      </div>
    </div>

    @if($edit)
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Manual Override</label>
        <div class="col-sm-5">
          <div class="card">
            <div class="card-body">
              <table class="table table-borderless table-sm" style="margin-bottom: 0;">

                <tr>

                  <td>{{ $guest->first_name }} {{ $guest->last_name }}</td>

                  <td style="width: 160px;">

                    <input type="hidden" name="is_attending" value="{{ $guest->is_attending }}">

                    <a href="#"
                       class="btn btn-success btn-block js-attending-override"
                       data-is-guest="1"
                       data-is-attending="1"
                       style="{{ !$guest->is_attending ? "display: none;" : "" }}"
                    >Attending</a>

                    <a href="#"
                       class="btn btn-danger btn-block js-attending-override"
                       data-is-guest="1"
                       data-is-attending="0"
                       style="margin-top: 0; {{ $guest->is_attending ? "display: none;" : "" }}"
                    >Not Attending</a>

                  </td>

                </tr>

                @if($guest->invite->is_for_two_guests)
                  <tr>

                    <td>{{ $guest->partner->name }}</td>

                    <td style="width: 160px;">

                      <input type="hidden" name="partner_is_attending" value="{{ $guest->partner->is_attending }}">

                      <a href="#"
                         class="btn btn-success btn-block js-attending-override"
                         data-is-guest="0"
                         data-is-attending="1"
                         style="{{ !$guest->partner->is_attending ? "display: none;" : "" }}"
                      >Attending</a>

                      <a href="#"
                         class="btn btn-danger btn-block js-attending-override"
                         data-is-guest="0"
                         data-is-attending="0"
                         style="margin-top: 0; {{ $guest->partner->is_attending ? "display: none;" : "" }}"
                      >Not Attending</a>
                    </td>

                  </tr>
                @endif

              </table>
            </div>
          </div>
        </div>
      </div>
    @endif

    {{--

    <h3>Gift</h3>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Gift Received</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="gift" rows="3" disabled></textarea>
      </div>
    </div>

    --}}

    <div class="form-group row">
      <div class="col-sm-2 offset-sm-2">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
      </div>
      <div class="col-sm-8">
        <div class="form-check form-check-inline">
          <input type="checkbox" class="form-check-input" name="is_ready" {{ $guest->is_ready ? "checked" : "" }}>
          <label class="form-check-label">This guest's information is complete</label>
        </div>
      </div>
    </div>

  </form>

  <hr>

  @if($edit)

    <div class="row" style="margin-bottom: 40px; text-align: center;">

      <div class="col-sm-3 offset-sm-9">
        <div class="card">
          <div class="card-body">

            <h4>Danger Zone</h4>

            <form method="POST" action="/admin/guests/{{ $guest->id }}" class="delete" style="margin-top: 20px;">
              @csrf
              <input type="hidden" name="_method" value="delete" />
              <button type="submit" class="btn btn-sm btn-danger">Delete this Guest</button>
            </form>

          </div>
        </div>
      </div>

    </div>

  @endif

@endsection

@section('scripts')
  <script>
      $("form.delete").on('submit', function (e) {
          var result = confirm("Delete this guest?");
          if (result !== true) {
              e.preventDefault();
          }
      });

      $(".js-attending-override").on('click', function (e) {
          e.preventDefault();
          if (this.dataset.isGuest === "1") {
              $("input[name='is_attending']").val(this.dataset.isAttending === "1" ? "0" : "1");
          } else {
              $("input[name='partner_is_attending']").val(this.dataset.isAttending === "1" ? "0" : "1");
          }

          $(this).hide();
          $(this).siblings(".js-attending-override").show();
      });


      $(".js-invite-note").on('keyup', function (e) {
          var $link = $(".js-invite-link");
          $link.attr('href', $link.data('base-url') + encodeURI(e.target.value));
      });
  </script>
@endsection
