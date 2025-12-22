@if (session()->has('success'))
    <div
        class="rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-sm text-green-800 dark:border-green-700 dark:bg-green-900/30 dark:text-green-200">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('warning'))
    <div
        class="rounded-lg border border-yellow-300 bg-yellow-100 px-4 py-3 text-sm text-yellow-800 dark:border-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-200">
        {{ session('warning') }}
    </div>
@endif

@if (session()->has('error'))
    <div
        class="rounded-lg border border-red-300 bg-red-100 px-4 py-3 text-sm text-red-800 dark:border-red-700 dark:bg-red-900/30 dark:text-red-200">
        {{ session('error') }}
    </div>
@endif
