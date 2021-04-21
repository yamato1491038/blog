<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <table class="table">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">
                  <div class="low-title">
                    マイページ
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">名前</th>
                <td>
                  <div class="low-style">
                    {{ $user_info->name }}
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">メールアドレス</th>
                <td>
                  <div class="low-style">
                    {{ $user_info->email }}
                  </div>
                </td>
                
              </tr>
              <tr>
                <th scope="row">プロフ画像</th>
                <td>
                  <div class="low-image">
                    <img src="{{ Storage::url($my_image->file_path) }}" style="height: 100%;" class="rounded-circle"/>
                    <div class="low-image_text">
                      変更
                      <form method="post" action="{{ route('my_image.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" accept="image/png, image/jpeg">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="submit" value="Upload">
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">パスワード等詳細変更</th>
                <td>
                  <div class="low-style">
                  <a href="{{ route('profile.show') }}" class="btn btn-outline-info" role="button">変更</a>
                  </div>
                </td>
                
              </tr>
            </tbody>
          </table>
          </div>
        </div><!-- .col-md-6 --> 
      </div>
    </div>

  <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
      -->
  </body>
</html>