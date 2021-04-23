<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Group;
use App\Models\MyImage;

use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index(Request $request) {

        $prefs = config('pref');

        
        $addresses = Address::search()->paginate(15);
        $search_params = $request->only([
            'name',
            'zip_code',
            'prefecture',
            'city',
            'town',
            'phone_number',
            'prefs' => $prefs
        ]);

        // ナビバー画像呼び出し
        $user_id = Auth::id();
        $my_image = MyImage::where('user_id', $user_id)->first();

        $groups = Group::all();
        
        return view('address.index', [
            'prefs' => $prefs,
            'addresses' => $addresses,
            'search_params' => $search_params,
            'my_image' => $my_image,
            'groups' => $groups
        ]);
    }



    public function create(){

        $prefs = config('pref');
        $groups = Group::all();

        return view('address.create', [
            'prefs' => $prefs,
            'groups' => $groups
            ]);
    }


    public function store(Request $request){

        $address = new Address;

        $address->name = $request->input('name');
        $address->zip_code = $request->input('zip_code');
        $address->prefecture = $request->input('prefecture');
        $address->city = $request->input('city');
        $address->town = $request->input('town');
        $address->phone_number = $request->input('phone_number');
        $address->group_id = $request->input('group_id');

        $address->save();

        return view('address.store');
    }



    public function csvDownload() {
        $addresses = Address::search()->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv"
        ];

        $callback = function() use($addresses) {
            $handle = fopen('php://output', 'w');

            $columns = [
                'id',
                'name',
                'zip_code',
                'prefecture',
                'city',
                'address',
                'phone_number'
            ];

            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($handle, $columns);

            foreach($addresses as $address) {
                $csv = [
                    $address->id,
                    $address->name,
                    $address->zip_code,
                    $address->prefecture,
                    $address->city,
                    $address->address,
                    $address->phone_number
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($handle, $csv);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);

    }


}

