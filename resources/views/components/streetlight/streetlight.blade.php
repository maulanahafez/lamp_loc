@props(['streetlight'])

<div class="shadow-sm border border-secondary rounded-sm">
  <table class="table table-xs table-zebra h-full">
    <tr>
      <th class="w-[40%] max-w-[40%]">Lat, Long</th>
      <td>{{ "$streetlight->lat, $streetlight->long" }}</td>
    </tr>
    <tr>
      <th>Group - Name</th>
      <td>{{ "{$streetlight->streetlight_group->code} - $streetlight->name" }}</td>
    </tr>
    <tr>
      <th>Street</th>
      <td>{{ "{$streetlight->streetlight_group->street}" }}</td>
    </tr>
    <tr>
      <th>Type</th>
      <td>{{ "$streetlight->type" }}</td>
    </tr>
    <tr>
      <th>Status</th>
      <td>{{ "$streetlight->status" }}</td>
    </tr>
    <tr>
      <th>Model</th>
      <td>{{ "$streetlight->model" }}</td>
    </tr>
    <tr>
      <th>Height</th>
      <td>{{ "$streetlight->height m" }}</td>
    </tr>
    @php
      $voltage = '';
      if ($streetlight->voltage_rate != '') {
          [$voltage, $type] = explode('/', $streetlight->voltage_rate);
          $voltage = "$voltage V $type";
      }
    @endphp
    <tr>
      <th>Rate</th>
      <td>{{ "$streetlight->power_rate m - $voltage" }}</td>
    </tr>
    <tr>
      <th>Illumination Level</th>
      <td>{{ "$streetlight->illumination_level lux" }}</td>
    </tr>
    <tr>
      <th>Manufacturer</th>
      <td>{{ "$streetlight->manufacturer" }}</td>
    </tr>
  </table>
</div>
