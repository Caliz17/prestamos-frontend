<x-guest-layout>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
         class="mx-auto h-10 w-auto" alt="Logo" />

    <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-white">
      Inicia sesión en tu cuenta
    </h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

    @if ($errors->any())
      <p class="text-red-400 text-sm mb-4">
        {{ $errors->first() }}
      </p>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-100">Email</label>
        <div class="mt-2">
          <input id="email" type="email" name="email" required
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-white
                   outline-1 outline-white/10 focus:outline-indigo-500" />
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-100">Password</label>
        <div class="mt-2">
          <input id="password" type="password" name="password" required
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-white
                   outline-1 outline-white/10 focus:outline-indigo-500" />
        </div>
      </div>

      <button type="submit"
        class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm font-semibold text-white hover:bg-indigo-400">
        Iniciar sesión
      </button>
    </form>

    <p class="mt-10 text-center text-sm text-gray-400">
      ¿No tienes cuenta?
      <a href="{{ route('register') }}" class="font-semibold text-indigo-400 hover:text-indigo-300">Regístrate</a>
    </p>
  </div>
</div>

</x-guest-layout>
