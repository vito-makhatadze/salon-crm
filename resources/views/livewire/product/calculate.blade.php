<div>
    <div x-data="{modal:false}">
        <span @click="modal = true" class="bg-gray-200 p-2 cursor-pointer rounded mr-2 block">
            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-calculator-fill" fill="#444" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z"/>
              </svg>
        </span>
        <x-modal x-show="modal">
            <div class="grid grid-cols-1 md:grid-cols-3 mb-2">
                <div class="col-span-1 px-3 mb-6 md:mb-0  flex items-center justify-center">
                  <div>
                    <small class="text-xs font-normal">@lang('product.left')</small>
                    <h6 class="font-bold text-xs">
                      {{$product->stock}}
                      @if ($product->unit == "gram")
                      @lang('product.gram')
                      @elseif ($product->unit == "metre")
                      @lang('product.centimeter')
                      @elseif ($product->unit == "unit")
                      @lang('product.unit')
                      @endif
                    </h6>
                  </div>
                  
                </div>
                <div class="col-span-1 px-3 mb-6 md:mb-0 flex items-center justify-center">
                  <div>
                    <input class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="amout" type="number" min="1" step="1" max="{{$product->stock}}" value="1">
                    <p class="w-full block font-normal @if($product->stock - ($amout ? intval($amout) : 1) < 0) text-red-500 @endif" style="font-size: 0.7rem">
                        {{$message}}
                    </p>
                  </div>
                </div>
                <div class="col-span-1 font-normal text-xs px-3 mb-6 md:mb-0  flex items-center justify-center">
                    @if ($product->unit == "gram")
                    @lang('product.gram')
                    @elseif ($product->unit == "metre")
                    @lang('product.metre')
                    @elseif ($product->unit == "unit")
                    @lang('product.unit')
                    @endif = <span class="font-bold ml-1 text-sm">
                                {{($amout ? intval($amout) : 1) * $product->price/100}}
                            </span> <sup class="ml-1"> @lang('money.icon')</sup>
                  </div>
              </div>
              <button wire:click="addproductinventory()" class="w-full mb-3 py-2 px-4 bg-indigo-500 font-normal text-xs text-white">
                @lang('product.inventorisation')
              </button>
              @if ($error)    
              <p class="w-full py-2 text-center text-red-400 text-xs font-normal">
                {{$error}}
              </p>
              @endif
              @forelse ($inventories as $item)
              <div class="w-full bg-gray-200 mb-2 p-3 relative">
                @if ($item->status == 0)
                <span wire:click="deleteinventory({{$item->id}})"class="absolute top-0 right-0 -mr-1 -mt-1 bg-gray-300 cursor-pointer p-1 shadow rounded-md">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="#f54747" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                    <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                  </svg>
                </span>
                
                <span  wire:click="approveinventory({{$item->id}})"  class="absolute top-0 right-0 mt-6 -mr-1 bg-gray-300 cursor-pointer p-1 shadow rounded-md">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="#5cb876" stroke="#5cb876" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                  </svg>
                </span>
                @endif
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="font-bolder text-sm">{{$item->real}}</h3>
                    <h6 class="font-normal" style="font-size: 0.7rem">@lang('product.updatedamout')</h6>
                  </div>
                  <div>
                    <h3 class="font-bolder text-sm">{{$item->old}}</h3>
                    <h6 class="font-normal" style="font-size: 0.7rem">@lang('product.oldamout')</h6>
                  </div>
                  <div>
                    <h3 class="font-bolder text-sm">{{Carbon\Carbon::parse($item->created_at)->isoFormat('DD-MM-Y')}}</h3>
                    <h6 class="font-normal" style="font-size: 0.7rem">@lang('product.date')</h6>
                  </div>
                </div>
              </div>
              @empty
                  <p class="text-xs font-normal text-center w-full">@lang('product.notstarted')</p>
              @endforelse


        </x-modal>
    </div>
</div>
