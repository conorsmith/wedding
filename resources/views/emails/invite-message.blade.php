@inject('siteMode', 'ConorSmith\Wedding\SiteMode')

<h2>Hey {{ $invite->guestA->first_name }}{{ $invite->isForTwoGuests() ? " & " . $invite->guestB->first_name : "" }},</h2>

<p>We're getting married this summer and <strong>you're invited!</strong></p>

<table>
  <tr>
    <td align="center">
      <p>
        <a href="http://www.{{ $siteMode->getDomainName() }}/invite/{{ $invite->id }}?key={{ $invite->access_key }}" class="button">Open your invite</a>
      </p>
    </td>
  </tr>
</table>

<p><em>– {{ $siteMode->getNames() }}</em></p>
