<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<x-backend.layouts.partials.head />

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <x-.backend.layouts.partials.aside />


        <div class="flex flex-col flex-1 w-full">

            <x-backend.layouts.partials.navbar />

            <main class="h-full overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
