<x-layout.main>
  @section('content')
    <div class="mt-4 flex flex-wrap gap-2">
      <a class="btn btn-sm btn-primary rounded-sm capitalize" href="{{ route('report.create') }}">
        <i class="fa-solid fa-plus"></i>
        Add Report
      </a>
    </div>
    <div class="mt-2 overflow-x-auto no-scrollbar">
      <table class="table rounded-sm" id="table">
        <thead>
          <tr>
            <th class="max-w-[5%] w-[5%]">No</th>
            <th>Streetlight <span class="text-xs">(Name - Code - Street)</span></th>
            <th>Category</th>
            <th>Status</th>
            <th class="max-w-[5%] w-[5%]">Action</th>
          </tr>
        </thead>
      </table>
    </div>
  @endsection

  @section('js')
    <script>
      $(function() {
        // Datatable
        $('#table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('report.data') }}",
          columns: [{
              data: 'DT_RowIndex',
              orderable: false,
              searchable: false
            },
            {
              data: 'streetlight_detail',
            },
            {
              data: 'category',
            },
            {
              data: 'status',
            },
            {
              data: 'action',
              orderable: false,
              searchable: false
            },
          ]
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
  @endsection
</x-layout.main>
