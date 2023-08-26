<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Supervisor Profile
        </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="" class="text-gray-900 dark:text-white">Supervisor
                        Profile</a>
                </li>
            </ol>
        </div>
        {{-- Info --}}
        <div class="px-2 py-2 mb-2">
            <div class="container mx-auto p-4 bg-white shadow-md rounded-lg">
                <div class="grid grid-cols-3">
                    <div class="grid col-span-1 justify-center items-center ">
                        <div class="mb-2 ">
                            <img src="https://pyxis.nymag.com/v1/imgs/7be/898/c22698a83a66c5a268116b0f311af72592-22-rm-bts-2.rvertical.w330.jpg"
                                alt="Profile Image" class=" w-36 h-36 rounded-full">
                            <div class="justify-center flex ">{{ $user->supervisor->designation }}</div>
                            <div class="justify-center flex ">{{ $user->department }}</div>
                        </div>
                    </div>
                    <div class="col-start-2 col-span-2">
                        <div class=" gap-4 mb-2">
                            <span class="text-gray-700 font-bold mb-2 col-span-1">Faculty ID:</span>
                            <span class="col-span-2">{{ $user->supervisor->faculty_id }}</span>
                        </div>
                        <div class=" gap-4 mb-2">
                            <span class="text-gray-700 font-bold mb-2 col-span-1">Name:</span>
                            <span class="col-span-2">{{ $user->first_name . ' ' . $user->last_name }}</span>
                        </div>
                        <div class=" gap-4 mb-2">
                            <span class="text-gray-700 font-bold mb-2 col-span-1">Email:</span>
                            <span class="col-span-2">{{ $user->email }}</span>
                        </div>
                        <div class=" gap-4 mb-2">
                            <span class="text-gray-700 font-bold mb-2 col-span-1">Contact:</span>
                            <span class="col-span-2">{{ $user->phone_number }}</span>
                        </div>
                        <div class="gap-4 mb-2">
                            <span class="text-gray-700 font-bold mb-2 col-span-1">Domain:</span>
                            @if (count($domains) == 0)
                                <span class="col-span-2 text-green-600">Not set yet</span>
                            @else
                                <span class="col-span-2">
                                    @foreach ($domains as $domain)
                                        {{ $domain->name }}
                                        @unless ($loop->last)
                                            ,
                                        @endunless
                                    @endforeach
                                </span>
                            @endif
                        </div>
                        <div class=" gap-4 mb-2">
                            <span class="text-gray-700 font-bold mb-2 col-span-1">Availability Status:</span>
                            <span class="col-span-2">
                                @if ($user->supervisor->availability == 1)
                                    Yes
                                @elseif ($user->supervisor->availability == 0)
                                    No
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mx-auto p-4 mt-2 bg-white shadow-md rounded-lg ">
                <h1 class="text-2xl font-semibold mb-4">Publications/Research</h1>
                <div class="border-t border-gray-300 px-3 pt-6 space-y-8">
                    <p class="font-semibold">Nasir Muhammad Munim, Tahmina Tabassum Treena, Mohammad Rakibul Islam and Mirza Muntasir Nishat, “Design and analysis of an ultra-high sensitive and tunable metal-insulator-metal waveguide-coupled octagonal ring resonator utilizing gold nanorods”, Sensing and Bio-Sensing Research, Volume 38, December 2022, 100529. [Scopus Q1 journal]</p> 
                    <hr class="my-4 border-gray-300">
                    <p class="font-semibold">Mohammad Rakibul Islam, Md Moinul Islam Khan, Fariha Mehjabin, Jubair Alam Chowdhury, Mohibul Islam, Ahmad Jarif Yeasir, Jannat Ara Mim, Tajuddin Ahmed Nahid, “Design of a dual spider-shaped surface plasmon resonance-based refractometric sensor with high amplitude sensitivity”, IET Optoelectronics, 15 November 2022. https://doi.org/10.1049/ote2.12084. [SCIE indexed, JCR Impact Factor: 1.691]</p>
                    <hr class="my-4 border-gray-300">
                    <p class="font-semibold">Mohammad Rakibul Islam, Md Moinul Islam Khan, Fariha Mehjabin, Jubair Alam Chowdhury, Mohibul Islam, Ahmad Jarif Yeasir, Jannat Ara Mim, Tajuddin Ahmed Nahid, “Design of a dual spider-shaped surface plasmon resonance-based refractometric sensor with high amplitude sensitivity”, IET Optoelectronics, 15 November 2022. https://doi.org/10.1049/ote2.12084. [SCIE indexed, JCR Impact Factor: 1.691]</p>
                </div>
            </div>

        </div>
    </div>
    </div>
</x-frontend.student.layouts.master>
