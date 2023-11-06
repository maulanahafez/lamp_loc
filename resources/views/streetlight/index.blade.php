<x-layout.main>
  @section('content')
    @if ($streetlight)
      <form class="join justify-center w-full" action="{{ route('streetlight.clear_session') }}" method="post">
        @csrf
        <button class="join-item btn btn-sm btn-outline btn-neutral rounded-sm capitalize" type="submit"
          href="{{ route('streetlight.create') }}">
          <i class="fa-solid fa-eraser"></i>
        </button>
        <button class="join-item btn btn-sm btn-outline btn-neutral rounded-sm capitalize" id="toggle" type="button">
          <i class="fa-solid fa-eye-slash" id="icon"></i>
        </button>
      </form>
      <div class="mt-4 grid grid-cols-1 lg:grid-cols-2 gap-6" id="info">
        <div class="w-full h-72 shadow-sm" id="map"></div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <x-streetlight.images :streetlight="$streetlight" />
          <x-streetlight.streetlight :streetlight="$streetlight" />
        </div>
      </div>
    @endif
    <div class="mt-4">
      <a class="btn btn-sm btn-primary rounded-sm capitalize" href="{{ route('streetlight.create') }}">
        <i class="fa-solid fa-plus"></i>
        Add Streetlight
      </a>
    </div>
    <div class="mt-2 overflow-x-auto no-scrollbar">
      <table class="table rounded-sm" id="table">
        <thead>
          <tr>
            <th class="max-w-[5%] w-[5%]">No</th>
            <th>Group ID - Name</th>
            <th>Type</th>
            <th>Model</th>
            <th>Status</th>
            <th>Rate</th>
            <th class="max-w-[5%] w-[5%]">Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <template>
      <div></div>
    </template>
  @endsection

  @section('js')
    <script>
      $(document).on('click', '.lihat', function(e) {
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

      $(function() {
        // Datatable
        $('#table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('streetlight.data') }}",
          columns: [{
              data: 'DT_RowIndex',
              orderable: false,
              searchable: false
            },
            {
              data: 'group_name',
            },
            {
              data: 'type',
            },
            {
              data: 'model',
            },
            {
              data: 'status',
            },
            {
              data: 'rate',
            },
            {
              data: 'action',
              orderable: false,
              searchable: false
            },
          ]
        })

        // Toggle icon
        $('#toggle').on('click', function() {
          $('#info').fadeToggle();
          if ($('#icon').hasClass('fa-eye')) {
            $('#icon').removeClass('fa-eye').addClass('fa-eye-slash');
          } else {
            $('#icon').removeClass('fa-eye-slash').addClass('fa-eye');
          }
        })

        // Delete
        $(document).on('click', '.delete', function(e) {
          e.preventDefault();
          var id = $(this).data('id');
          var url = $(this).attr('href');
          Swal.fire({
            title: 'Delete Confirmation',
            text: 'Are you sure want to delete this data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                type: "DELETE",
                url: url,
                data: {
                  _token: '{{ csrf_token() }}',
                },
                success: function(res) {
                  location.reload();
                },
              });
            }
          })
        })
      })
    </script>
    <script>
      @if ($streetlight)
        var latlng = [{{ $streetlight->lat }}, {{ $streetlight->long }}];
        console.log(latlng);
        var map = L.map('map').setView(latlng, 16);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker(latlng, {
          icon: newIcon
        }).addTo(map);
      @endif
    </script>
  @endsection
</x-layout.main>
