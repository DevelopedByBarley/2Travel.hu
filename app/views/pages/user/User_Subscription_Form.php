<?php if (!isset($params["isRegistered"])) : ?>
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col text-center">
                <h1>Registration</h1>
            </div>
        </div>
        <hr />

        <form action="/user/register" method="POST" class="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-lg-4 mb-2">
                    <div class="form-outline">
                        <label class="form-label" for="form8Example3">Vezetkénév</label>
                        <input type="text" id="form8Example3" class="form-control" placeholder="Vezetkénév" name="firstName" value="<?= $params["values"]["firstName"] ?? "" ?>" style="border: <?php echo (!isset($params["errorMessages"]["firstName"])) ? '2px solid green' : '2px solid red'; ?>" />

                    </div>
                </div>
                <div class="col-xs-12 col-lg-4 mb-2">
                    <!-- Name input -->
                    <div class="form-outline">
                        <label class="form-label" for="form8Example4">Keresztnév</label>
                        <input type="text" id="form8Example4" class="form-control" placeholder="Keresztnév" name="lastName" value="<?= $params["values"]["lastName"] ?? "" ?>" style="border: <?php echo (!isset($params["errorMessages"]["lastName"])) ? '2px solid green' : '2px solid red'; ?>"/>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-4 mb-2">
                    <div class="form-outline">
                        <label class="form-label" for="form8Example5">Kor</label>
                        <input type="number" id="form8Example5" class="form-control" placeholder="Kor" name="age" value="<?= $params["values"]["age"] ?? "" ?>" style="border: <?php echo (!isset($params["errorMessages"]["age"])) ? '2px solid green' : '2px solid red'; ?>"/>
                    </div>
                </div>
                <div class=" col-xs-12 col-lg-6 mb-2">
                        <div class="form-outline">
                            <label class="form-label" for="form8Example5">E-mail</label>
                            <input type="email" id="form8Example5" class="form-control" placeholder="E-mail" name="email" value="<?= $params["values"]["email"] ?? "" ?>" style="border: <?php echo (!isset($params["errorMessages"]["email"])) ? '2px solid green' : '2px solid red'; ?>"/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-6 mb-2">
                        <div class="form-outline">
                            <label class="form-label" for="form8Example5">Jelszó</label>
                            <input type="password" id="form8Example5" class="form-control" placeholder="Jelszó" name="password" value="<?= $params["values"]["password"] ?? "" ?>" style="border: <?php echo (!isset($params["errorMessages"]["password"])) ? '2px solid green' : '2px solid red'; ?>"/>
                        </div>
                    </div>
                    <div class="col-xs-12 mb-2">
                        <div class="form-outline">
                            <label class="form-label" for="form8Example5">Nemzetiség</label>
                            <input type="text" id="form8Example5" class="form-control" placeholder="Nemzetiség" name="nationality" value="<?= $params["values"]["nationality"] ?? "" ?>" style="border: <?php echo (!isset($params["errorMessages"]["nationality"])) ? '2px solid green' : '2px solid red'; ?>"/>
                        </div>
                    </div>
                    <div class="col-xs-12 mb-2">
                        <div class="form-outline">
                            <label class="form-label" for="form8Example5">Ország</label>
                            <input type="text" id="form8Example5" class="form-control" placeholder="Ország" name="country" value="<?= $params["values"]["country"] ?? "" ?>" style="border: <?php echo (!isset($params["errorMessages"]["country"])) ? '2px solid green' : '2px solid red'; ?>"/>
                        </div>
                    </div>
                    <div class="mt-3 mb-3">
                        <label for="formFile" class="form-label">Profilkép feltöltése</label>
                        <input class="form-control" type="file" id="formFile" name="files">
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-info mt-2">Regisztráció</button>
                <div>
                    <a href="/user?isRegistered=1" class="d-inline-block mt-2 mb-5">Ha regisztráltál már jelentkezz be!</a>
                </div>
        </form>
    </div>

<?php else : ?>





    <form id="login-form" action="/user/login" method="POST" class="text-center">
        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="email" id="form1Example1" class="form-control" name="email" />
            <label class="form-label" for="form1Example1">Email</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input type="password" id="form1Example2" class="form-control" name="password" />
            <label class="form-label" for="form1Example2">Password</label>
        </div>

        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">

            <div class="col">
                <!-- Simple link -->
                <a href="#!">Forgot password?</a>
            </div>
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Sign in</button>

        <div>
            <a href="/user" class="d-inline-block mt-2 mb-5">Nincs még profilod? Regisztráció</a>
        </div>
    </form>

<?php endif ?>