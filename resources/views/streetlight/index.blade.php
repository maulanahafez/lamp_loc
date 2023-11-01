<x-layout.main>
  @section('content')
    <div>
      <a class="btn btn-sm text-xs btn-primary rounded-sm" href="{{ route('streetlight.create') }}">
        <i class="fa-solid fa-plus"></i>
        Add Streetlight
      </a>
    </div>
    <div class="mt-4 overflow-x-auto no-scrollbar">
      <table class="table rounded-sm" id="table">
        <thead>
          <tr>
            <th class="max-w-[5%] w-[5%]">No</th>
            <th>Name</th>
            <th>Type</th>
            <th>Model</th>
            <th>Status</th>
            <th>Rate</th>
            <th class="max-w-[5%] w-[5%]">Action</th>
          </tr>
        </thead>
      </table>
    </div>
  @endsection

  @section('js')
    <script>
      $(function() {
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
              data: 'name',
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
      })
    </script>
  @endsection
</x-layout.main>
