<div class="flex shadow-xs rounded-base -space-x-0.5">
    <button id="dropdown-button" data-dropdown-toggle="dropdown" type="button" class="inline-flex items-center shrink-0 z-10 text-body bg-gray-100 box-border border border-default-medium hover:bg-yellow-500 hover:text-white focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-s-base text-sm px-4 py-2.5 focus:outline-none">
        <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.143 4H4.857A.857.857 0 0 0 4 4.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 10 9.143V4.857A.857.857 0 0 0 9.143 4Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 20 9.143V4.857A.857.857 0 0 0 19.143 4Zm-10 10H4.857a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286A.857.857 0 0 0 9.143 14Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286a.857.857 0 0 0-.857-.857Z"/></svg>
        Categories
        <svg class="w-4 h-4 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/></svg>
    </button>
    <div id="dropdown" class="z-10 hidden bg-white border border-default-medium rounded-base shadow-lg w-44">
        <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdown-button">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="block p-2 hover:bg-yellow-300 hover:text-heading rounded-md">
                        {{ $category->name }}
                </a>
            @endforeach
        </ul>
    </div>
    <input type="text" wire:model="name" autocomplete="off" data-modal-target="default-modal" data-modal-toggle="default-modal" id="search-dropdown" id="input-group-1" class="px-3 py-2.5 bg-white border border-gray-300 text-heading text-sm focus:ring-gray-400 focus:border-gray-400 block w-full placeholder:text-body" placeholder="Recherche de produits">
    <button data-modal-target="default-modal" data-modal-toggle="default-modal" type="button" class="inline-flex items-center  text-white bg-yellow-500 hover:bg-yellow-600 box-border border border-transparent focus:ring-4 focus:ring-yellow-100 shadow-xs font-medium leading-5 rounded-e-base text-sm px-4 py-2.5 focus:outline-none">
    <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
        Recherche
    </button>

    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white border border-default rounded-lg shadow-sm p-4 md:p-6">
                <!-- Modal header -->
                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                    <h3 class="text-lg font-medium text-heading">
                        Rechercher les produits
                    </h3>
                    <button type="button" class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="space-y-4 md:space-y-6 py-4 md:py-6">
                    <input wire:model.live.debounce.5000ms="search" type="text" class="rounded w-full" placeholder="Recherche de produits..." autocomplete="off">

                    <div>
                        @if (!empty($products))
                            @foreach ($products as $product)
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <div class="w-full flex flex-wrap bg-gray-200 hover:bg-gray-300 cursor-pointer my-2">
                                        @if ($product->primaryImage)
                                            <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}"
                                                alt="{{ $product->name }}"
                                                class="w-20 h-20 object-cover group-hover:scale-110 transition duration-300">
                                        @else
                                            <div class="flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-400">
                                                <span class="text-6xl text-gray-500">{{ substr($product->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <p class="p-2 m-2">
                                            {{ $product->name }} <br>
                                            <span class="text-xs">{{ $product->category->name }}</span>
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
