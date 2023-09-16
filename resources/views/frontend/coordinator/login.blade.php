<x-frontend.coordinator.layouts.partials.head />
<div class="flex min-h-full flex-col items-center justify-center px-6 py-12 bg-gray-100 lg:px-8">
    <div class="bg-opacity-10  bg-cyan-100 text-center backdrop-blur-md rounded-2xl p-6 w-4/12 shadow-2xl">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="/">
                <img class="mx-auto h-28 w-auto" src="{{ asset('ui/frontend/images/uu-logo-clear.png') }}"
                    alt="uttara university logo">
            </a>
            <h2 class="mt-4 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"> Project Allocation &
                Management System (PAMS)</h2>
            <h3 class="mt-4 text-center text-xl font-semibold leading-9 tracking-tight text-gray-900">Coordinator Account
                Information</h3>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form method="POST" action="{{ route('coordinator.authenticate') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-left text-md font-medium leading-6 font-mono text-gray-900">Email
                        address</label>
                    <div class="mt-2">
                        <input id="email" name="email" placeholder="Enter email" type="email" value="{{ old('email') }}" autofocus
                            autocomplete="email" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-left text-md font-medium leading-6 font-mono text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot
                                password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" placeholder="Enter password"  type="password" autocomplete="current-password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        in</button>
                </div>
            </form>

        </div>
    </div>
</div>
