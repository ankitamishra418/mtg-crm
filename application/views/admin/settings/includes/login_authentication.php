<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div role="tabpanel" class="tab-pane" id="login_authentication">

    <div class="form-group">

        <label class="control-label">
            Admin Login Type
        </label>

        <div class="radio radio-primary">
            <input type="radio"
                   id="login_with_otp"
                   name="settings[login_type]"
                   value="with_otp"
                   <?php if(get_option('login_type') == 'with_otp'){echo 'checked';} ?>>

            <label for="login_with_otp">
                Login With OTP
            </label>
        </div>

        <div class="radio radio-primary">
            <input type="radio"
                   id="login_without_otp"
                   name="settings[login_type]"
                   value="without_otp"
                   <?php if(get_option('login_type') == 'without_otp'){echo 'checked';} ?>>

            <label for="login_without_otp">
                Login Without OTP
            </label>
        </div>

    </div>

</div>
