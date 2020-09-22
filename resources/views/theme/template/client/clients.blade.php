@extends('theme.layout.layout')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10 font-medium font-caps">
    დაამატეთ კლიენტის ჩანაწერი
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="flex">
            <a href="/clients/create" class="button text-white bg-theme-1 shadow-md mr-2 font-bold font-caps text-xs">კლიენტის დამატება</a>
        <div class="dropdown relative">
            <button class="dropdown-toggle button px-2 box text-gray-700">
                <span class="w-5 h-5 flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-4 h-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> </span>
            </button>
            <div class="dropdown-box mt-10 absolute w-40 top-0 left-0 z-20">
                <div class="dropdown-box__content box p-2">
                    <a href="" onclick="window.print()" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer w-4 h-4 mr-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> ბეჭდვა </a>
                    <a href="{{route('ClientExcel')}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text w-4 h-4 mr-2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> ექსელში ექსპორტი </a>
                </div>
            </div>
        </div>
        </div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <form action="" class="flex box p-2">
                <input class="appearance-none font-normal text-xs block w-56 bg-gray-200 text-gray-700 border rounded py-3 px-4  leading-tight focus:outline-none focus:bg-white" type="text" placeholder="სახელი ან ნომერი">
                <input class="appearance-none font-normal text-xs font-caps block w-56 ml-3 bg-indigo-500 text-white border rounded py-3 px-4  leading-tight " type="submit" value="ძებნა">
                  
            </form>
        </div>
    </div>
    <table class="table table-report -mt-2 col-span-12">
        <thead>
            <tr>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">კლიენტი</th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">რეგისტრაციის დრო</th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">გადახდილი თანხა</th>
                <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">პრივილეგია</th>
            </tr>
        </thead>
        <tbody>
            @if ($clients)
            @foreach ($clients as $client)
                <tr>
                <td class="whitespace-no-wrap">
                    <h6 class="font-bold text-black uppercase text-sm">{{$client->{"full_name_".app()->getLocale()} }}</h6>
                    <span class="text-gray-700 text-xs">{{$client->number}}</span>
                </td>
                <td class="whitespace-no-wrap">
                    <h6 class="text-sm text-black font-normal"><span class="text-xs">რეგ:</span> {{$client->created_at}}</h6>
                    <h6 class="text-sm text-black font-normal"><span class="text-xs">გან:</span> {{$client->created_at}}</h6>
                </td>
                <td>
                <h6 class="text-sm text-black font-bold">{{$client->getPayedMoney()}} <sup>₾</sup></h6>
                <span class="text-xs font-normal">რაოდენობა: {{$client->clientservices()->where('status', true)->whereNull('deleted_at')->count()}}</span><br>
                <span class="text-xs font-normal">შეკვეთები: {{$client->clientservices()->whereNull('deleted_at')->count()}}</span>
                </td>
                <td>
                    <div class="flex justify-center items-center">
                        <a href=" {{route('EditClient', $client->id)}} "  class="p-2 bg-gray-300 rounded-lg ml-2" href="javascript:;"> 
                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>
                            </a>
                        <form action="{{route('DeleteClient', $client->id)}}" method="get">
                            @csrf
                                <button type="submit"  class="p-2 bg-gray-300 rounded-lg ml-2" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal">
                                    <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-trash2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3.18 4l1.528 9.164a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836L12.82 4H3.18zm.541 9.329A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671L14 3H2l1.721 10.329z"/>
                                        <path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z"/>
                                        <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                    </svg>
                                    </button>
                        </form>
                        </div>
                </td>
                </tr>
            @endforeach
              {{$clients->links()}}
            @endif
        </tbody>
    </table>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="services"]').addClass('side-menu--active');
        
	});

</script>
@endsection