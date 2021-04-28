<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Group;
use App\Models\MyImage;
use App\Models\Like;

use SplFileObject;

use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // protected $csvimport = null;

    // public function __construct(CSVimport $csvimport){
    //     $this->csvimport = $csvimport;
    // }


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

        $likes = Like::where('user_id', $user_id)->get();
        
        return view('address.index', [
            'prefs' => $prefs,
            'addresses' => $addresses,
            'search_params' => $search_params,
            'my_image' => $my_image,
            'groups' => $groups,
            'likes' => $likes
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

        return redirect('address/index');
    }


    public function show($id){

        $address = Address::find($id);

        $prefs = config('pref');
        $groups = Group::all();

        return view('address.show', [
            'address' => $address,
            'prefs' => $prefs,
            'groups' => $groups
            ]);
    }


    public function update(Request $request, $id){

        $address = Address::find($id);

        $address->name = $request->input('name');
        $address->zip_code = $request->input('zip_code');
        $address->prefecture = $request->input('prefecture');
        $address->city = $request->input('city');
        $address->town = $request->input('town');
        $address->phone_number = $request->input('phone_number');
        $address->group_id = $request->input('group_id');

        $address->save();

        return redirect('address/index');
    }

    public function destroy($id){

        $address = Address::find($id);
        $address->delete();

        return redirect('address/index');
    }


    public function nameSearch(Request $request){

        $name = $request->keyword;
        $result = Address::where('name', 'LIKE', $name . '%')->first();

        return response()->json(["result"=> $result]);
    }



    public function csvImport(Request $request){

        // アップロードしたファイルを取得
        $uploaded_file = $request->file('csv_file');

        // アップロードしたファイルの絶対パスを取得
        $file_path = $request->file('csv_file')->path($uploaded_file);

        //SplFileObjectを生成
        $file = new SplFileObject($file_path);

        $file->setFlags(SplFileObject::READ_CSV);

        $row_count = 1;
        
        foreach ($file as $row){
            // 最終行の処理(最終行が空っぽの場合の対策
            if ($row === [null]) continue; 
            
            // 1行目のヘッダーは取り込まない
            if ($row_count > 1){
                // CSVの文字コードがSJISなのでUTF-8に変更
                $name = mb_convert_encoding($row[0], 'UTF-8');
                $zip_code = mb_convert_encoding($row[1], 'UTF-8');
                $prefecture = mb_convert_encoding($row[2], 'UTF-8');
                $city = mb_convert_encoding($row[3], 'UTF-8');
                $town = mb_convert_encoding($row[4], 'UTF-8');
                $phone_number = mb_convert_encoding($row[5], 'UTF-8');
                $group_id = mb_convert_encoding($row[6], 'UTF-8');
                
                //1件ずつインポート
                    Address::insert(array(
                        'name' => $name, 
                        'zip_code' => $zip_code,
                        'prefecture' => $prefecture,
                        'city' => $city,
                        'town' => $town,
                        'phone_number' => $phone_number,
                        'group_id' => $group_id
                    ));
            }
            $row_count++;
        }
    
        return redirect('address/index');
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
                'town',
                'phone_number',
                'group_id'
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
                    $address->town,
                    $address->phone_number,
                    $address->group_id
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);
                fputcsv($handle, $csv);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }
}

