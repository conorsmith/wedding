@inject('siteMode', 'ConorSmith\Wedding\SiteMode')

<h2>Dear {{ $invite->guestA->first_name }}{{ $invite->isForTwoGuests() ? " & " . $invite->guestB->first_name : "" }},</h2>

<p>We request the pleasure of your company at our wedding this summer.</p>

<table>
  <tr>
    <td align="center">
      <p>
        <a href="http://www.{{ $siteMode->getDomainName() }}/invite/{{ $invite->id }}?key={{ $invite->access_key }}" class="button">Please click here to open your invite</a>
      </p>
    </td>
  </tr>
</table>

<p><em>– {{ $siteMode->getNames() }}</em></p>
