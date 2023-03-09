<form id="login-form" action="/user/authenticate?id=<?= $params["userId"] ?>" method="POST">

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="number" id="form1Example2" class="form-control" name="code" />
        <label class="form-label" for="form1Example2">Password</label>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
</form>