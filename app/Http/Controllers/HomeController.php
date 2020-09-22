<?php
/**
 *  app/Http/Controllers/HomeController.php
 *
 * User:
 * Date-Time: 01.09.20
 * Time: 13:33
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Auth;
use App\ClientService;
use App\Client;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ActionHome()
    {
        if (view()->exists('theme.template.home.home_index')) {
            $data = [
                
            ];
            if(Auth::user()->isUser()){
                $user = Auth::user();
                $userclients = ClientService::where('user_id', $user->id)->whereNull('deleted_at')->get();
                return view('theme.template.user.user_profile', compact('user', 'userclients'));
            }
            $totalclients = Client::count();
            $userdservices = ClientService::where('status', true)->count();
            $usedservices = ClientService::where('status', true)->get();
            $allclientservices = ClientService::count();
            $income = 0;
            $todayservices = ClientService::whereDate('session_start_time', Carbon::today())->whereNull('deleted_at')->paginate(40);
            foreach($usedservices as $service){
                $income += $service->getServicePrice();
            }
            return view('theme.template.home.home_index', compact('totalclients', 'userdservices', 'income', 'allclientservices', 'todayservices'));
        } else {
            abort('404');
        }
    }
}
