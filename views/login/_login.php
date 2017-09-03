<form id="login-form" method="post" role="form" action="login/login" style="display: block;">
    <div class="form-group">
        <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email"
               value="" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
    </div>
    <div class="form-group text-center">
        <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
        <label for="remember"> Remember Me</label>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <input type="hidden" name="login_form" value="login_form">
                <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                       class="form-control btn btn-login" value="Log In">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</form>
