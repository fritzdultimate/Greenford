@include('admin.layouts.header')
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
    <div class="pageTitle">KYC Documents</div>
    <div class="right">
    </div>
</div>
<!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">


        <div class="section mt-2">
            <div class="card">
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-end">Front KYC</th>
                                <th scope="col" class="text-end">Back KYC</th>
                                <th scope="col" class="text-end">Address Proof</th>
                                <th scope="col" class="text-end">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_settings_  as $setting)
                                <tr>
                                    <th scope="row">{{ $setting->user->fullname }}</th>
                                    <td><a href="{{asset($setting->front_kyc)}}">View Image</a></td>
                                    <td><a href="{{asset($setting->back_kyc)}}">View Image</a></td>
                                    <td><a href="{{asset($setting->address_proof)}}">View Image</a></td>
                                    <td class="text-end text-primary">
                                        <div class="card-button dropdown">
                                            <button type="button" class="btn btn-link btn-icon" data-bs-toggle="dropdown">
                                                <ion-icon name="ellipsis-horizontal"></ion-icon>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" data-bs-target="#DialogIconedButtonInline" href="#" data-bs-toggle="modal" id="CardActionBtn" data-id="{{ $setting->user_id }}" data-kyc="tier 1" onclick="upgrade(this)">
                                                    Downgrade to Tier 1
                                                </a>
                                                <a class="dropdown-item" data-bs-target="#DialogIconedButtonInline" href="#" data-bs-toggle="modal" id="CardActionBtn" data-id="{{ $setting->user_id }}" data-kyc="tier 2" onclick="upgrade(this)">
                                                    Upgrade to Tier 2
                                                </a>
                                                <a class="dropdown-item" data-bs-target="#DialogIconedButtonInline" href="#" data-bs-toggle="modal" data-id="{{ $setting->user_id }}" data-kyc="tier 3" onclick="upgrade(this)">Upgrade to Tier 3
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- * App Capsule -->
<script src="{{ asset('dash/js/fn.js') }}"></script>
<script src="{{ asset('dash/js/upgrade-kyc.js') }}"></script>
@include('admin.layouts.footer')

<script>
    function upgrade(event) {
        USERFORKYCID = event.dataset.id;
        KYCTOUPGRADETO = event.dataset.kyc;
        confirmDialogIconedButtonAction.innerHTML = "UPGRADE"
        IconedButtonInlineHeader.innerHTML = "Upgrade KYC";
        IconedButtonInlineMessage.innerHTML = "User's KYC will be ugraded instantly!"

        console.log(event.dataset.id)
    }

    // function suspend(event) {
    //     console.log(event.dataset.id)
    // }
</script>