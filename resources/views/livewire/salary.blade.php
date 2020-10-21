<div>
    <div class="flex items-center justify-center mx-auto ">
        <div class="mt-3 mx-auto md:col-span-5" style="width: 70%">
            <div class="bg-white p-2 w-full block">
                <div class="flex items-center">
                    <input wire:model="search" class="font-normal text-xs appearance-none block w-full bg-white text-gray-700 py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="მოძებნე თანამშრომლის სახელით ან გვარით..">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                  </svg>
                </div>
               
            </div>
            @if ($salaries)
                @foreach ($salaries as $item)
                <div class="bg-white p-3 w-full block mt-2 grid grid-cols-12">
                    <div class="col-span-3">
                        <small class="font-normal text-xs">თანამშრომლი</small>
                        <h6 class="font-bolder text-xs text-gray-700">{{$item->first_name .' '. $item->last_name}}</h6>
                    </div>
                    <div class="col-span-2">
                        <small class="font-normal text-xs">ხელფასი</small>
                        <h6 class="font-bolder text-xs text-gray-700">{{number_format($item->salary/100 ,2)}} <sup>₾</sup> </h6>
                    </div>
                    <div class="col-span-2">
                        <small class="font-normal text-xs">გამომუშავებული</small>
                        <h6 class="font-bolder text-xs text-gray-700"> {{number_format($item->made_salary/100, 2)}} <sup>₾</sup> </h6>
                    </div>
                    <div class="col-span-2">
                        <small class="font-normal text-xs">ბონუსი</small>
                        <h6 class="font-bolder text-xs text-gray-700">{{number_format($item->bonus/100 ,2)}} <sup>₾</sup> </h6>
                    </div>
                    <div class="col-span-2">
                        <small class="font-normal text-xs">ტიპი</small>
                        <h6 class="font-bold text-xs text-gray-700">
                            @if ($item->type == 'salary')
                            სტანდარტული ხელფასი
                            @elseif ($item->type == 'avansi')
                            ავანსი
                            @elseif ($item->type == 'other')
                            სხვა თანხა
                            @endif
                        </h6>
                    </div>
                    <div class="col-span-1">
                        <small class="font-normal text-xs">თარიღი</small>
                        <h6 class="font-bolder text-xs text-gray-700">{{Carbon\Carbon::parse($item->created_at)->isoFormat('Y-MM-DD')}}</h6>
                    </div>
                    <div class="col-span-12 mt-1">
                        <p>{{$item->description}}</p>
                    </div>
                </div>
                @endforeach
                <div class="w-full">
                    {{$salaries->links()}}
                </div>
            @endif
        </div>
    </div>
</div>