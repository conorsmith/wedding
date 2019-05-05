
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
