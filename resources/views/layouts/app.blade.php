<!doctype html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name') }}</title>
  @vite('resources/css/app.css')
</head>
<body class="h-full">
  <div id="app" class="min-h-full">
    <nav class="border-b border-gray-200 bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
          <div class="flex">
            <div class="flex flex-shrink-0 items-center">
              <img class="block h-8 w-auto lg:hidden" src="/images/mark.svg" alt="Your Company">
              <img class="hidden h-8 w-auto lg:block" src="/images/mark.svg" alt="Your Company">
            </div>
            <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
              <!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
              @foreach ($mainMenu as $item)
                @if ($item['active'])
                  <a href="{{ $item['url'] }}"
                     class="border-indigo-500 text-gray-900 inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium"
                     aria-current="page"
                  >
                    {{ $item['title'] }}
                  </a>
                @else
                  <a href="{{ $item['url'] }}"
                     class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium"
                  >
                    {{ $item['title'] }}
                  </a>
                @endif
              @endforeach
            </div>
          </div>
          <div class="-mr-2 flex items-center sm:hidden">
            <!-- Mobile menu button -->
            <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" aria-controls="mobile-menu" aria-expanded="false">
              <span class="absolute -inset-0.5"></span>
              <span class="sr-only">Open main menu</span>
              <!-- Menu open: "hidden", Menu closed: "block" -->
              <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
              <!-- Menu open: "block", Menu closed: "hidden" -->
              <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <div class="sm:hidden" id="mobile-menu">
        <div class="space-y-1 pb-3 pt-2">
          @foreach ($mainMenu as $item)
            @if ($item['active'])
              <a href="{{ $item['url'] }}"
                 class="border-indigo-500 bg-indigo-50 text-indigo-700 block border-l-4 py-2 pl-3 pr-4 text-base font-medium"
                 aria-current="page"
              >
                {{ $item['title'] }}
              </a>
            @else
              <a href="{{ $item['url'] }}"
                 class="border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800 block border-l-4 py-2 pl-3 pr-4 text-base font-medium"
              >
                {{ $item['title'] }}
              </a>
            @endif
          @endforeach
        </div>
      </div>
    </nav>

    <div class="py-6">
      <header class="md:flex md:items-center md:justify-between mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="min-w-0 flex-1">
          <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            @yield('heading', 'Home')
          </h2>
        </div>
        @if (isset($button))
          <div class="mt-4 flex md:ml-4 md:mt-0">
            <primary-button href="{{ $button['url'] }}">
              {{ $button['label'] }}
            </primary-button>
          </div>
        @endif
      </header>

      <main class="mt-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
          @yield('page')
        </div>
      </main>
    </div>
  </div>
  @vite('resources/js/app.js')
</body>
</html>
