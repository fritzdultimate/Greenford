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
            Upgrade
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
        @csrf
        @if(!$user_settings->front_kyc)
        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <div href="#">
                    <img src="{{ asset('app_assets/img/sample/photo/document.jpg') }}" alt="avatar" class="imaged w100 rounded" id="front-kyc">
                    <label for="front_kyc">
                        <span class="button">
                            <ion-icon name="camera-outline"></ion-icon>
                        </span>
                    </label>
                </div>
            </div>
            <div>
                @csrf
                <input id="front_kyc" type="file" accept="image/*" name="front_kyc" class="document_file" style="display: none" data-img="front-kyc">
            </div>
            <div class="mt-1">
            <p>
                Upload the front cover of any of your valid ID card, which have the same name as with the name used for acount registration with us.
            </p>
            <p>Note that every details should be well shown.</p>
            </div>
        </div>
        @endif

        @if(!$user_settings->back_kyc)
        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <div href="#">
                    <img src="{{ asset('app_assets/img/sample/photo/document.jpg') }}" alt="avatar" class="imaged w100 rounded" id="back-kyc">
                    <label for="back_kyc">
                        <span class="button">
                            <ion-icon name="camera-outline"></ion-icon>
                        </span>
                    </label>
                </div>
            </div>
            <div>
                @csrf
                <input id="back_kyc" type="file" accept="image/*" name="back_kyc" class="document_file" style="display: none" data-img="back-kyc">
            </div>
            <div class="mt-1">
                <p>
                    Upload the back cover of any of your valid ID card of which you uploaded the front.
                </p>
                <p>Note that every details should be well shown.</p>
            </div>
        </div>
        @endif

        @if(!$user_settings->address_proof)
        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <div href="#">
                    <img src="{{ asset('app_assets/img/sample/photo/document.jpg') }}" alt="avatar" class="imaged w100 rounded" id="proof-kyc">
                    <label for="address_proof">
                        <span class="button">
                            <ion-icon name="camera-outline"></ion-icon>
                        </span>
                    </label>
                </div>
            </div>
            <div>
                @csrf
                <input id="address_proof" type="file" accept="image/*" name="address_proof" class="document_file" style="display: none" data-img="proof-kyc">
            </div>
            <div class="mt-1">
                <p>
                    Upload a proof of your address, this can be a utility bill paid not more than two months ago.
                </p>
                <p>We recommend uploading a utility bill as this is more easier to verify.</p>
            </div>
        </div>
        @endif

    </div>
    <!-- * App Capsule -->

@include('user.layouts.general-scripts')
@include('user.layouts.footer')

<script>
    let host = location.origin;
    let urlPrefix = host + '/app/setting/';
    let file_elements = document.querySelectorAll('.document_file');
    [...file_elements].forEach(elem => {
        elem.addEventListener('change', env => {
            const [file] = elem.files;
            if(file) {
                document.getElementById(elem.dataset.img).src = URL.createObjectURL(file);

                let form_data = new FormData();
                form_data.append('kyc_file', elem.files[0]);
                form_data.append('html_named', elem.name);
                form_data.append('_token', document.getElementsByName('_token')[0].value);

                let ajax_request = new XMLHttpRequest();
                ajax_request.open('POST', urlPrefix + "uploadKycFile");
                ajax_request.upload.addEventListener('progress', function(event) {
                    let percent_completed = Math.round((event.loaded / event.total) * 100);
                    console.log(percent_completed);
                });
                ajax_request.addEventListener('load', function(event) {
                    let file_data = JSON.parse(event.target.response);
                    console.log(file_data.success.message[0])
                    showSuccessModal(file_data.success.message[0], [''])
                });

                ajax_request.send(form_data)
            }
        })
        console.log(elem.name)
    })


</script>