<form id="register-form" method="post" role="form" action="login/signup" style="display: none;">
    <div class="form-group">
        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Name" value="">
    </div>
    <div class="form-group">
        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
    </div>
    <div class="form-group">
        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control"
               placeholder="Confirm Password">
    </div>
    <div class="form-group">
        <div class="g-recaptcha" data-sitekey="<?= \Dykyi\Common\Config::get('recaptcha')['private'] ?>"></div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <input type="hidden" name="register_form" value="register_form">
                <input type="submit" name="register-submit" id="register-submit" tabindex="4"
                       class="form-control btn btn-register" value="Register Now">
            </div>
        </div>
    </div>
</form>
