<x-layout.main>
  @section('content')
    <div class="flex flex-col lg:flex-row gap-6">
      <div class="basis-auto grow">
        <div class="border border-black/20 rounded-sm shadow-sm border-t-2 border-t-secondary">
          <div class="px-4 py-2 border border-b/20">Add New Streetlight</div>
          <div class="card">
            <div class="card-body pt-2 pb-6 px-4">
              <form action="{{ route('streetlight.store') }}" method="POST">
                @csrf
                <div>
                  <label class="label" for="name">
                    <span class="label-text font-bold">
                      Name
                    </span>
                  </label>
                  <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="name"
                    placeholder="Name" type="text" name="name" value="{{ old('name') }}">
                  @error('name')
                    <div class="text-error mt-1">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mt-2 grid lg:grid-cols-2 md:grid-cols-1 gap-4">
                  <div>
                    <label class="label" for="type">
                      <span class="label-text font-bold">
                        Type
                      </span>
                    </label>
                    <div class="space-y-1">
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="type" type="radio" value="LED" />
                        <span>LED</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="type" type="radio"
                          value="Tungsten" />
                        <span>Tungsten</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="type" type="radio"
                          value="Fluorescent" />
                        <span>Fluorescent</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="type" type="radio"
                          value="Halogen" />
                        <span>Halogen</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="type" type="radio"
                          value="Sodium Vapor" />
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
                    <label class="label" for="type">
                      <span class="label-text font-bold">
                        Status
                      </span>
                    </label>
                    <div class="space-y-1">
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="status" type="radio" value="Aktif" />
                        <span class="badge badge-primary">Aktif</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="status" type="radio" value="Rusak" />
                        <span class="badge badge-secondary">Rusak</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="status" type="radio"
                          value="Dalam Pemeliharaan" />
                        <span class="badge badge-warning">Dalam Pemeliharaan</span>
                      </label>
                      <label class="flex items-center gap-x-2 cursor-pointer">
                        <input class="radio radio-sm checked:bg-secondary" name="status" type="radio" value="Mati" />
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
                      <option value="Classic">Classic</option>
                      <option value="Solar-Powered">Solar-Powered</option>
                      <option value="Modern LED">Modern LED</option>
                      <option value="Decorative">Decorative</option>
                      <option value="High-Pole">High-Pole</option>
                      <option value="Traditional Lamp">Traditional Lamp</option>
                      <option value="Smart">Smart</option>
                      <option value="Industrial High-Bay">Industrial High-Bay</option>
                      <option value="Vintage Lantern">Vintage Lantern</option>
                      <option value="Minimalist">Minimalist</option>
                    </select>
                    @error('model')
                      <div class="text-error mt-1">
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
                      placeholder="Height (m)" type="number" name="height" value="{{ old('height') }}">
                    @error('height')
                      <div class="text-error mt-1">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="mt-2 grid lg:grid-cols-3 md:grid-cols-1 gap-4">
                  <div class="mt-2">
                    <label class="label" for="power_rate">
                      <span class="label-text font-bold">
                        Power Rate
                      </span>
                    </label>
                    <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="power_rate"
                      placeholder="Power Rate (W)" type="number" name="power_rate" value="{{ old('power_rate') }}">
                    @error('power_rate')
                      <div class="text-error mt-1">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="mt-2">
                    <label class="label" for="voltage_rate">
                      <span class="label-text font-bold">
                        Voltage
                      </span>
                    </label>
                    <div class="join">
                      <input class="join-item input input-sm input-bordered rounded-sm input-secondary w-full"
                        id="voltage_rate_rate" placeholder="Voltage (V)" type="number" name="voltage_rate_rate"
                        value="{{ old('voltage_rate') }}">
                      <select class="join-item select rounded-sm select-bordered select-sm select-secondary"
                        id="voltage_rate_type" name="voltage_rate_type">
                        <option value="AC">AC</option>
                        <option value="DC">DC</option>
                      </select>
                    </div>
                    @error('voltage_rate_rate')
                      <div class="text-error mt-1">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="mt-2">
                    <label class="label" for="illumination_level">
                      <span class="label-text font-bold">
                        Illumination Level
                      </span>
                    </label>
                    <input class="input input-sm input-bordered rounded-sm input-secondary w-full"
                      id="illumination_level" placeholder="Illumination Level (lux)" type="number"
                      name="illumination_level" value="{{ old('illumination_level') }}">
                    @error('illumination_level')
                      <div class="text-error mt-1">
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
                    placeholder="Manufacturer" type="text" name="manufacturer" value="{{ old('manufacturer') }}">
                  @error('manufacturer')
                    <div class="text-error mt-1">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mt-4 space-y-2 text-end">
                  <a class="btn btn-neutral rounded-sm btn-sm capitalize text-white" href="/">
                    <i class="fa-solid fa-backward"></i>
                    Back
                  </a>
                  <button class="btn btn-secondary rounded-sm btn-sm capitalize text-white" type="submit">
                    <i class="fa-solid fa-square-plus"></i>
                    Create
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="lg:basis-[32rem] basis-full">
        <div class=" border border-black/20 rounded-sm shadow-sm border-t-2 border-t-primary">
          <div class="px-4 py-2 border border-b/20">Streetlight Coordinate</div>
          <div class="card">
            <div class="card-body">

            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection

  @section('js')
    <script>
      $(function() {
        $('#type').select2()
      })
    </script>
  @endsection
</x-layout.main>
