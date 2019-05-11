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
          <td style="text-align: right;">{{ $totalInvited }}</td>
          <td class="text-muted">/ {{ config('wedding.capacity') }}</td>
        </tr>
        <tr><td colspan="3"></td></tr>
        <tr>
          <td>Invites Sent</td>
          <td style="text-align: right;">{{ $totalSent }}</td>
          <td class="text-muted">/ {{ $totalInvites }}</td>
        </tr>
        <tr>
          <td>Responses Received</td>
          <td style="text-align: right;">{{ $totalResponses }}</td>
          <td class="text-muted">/ {{ $totalSent }}</td>
        </tr>
        <tr><td colspan="3"></td></tr>
        <tr>
          <td>Guests Attending</td>
          <td style="text-align: right;">{{ $totalAttending }}</td>
          <td class="text-muted">/ {{ config('wedding.capacity') }}</td>
        </tr>
      </table>

    </div>
    <div class="col-sm-8">
      <div class="card">
        <div class="card-body">
          <a href="/admin/invites?type=email" class="btn btn-light">Manage Email Invites</a>
          <a href="/admin/invites?type=physical" class="btn btn-light">Manage Physical Invites</a>
        </div>
      </div>
    </div>
  </div>

@endsection