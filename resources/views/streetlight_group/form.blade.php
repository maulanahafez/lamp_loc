<x-layout.main>
  @section('content')
    <div class="grid grid-cols-1 md:grid-cols-2">
      <div class="">
        <div class="border border-black/20 rounded-sm shadow-sm border-t-2 border-t-secondary">
          <div class="px-4 py-2 border border-b/20">{{ $button }} Streetlight Group</div>
          <div class="card">
            <div class="card-body pt-2 pb-6 px-4">
              <form action="{{ $action }}" method="POST">
                @csrf
                @if ($button == 'Edit')
                  @method('PUT')
                @endif
                <div>
                  <label class="label" for="code">
                    <span class="label-text font-bold">
                      Code
                    </span>
                  </label>
                  <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="code"
                    placeholder="Code" type="text" name="code"
                    value="{{ old('code', $button == 'Edit' ? $data->code : null) }}">
                  @error('code')
                    <div class="text-error mt-1 text-sm">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div>
                  <label class="label" for="street">
                    <span class="label-text font-bold">
                      Street
                    </span>
                  </label>
                  <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="street"
                    placeholder="Street" type="text" name="street"
                    value="{{ old('street', $button == 'Edit' ? $data->street : null) }}">
                  @error('street')
                    <div class="text-error mt-1 text-sm">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mt-4 space-y-2 text-end">
                  <a class="btn btn-neutral rounded-sm btn-sm capitalize text-white"
                    href="{{ route('streetlight_group.index') }}">
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
    </div>
  @endsection

  @section('js')
    <script>
      $(function() {
        $("[name='code']").on('input', function() {
          $(this).val($(this).val().toUpperCase())
        })
      })
    </script>
  @endsection
</x-layout.main>
