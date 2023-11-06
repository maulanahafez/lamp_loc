<x-layout.main>
  @section('content')
    <form action="{{ $action }}" method="POST">
      @csrf
      @if ($button == 'Edit')
        @method('PUT')
      @endif
      <div class="flex flex-col lg:flex-row gap-6">
        <div class="order-last lg:order-first basis-auto grow">
          <div class="border border-black/20 rounded-sm shadow-sm border-t-2 border-t-secondary">
            <div class="px-4 py-2 border border-b/20">{{ $button }} Streetlight</div>
            <div class="card">
              <div class="card-body pt-2 pb-6 px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                  <div>
                    <label class="label" for="streetlight_group_id">
                      <span class="label-text font-bold required">
                        Group
                      </span>
                    </label>
                    <select class="w-full select select-secondary select-bordered select-sm" id="streetlight_group_id"
                      name="streetlight_group_id">
                      <option value>-- Choose Group --</option>
                      @if ($button == 'Edit')
                        <option value="{{ $data->streetlight_group_id }}" selected>
                          {{ $data->streetlight_group->code . ' - ' . $data->streetlight_group->street }}
                        </option>
                      @endif
                    </select>
                    @error('streetlight_group_id')
                      <div class="text-error mt-1 text-sm">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div>
                    <label class="label" for="order">
                      <span class="label-text font-bold required">
                        Order
                      </span>
                    </label>
                    <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="order"
                      placeholder="Order" type="number" name="order"
                      value="{{ old('order', $button == 'Edit' ? $data->order : null) }}">
                    @error('order')
                      <div class="text-error mt-1 text-sm">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div>
                  <label class="label" for="name">
                    <span class="label-text font-bold required">
                      Name
                    </span>
                  </label>
                  <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="name"
                    placeholder="Name" type="text" name="name"
                    value="{{ old('name', $button == 'Edit' ? $data->name : null) }}">
                  @error('name')
                    <div class="text-error mt-1 text-sm">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mt-2 grid lg:grid-cols-2 md:grid-cols-1 gap-4">
                  <div>
                    <label class="label">
                      <span class="label-text font-bold">
                        Type
                      </span>
                    </label>
                    <div class="space-y-1">
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="type" type="radio" value="LED"
                          @checked($button == 'Edit' && $data->type == 'LED') />
                        <span>LED</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="type" type="radio" value="Tungsten"
                          @checked($button == 'Edit' && $data->type == 'Tungsten') />
                        <span>Tungsten</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="type" type="radio"
                          value="Fluorescent" @checked($button == 'Edit' && $data->type == 'Fluorescent') />
                        <span>Fluorescent</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="type" type="radio" value="Halogen"
                          @checked($button == 'Edit' && $data->type == 'Halogen') />
                        <span>Halogen</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="type" type="radio"
                          value="Sodium  @checked($button == 'Edit' && $data->type == '')VaSodiumpor" />
                        <span>Sodium Vapor</span>
                      </label>
                    </div>
                    @error('type')
                      <div class="text-sm text-error mt-1">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div>
                    <label class="label">
                      <span class="label-text font-bold">
                        Status
                      </span>
                    </label>
                    <div class="space-y-1">
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="status" type="radio" value="Aktif"
                          @checked($button == 'Edit' && $data->status == 'Aktif') />
                        <span class="badge badge-primary">Aktif</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="status" type="radio" value="Rusak"
                          @checked($button == 'Edit' && $data->status == 'Rusak') />
                        <span class="badge badge-secondary">Rusak</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="status" type="radio"
                          value="Dalam Pemeliharaan" @checked($button == 'Edit' && $data->status == 'Dalam Pemeliharaan') />
                        <span class="badge badge-warning">Dalam Pemeliharaan</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="status" type="radio" value="Mati"
                          @checked($button == 'Edit' && $data->status == 'Mati') />
                        <span class="badge badge-error">Mati</span>
                      </label>
                    </div>
                    @error('status')
                      <div class="text-sm text-error mt-1">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="mt-2 grid lg:grid-cols-2 md:grid-cols-1 gap-4">
                  <div>
                    <label class="label" for="model">
                      <span class="label-text font-bold">
                        Model
                      </span>
                    </label>
                    <select class="select select-bordered select-secondary select-sm rounded-sm w-full" id="model"
                      name="model">
                      <option value>-- Choose Streetlight Model --</option>
                      <option @selected($button == 'Edit' && $data->model == 'Classic') value="Classic">Classic</option>
                      <option @selected($button == 'Edit' && $data->model == 'Solar-Powered') value="Solar-Powered">Solar-Powered</option>
                      <option @selected($button == 'Edit' && $data->model == 'Modern LED') value="Modern LED">Modern LED</option>
                      <option @selected($button == 'Edit' && $data->model == 'Decorative') value="Decorative">Decorative</option>
                      <option @selected($button == 'Edit' && $data->model == 'High-Pole') value="High-Pole">High-Pole</option>
                      <option @selected($button == 'Edit' && $data->model == 'Traditional Lamp') value="Traditional Lamp">Traditional Lamp</option>
                      <option @selected($button == 'Edit' && $data->model == 'Smart') value="Smart">Smart</option>
                      <option @selected($button == 'Edit' && $data->model == 'Industrial High-Bay') value="Industrial High-Bay">Industrial High-Bay</option>
                      <option @selected($button == 'Edit' && $data->model == 'Vintage Lantern') value="Vintage Lantern">Vintage Lantern</option>
                      <option @selected($button == 'Edit' && $data->model == 'Minimalist') value="Minimalist">Minimalist</option>
                    </select>
                    @error('model')
                      <div class="text-error mt-1 text-sm">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div>
                    <label class="label" for="height">
                      <span class="label-text font-bold">
                        Height
                      </span>
                    </label>
                    <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="height"
                      placeholder="Height (m)" step="any" type="number" name="height"
                      value="{{ old('height', $button == 'Edit' ? $data->height : null) }}">
                    @error('height')
                      <div class="text-error mt-1 text-sm">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="mt-2 grid lg:grid-cols-3 md:grid-cols-1 gap-4">
                  <div>
                    <label class="label" for="power_rate">
                      <span class="label-text font-bold">
                        Power Rate
                      </span>
                    </label>
                    <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="power_rate"
                      placeholder="Power Rate (W)" type="number" name="power_rate"
                      value="{{ old('power_rate', $button == 'Edit' ? $data->power_rate : null) }}">
                    @error('power_rate')
                      <div class="text-error mt-1 text-sm">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div>
                    <label class="label" for="voltage_rate_rate">
                      <span class="label-text font-bold">
                        Voltage
                      </span>
                    </label>
                    <div class="join" x-data="handleVoltageRate()">
                      <input class="join-item input input-sm input-bordered rounded-sm input-secondary w-full"
                        id="voltage_rate_rate" placeholder="Voltage (V)" type="number" name="voltage_rate_rate"
                        @if ($button == 'Edit' && !old('voltage_rate_rate')) :value="voltage_rate_rate" @endif
                        value="{{ old('voltage_rate_rate') }}">
                      <select class="join-item select rounded-sm select-bordered select-sm select-secondary"
                        id="voltage_rate_type" name="voltage_rate_type">
                        <option value="AC" :selected="voltage_rate_type == 'AC'">AC</option>
                        <option value="DC" :selected="voltage_rate_type == 'DC'">DC</option>
                      </select>
                      @if ($button == 'Edit')
                        <script>
                          function handleVoltageRate() {
                            let voltage_rate = "{{ $data->voltage_rate }}";
                            let [voltage_rate_rate, $voltage_rate_type] = voltage_rate.split('/');
                            return {
                              voltage_rate_rate,
                              voltage_rate_type,
                            }
                          }
                        </script>
                      @endif
                    </div>
                    @error('voltage_rate_rate')
                      <div class="text-error mt-1 text-sm">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div>
                    <label class="label" for="illumination_level">
                      <span class="label-text font-bold">
                        Illumination Level
                      </span>
                    </label>
                    <input class="input input-sm input-bordered rounded-sm input-secondary w-full"
                      id="illumination_level" placeholder="Illumination Level (lux)" type="number"
                      name="illumination_level"
                      value="{{ old('illumination_level', $button == 'Edit' ? $data->illumination_level : null) }}">
                    @error('illumination_level')
                      <div class="text-error mt-1 text-sm">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="mt-2">
                  <label class="label" for="manufacturer">
                    <span class="label-text font-bold">
                      Manufacturer
                    </span>
                  </label>
                  <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="manufacturer"
                    placeholder="Manufacturer" type="text" name="manufacturer"
                    value="{{ old('manufacturer', $button == 'Edit' ? $data->manufacturer : null) }}">
                  @error('manufacturer')
                    <div class="text-error mt-1 text-sm">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mt-4 space-y-2 text-end">
                  <a class="btn btn-neutral rounded-sm btn-sm capitalize text-white"
                    href="{{ route('streetlight.index') }}">
                    <i class="fa-solid fa-backward"></i>
                    Back
                  </a>
                  <button class="btn btn-secondary rounded-sm btn-sm capitalize text-white" type="submit">
                    <i class="fa-solid fa-square-plus"></i>
                    {{ $button }}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="lg:basis-[32rem] basis-full">
          <div class=" border border-black/20 rounded-sm shadow-sm border-t-2 border-t-primary">
            <div class="px-4 py-2 border border-b/20">Streetlight Coordinate</div>
            <div class="card">
              <div class="card-body pt-2 pb-6 px-4">
                <div class="h-60 w-full" id="map"></div>
                <div class="grid lg:grid-cols-2 gap-4">
                  <div>
                    <label class="label" for="lat">
                      <span class="label-text font-bold required">
                        Latitude
                      </span>
                    </label>
                    <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="lat"
                      readonly placeholder="Latitude" type="number" name="lat" value="{{ old('lat') }}">
                    @error('lat')
                      <div class="text-error mt-1 text-sm">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div>
                    <label class="label" for="long">
                      <span class="label-text font-bold required">
                        Longitude
                      </span>
                    </label>
                    <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="long"
                      readonly placeholder="Longitude" type="number" name="long" value="{{ old('long') }}">
                    @error('long')
                      <div class="text-error mt-1 text-sm">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div>
                  <p class="text-sm">
                    <span>
                      You can either double-click on the map to select a location or use your
                    </span>
                    <a class="underline text-blue-500" id="currentLocationBtn" href="/">
                      current location.
                    </a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  @endsection

  @section('js')
    <script>
      $(function() {
        $('#streetlight_group_id').select2({
          ajax: {
            url: "{{ route('streetlight_group.get_groups') }}",
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
              return {
                results: $.map(data, function(item) {
                  return {
                    id: item.id,
                    text: item.item
                  };
                })
              };
            },
            cache: true
          },
        });
      })
    </script>
    <script>
      $(function() {
        var map = L.map('map').setView([0, 0], 16);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = null;

        @if ($button == 'Create')
          map.locate({
            setView: true,
            maxZoom: 16
          });
        @else
          map.setView([{{ $data->lat }}, {{ $data->long }}], 16)
          marker = L.marker([{{ $data->lat }}, {{ $data->long }}]).addTo(map)
          $('#lat').val('{{ $data->lat }}')
          $('#long').val('{{ $data->long }}')
        @endif

        function onLocationFound(e) {
          var lat = e.latlng.lat;
          var long = e.latlng.lng;
          if (marker) {
            marker.setLatLng(e.latlng).addTo(map)
              .bindPopup("You are here").openPopup();
          } else {
            marker = L.marker(e.latlng).addTo(map)
              .bindPopup("You are here").openPopup();
          }
          map.setView([lat, long], 16)
          $('#lat').val(lat)
          $('#long').val(long)
        }

        function onLocationError(e) {
          alert(e.message);
        }

        map.on('locationfound', onLocationFound);
        map.on('locationerror', onLocationError);

        map.on('dblclick', function(e) {
          var lat = e.latlng.lat.toFixed(6);
          var lon = e.latlng.lng.toFixed(6);
          if (marker) {
            marker.setLatLng(e.latlng);
          } else {
            marker = L.marker(e.latlng).addTo(map);
          }
          $('#lat').val(lat);
          $('#long').val(lon);
        });

        $('#currentLocationBtn').on('click', function(e) {
          e.preventDefault();
          map.locate({
            setView: true,
            maxZoom: 16
          });
        })
      })
    </script>
  @endsection
</x-layout.main>
