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
            <?php $isPartner = $partner && $partner->id === $otherGuest->id; ?>
            <option value="{{ $otherGuest->id }}" {{ $isPartner ? 'selected="selected"' : '' }}>
              {{ $otherGuest->first_name }} {{ $otherGuest->last_name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-2">
        @if($partner)
          <a href="/admin/guests/{{ $partner->id }}" class="btn btn-block btn-light">Edit Partner's Info</a>
        @endif
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Children</label>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="has_children" value="option1">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="has_children" value="option2">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>

    <h3>Invite</h3>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Joint Invite</label>
      <div class="col-sm-1">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="invite_plus_partner" value="yes" {{ $guest->getInvite()->isForTwoGuests() ? 'checked="checked"' : '' }}>
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="invite_plus_partner" value="no" {{ $guest->getInvite()->isForOneGuest() ? 'checked="checked"' : '' }}>
          <label class="form-check-label">No</label>
        </div>
      </div>
      @if($guest->getInvite()->isForTwoGuests())
        <div class="col-sm-2">
          <input type="text" readonly class="form-control-plaintext" style="font-style: italic;" value="{{ $guest->getInvite()->guestA->first_name }} and {{ $guest->getInvite()->guestB->first_name }}">
        </div>
        <div class="col-sm-2">
          <a href="/admin/invites/{{ $guest->getInvite()->id }}/switch?guest={{ $guest->id }}" class="btn btn-block btn-light">Reverse Names</a>
        </div>
      @endif
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Send Invite via Email</label>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="receive_email" value="1" {{ $guest->receive_email ? 'checked="checked"' : '' }}>
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="receive_email" value="0" {{ !$guest->receive_email ? 'checked="checked"' : '' }}>
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Send Physical Invite</label>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="receive_physical" value="1" {{ $guest->receive_physical ? 'checked="checked"' : '' }}>
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="receive_physical" value="0" {{ !$guest->receive_physical ? 'checked="checked"' : '' }}>
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Personal Note</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="invite_note" rows="3">{{ $guest->getInvite()->note }}</textarea>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-10 offset-2">
        <a href="/preview-invite/{{ $guest->getInvite()->id }}" target="_blank">Preview Invite</a>
      </div>
    </div>

    <h3>RSVP</h3>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Attending</label>
      <div class="col-sm-10">
        <span class="badge badge-{{ $guest->getInvite()->response && $guest->getInvite()->response->attending ? "success" : "secondary" }}">Yes</span>
        <span class="badge badge-{{ $guest->getInvite()->response && !$guest->getInvite()->response->attending ? "danger" : "secondary" }}">No</span>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Response Note</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="note" rows="3" disabled>{{ $guest->hasResponded() ? $guest->getInvite()->response->note : "" }}</textarea>
      </div>
    </div>

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

              @if($guest->getInvite()->isForTwoGuests())
                <tr>

                  <td>{{ $partner->first_name }} {{ $partner->last_name }}</td>

                  <td style="width: 160px;">

                    <input type="hidden" name="partner_is_attending" value="{{ $partner->is_attending }}">

                    <a href="#"
                       class="btn btn-success btn-block js-attending-override"
                       data-is-guest="0"
                       data-is-attending="1"
                       style="{{ !$partner->is_attending ? "display: none;" : "" }}"
                    >Attending</a>

                    <a href="#"
                       class="btn btn-danger btn-block js-attending-override"
                       data-is-guest="0"
                       data-is-attending="0"
                       style="margin-top: 0; {{ $partner->is_attending ? "display: none;" : "" }}"
                    >Not Attending</a>
                  </td>

                </tr>
              @endif

            </table>
          </div>
        </div>
      </div>
    </div>

    <h3>Gift</h3>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Gift Received</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="gift" rows="3" disabled></textarea>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-10 offset-sm-2">
        <button type="submit" class="btn btn-primary btn-lg">Save</button>
      </div>
    </div>

  </form>

  @if($edit)

    <hr>

    <div class="row" style="margin-bottom: 40px; text-align: right;">

      <div class="col-sm-3 offset-sm-9">

        <h3>Danger Zone</h3>

        <form method="POST" action="/admin/guests/{{ $guest->id }}" class="delete">
          @csrf
          <input type="hidden" name="_method" value="delete" />
          <button type="submit" class="btn btn-sm btn-danger">Delete this Guest</button>
        </form>

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
  </script>
@endsection
