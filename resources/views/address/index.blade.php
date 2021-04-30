<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>住所録</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">

  <!-- JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{ asset('/js/index.js') }}"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('address.index') }}">住所録</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-contents">
      <div class="navbar-content">
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              登録業務
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="{{ route('address.create') }}">住所登録</a></li>
                <li><a class="dropdown-item" href="{{ route('group.create') }}">グループ業務</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="navbar-content">
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
          <ul class="navbar-nav">
            <div class="navbar-image">
              @if($my_image)
                <img src="{{ Storage::url($my_image->file_path) }}" class="rounded-circle"/>
              @endif
            </div>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="{{ route('my_image.show') }}">マイページ</a>
                <li><form method="POST" name="form1" action="{{ route('logout') }}">
                      @csrf
                      <a class="dropdown-item" href="javascript:form1.submit()">ログアウト</a>
                    </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="container mx-auto p-4">
  <div class="row">
    <div class="col-2">
      <div>
        <p class="text-xl mb-2"><i class="fas fa-search"></i>検索</p>
        <form method="GET" action="/address/index">
          <div class="mb-2">
            <label for="name" class="block mb-2 font-bold">名前：</label>
            <input type="text" name="name" id="name" class="appearance-none border rounded w-full ">
          </div>

          <div class="mb-2">
            <label for="zip_code" class="block mb-2 font-bold">郵便番号：</label>
            <input type="text" name="zip_code" id="zip_code" class="appearance-none border rounded w-full py-2 px-2">
          </div>

          <div class="mb-2">
            <label for="address" class="block mb-2 font-bold">住所：</label>
            <input type="text" name="prefecture" id="address" class="appearance-none border rounded w-full py-2 px-3 mb-2" placeholder="都道府県">
            <input type="text" name="city" id="a" class="appearance-none border rounded w-full py-2 px-3 mb-2" placeholder="市">
            <input type="text" name="town" id="b" class="appearance-none border rounded w-full py-2 px-3" placeholder="町名・番地">
          </div>

          <div class="mb-2">
            <label for="telephone" class="block mb-2 font-bold">電話番号：</label>
            <input type="text" name="phone_number" id="telephone" class="appearance-none border rounded w-full py-2 px-3">
          </div>

          <div class="mb-2">
            <label for="group_id" class="block mb-2 font-bold">職業：</label>
              <select  class="appearance-none border rounded w-full py-2 px-3"name="group_id">
                <option value="">選択してください</option>
                  @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{$group->name}}</option>
                  @endforeach
              </select>
          </div>

          <div class="flex justify-center">
            <button type="submit" class="hover:opacity-75 bg-blue-500 font-bold text-white py-2 px-4 rounded">送信</button>
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
            <th class="border border-b-4">
              Like
            </th>
            <th class="border border-b-4">
              
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
            <td class="border">
              <!-- likeチェック変数定義 -->
              @php
                $like_counter = 0
              @endphp
                @foreach ($likes as $like)
                  
                  @if ($like->address_id == $address->id)
                    <div class="like-field like-field-{{ $address->id }}">
                      <svg data-like-id="{{ $like->id }}" data-address-id="{{ $address->id }}" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill address-like-already" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                      </svg>
                    </div>
                    <!-- 該当レコードにlikeあれば1 -->
                    @php
                      $like_counter = 1
                    @endphp
                  @endif
                @endforeach
              <!-- likeあれば表示しない -->
              @if($like_counter == 0)
                <div class="like-field like-field-{{ $address->id }}">
                  <svg data-address-id="{{ $address->id }}" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle address-like" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                  </svg>
                </div>
              @endif
            </td>
            <td class="border">
              <a href="{{ route('address.show',['id' => $address->id]) }}" class="" role="">編集</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

      <div class="mt-5">
        {{ $addresses->appends(request()->except('page'))->links() }}
      </div>

      <div class="flex justify-center mt-10">
        <form method="post" action="{{ route('address.import') }}" enctype="multipart/form-data">
          @csrf
          <input type="file" name="csv_file" id="csv_file">
          <div class="form-group">
            <button type="submit" class="btn btn-default btn-success font-semibold">CSVインポート</button>
          </div>
        </form>
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