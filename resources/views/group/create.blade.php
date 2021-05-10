<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  </head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card" style="margin-top:20px;">
          <div class="card-header">グループ新規登録</div>
          <div class='card-body'>

            @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              
            <form method="POST" action="{{ route('group.store') }}">
              @csrf
              <div class="mb-3">
              <label for="name" class="form-label">グループ名</label>
              <input type="text" class="form-control" id="name" name="name" value="" required>
              </div>

              <input class="btn btn-info" type="submit" name="btn_confirm" value="登録する">
              <a href="{{ route('address.index') }}" class="btn btn-secondary" role="button">戻る</a>
            </form>
          </div>
        </div>
      </div><!-- .col-md-6 --> 
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6">
        @if (session('alert'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong >{{ session('alert') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if (session('success'))
          <div class="alert alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">グループ名</th>
              <th scope="col">所属人数</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach($groups as $group)
              <tr>
                <th scope="row">{{ $group->id }}</th>
                  <td>{{ $group->name }}</td>
                  <td>{{ $group->count }}</td>
                <td>
                  <div class="button-contents">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}">修正</button>
                    <div class="modal fade" id="exampleModal{{ $group->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">グループ名修正</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{ route('group.update', ['id' => $group->id]) }}">
                              @csrf
                              <input type="text" class="form-control" id="" name="name" value="{{ $group->name }}" required>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                              <input class="btn btn-info" type="submit" name="btn_confirm" value="変更">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <form action="{{route('group.destroy')}}" method="post">
                      @csrf
                      @method("delete")
                      <input type="hidden" name="id" value="{{$group->id}}">
                      <input type="submit" value="削除" class="btn btn-sm btn-danger"  onclick='return confirm("削除しますか？");'>
                      
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
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