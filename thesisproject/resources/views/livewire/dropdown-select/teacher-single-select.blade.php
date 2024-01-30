<div>
    <div class="relative">
        <input
            type="search"
            class="input input-bordered input-accent w-full"
            placeholder="{{__('general.search')}}..."
            wire:model.live="query"
            wire:ignore
        />
        <span wire:loading class="flex absolute right-0 loading loading-spinner loading-md mt-3 me-[13px]">
        </span>

        @if(!empty($query))
            <div
                class="absolute z-10 list-group w-full rounded-t-none shadow-lg">
                <div class="block">
                    <div class="absolute z-40 left-0 mt-2 w-full">
                        <div class="py-1 text-sm rounded shadow-lg border input-bordered input-accent bg-base-300">
                            @if(!empty($data))
                                @foreach($data as $i => $item)
                                    <a wire:click="addSelectedItem({{$item['id']}})"
                                       class="block py-1 px-5 cursor-pointer hover:bg-accent hover:text-black font-semibold">{{$item['neptun']}}
                                        - {{$item['name']}}</a>
                                @endforeach
                            @else
                                <span
                                    class="block py-1 px-5 hover:bg-accent hover:text-black font-semibold">{{__('general.noResult')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- selections -->
    @if(!empty($selected_items))
        @foreach($selected_items as $selected_item)
            <div class="inline-flex items-center text-sm rounded mt-2 mr-1 badge badge-success py-4 px-2">
                <span
                    class="ml-2 mr-1 leading-relaxed truncate max-w-xs">{{$selected_item['neptun']}} - {{$selected_item['name']}}</span>
                <button wire:click="removeSelectedItem({{$selected_item['id']}})" type="button"
                        class="w-6 h-8 inline-block align-middle text-gray-500 hover:text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                              d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z"/>
                    </svg>
                </button>
            </div>
        @endforeach
    @endif
</div>
