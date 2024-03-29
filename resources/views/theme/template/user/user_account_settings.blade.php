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
                <div class="font-bold text-sm "> {{$user->profile->first_name}} {{$user->profile->last_name}}</div>
                    <div class="text-gray-600 font-normal text-xs"> 
                        
                       {{ $user->getRoleNames()->first() == "user" ? __('details.employee') : $user->getRoleNames()->first() }}
                    </div>
                </div>
            </div>
            <div class="p-5 border-t border-gray-200">
            <a class="flex items-center font-medium" @if(auth()->user()->isAdmin()) href="/user/showprofile/{{$user->id}}" @else href="/" @endif> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity w-4 h-4 mr-2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> @lang('details.job_table') </a>
                <a class="flex items-center text-theme-1 mt-5 font-medium" href="/profile/accountsettings"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg> @lang('details.details') </a>
                @if($user->id == Auth()->user()->id)
                <a class="flex items-center   mt-5 font-medium" href="/profile/changepassword"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock w-4 h-4 mr-2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> @lang('details.password') </a>
              @endif
              </div>
            <div class="p-5 border-t border-gray-200">
              <div class="flex">
                <div class="w-1/3 p-3">
                    <h6 class="font-bold font-caps text-base text-black">{{$user->getEarnedMoney() ? $user->getEarnedMoney() : 0}} <sup>@lang('money.icon')</sup></h6>
                    <span class="font-normal text-xs">@lang('details.earn')</span>
                </div>
                  <div class="w-1/3 p-3">
                      <h6 class="font-bold font-caps text-base text-black">{{$user->ClientCount()}}</h6>
                      <span class="font-normal text-xs">@lang('details.clients')</span>
                  </div>
                  <div class="w-1/3 p-3">
                      <h6 class="font-bold font-caps text-base text-black"> {{$user->profile->salary}} <sup>@lang('money.icon')</sup></h6>
                      <span class="font-normal text-xs">@lang('details.salary')</span>
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
                    @if (auth()->user()->isAdmin())
                    <a href="/profile/turn/{{$user->id}}/0" class="button button--sm border text-gray-700 ml-auto font-bold font-caps text-xs">@lang('details.off')</a>
                    @endif
                @else
                <div class="flex items-center justify-center h-full font-normal text-xs">
                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi mr-2 bi-dash-circle-fill" fill="#ff6155" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path>
                      </svg>@lang('details.non_active')
                    </div>
                    @if (auth()->user()->isAdmin())
               <a href="/profile/turn/{{$user->id}}/1" class="button button--sm border text-gray-700 ml-auto font-bold font-caps text-xs">@lang('details.on')</a>
               @endif     
                @endif
            </div>
        </div>
        @if (auth()->user()->hasAnyPermission(['admin']))
        <div x-data="{modal: false}">
            <button @click="modal = true" class="my-2 p-2 bg-indigo-500 text-center text-white w-full font-bold text-xs ">
              @lang('details.sms_send')
            </button>
                <x-modal x-show="modal" class="z-50">
                    <form action="{{ route('smsSendPost') }}" method="POST" class="bg-white mx-auto" autocomplete="off">
                        @csrf
                        <div class="w-full px-3 mb-2">
                        <label class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                            <h6 class="font-caps">
                              @lang('details.phone')
                            </h6> 
                        </label>
                        <input name="phone" value="{{$user->profile->phone}}" readonly required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" id="phone" type="text" minlength="9" maxlength="9" placeholder="555 11 22 33">
                        <small class="font-normal">@lang('details.check_number')</small> 
                        @error('phone')
                            <p class="font-normal text-xs text-red-500">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                        <div class="w-full px-3">
                            <label class="font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="text">
                              @lang('details.text')
                            </label>
                            <textarea name="text" id="text" cols="30" rows="5" class="appearance-none resize-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                            @error('text')
                                <p class="font-normal text-xs text-red-500">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="px-3 mt-2">
                            <button type="submit" class="w-full bg-indigo-500 py-3 px-4 text-white font-bold font-caps text-xs">@lang('details.send')</button>
                        </div>
                    </form>
                </x-modal>
            </div>
        @endif
    </div>

    {{-- End of Profile --}}
    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <div class="intro-y p-4  lg:mt-1">
        <form  enctype="multipart/form-data" class="w-5/12 box p-3 max-w-lg"  @if(auth()->user()->isAdmin()) action="{{route('UpdateUserProfile', $user->id)}}" @endif method="post" >
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block flex items-center justify-between bg-indigo-500 text-white uppercase tracking-wide p-3 cursor-pointer text-xs font-bold mb-2" for="userimage">
                  @lang('details.uploadimage')
                  <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-card-image" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9c0 .013 0 .027.002.04V12l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15 9.499V3.5a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm4.502 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                  </svg>
                </label>
                <input type="file" name="userimage" class="hidden" id="userimage">               
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-5">
              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                <label class="block font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                  @lang('details.first_name')
                </label>
            <input required name="first_name" value="{{$user->profile->first_name}}" class="font-normal appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" type="text"  @if(!auth()->user()->isAdmin()) readonly="true" @endif >
              </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase font-caps tracking-wide text-gray-700 text-xs font-bold mb-2" for="last-name">
                  @lang('details.last_name')
                </label>
                <input required name="last_name" value="{{$user->profile->last_name}}" class="font-normal appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="last-name" type="text" placeholder="Doe"  @if(!auth()->user()->isAdmin()) readonly="true" @endif>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-5">
              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                <label class="block font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  @lang('details.salary')
                </label>
            <input name="user_salary" value="{{$user->profile->salary}}" class="font-normal appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text"  @if(!auth()->user()->isAdmin()) readonly="true" @endif >
            @error('user_salary')
            <span class="invalid-feedback" role="alert">
                <strong style="color: tomato">{{ $message }}</strong>
                
                </span>
            @enderror 
          </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase font-caps tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  @lang('details.percent')
                </label>
                <input name="user_percent" value="{{$user->profile->percent}}" class="font-normal appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Doe"  @if(!auth()->user()->isAdmin()) readonly="true" @endif>
                @error('user_percent')
                <span class="invalid-feedback" role="alert">
                    <strong style="color: tomato">{{ $message }}</strong>
                    
                    </span>
                @enderror 
              </div>
            </div>
                <div class="flex flex-wrap -mx-3 mb-3">
                  <div class="w-full px-3">
                    <label class="block uppercase font-caps tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                      @lang('details.phone')
                    </label>
                <input required onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" name="phone" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" minlength="9" maxlength="9" value="{{$user->profile->phone}}"  @if(!auth()->user()->isAdmin()) readonly="true" @endif>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong style="color: tomato">{{ $message }}</strong>
                    
                    </span>
                @enderror   
              </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                  <div class="w-full @if($user->id == auth()->user()->id) md:w-1/2 @else md:w-1/3 @endif px-3 mb-4 md:mb-0">
                    <label class="block uppercase font-caps tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                      @lang('details.department')
                    </label>
                  <div class="relative">
                    <select class="font-normal  text-xs block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-department" name="department_id">
                      @if (auth()->user()->isAdmin())
                      <option value=""></option>
                      @foreach ($departments as $dept)
                      @if ($user->userHasJob->department_id ?? '' == $dept->id)
                      <option value="{{$dept->id}}" selected>{{$dept->name_ge }}</option>
                      @else 
                      <option value="{{$dept->id}}">{{$dept->name_ge }}</option> 
                      @endif
                      @endforeach
                      @else 
                      <option value="{{$user->userHasJob->department_id}}" selected>{{$user->getDepartmentName() }}</option>
                      @endif
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                  </div>
                  </div>
                  <div class="w-full @if($user->id == auth()->user()->id) md:w-1/2 @else md:w-1/3 @endif px-3 mb-4 md:mb-0">
                    <label class="block font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                      @lang('details.mail')
                    </label>
                  <input required name="email" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-xs" id="grid-zip" type="text" @if(!auth()->user()->isAdmin()) readonly="true" @endif value="{{$user->email}}">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong style="color: tomato">{{ $message }}</strong>
                      
                      </span>
                  @enderror
                </div>
                   @if ($user->id != Auth::user()->id)
                       <div class="w-full md:w-1/3 px-3 mb-4 md:mb-0">
                        <label class="block uppercase font-caps tracking-wide text-gray-700 text-xs font-bold mb-2" for="rolename">
                          @lang('details.role')
                        </label>
                       <div class="relative">
                         <select class="font-normal text-xs block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="rolename" name="rolename">
                           
                          @if ($user->id != Auth::user()->id)
                           @foreach ($roles as $role)
                           @if ($role->name != 'admin')
                           @if ($user->hasRole($role->name))
                           <option value="{{$role->name}}" selected>{{$role->name == "user" ? __('details.employee') : $role->name  }}</option>
                           @else
                           <option value="{{$role->name}}">{{$role->name == "user" ? __('details.employee') : $role->name }}</option>
                           @endif
                           @endif
                           @endforeach
                           @else 
                           {{-- <option value="{{$user->userHasJob->department_id}}" selected>{{$user->getDepartmentName() }}</option> --}}
                           @endif
                         </select>
                         <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                           <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                         </div>
                       </div>
                       </div>
                       @endif 
                      
                </div>
                
                <div class="flex">
                  <div class="my-3 w-full md:w-1/2 flex items-center justify-content font-normal text-xs">
                    <input type="checkbox" name="blockstatus" class="mr-3" id="blockstatus" @if(sizeof($user->getAllPermissions()) == 0) checked @endif>
                    <label for="blockstatus">@lang('details.block')</label>
                  </div>
                  
                  <div class="my-3 w-full md:w-1/2 flex items-center justify-content font-normal text-xs">
                    <label for="soldproduct">@lang('details.percent_from_sale')</label> 
                    <input name="soldproduct" id="soldproduct" placeholder="00" value="{{$user->profile->percent_from_sales}}" type="number" max="100" min="0" class="ml-3 font-normal text-xs appearance-none block w-16 bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-1 text-center leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                               
                  </div>
                </div>
               
                <div class="my-3 w-full  flex items-center justify-content font-normal text-xs">
                  <select data-placeholder="@lang('details.choose_service')" name="services[]" class="select2 w-full" multiple>
                    @foreach ($services as $service)
                      @if ($user->hasService($service->id))
                        <option value="{{$service->id}}" selected>{{$service->title_ge }}</option>
                      @else 
                        <option value="{{$service->id}}">{{$service->title_ge }}</option>
                      @endif
                    @endforeach
                </select>
                </div>
                <div class="flex justify-between items-center">
                  
                  <div class="p-2 flex items-center font-normal text-xs">
                    <label for="" class="mr-2">@lang('details.brake_time')</label>
                  <input onkeyup="addminutetag('minute1')" id="minute1" class="font-normal text-xs block appearance-none w-16 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" max="60" min="0" placeholder="00" required name="brake_between_meeting" value="{{$user->profile->brake_between_meeting}}">   
                  </div>
                  <div class="p-2 flex items-center font-normal text-xs">
                    <label for="" class="mr-2">@lang('details.interval')</label>
                  <input onkeyup="addminutetag('minute2')" id="minute2" class="font-normal text-xs block appearance-none w-16 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" max="60" min="0" placeholder="00" name="interval_between_meeting" value="{{$user->profile->interval_between_meeting}}">  
                  </div>
                </div>
                
                <div class="flex justify-between font-normal text-xs items-center">
                  <div class="p-1 flex items-center">
                      <input type="checkbox" id="Mo" @if($user->weekdays && in_array('Mo', json_decode($user->weekdays, true))) checked @endif name="Mo">
                      <label for="Mo" class="ml-2">@lang('details.mo')</label>
                  </div>
                  <div class="p-1 flex items-center">
                      <input type="checkbox" id="Tu" @if($user->weekdays && in_array('Tu', json_decode($user->weekdays, true))) checked @endif name="Tu">
                      <label for="Tu" class="ml-2">@lang('details.tu')</label>
                  </div>
                  <div class="p-1 flex items-center">
                      <input type="checkbox" id="We" @if($user->weekdays && in_array('We', json_decode($user->weekdays, true))) checked @endif name="We">
                      <label for="We" class="ml-2">@lang('details.we')</label>
                  </div>
                  <div class="p-1 flex items-center">
                      <input type="checkbox" id="Th" @if($user->weekdays && in_array('Th', json_decode($user->weekdays, true))) checked @endif name="Th">
                      <label for="Th" class="ml-2">@lang('details.th')</label>
                  </div>
                  <div class="p-1 flex items-center">
                      <input type="checkbox" id="Fr" @if($user->weekdays && in_array('Fr', json_decode($user->weekdays, true))) checked @endif name="Fr">
                      <label for="Fr" class="ml-2">@lang('details.fr')</label>
                  </div>
                  <div class="p-1 flex items-center">
                      <input type="checkbox" id="Sa" @if($user->weekdays && in_array('Sa', json_decode($user->weekdays, true))) checked @endif name="Sa">
                      <label for="Sa" class="ml-2">@lang('details.sa')</label>
                  </div>
                  <div class="p-1 flex items-center">
                      <input type="checkbox" id="Su" @if($user->weekdays && in_array('Su', json_decode($user->weekdays, true))) checked @endif name="Su">
                      <label for="Su" class="ml-2">@lang('details.su')</label>
                  </div>
                </div>
               
                @if(auth()->user()->isAdmin())
                <input type="submit" class="font-bold font-caps text-xs appearance-none block w-full bg-indigo-500 text-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none cursor-pointer" value="@lang('details.update')">
              
              @endif</form>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script>
      $(document).ready(function () {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="user"]').addClass('side-menu--active');
            $('#menuuser ul').addClass('side-menu__sub-open');
            $('#menuuser ul').css('display', 'block');
      });
      function addminutetag($user->id){
        if($('#'+$user->id).length == 2){
          $('#'+$user->id).val($('#'+$user->id).val()+":");
        }
      }
</script>
@endsection