<div class="container text-center">
  <div class="row">
    <div class="col">
      <h1 class="user-name text-center"><?= $params["user"]["firstName"] ?> <?= $params["user"]["lastName"] ?></h1>
      <img src="./public/images/userImages/<?= $params["userImage"] ?>" class="border mt-3 mb-5" style="height: 150px; width: 150px;border-radius: 50%" />
    </div>
    <div class="row mt-5 p-2">
      <div class="col-lg-3 border">
        <h4>Email</h4>
        <p> <?= $params["user"]["email"] ?></p>
      </div>
      <div class="col-lg-3 border">
        <h4>Password</h4>
        <p> ********* </p>
      </div>
      <div class="col-lg-3 border">
        <h4>Nationality</h4>
        <p> <?= $params["user"]["nationality"] ?></p>
      </div>
      <div class="col-lg-3 border">
        <h4>Country</h4>
        <p> <?= $params["user"]["country"] ?></p>
      </div>
    </div>
  </div>
  <br><br><br>
  <div class="row">
    <h3>Your Profile is created at</h3>
    <p><?= date('m/d/Y H:i:s', $params["user"]["createdAt"]) ?></p>
  </div>
</div>