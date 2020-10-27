@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
<div class="col-span-12 lg:col-span-6">
<form action="{{route('StorePurchase')}}" method="post">
       @csrf
       <div class="grid grid-cols-4 w-full">
        <div class="col-span-1 p-2">
            <label class="font-bold font-caps text-xs text-gray-700">შეყვიდის ტიპი</label>
            <div class="mt-2">
                <select required id="purchasetype" data-placeholder="აირჩიეთ შეტყიდვის ტიპი" name="purchase_type" class="font-helvetica select2 w-full" >
                    <option value="overhead" selected>ზედნადები</option>
                    <option value="purchase">შესყიდვის აქტით</option>
                </select>
            </div>
        </div>
        <div class="col-span-1 p-2" id="overhead_number">
            <label class="font-bold font-caps text-xs text-gray-700">ზედნადების ნომერი</label>
            <input  type="text"   autocomplete="off" class="input w-full border mt-2" name="overhead_number">
        </div>
        <div class="col-span-1 p-2" id="purchase_number" style="display: none">
            <label class="font-bold font-caps text-xs text-gray-700">შესყიდვის ნომერი</label>
            <input  type="text"  autocomplete="off" class="input w-full border mt-2" name="purchases_number">
        </div>
        <div class="col-span-1 p-2" >
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="distributor_id">
              მომწოდებელი
            </label>
            <div class="relative">
              <select class="block font-normal text-xs appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none bg-white focus:border-gray-500" required id="distributor_id" name="distributor_id">
                <option value="">აირჩიეთ</option>
                @foreach ($distributors as $dist)
                    <option value="{{$dist->id}}">{{$dist->{"name_".app()->getLocale()} }}</option>
                @endforeach
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
              </div>
            </div>
            @error('distributor_id')
                <span class="invalid-feedback" role="alert">
                    <strong style="color: tomato">{{ $message }}</strong>
                </span>
            @enderror
          </div>

        <div class="col-span-1 p-2">
            <label class="font-bold font-caps text-xs text-gray-700">შეძენის თარიღი</label>
            <input required class="mt-2 datepicker input border block mx-auto" name="purchase_date">
            
            @error('purchase_date')
                <span class="invalid-feedback" role="alert">
                    <strong style="color: tomato">{{ $message }}</strong>
                </span>
            @enderror
        </div>
       </div>
    
   <div class="flex items-center text-gray-700 p-2 mt-3">
    <input  type="checkbox" class="input border border-black mr-2" id="dgg" name="dgg">
    <label class="cursor-pointer select-none font-normal text-xs" for="dgg">დამატებული ღირებულების გადასახადი (დღგ)</label>
    </div>
<hr>
    <!-- Field -->
    <div class="py-3 justify-between flex items-center">
        <span class="text-sm font-medium">დაამატეთ ერთეული</span>
        <button type="button" id="addunit" class="dropdown-toggle button px-2 box text-gray-700 hover:bg-blue-900 hover:text-white">
            <span class="w-5 h-5 flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-4 h-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> </span>
        </button>
    </div>
    
    <div id="units">
        



       
          


    </div>

    
    <input type="submit" class=" mt-2 button text-white bg-theme-1 shadow-md mr-1 font-caps font-bold text-xs" value="ატვირთვა">


   </form>
</div>

</div>

@endsection
@section('custom_scripts')
<script type="text/javascript">
  function readURL(input, $id) {
        if (input.files && input.files[0]) {
            $("#preloadimages"+$id).html('');
        $(input.files).each(function () {
            var reader = new FileReader();
            reader.readAsDataURL(this);
            reader.onload = function (e) {
                $("#preloadimages"+$id).append(`
                <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                        <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="` + e.target.result +`">
                        </div>
                `);
            }
        });
    }
}
	$(document).ready(function() {
        
    
        $('.side-menu').removeClass('side-menu--active');
        $('.side-menu[data-menu="purchases"]').addClass('side-menu--active');
        $('#menupurchases ul').addClass('side-menu__sub-open');
        $('#menupurchases ul').css('display', 'block');

        $('#purchasetype').change(function(){
            $('#overhead_number').css('display', 'none');
            $('#purchase_number').css('display', 'none');
            $('#'+this.value+"_number").css('display', 'block');
        });
        
        $('#getter_person_search').keyup(function(){
            if($('#getter_person_id').val()){
                $('#getter_person_id').val("");
            }
            if($('#getter_person_search').val().length > 2){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                  url: "{{ route('GetProfilesForPurchase') }}",
                  method: 'post',
                  data: {
                     'value': $('#getter_person_search').val(),
                  },
                  success: function(result){
                    if(result.status == true){
                        if(result.data.length > 0){
                        if($('#showgetterperson').hasClass('hidden')){
                            $('#showgetterperson').removeClass('hidden');
                        }
                        }else if(!$('#showgetterperson').hasClass('hidden')){
                            $('#showgetterperson').addClass('hidden');
                        }
                        let html = '';
                        result.data.forEach(function(data){
                            html += `
                            <li class="mt-2 hover:bg-indigo-500 hover:text-white p-1 cursor-pointer" onclick="selectgetterperson(`+data['profileable_id']+`, '`+data['first_name']+` `+data['last_name']+`')">
                                `+data['first_name']+` `+data['last_name']+`
                            </li>
                            `;
                        });
                        $('#showgetterperson').html('');
                        $('#showgetterperson').html(html);
                    }
                    }
                  });
            }else{
                if(!$('#showgetterperson').hasClass('hidden')){
                    $('#showgetterperson').addClass('hidden');
                }
            }
            
        });
        //Responsive Person Search
        $('#responsible_person_search').keyup(function(){
            if($('#responsible_person_id').val()){
                $('#responsible_person_id').val("");
            }
            if($('#responsible_person_search').val().length > 2){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                  url: "{{ route('GetProfilesForPurchase') }}",
                  method: 'post',
                  data: {
                     'value': $('#responsible_person_search').val(),
                  },
                  success: function(result){
                    if(result.status == true){
                        if(result.data.length > 0){
                        if($('#showresponsiveperson').hasClass('hidden')){
                            $('#showresponsiveperson').removeClass('hidden');
                        }
                        }else if(!$('#showresponsiveperson').hasClass('hidden')){
                            $('#showresponsiveperson').addClass('hidden');
                        }
                        let html = '';
                        result.data.forEach(function(data){
                            html += `
                            <li class="mt-2 hover:bg-indigo-500 hover:text-white p-1 cursor-pointer" onclick="selectresponsible(`+data['profileable_id']+`, '`+data['first_name']+` `+data['last_name']+`')">
                                `+data['first_name']+` `+data['last_name']+`
                            </li>
                            `;
                        });
                        $('#showresponsiveperson').html('');
                        $('#showresponsiveperson').html(html);
                    }
                    }
                  });
            }else{
                if(!$('#showresponsiveperson').hasClass('hidden')){
                    $('#showresponsiveperson').addClass('hidden');
                }
            }
            
        });
        //Distributors Search
        $('#distributor_search').keyup(function(){
            if($('#distributor_id').val()){
                $('#distributor_id').val("");
            }
            if($('#distributor_search').val().length > 2){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                  url: "{{ route('GetDistributors') }}",
                  method: 'post',
                  data: {
                     'value': $('#distributor_search').val(),
                  },
                  success: function(result){
                      console.log(result);
                    if(result.status == true){
                        if(result.data.length > 0){
                        if($('#showdistributors').hasClass('hidden')){
                            $('#showdistributors').removeClass('hidden');
                        }
                        }else if(!$('#showdistributors').hasClass('hidden')){
                            $('#showdistributors').addClass('hidden');
                        }
                        let html = '';
                        result.data.forEach(function(data){
                            html += `
                            <li class="mt-2 hover:bg-indigo-500 hover:text-white p-1 cursor-pointer" onclick="selectdist(`+data['id']+`, '`+data['name_{{app()->getLocale()}}']+`')">
                            `+data['name_{{app()->getLocale()}}']+`
                            </li>
                            `;
                        });
                        $('#showdistributors').html('');
                        $('#showdistributors').html(html);
                    }
                    }
                  });
            }else{
                if(!$('#showdistributors').hasClass('hidden')){
                    $('#showdistributors').addClass('hidden');
                }
            }
            
        });
        $('#selectoffice').change(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                  url: "{{ route('GetDepartmentsByOffice') }}",
                  method: 'post',
                  data: {
                     'office_id': $('#selectoffice').val(),
                  },
                  success: function(result){
                    if(result.status == true){
                        let html = '';
                        result.data.forEach(function(data){
                            html += `<option value="`+data['id']+`">`+data['name_{{app()->getLocale()}}']+`</option>`;
                        });
                        $('#showdepartments').html('');
                        $('#showdepartments').html(html);
                    }
                    }
                  });
        });
        
        $('#addunit').click(function(){
            let randomid= Date.now();
            $('#units').append(`
            <div class="relative w-full mt-3 box p-4" id="`+randomid+`">
            <button type="button" onclick="removeunit('`+randomid+`')" class="absolute right-0 top-0 dropdown-toggle button px-2 box  bg-red-300 focus:bg-red-900 text-red-900">
                <span class="w-3 h-3 flex items-center justify-center "> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-4 h-2"><line x1="5" y1="12" x2="19" y2="12"></line></svg> </span>
            </button>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="font-bold font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                      საშუალების ტიპი
                    </label>
                    <div class="relative">
                      <select required name="ability_type[]" class="font-medium text-xs block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                        <option value="1">ძირითადი საშუალება</option>
                        <option value="2">ხარჯმასალა</option>
                      </select>
                      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                      </div>
                    </div>
                  </div>
                  <div class="w-full md:w-1/3 px-3">
                    <label class="font-bold font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                      დასახელება
                    </label>
                    <input required autocomplete="off" name="title[]" class="font-medium text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="დასახელება">
                  </div>
                  <div class="w-full md:w-1/3 px-3">
                    <div>
                        <label for="price" class="block  leading-5 font-medium text-gray-700 font-bold font-caps text-xs">ფასი</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                          <input name="unit_price[]" type="number" min="0" step="0.01" class="block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="xxx.xx">
                          <div class="absolute inset-y-0 right-0 flex items-center">
                            <select name="currency[]" aria-label="Currency" class="form-select h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5">
                                <option value="gel" >GEL</option>
                              <option value="usd" >USD</option>
                              <option value="eur" >EUR</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="w-full md:w-1/4 px-3 mb-6 mt-3 md:mb-0">
                        <label class="font-bold font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                          ზომის ერთეული
                        </label>
                        <div class="relative">
                          <select required name="unit[]" class="block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                            <option value="unit" selected >ცალი</option>
                            <option value="gram">გრამი</option>
                            <option value="metre">სანტიმეტრი</option>
                          </select>
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>
                        </div>
                      </div>
                      <div class="w-full md:w-1/4 mt-3 px-3">
                    <label class="font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="brand`+randomid+`">
                        ბრენდი
                        </label>
                        <div class="relative">
                        <select name="brand[]" required class="brands font-normal text-xs block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="brand`+randomid+`">
                            <option value="">აირჩიეთ</option>
                            
                        </select>
                        <div x-data="{modal:false}" class=" absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <button @click="modal = true" type="button" class="p-1 bg-indigo-500 rounded">
                                <svg width="0.85em" height="0.85em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                </svg>
                            </button>
                            <x-modal x-show="modal">
                                <div class="w-full mb-6 md:mb-0">
                                <label class="font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="brandcat`+randomid+`">
                                    კატეგორია
                                </label>
                                <div class="relative">
                                    <select class="font-normal text-xs block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="brandcat`+randomid+`">
                                    <option value="">აირჩიეთ</option>
                                    @foreach ($categories as $cat)
                                        <optgroup label="{{$cat->{'title_'.app()->getLocale()} }}">
                                          @foreach($cat->subcategories as $subcat)
                                            <option value="{{$subcat->id}}">{{$subcat->name }}</option>
                                          @endforeach
                                        </optgroup>
                                    @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mt-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="brandname`+randomid+`">
                                    ბრენდის სახელი
                                    </label>
                                    <input class="ont-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="brandname`+randomid+`" type="text" placeholder="დასახელება">
                                </div>
                                </div>
                                <button @click="modal = false" type="button" onclick="addNewBrand(`+randomid+`)" class="font-bold text-xs text-white font-caps bg-indigo-500 w-full p-3 text-center"> დამატება</button>
                            </x-modal>
                        </div>
                        </div>
                    </div>
              <div class="w-full md:w-1/4 mt-3 px-3">
                <label class="font-bold font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                  რაოდენობა
                </label>
                <input required autocomplete="off" name="quantity[]" class="font-medium text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="number" min="0" step="1" placeholder="xxx">
              </div>
              <div class="w-full md:w-1/4 px-3 mb-6 mt-3 md:mb-0">
                <label class="font-bold font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                  საწყობი
                </label>
                <div class="relative">
                  <select required name="storage[]" class="storages block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                   <option value="">აირჩიეთ</option>
                  </select>
                  
                  <div x-data="{modal:false}" class=" absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <button @click="modal = true" type="button" class="p-1 bg-indigo-500 rounded">
                                <svg width="0.85em" height="0.85em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                </svg>
                            </button>
                        <x-modal x-show="modal">
                            <div class="flex flex-wrap -mx-3 mt-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="storagename`+randomid+`">
                                    საწყობის სახელი
                                    </label>
                                    <input class="ont-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="storagename`+randomid+`" type="text" placeholder="დასახელება">
                                </div>
                            </div>
                            <button @click="modal = false" type="button" onclick="addNewStorage(`+randomid+`)" class="font-bold text-xs text-white font-caps bg-indigo-500 w-full p-3 text-center"> დამატება</button>
                        </x-modal>
                    </div>
                </div>
              </div>
             
            <div class="w-full px-4 mt-2">
                <label class="font-bold font-caps text-xs text-gray-700">აღწერა ქართულად <span class="text-red-500">*</span> </label>
                <div class="mt-2 font-medium text-xs">
                    <textarea required data-feature="basic" class="summernote" name="body[]" style="display: none;"></textarea>
                </div>
            </div>
            </div>
        </div>
            `);
            $('.summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                ]
            });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('getData') }}",
            method: 'get',
            success: function(result){
                if(result.status == true){
                    $('.brands').each(function(g, test) {
                        $(test).html('');
                        $(result.brands).each(function(i, obj) {
                            $(test).append(new Option(obj['name'], obj['id']));
                        });
                    });
                    $('.storages').each(function(g, test) {
                        $(test).html('');
                        $(result.storages).each(function(i, obj) {
                            $(test).append(new Option(obj['name'], obj['id']));
                        });
                    });
                }
            }
        });
        });
    });
     function removeunit($id){
        $('#'+$id).remove();
    }
    function selectdist($id, $name){
        $('#distributor_search').val($name);
        $('#distributor_id').val($id);
        $('#showdistributors').addClass('hidden');
    }
    function selectresponsible($id, $name){
        $('#responsible_person_search').val($name);
        $('#responsible_person_id').val($id);
        $('#showresponsiveperson').addClass('hidden');
    }
    function selectgetterperson($id, $name){
        $('#getter_person_search').val($name);
        $('#getter_person_id').val($id);
        $('#showgetterperson').addClass('hidden');
    }
    function addNewBrand($id){
        let category = parseInt($('#brandcat'+$id).val());
        let brand = $('#brandname'+$id).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('addNewBrand') }}",
            method: 'post',
            data: {
                'category_id': category,
                'brand_name': brand,
            },
            success: function(result){
                if(result.status == true){
                    $('.brands').each(function(i, obj) {
                        $(obj).append(new Option(result.text, result.value));
                    });
                }
            }
        });
    }
    function addNewStorage($id){
        let storagename = $('#storagename'+$id).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('addNewStorage') }}",
            method: 'post',
            data: {
                'storagename': storagename,
            },
            success: function(result){
                if(result.status == true){
                    $('.storages').each(function(i, obj) {
                        $(obj).append(new Option(result.text, result.value));
                    });
                }
            }
        });
    }
</script>
@endsection