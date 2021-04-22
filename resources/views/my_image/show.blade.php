<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/my_page.css') }}">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('/js/image_upload.js') }}"></script>

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
                    <img src="{{ Storage::url($my_image->file_path) }}" data-bs-toggle="modal" data-bs-target="#exampleModal" style="height: 100%;" class="rounded-circle"/>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" id="image-box">
                          <form method="post" action="{{ route('my_image.upload') }}" enctype="multipart/form-data">
                            @csrf
                            <input class="image-file" type="file" name="image" accept="image/png, image/jpeg">
                            <input class="id-file" type="hidden" data-uid="{{ Auth::id() }}" name="user_id" value="{{ Auth::id() }}">
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            
                            <input type="submit" class="btn btn-primary" value="Upload">
                          </form>
                          </div>
                        </div>
                      </div>
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