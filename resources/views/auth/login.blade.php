<x-layout.auth>
  @section('content')
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-center h-screen">
        <div
          class="card basis-60 shadow-md grow max-w-sm mx-auto bg-white border-t-2 border-secondary-focus rounded-md border-x border-b border-x-black/10 border-b-black/10">
          <div class="card-body py-6">
            <div>
              <div>
                <div class="bg-cover bg-center py-8 rounded-sm text-center"
                  style="background-image: url('{{ asset('img/streetlight.jpg') }}')">
                  <p class="text-2xl text-white font-bold tracking-widest">Lamp Loc</p>
                  <p class="text-sm text-white/60 font-normal">Streetlamp Locator</p>
                </div>
                <div class="text-start mt-4">
                  <p class="font-semibold text-xl">Login <i class="fa-regular fa-lightbulb"></i></p>
                  <p class="text-sm text-black/60 font-normal">Welcome, please sign in to your account!</p>
                </div>
              </div>
            </div>
            <div>
              <form action="{{ route('auth.login') }}" method="post">
                @csrf
                <div>
                  <label class="label" for="email">
                    <span class="label-text text-xs">
                      Email
                    </span>
                  </label>
                  <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="email"
                    placeholder="Email" type="email" name="email" value="{{ old('email') }}">
                  @error('email')
                    <div class="text-error text-xs mt-1">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mt-2">
                  <label class="label" for="password">
                    <span class="label-text text-xs">
                      Password
                    </span>
                  </label>
                  <input class="input input-sm input-bordered rounded-sm input-secondary w-full" id="password"
                    placeholder="Password" type="password" name="password">
                  @error('password')
                    <div class="text-error text-xs mt-1">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mt-4 space-y-2">
                  <button class="btn btn-secondary w-full rounded-sm btn-sm capitalize text-white"
                    type="submit">Login</button>
                  <a class="btn btn-neutral w-full rounded-sm btn-sm capitalize text-white" href="/">Back</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection

  @section('js')
    <script></script>
  @endsection
</x-layout.auth>
