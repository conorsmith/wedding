@extends('admin.layout')

@section('content')

  <a href="/admin/guests/new" class="btn btn-light border" style="float: right;">Add Guest</a>

  <h1 class="display-3">Guests</h1>

  <table class="table">
    <thead>
      <tr>
        <th colspan="2">Name</th>
        <th><i class="fas fa-envelope"></i></th>
        <th><i class="fas fa-phone"></i></th>
        <th><i class="fas fa-home"></i></th>
        <th colspan="2"></th>
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
      </tr>
    @endforeach
    </tbody>
  </table>

@endsection
