<x-layout.app>
  @section('content')
    <nav class="bg-secondary shadow-sm">
      <div class="container mx-auto px-4 py-2">
        <div class="flex items-center justify-center gap-x-4">
          <i class="fa-regular fa-lightbulb text-white text-2xl"></i>
          <a href="/">
            <p class="text-lg text-white font-semibold tracking-widest">Lamp Loc</p>
            <p class="text-xs text-white/70">Streetlamp Locator</p>
          </a>
        </div>
      </div>
    </nav>

    <header class="container mx-auto px-4 py-12 max-w-[1024px]">
      <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
        <div class="space-y-2">
          <p class="text-xl text-secondary/70 font-semibold">Streetlamp Locator</p>
          <p class="text-5xl font-bold tracking-widest">Lamp Loc</p>
          <p class="text-black/60 text-lg">
            A streetlight mapping and issue reporting platform designed to brighten our communities, one light at a time.
            Explore, report, and illuminate the way forward.
          </p>
          <div>
            <a class="btn btn-secondary !px-8 text-base mt-4 rounded-sm text-white capitalize"
              href="{{ route('login') }}">
              Login
            </a>
            <a class="btn btn-secondary btn-outline !px-8 text-base mt-4 rounded-sm text-white capitalize"
              href="{{ route('login') }}">
              Register
            </a>
          </div>
        </div>
        <div class="hidden lg:block">
          <div class="grid grid-rows-2 gap-6 grid-cols-2">
            <img class="rounded-sm h-52 w-full object-cover select-none" src="{{ asset('img/home/2.jpg') }}"
              alt="">
            <img class="rounded-sm h-full w-full object-cover row-span-2 select-none" src="{{ asset('img/home/1.jpg') }}"
              alt="">
            <img class="rounded-sm h-52 w-full object-cover select-none" src="{{ asset('img/home/3.jpg') }}"
              alt="">
          </div>
        </div>
      </div>
    </header>

    <div class="bg-secondary/5">
      <section class="container mx-auto px-4 py-12 max-w-[1024px]">
        <div>
          <p class="text-3xl font-bold tracking-wider text-center">STREETLIGHT MAPPING</p>
          <p class=" text-black/60 text-center mx-auto max-w-lg mt-2">
            Discover the geography of our streetlights. Explore the locations and distribution of streetlights across the
            area. Get insights into their positions and density for a well-lit and secure neighborhood.
          </p>
          <div class="mt-4">
            <label class="label" for="streetlight_group_id">
              <span class="label-text font-bold required">
                Streetlight Group
              </span>
            </label>
            <select class="w-full max-w-md select select-secondary select-bordered select-sm" id="streetlight_group_id"
              name="streetlight_group_id">
              <option value>-- Choose Group --</option>
            </select>
            @error('streetlight_group_id')
              <div class="text-error mt-1 text-sm">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mt-6 h-72 w-full" id="map"></div>
        </div>
      </section>
    </div>

    <section class="container mx-auto px-4 py-12 max-w-[1024px]">
      <div>
        <p class="text-3xl font-bold tracking-wider text-center">REPORT AN ISSUE</p>
        <p class=" text-black/60 text-center mx-auto max-w-lg mt-2">
          Help us improve our community by reporting streetlight-related issues. Whether it's a malfunctioning light,
          damaged infrastructure, or any concerns you've observed, share your findings with us. Your reports are crucial
          for maintaining a well-lit and safe environment.
        </p>
      </div>
    </section>
  @endsection

  @section('js')
    {{-- Select2 Group --}}
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

    {{-- Streetlight Group Mapping --}}
    <script>
      $(function() {
        /**
         * Base Map
         */
        var map = L.map('map').setView([0, 0], 16);
        var newIcon = L.icon({
          iconUrl: "{{ asset('leaflet/images/streetlight.png') }}",
          iconSize: [64, 64],
          iconAnchor: [32, 64],
          popupAnchor: [0, -32]
        });
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        /**
         * Current Location
         */
        var currentLocationMarker = null;
        map.locate({
          setView: true,
          maxZoom: 16
        });

        function onLocationFound(e) {
          var lat = e.latlng.lat;
          var long = e.latlng.lng;
          if (currentLocationMarker) {
            currentLocationMarker.setLatLng(e.latlng).addTo(map)
              .bindPopup("You are here").openPopup();
          } else {
            currentLocationMarker = L.marker(e.latlng).addTo(map)
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

        /**
         * Handle Group Changes
         */
        var streetlightMarkers = [];
        var streetlightLine = null;
        var res = [];
        var latLngs = [];
        $('#streetlight_group_id').on('change', function() {
          var value = $('#streetlight_group_id').val()
          streetlightMarkers.forEach(function(marker) {
            map.removeLayer(marker);
          });
          streetlightMarkers = [];
          latLngs = [];
          if (streetlightLine) {
            map.removeLayer(streetlightLine);
          }
          $.ajax({
            url: "{{ route('home.get_streetlights') }}",
            type: 'GET',
            dataType: 'json',
            data: {
              streetlight_group_id: value
            },
            success: function(data) {
              res = data
              console.log(res);
              if (res.length == 0) {
                Swal.fire({
                  toast: true,
                  icon: 'info',
                  text: 'Tidak ada lampu jalan pada grup ini!',
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                })
              }
              var middle = Math.floor(res.length / 2);
              res.forEach(function(item, i) {
                var lat = item.lat;
                var long = item.long;
                if (i === middle) {
                  map.setView([lat, long], 16)
                }
                var marker = L.marker([lat, long], {
                    icon: newIcon
                  }).addTo(map)
                  .bindPopup(
                    `a`
                  );
                streetlightMarkers.push(marker);
                latLngs.push([lat, long]);
              });
              streetlightLine = L.polyline(latLngs, {
                color: 'red'
              }).addTo(map);
            },
            error: function(xhr, status, error) {
              console.error(error);
            }
          });
        })
      })
    </script>

    {{-- Streetlight Mapping for Issue Reporting --}}
  @endsection
</x-layout.app>
