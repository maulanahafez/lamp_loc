<x-layout.main>
  @section('content')
    <div class="flex flex-col lg:flex-row gap-6">
      <div class="order-last lg:order-first basis-auto grow">
        <div class="border border-black/20 rounded-sm shadow-sm border-t-2 border-t-secondary">
          <div class="px-4 py-2 border border-b/20">{{ $button }} Report</div>
          <div class="card">
            <div class="card-body pt-2 pb-6 px-4">
              <form id="form" method="post" action="{{ $action }}">
                @csrf
                @if ($button == 'Edit')
                  @method('PUT')
                @endif
                <div>
                  <label class="label" for="streetlight_id">
                    <span class="label-text font-bold required">
                      Streetlight
                    </span>
                  </label>
                  <select class="w-full select select-secondary select-bordered select-sm" id="streetlight_id"
                    @disabled($button == 'Edit') name="streetlight_id">
                    <option value>-- Choose Streetlight --</option>
                    @if ($button == 'Edit')
                      <option value="{{ $data->streetlight->id }}" selected>
                        {{ "{$data->streetlight->streetlight_group->code} - {$data->streetlight->streetlight_group->street} - {$data->streetlight->name}" }}
                      </option>
                    @endif
                  </select>
                  <p class="text-sm text-black/60 mt-1">You can manually select streetlight or scan QR codes to do so.</p>
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
                      <input class="radio radio-sm checked:bg-secondary" name="category" type="radio" value="Rusak"
                        @checked($button == 'Edit' && $data->category == 'Rusak') />
                      <span class="badge badge-primary">Rusak</span>
                    </label>
                    <label class="flex items-center gap-x-2 cursor-pointer">
                      <input class="radio radio-sm checked:bg-secondary" name="category" type="radio" value="Mati"
                        @checked($button == 'Edit' && $data->category == 'Mati') />
                      <span class="badge badge-secondary">Mati</span>
                    </label>
                    <label class="flex items-center gap-x-2 cursor-pointer">
                      <input class="radio radio-sm checked:bg-secondary" name="category" type="radio"
                        value="Kerusakan Tiang" @checked($button == 'Edit' && $data->category == 'Kerusakan Tiang') />
                      <span class="badge badge-warning">Kerusakan Tiang</span>
                    </label>
                    <label class="flex items-center gap-x-2 cursor-pointer">
                      <input class="radio radio-sm checked:bg-secondary" name="category" type="radio"
                        value="Gangguan Listrik" @checked($button == 'Edit' && $data->category == 'Gangguan Listrik') />
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
                      {!! old('desc', $button == 'Edit' ? $data->desc : null) !!}
                    </div>
                    <textarea class="w-full hidden" id="desc" name="desc"></textarea>
                  </div>
                  @error('desc')
                    <div class="text-sm text-error mt-1">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                @if ($button == 'Edit')
                  <div class="mt-2">
                    <label class="label">
                      <span class="label-text font-bold required">
                        Status
                      </span>
                    </label>
                    <div class="space-y-1">
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="status" type="radio"
                          value="In Progress" @checked($button == 'Edit' && $data->status == 'In Progress') />
                        <span class="badge badge-primary">In Progress</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="status" type="radio" value="Completed"
                          @checked($button == 'Edit' && $data->status == 'Completed') />
                        <span class="badge badge-secondary">Completed</span>
                      </label>
                    </div>
                    @error('status')
                      <div class="text-sm text-error mt-1">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="mt-2">
                    <label class="label" for="staff_notes">
                      <span class="label-text font-bold required">
                        Staff Notes
                      </span>
                    </label>
                    <div class="max-w-2xl border-t border-secondary rounded-sm">
                      <div id="quill_staff_notes" style="height: 250px;">
                        {!! old('staff_notes', $button == 'Edit' ? $data->staff_notes : null) !!}
                      </div>
                      <textarea class="w-full hidden" id="staff_notes" name="staff_notes"></textarea>
                    </div>
                    @error('staff_notes')
                      <div class="text-sm text-error mt-1">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                @endif
                <div class="mt-4 space-y-2 text-end">
                  <a class="btn btn-neutral rounded-sm btn-sm capitalize text-white" href="{{ route('report.index') }}">
                    <i class="fa-solid fa-backward"></i>
                    Back
                  </a>
                  <button class="btn btn-secondary rounded-sm btn-sm capitalize text-white" type="submit">
                    <i class="fa-solid fa-square-plus"></i>
                    {{ $button }}
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
                <div class="h-60 w-full" id="map"></div>
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
                  <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="lat" readonly
                    placeholder="Latitude" type="number" name="lat" value="{{ old('lat') }}">
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
                  <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="long" readonly
                    placeholder="Longitude" type="number" name="long" value="{{ old('long') }}">
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
  @endsection

  @section('js')
    <script>
      $(function() {
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
        var map = L.map('map').setView([0, 0], 16);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        function handleMap(lat, long) {
          $('#lat').val(lat);
          $('#long').val(long);
          $('#map-container').removeClass('hidden');
          latlng = [lat, long];
          map = map.setView(latlng, 16);
          map.invalidateSize(true);
          if (marker) {
            map.removeLayer(marker)
            marker = null;
          }
          marker = L.marker(latlng, {
            icon: newIcon
          }).addTo(map);
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

        @if ($button == 'Edit')
          handleMap({{ $data->streetlight->lat }}, {{ $data->streetlight->long }})
          $('#reader').toggleClass('hidden')
          quill_desc.enable(false);
          var quill_staff_notes = new Quill('#quill_staff_notes', {
            theme: 'snow',
            placeholder: 'Staff notes goes here...',
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
        @endif


        $('#form').on('submit', function(e) {
          var desc_content = quill_desc.root.innerHTML;
          if (desc_content == "<p><br></p>") {
            $('#desc').val("");
          } else {
            $('#desc').val(desc_content);
          }
          @if ($button == 'Edit')
            var staff_notes_content = quill_staff_notes.root.innerHTML;
            if (staff_notes_content == "<p><br></p>") {
              $('#staff_notes').val("");
            } else {
              $('#staff_notes').val(staff_notes_content);
            }
          @endif
        })

        html5QrcodeScanner.render(onScanSuccess);
      })
    </script>
  @endsection
</x-layout.main>
