<x-layout.main>
  @section('content')
    @if ($group)
      <div class="w-full h-80" id="map"></div>
    @endif
    <div class="mt-4 flex flex-wrap gap-2">
      <a class="btn btn-sm btn-primary rounded-sm capitalize" href="{{ route('streetlight_group.create') }}">
        <i class="fa-solid fa-plus"></i>
        Add Group
      </a>
      @if ($group)
        <form action="{{ route('streetlight_group.clear_session') }}" method="post">
          @csrf
          <button class="btn btn-sm btn-outline rounded-sm capitalize" type="submit"
            href="{{ route('streetlight_group.create') }}">
            <i class="fa-solid fa-eraser"></i>
            Clear Session
          </button>
        </form>
      @endif
    </div>
    <div class="mt-2 overflow-x-auto no-scrollbar">
      <table class="table rounded-sm" id="table">
        <thead>
          <tr>
            <th class="max-w-[5%] w-[5%]">No</th>
            <th class="max-w-[5%] w-[5%]">Code</th>
            <th>Street</th>
            <th class="max-w-[5%] w-[5%]">Action</th>
          </tr>
        </thead>
      </table>
    </div>
  @endsection

  @section('js')
    <script>
      // Lihat Group
      $(document).on('click', '.lihat', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
          url: `{{ route('streetlight_group.set_session') }}`,
          method: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            group_id: id,
          },
          success: function(res) {
            if (res) {
              location.reload()
            } else {
              Swal.fire({
                toast: true,
                icon: 'error',
                text: 'Gagal memproses permintaan Anda, coba beberapa saat lagi!',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
              })
            }
          },
        })
      })

      // Lihat Satuan
      $(document).on('click', '.streetlight', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
          url: `{{ route('streetlight.set_session') }}`,
          method: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            streetlight_id: id,
          },
          success: function(res) {
            if (res) {
              window.location.href = "{{ route('streetlight.index') }}";
            } else {
              Swal.fire({
                toast: true,
                icon: 'error',
                text: 'Gagal memproses permintaan Anda, coba beberapa saat lagi!',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
              })
            }
          },
        })
      })

      $(function() {
        $('#table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('streetlight_group.data') }}",
          columns: [{
              data: 'DT_RowIndex',
              orderable: false,
              searchable: false
            },
            {
              data: 'code',
            },
            {
              data: 'street',
            },
            {
              data: 'action',
              orderable: false,
              searchable: false
            },
          ]
        })
      })
    </script>
    <script>
      @if ($group)
        $(function() {
          var map = L.map('map').setView([-7.453111, 109.296101], 14);
          L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
          }).addTo(map);

          var res = [];
          var latLngs = [];

          $.ajax({
            url: "{{ route('streetlight_group.get_streetlights') }}",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              res = data
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
                    `<a class="btn btn-link btn-xs streetlight" data-id="${item.id}" href="/">{{ $group->code }} - ${item.name}</a>`
                  );
                latLngs.push([lat, long]);
              });
              var line = L.polyline(latLngs, {
                color: 'red'
              }).addTo(map);
            },
            error: function(xhr, status, error) {
              console.error(error);
            }
          });
        })
      @endif
    </script>
  @endsection
</x-layout.main>
