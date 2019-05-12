@extends('admin.layout')

@section('content')

  <h1 class="display-3">Dashboard</h1>

  <div class="row">

    <div class="col-sm-4">

      <div class="card">
        <h5 class="card-header">Guests</h5>
        <div class="card-body">
          <table class="table" style="margin-bottom: 0;">
            <tr>
              <td>Shortlist</td>
              <td style="text-align: right;">{{ $totalGuests }}</td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Selected to Invite</td>
              <td style="text-align: right;">{{ $totalInvited }}</td>
              <td class="text-muted" style="text-align: right;">/</td>
              <td class="text-muted" style="text-align: right;">{{ config('wedding.capacity') }}</td>
            </tr>
            <tr>
              <td>Attending</td>
              <td style="text-align: right;">{{ $totalAttending }}</td>
              <td class="text-muted" style="text-align: right;">/</td>
              <td class="text-muted" style="text-align: right;">{{ config('wedding.capacity') }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="card">
        <h5 class="card-header">Invites</h5>
        <div class="card-body">
          <table class="table" style="margin-bottom: 0;">
            <tr>
              <td>Email Invites</td>
              <td style="text-align: right;">{{ $totalEmailInvites }}</td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Physical Invites</td>
              <td style="text-align: right;">{{ $totalPhysicalInvites }}</td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Invites Sent</td>
              <td style="text-align: right;">{{ $totalSent }}</td>
              <td class="text-muted" style="text-align: right;">/</td>
              <td class="text-muted" style="text-align: right;">{{ $totalInvites }}</td>
            </tr>
            <tr>
              <td>Responses Received</td>
              <td style="text-align: right;">{{ $totalResponses }}</td>
              <td class="text-muted" style="text-align: right;">/</td>
              <td class="text-muted" style="text-align: right;">{{ $totalSent }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection