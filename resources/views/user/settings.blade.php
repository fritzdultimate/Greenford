@include('user.layouts.header')
@include('user.dialogbox.error-modal')
@include('user.dialogbox.success-modal')
@include('user.dialogbox.iconed-button-inline')
    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Settings
        </div>
        <div class="right">
            <a href="/user/notifications" class="headerButton">
                <ion-icon class="icon" name="notifications-outline"></ion-icon>
                <span class="badge badge-danger">4</span>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <div href="#">
                    <img src="{{$user_settings->profile_image_url ? asset($user_settings->profile_image_url) : asset('app/img/sample/avatar/avatar1.png') }}" alt="avatar" class="imaged w100 rounded" id="avatar">
                    <label for="profile_image">
                        <span class="button">
                            <ion-icon name="camera-outline"></ion-icon>
                        </span>
                    </label>
                </div>
            </div>
            <div>
                @csrf
                <input id="profile_image" type="file" accept="image/*" name="profile_image" style="display: none">
            </div>
            <div class="mt-1">
            <span class="badge badge-primary">{{ $user_account->kyc_level }}</span>
            </div>
        </div>

        <div class="listview-title mt-1">Theme</div>
        <ul class="listview image-listview text inset no-line">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Dark Mode
                        </div>
                        <div class="form-check form-switch  ms-2">
                            <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodeSwitch" name="mode" onchange="toggleMode()" {{ $user_settings->dark_mode ? 'checked' : '' }}>
                            <label class="form-check-label" for="darkmodeSwitch"></label>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <div class="listview-title mt-1">Notifications</div>
        <ul class="listview image-listview text inset">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Transaction Email Alert
                            <div class="text-muted">
                                Send email when new transaction is initiated
                            </div>
                        </div>
                        <div class="form-check form-switch  ms-2">
                            <input class="form-check-input" type="checkbox" id="SwitchCheckDefault1" name="enable_email_notification" onchange="toggleTransactionEmails()" {{ $user_settings->transaction_emails ? 'checked' : '' }}>
                            <label class="form-check-label" for="SwitchCheckDefault1"></label>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <div class="listview-title mt-1">Upgrade</div>
        <ul class="listview image-listview text mb-2 inset">
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Upgrade Account</div>
                    </div>
                </a>
            </li>
        </ul>

        <div class="listview-title mt-1">Security</div>
        <ul class="listview image-listview text mb-2 inset">
            <li>
                <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#passwordFormActionSheet">
                    <div class="in">
                        <div>Update Password</div>
                    </div>
                </a>
            </li>
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            2 Step Verification
                        </div>
                        <div class="form-check form-switch ms-2">
                            <input class="form-check-input" type="checkbox" id="SwitchCheckDefault3" name="twofac" onchange="toggleTwoFactor()" {{ $user_settings->twofac ? 'checked' : '' }} />
                            <label class="form-check-label" for="SwitchCheckDefault3"></label>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#DialogIconedButtonInline" onclick="logoutAllDevices()">
                    <div class="in">
                        <div>Log out all devices</div>
                    </div>
                </a>
            </li>
        </ul>

        <div class="listview-title mt-1">Others</div>
        <ul class="listview image-listview text mb-2 inset">
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Report Scam</div>
                    </div>
                </a>
            </li>

            <li>
                <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#AboutUsModal">
                    <div class="in">
                        <div>About {{ env('SITE_NAME') }}</div>
                    </div>
                </a>
            </li>

            <li>
                <a href="mailto:support@greenfordcreditunion.com" class="item">
                    <div class="in">
                        <div>Help And Feedback</div>
                    </div>
                </a>
            </li>

            <li>
                <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#ModalBasic">
                    <div class="in">
                        <div>FAQs</div>
                    </div>
                </a>
            </li>
        </ul>


    </div>
    <!-- * App Capsule -->

    <!-- Update Password Action Sheet -->
    <div class="modal fade action-sheet" id="passwordFormActionSheet" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Password</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content" id="modalContentSavings">
                        <form class="change-password-form">
                            <div class="form-group basic">
                                <label class="label">Password</label>
                                <div class="input-group mb-2">
                                    <input type="password" class="form-control" placeholder="" name="password">
                                </div>
                            </div>

                            <div class="form-group basic">
                                <label class="label">Confirm Password</label>
                                <div class="input-group mb-2">
                                    <input type="password" class="form-control" placeholder="" name="confirm_password">
                                </div>
                            </div>

                            <div class="form-group basic">
                                <button type="button" class="btn btn-primary btn-block btn-lg change-password-btn">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * Update Password Action Sheet -->

    <!-- FAQs -->
    <div class="modal fade modalbox" id="ModalBasic" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Frequently Asked Questions</h5>
                    <a href="#" data-bs-dismiss="modal">Close</a>
                </div>
                <div class="modal-body">
                    <div class="section full mt-2">
                        <div class="accordion" id="accordionExample1">
                            @foreach($faqs as $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#accordion0{{  $faq->id }}">
                                        {{  $faq->question }}
                                    </button>
                                </h2>
                                <div id="accordion0{{  $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample1">
                                    <div class="accordion-body">
                                    {{  $faq->answer }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * FAQs -->

    <!-- About {{ env('SITE_NAME') }} -->
    <div class="modal fade modalbox" id="AboutUsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">About {{ env('SITE_NAME') }}</h5>
                    <a href="#" data-bs-dismiss="modal">Close</a>
                </div>
                <div class="modal-body">
                    <p>SOme few text</p>
                </div>
            </div>
        </div>
    </div>
    <!-- * About {{ env('SITE_NAME') }} -->

@include('user.layouts.general-scripts')
<script src="{{ asset('dash/js/settings.js') }}"></script>
@include('user.layouts.footer')

<script>
    IconedButtonInlineHeader.innerHTML = "Logout from all other devices?"
    IconedButtonInlineMessage.innerHTML = "Other devices currently logged in will be logged out immediately.";

    function logoutAllDevices() {
        LOGOUTALLDEVICES = true;
    }

    profile_image.onchange = env => {
        const [file] = profile_image.files;
        if(file) {
            avatar.src = URL.createObjectURL(file);

            let form_data = new FormData();
            form_data.append('profile_image', profile_image.files[0]);
            form_data.append('_token', document.getElementsByName('_token')[0].value);


            let ajax_request = new XMLHttpRequest();
            ajax_request.open('POST', urlPrefix + "uploadImage");
            ajax_request.upload.addEventListener('progress', function(event) {
                let percent_completed = Math.round((event.loaded / event.total) * 100);
                console.log(percent_completed);
            });
            ajax_request.addEventListener('load', function(event) {
                let file_data = JSON.parse(event.target.response);
                console.log(file_data)
                showSuccessModal("Profile Image Uploaded successfully!", [''])
            });

            ajax_request.send(form_data)

            
        }
    }
</script>