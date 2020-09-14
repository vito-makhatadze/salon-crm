@extends('theme.layout.layout')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto font-helvetica">
        ახალი სერვისის რეგისტრაცია
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
    <form  action="{{route('StoreClient')}}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="intro-y box p-5">
                
            <div class="flex">
                <div class="w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">კლიენტის სრული სახელი GE <span class="text-red-500">*</span></label> <br>
                    <input required type="text" autocomplete="off" name="client_name_ge" id="client_name_ge"  class="font-normal text-sm input w-full border category mt-2" placeholder="სრული სახელი">
                </div>
                <div class="w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">კლიენტის სრული სახელი RU</label> <br>
                    <input type="text" autocomplete="off" name="client_name_ru" id="client_name_ru"  class="font-normal text-sm input w-full border category mt-2" placeholder="სრული სახელი">
                </div>
                <div class="w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">კლიენტის სრული სახელი EN</label> <br>
                    <input type="text" autocomplete="off" name="client_name_en" id="client_name_en"   class="font-normal text-sm input w-full border category mt-2" placeholder="სრული სახელი">
                </div>
               </div>
               <div class="flex">
                <div class="w-1/2 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">მისამართი</label>
                    <input type="text" min="0" step="1" name="client_address" id="client_address" class="font-normal text-sm input w-full border mt-2" placeholder="კლიენტის მისამართი">
                </div>
                <div class="w-1/2 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">ნომერი <span class="text-red-500">*</span></label>
                    <input required type="text" min="0" step="1" name="client_number" id="client_number" class="font-normal text-sm input w-full border mt-2" placeholder="კლიენტის ნომერი">
                </div>
               </div>
               <div class="flex my-4 justify-between items-center p-2">
                   <h6 class="font-bold font-caps text-sm text-gray-700">სერვისის დამატება</h6>
                   <button type="button" id="addservice" class="dropdown-toggle bg-gray-300 button px-2 box text-gray-700 hover:bg-blue-900 hover:text-white">
                       <span class="w-5 h-5 flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-4 h-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> </span>
                   </button>
               </div>
               <!-- Choose Service -->
               <div id="services">
                <div class="flex">
                    <div class="w-1/4 p-2">
                        <div class="flex justify-between align-items-center">
                            <label class="font-bold font-caps text-xs text-gray-700">აირჩიეთ სერვისი <span class="text-red-500">*</span></label>
                        </div>
                        <div class="mt-2">
                            <select required name="servicepicker[]" class="select2 w-full">
                                @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->{"title_".app()->getLocale()} }}</option>
                                @endforeach
                            </select>
                        </div>
                      
                    </div>
                    
                    <div class="w-1/4 p-2">
                        <div class="flex justify-between align-items-center">
                            <label class="font-bold font-caps text-xs text-gray-700">ჩაწერის თარიღი <span class="text-red-500">*</span></label>
                        </div>
                        
                        <div class="w-full mt-2">
                            <input required name="datepicker[]" id="datepicker" type="date" class=" input w-full border block mx-auto"> 
                        </div>
                      
                    </div>
                    <div class="w-1/4 p-2">
                        <div class="flex justify-between align-items-center">
                            <label class="font-bold font-caps text-xs text-gray-700">ჩაწერის დრო <span class="text-red-500">*</span></label>
                        </div>
                        
                        <div class="w-full mt-2">
                            <input required type="time" name="timepicker[]" id="datepicker"  class=" input w-full border block mx-auto"> 
                        </div>
                      
                    </div>
                    
                    <div class="w-1/4 p-2">
                        <div class="flex justify-between align-items-center">
                            <label class="font-bold font-caps text-xs text-gray-700">აირჩიეთ სტილისტი <span class="text-red-500">*</span></label>
                        </div>
                        <div class="mt-2">
                            <select required name="userpicker[]" class="select2 w-full">
                                <option value=""></option>
                                @foreach ($workers as $per)
                                <option value="{{$per->id}}">{{$per->profile()->first()->first_name}} {{$per->profile()->first()->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                      
                    </div>
                  </div>
               </div>
              
              <br>
                <input type="submit" class=" button text-white bg-theme-1 shadow-md ml-2 font-bold font-caps text-xs" value="ატვირთვა">
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
        $('.side-menu[data-menu="services"]').addClass('side-menu--active');
    });
    $('#addservice').click(function(){
            let randomid= Date.now();
        $('#services').append(`
        <div class="flex relative" id="removeservice`+randomid+`">
            <span class="absolute right-0 top-3 bg-red-400 text-white px-2 rounded cursor-pointer" onclick="removeserv('removeservice`+randomid+`')">x</span>
            <div class="w-1/4 p-2">
                        <div class="flex justify-between align-items-center">
                            <label class="font-bold font-caps text-xs text-gray-700">აირჩიეთ სერვისი <span class="text-red-500">*</span></label>
                        </div>
                        <div class="mt-2">
                            <select required name="servicepicker[]" class="select2 w-full">
                                @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->{"title_".app()->getLocale()} }}</option>
                                @endforeach
                            </select>
                        </div>
                      
                    </div>
                    <div class="w-1/4 p-2">
                        <div class="flex justify-between align-items-center">
                            <label class="font-bold font-caps text-xs text-gray-700">ჩაწერის თარიღი <span class="text-red-500">*</span></label>
                        </div>
                        
                        <div class="w-full mt-2">
                            <input required name="datepicker[]"  type="date" class=" input w-full border block mx-auto"> 
                        </div>
                      
                    </div>
                    <div class="w-1/4 p-2">
                        <div class="flex justify-between align-items-center">
                            <label class="font-bold font-caps text-xs text-gray-700">ჩაწერის დრო <span class="text-red-500">*</span></label>
                        </div>
                        
                        <div class="w-full mt-2">
                            <input required type="time" name="timepicker[]"  class=" input w-full border block mx-auto"> 
                        </div>
                      
                    </div>
                    
                    <div class="w-1/4 p-2">
                        <div class="flex justify-between align-items-center">
                            <label class="font-bold font-caps text-xs text-gray-700">აირჩიეთ სტილისტი <span class="text-red-500">*</span></label>
                        </div>
                        <div class="mt-2">
                            <select required name="userpicker[]" class="select2 w-full">
                                <option value=""></option>
                                @foreach ($workers as $per)
                                <option value="{{$per->id}}">{{$per->profile()->first()->first_name}} {{$per->profile()->first()->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                      
                    </div>
                  </div>
                
        `);
        $('.select2').select2();
        $('.datepicker').datepicker();
    });
    function removeserv($id){
        $('#'+$id).remove();
    }
</script>
@endsection
