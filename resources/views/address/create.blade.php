createです
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
    <div class="row">
      <div class="col-md-6">
        <form method="POST" action="input2.php">
          <div class="mb-3">
          <label for="your_name" class="form-label">氏名</label>
          <input type="text" class="form-control" id="your_name" name="your_name" value="<?php if(!empty($_POST['your_name'] ))echo h($_POST['your_name']) ; ?>" required>
          </div>

          <div class="mb-3">
          <label for="email" class="form-label">メールアドレス</label>
          <input type="email"  class="form-control" id="email" name="email" value="<?php  if(!empty($_POST['email'] ))echo h($_POST['email']) ; ?>" required>
          </div>

          <div class="mb-3">
          <label for="url" class="form-label">ホームページ</label>
          <input type="url"  class="form-control" id="url" name="url" value="<?php  if(!empty($_POST['url'] ))echo h($_POST['url']) ; ?>">
          </div>

          <div class="mb-3">
            <label for="gender" class="form-label">性別</label>
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="gender1" name="gender" value="0"<?php  if(!empty($_POST['gender']) && $_POST['gender'] === '0'){ echo 'checked'; } ?>>
              <label class="form-check-label" for="gender1">男性</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="gender2" name="gender" value="1"<?php  if(!empty($_POST['gender']) && $_POST['gender'] === '1'){ echo 'checked'; } ?>>
                <label class="form-check-label" for="gender2">女性</label>
              </div>
          </div>

          <div class="mb-3">
            <label for="age" class="form-label">年齢</label>
              <select  class="form-select"name="age">
                <option value="">選択してください</option>
                <option value="1">～19歳</option>
                <option value="2">20～29歳</option>
                <option value="3">30～39歳</option>
                <option value="4">40～49歳</option>
                <option value="5">50～59歳</option>
                <option value="6">60歳～</option>
              </select>
          </div>

          <div class="mb-3">
            <label for="contact" class="form-label">お問い合わせ内容</label>
            <textarea class="form-control" id="contact" rows="3" name="contact"><?php  if(!empty($_POST['contact'] ))echo h($_POST['contact']) ; ?></textarea>
          </div>

          <div class="mb-3">
            <input type="checkbox" class="form-check-input" name="caution" value="1"id="caution">
            <label class="form-check-label" for="caution">注意事項にチェックする</label>
            </div>

          <input class="btn btn-info" type="submit" name="btn_confirm" value="確認する">
        </form>
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