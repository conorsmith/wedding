@extends('admin.layout')

@section('content')

  <h1 class="display-3">Dashboard</h1>

  <div class="row">
    <div class="col-sm-4">

      <table class="table">
        <tr>
          <td>Tentative Guests</td>
          <td style="text-align: right;">{{ $totalGuests }}</td>
          <td></td>
        </tr>
        <tr>
          <td>Selected to Invite</td>
          <td style="text-align: right;">{{ $totalInvites }}</td>
          <td class="text-muted">/ {{ config('wedding.capacity') }}</td>
        </tr>
        <tr>
          <td>Invites Sent</td>
          <td style="text-align: right;">{{ $totalSent }}</td>
          <td></td>
        </tr>
      </table>

    </div>
  </div>

@endsection