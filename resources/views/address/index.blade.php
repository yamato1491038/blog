<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>住所録</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>

<body>
<div class="container mx-auto p-5">
  <div class="row">
    <div class="col-8">
      <p class="text-3xl mb-8"><i class="far fa-address-book"></i> 
        住所録
        <a href="{{ route('address.create') }}" class="ml-4 text-sm text-gray-700 underline">情報登録</a>
      </p>
    </div>
    <div class="col">
      <div class="row">
        <div class="col">
          {{ Auth::user()->name }}
        </div>
        <div class="col"></div>
        <div class="col">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-jet-dropdown-link href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        this.closest('form').submit();">
                {{ __('Logout') }}
            </x-jet-dropdown-link>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-2">
      <div>
        <p class="text-xl mb-4"><i class="fas fa-search"></i> 検索</p>
        <form method="GET" action="/address/index">
          <div class="mb-4">
            <label for="name" class="block mb-2 font-bold">名前：</label>
            <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3">
          </div>

          <div class="mb-4">
            <label for="name" class="block mb-2 font-bold">郵便番号：</label>
            <input type="text" name="zip_code" id="name" class="shadow appearance-none border rounded w-full py-2 px-3">
          </div>

          <div class="mb-4">
            <label for="name" class="block mb-2 font-bold">住所：</label>
            <input type="text" name="prefecture" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 mb-2" placeholder="都道府県">
            <input type="text" name="city" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 mb-2" placeholder="市">
            <input type="text" name="town" id="name" class="shadow appearance-none border rounded w-full py-2 px-3" placeholder="町名・番地">
          </div>

          <div class="mb-4">
            <label for="name" class="block mb-2 font-bold">電話番号：</label>
            <input type="text" name="phone_number" id="name" class="shadow appearance-none border rounded w-full py-2 px-3">
          </div>

          <div class="flex justify-center">
            <button type="submit" class="hover:opacity-75 bg-blue-500 font-semibold text-white py-2 px-4 rounded">送信</button>
          </div>

        </form>
      </div>
    </div>
    <div class="col">
      <table class="border-collapse border w-full table-auto">
        <thead class="bg-gray-100">
          <tr>
            <th class="border p-2 border-b-4">
              id
            </th>
            <th class="border p-2 border-b-4">
              名前
            </th>
            <th class="border border-b-4">
              郵便番号
            </th>
            <th class="border border-b-4">
              都道府県
            </th>
            <th class="border border-b-4">
              市
            </th>
            <th class="border border-b-4">
              町名・番地
            </th>
            <th class="border border-b-4">
              電話番号
            </th>
          </tr>
        </thead>
        <tbody>
        @foreach ($addresses as $address)
          <tr class="hover:bg-grey-lighter">
            <td class="border">
              {{$address->id}}
            </td>
            <td class="border">
              {{$address->name}}
            </td>
            <td class="border">
              {{$address->zip_code}}
            </td>
            <td class="border">
              {{ $prefs[$address->prefecture] }}
            </td>
            <td class="border">
              {{$address->city}}
            </td>
            <td class="border">
              {{$address->town}}
            </td>
            <td class="border">
              {{$address->phone_number}}
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

      <div class="mt-5">
        {{ $addresses->appends(request()->except('page'))->links() }}
      </div>

      <div class="flex justify-center mt-10">
        <form method="GET" action="{{ route('address.export') }}">
          @foreach($search_params as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
          @endforeach
          <button type="submit" class="hover:opacity-75 bg-blue-500 font-semibold text-white py-2 px-4 rounded">
            CSVダウンロード
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>

</html>