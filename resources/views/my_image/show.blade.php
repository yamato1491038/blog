<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  
  </head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">情報登録</div>
          <div class='card-body'>
            <form method="POST" action="{{ route('address.store') }}">
              @csrf
              <div class="mb-3">
              <label for="name" class="form-label">氏名</label>
              <input type="text" class="form-control" id="name" name="name" value="" required>
              </div>

              <div class="mb-3">
              <label for="zip_code" class="form-label">郵便番号</label>
              <input type="text"  class="form-control" id="" name="zip_code" value="" required>
              </div>

              <div class="mb-3">
                <label for="prefecture" class="form-label">都道府県</label>
                  
              </div>

              <div class="mb-3">
                <label for="city" class="form-label">市・町</label>
                <input type="text"  class="form-control" id="city" name="city" value="">
              </div>

              <div class="mb-3">
                <label for="town" class="form-label">番地</label>
                <input type="text"  class="form-control" id="town" name="town" value="">
              </div>
              
              <div class="mb-3">
                <label for="phone_number" class="form-label">電話番号</label>
                <input type="text"  class="form-control" id="phone_number" name="phone_number" value="">
              </div>

              <div class="mb-3">
                <label for="group_id" class="form-label">職業</label>
                  
                </div>

              <input class="btn btn-info" type="submit" name="btn_confirm" value="登録する">
            </form>
          </div>
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