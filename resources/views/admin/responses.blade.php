@extends('admin.layout')

@section('content')

  <h1 class="display-3">Responses</h1>

  <table class="table">
    <thead>
    <tr>
      <th>Guests</th>
      <th style="text-align: center;">RSVP</th>
      <th>Sent at</th>
      <th>Note</th>
    </tr>
    </thead>
    <tbody>
    @foreach($responses as $response)
      <?php $invite = $response->linkedInvite; ?>
      <tr>

        <td>
          {{ $invite->guestA->first_name }} {{ $invite->guestA->last_name }}
          @if($invite->isForTwoGuests())
            + {{ $invite->guestB->first_name }} {{ $invite->guestB->last_name }}
          @endif
        </td>

        <td style="width: 120px;">
          @if($response->attending)
            <a href="#" class="btn btn-sm btn-success btn-block disabled">
              <i class="far fa-check-circle"></i> Yes
            </a>
          @else
            <a href="#" class="btn btn-sm btn-danger btn-block disabled">
              No
            </a>
          @endif
        </td>

        <td class="small js-sent-at">
          {{ $response->created_at->format("Y") }}&#8209;{{ $response->created_at->format("m") }}&#8209;{{ $response->created_at->format("d") }}&nbsp;{{ $response->created_at->format("H:i") }}
        </td>

        <td class="small">{{ $response->note }}</td>

      </tr>
    @endforeach
    </tbody>
  </table>

@endsection

@section('scripts')
@endsection
