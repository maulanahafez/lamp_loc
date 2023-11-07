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
        <div class="mt-6 flex flex-col lg:flex-row gap-6">
          <div class="order-last lg:order-first basis-auto grow">
            <div class="border border-black/20 rounded-sm shadow-sm border-t-2 border-t-secondary">
              <div class="px-4 py-2 border border-b/20">Report an Issue</div>
              <div class="card">
                <div class="card-body pt-2 pb-6 px-4">
                  <form id="form" method="post" action="{{ route('home.report_issue') }}">
                    @csrf
                    <div>
                      <label class="label" for="streetlight_id">
                        <span class="label-text font-bold required">
                          Streetlight
                        </span>
                      </label>
                      <select class="w-full select select-secondary select-bordered select-sm" id="streetlight_id"
                        name="streetlight_id">
                        <option value>-- Choose Streetlight --</option>
                      </select>
                      <p class="text-sm text-black/60 mt-1">You can manually select streetlight or scan QR codes to do so.
                      </p>
                      @error('streetlight_id')
                        <div class="text-error mt-1 text-sm">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="mt-2">
                      <label class="label">
                        <span class="label-text font-bold required">
                          Category
                        </span>
                      </label>
                      <div class="space-y-1">
                        <label class="flex items-center gap-x-2 cursor-pointer">
                          <input class="radio radio-sm checked:bg-secondary" name="category" type="radio"
                            value="Rusak" />
                          <span class="badge badge-primary">Rusak</span>
                        </label>
                        <label class="flex items-center gap-x-2 cursor-pointer">
                          <input class="radio radio-sm checked:bg-secondary" name="category" type="radio"
                            value="Mati" />
                          <span class="badge badge-secondary">Mati</span>
                        </label>
                        <label class="flex items-center gap-x-2 cursor-pointer">
                          <input class="radio radio-sm checked:bg-secondary" name="category" type="radio"
                            value="Kerusakan Tiang" />
                          <span class="badge badge-warning">Kerusakan Tiang</span>
                        </label>
                        <label class="flex items-center gap-x-2 cursor-pointer">
                          <input class="radio radio-sm checked:bg-secondary" name="category" type="radio"
                            value="Gangguan Listrik" />
                          <span class="badge badge-error">Gangguan Listrik</span>
                        </label>
                      </div>
                      @error('category')
                        <div class="text-sm text-error mt-1">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="mt-2">
                      <label class="label" for="desc">
                        <span class="label-text font-bold required">
                          Description
                        </span>
                      </label>
                      <div class="max-w-2xl border-t border-secondary rounded-sm">
                        <div id="quill_desc" style="height: 250px;">
                          {!! old('desc') !!}
                        </div>
                        <textarea class="w-full hidden" id="desc" name="desc"></textarea>
                      </div>
                      @error('desc')
                        <div class="text-sm text-error mt-1">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="mt-4 space-y-2 text-end">
                      <button class="btn btn-secondary rounded-sm btn-sm capitalize text-white" type="submit">
                        <i class="fa-solid fa-square-plus"></i>
                        Submit
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="lg:basis-[32rem] basis-full">
            <div class="border border-black/20 rounded-sm shadow-sm border-t-2 border-t-secondary">
              <div class="px-4 py-2 border border-b/20">Streetlight Location</div>
              <div class="card">
                <div class="card-body pt-0 pb-6 px-4">
                  <div class="mt-4 hidden" id="map-container">
                    <div class="h-60 w-full" id="map_issue"></div>
                  </div>
                  <div class="mt-4" id="reader">
                  </div>
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
                  <button class="hidden capitalize btn btn-sm text-sm rounded-sm btn-secondary" id="rescan"
                    type="button">
                    <i class="fa-solid fa-refresh"></i>
                    <span>Rescan</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
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
    <script>
      $(function() {
        var newIcon = L.icon({
          iconUrl: "{{ asset('leaflet/images/streetlight.png') }}",
          iconSize: [64, 64],
          iconAnchor: [32, 64],
          popupAnchor: [0, -32]
        });

        $('#streetlight_id').select2({
          ajax: {
            url: "{{ route('streetlight.get_streetlight') }}",
            dataType: 'json',
            delay: 250,
            minimumInputLength: 3,
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

        var marker = null;
        var latlng = null;
        var map_issue = L.map('map_issue').setView([0, 0], 16);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map_issue);

        function handleMap(lat, long) {
          $('#lat').val(lat);
          $('#long').val(long);
          $('#map-container').removeClass('hidden');
          latlng = [lat, long];
          map_issue = map_issue.setView(latlng, 16);
          map_issue.invalidateSize(true);
          if (marker) {
            map_issue.removeLayer(marker)
            marker = null;
          }
          marker = L.marker(latlng, {
            icon: newIcon
          }).addTo(map_issue);
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
          "reader", {
            fps: 10,
            qrbox: 250
          });

        function handleScanner() {
          $('#reader').toggleClass('hidden')
          $('#rescan').toggleClass('hidden')
        }

        function handleStreetlight(id) {
          try {
            $.ajax({
              url: "{{ route('streetlight.get_streetlight_scan') }}",
              method: "POST",
              data: {
                _token: '{{ csrf_token() }}',
                id,
              },
              success: function(res) {
                var option = new Option(res.data, id);
                $('#streetlight_id').append(option);
                $('#streetlight_id').val(id);
                let lat = res.streetlight.lat
                let long = res.streetlight.long
                handleMap(lat, long);
              },
              error: function(error) {
                console.error('Error: ' + JSON.stringify(error));
              }
            });
          } catch (error) {
            console.log(error);
          }
        }

        function onScanSuccess(decodedText, decodedResult) {
          let [type, id] = decodedText.split('-')
          handleScanner();
          handleStreetlight(id);
        }

        $('#rescan').on('click', function() {
          handleScanner();
        })

        $('#streetlight_id').on('change', function() {
          let id = $(this).val();
          handleStreetlight(id);
        })

        var quill_desc = new Quill('#quill_desc', {
          theme: 'snow',
          placeholder: 'Issue description goes here...',
          modules: {
            toolbar: {
              container: [
                ['bold', 'italic', 'underline', 'strike'],
                [{
                  'header': 1
                }, {
                  'header': 2
                }],
                ['link', 'image', 'video'],
                ['blockquote', 'code-block'],
                [{
                  'list': 'ordered'
                }, {
                  'list': 'bullet'
                }],
                [{
                  'indent': '-1'
                }, {
                  'indent': '+1'
                }],
                ['clean'],
              ],
            }
          }
        });

        $('#form').on('submit', function(e) {
          var desc_content = quill_desc.root.innerHTML;
          if (desc_content == "<p><br></p>") {
            $('#desc').val("");
          } else {
            $('#desc').val(desc_content);
          }
        })

        html5QrcodeScanner.render(onScanSuccess);
      })
    </script>
  @endsection
</x-layout.app>
