@extends('theme.layout.layout')
@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
        <div class="intro-y box mt-5">
            <div class="relative flex items-center p-5">
                <div class="w-12 h-12 image-fit">
                  @if ($user->image()->first())
                  <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset('../storage/profile/'.$user->id.'/'.$user->image()->first()->name)}}">
                  @else
                  <img alt="" class="rounded-full" src="/no-avatar.png">
                  @endif
                </div>
                <div class="ml-4 mr-auto">
                <div class="font-bold text-sm "> {{$user->profile()->first()->first_name}} {{$user->profile()->first()->last_name}}</div>
                    <div class="text-gray-600 font-normal text-xs"> 
                        @if ($user->isUser())
                            სტილისტი
                        @endif
                    </div>
                </div>
            </div>
            <div class="p-5 border-t border-gray-200">
            <a class="flex items-center font-medium" @if($user->id != Auth::user()->id) href="/user/showprofile/{{$user->id}}" @else href="/" @endif> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity w-4 h-4 mr-2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> სამუშაო ცხრილი </a>
                <a class="flex items-center text-theme-1 mt-5 font-medium" href="/profile/accountsettings"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg> ანგარიშის დეტალები </a>
                @if($user->id == Auth::user()->id)
                <a class="flex items-center   mt-5 font-medium" href="/profile/changepassword"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock w-4 h-4 mr-2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> პაროლის შეცვლა </a>
              @endif
              </div>
            <div class="p-5 border-t border-gray-200">
              <div class="flex">
                  <div class="w-1/3 p-3">
                      <h6 class="font-bold font-caps text-base text-black">{{$user->getEarnedMoney()}} <sup>₾</sup></h6>
                      <span class="font-normal text-xs">შემოსული</span>
                  </div>
                  <div class="w-1/3 p-3">
                      <h6 class="font-bold font-caps text-base text-black">{{$user->ClientCount()}}</h6>
                      <span class="font-normal text-xs">კლიენი</span>
                  </div>
                  <div class="w-1/3 p-3">
                      <h6 class="font-bold font-caps text-base text-black"> {{$user->profile()->first()->salary}} <sup>₾</sup></h6>
                      <span class="font-normal text-xs">ხელფასი</span>
                  </div>
              </div>
            </div>
            <div class="p-5 border-t flex items-center justify-center">
                @if ($user->active)
                <div class="flex items-center justify-center h-full font-normal text-xs">
                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-check-circle-fill mr-2" fill="#5dc78c" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                      </svg>აქტიური
                    </div>
                    @if ($user->id == Auth::user()->id)
                    <a href="/profile/turn/0" class="button button--sm border text-gray-700 ml-auto font-bold font-caps text-xs">გათიშვა</a>
                    @endif
                @else
                <div class="flex items-center justify-center h-full font-normal text-xs">
                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi mr-2 bi-dash-circle-fill" fill="#ff6155" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path>
                      </svg>არა აქტიური
                    </div>
                    @if ($user->id == Auth::user()->id)
               <a href="/profile/turn/1" class="button button--sm border text-gray-700 ml-auto font-bold font-caps text-xs">ჩართვა</a>
               @endif     
                @endif
            </div>
        </div>
        <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
          <div class="intro-x flex items-center h-10">
              <h2 class="font-bolder font-caps text-gray-800 text-sm truncate mr-5">
                  ტრანსაქციები
              </h2>
          </div>
          <div class="mt-5">

            {{-- Transactions --}}
            @forelse ($user->transacrions() as $item)
            <div class="intro-x">
                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                    <div class="w-10 h-10 flex bg-gray-300 font-bolder items-center justify-center image-fit rounded-full overflow-hidden">
                        {{$item->percent}} <sub>%</sub>
                    </div>
                    <div class="ml-4 mr-auto">
                    <div class="font-medium">{{$item->getClientName()}}</div>
                        <div class="text-gray-600 text-xs">{{Carbon\Carbon::parse($item->created_at)->settings([
                            'toStringFormat' => 'jS \o\f F, Y',
                        ])}}</div>
                    </div>
                <div class="text-theme-9 font-normal">+{{round($item->service_price/100 * $item->percent/100, 2)}} <sup>₾</sup></div>
                </div>
            </div>
            @empty
                
            @endforelse
             
          </div>
      </div>
    </div>

    {{-- End of Profile --}}
    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <div class="intro-y p-4  lg:mt-1">
          
         
        <form class="w-5/12 box p-3 max-w-lg"  @if($user->id != auth::user()->id) action="{{route('UpdateUserProfile', $user->id)}}" @endif method="post">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-5">
              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                <label class="block font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  სახელი
                </label>
            <input name="first_name" value="{{$user->profile()->first()->first_name}}" class="font-normal appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text"  @if($user->id == Auth::user()->id) readonly="true" @endif >
              </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase font-caps tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  გვარი
                </label>
                <input name="last_name" value="{{$user->profile()->first()->last_name}}" class="font-normal appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Doe"  @if($user->id == Auth::user()->id) readonly="true" @endif>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-5">
              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                <label class="block font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  ხელფასი
                </label>
            <input name="user_salary" value="{{$user->profile()->first()->salary}}" class="font-normal appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text"  @if($user->id == Auth::user()->id) readonly="true" @endif >
            @error('user_salary')
            <span class="invalid-feedback" role="alert">
                <strong style="color: tomato">{{ $message }}</strong>
                
                </span>
            @enderror 
          </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase font-caps tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  პროცენტი
                </label>
                <input name="user_percent" value="{{$user->profile()->first()->percent}}" class="font-normal appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Doe"  @if($user->id == Auth::user()->id) readonly="true" @endif>
                @error('user_percent')
                <span class="invalid-feedback" role="alert">
                    <strong style="color: tomato">{{ $message }}</strong>
                    
                    </span>
                @enderror 
              </div>
            </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full px-3">
                    <label class="block uppercase font-caps tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                      ნომერი
                    </label>
                <input name="phone" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" min="9" max="9" value="{{$user->profile()->first()->phone}}"  @if($user->id == Auth::user()->id) readonly="true" @endif>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong style="color: tomato">{{ $message }}</strong>
                    
                    </span>
                @enderror   
              </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                  <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                    <label class="block uppercase font-caps tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                      დეპარტამენტი
                    </label>
                  <div class="relative">
                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-department" name="department_id">
                      @if ($user->id != Auth::user()->id)
                      <option value=""></option>
                      @foreach ($departments as $dept)
                      @if ($user->getDepartmentId() == $dept->id)
                      <option value="{{$dept->id}}" selected>{{$dept->{"name_".app()->getLocale()} }}</option>
                      @else 
                      <option value="{{$dept->id}}">{{$dept->{"name_".app()->getLocale()} }}</option> 
                      @endif
                      @endforeach
                      @else 
                      <option value="{{$user->getDepartmentId()}}" selected>{{$user->getDepartmentName() }}</option>
                      @endif
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                  </div>
                  </div>
                  <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                    <label class="block font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                      ელ-ფოსტა
                    </label>
                  <input name="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-xs" id="grid-zip" type="text" @if($user->id == Auth::user()->id) readonly="true" @endif value="{{$user->email}}">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong style="color: tomato">{{ $message }}</strong>
                      
                      </span>
                  @enderror
                </div>
                </div>
                
               
                @if($user->id != auth::user()->id)
                <input type="submit" class="font-bold font-caps text-xs appearance-none block w-full bg-indigo-500 text-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none cursor-pointer" value="განახლება">
              
              @endif</form>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script>
      $(document).ready(function () {
            
      });
</script>
@endsection