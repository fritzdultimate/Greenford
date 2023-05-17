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
                                <th scope="col">Current Level</th>
                                <th scope="col" class="text-end">Front KYC</th>
                                <th scope="col" class="text-end">Back KYC</th>
                                <th scope="col" class="text-end">Address Proof</th>
                                <th scope="col" class="text-end">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users  as $user)
                            <tr>
                                <th scope="row">{{ $user_settings->user->fullname }}</th>
                                <td>{{ $user_account->kyc_level }}</td>
                                <td><a href="{{asset($user_settings->front_kyc)}}">View Image</a></td>
                                <td><a href="{{asset($user_settings->back_kyc)}}">View Image</a></td>
                                <td><a href="{{asset($user_settings->address_proof)}}">View Image</a></td>
                                <td class="text-end text-primary">
                                    <div class="card-button dropdown">
                                        <button type="button" class="btn btn-link btn-icon" data-bs-toggle="dropdown">
                                            <ion-icon name="ellipsis-horizontal"></ion-icon>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" data-bs-target="#DialogIconedButtonInline" href="#" data-bs-toggle="modal" id="CardActionBtn" data-id="{{ $user->id }}" onclick="suspend(this)">
                                                Upgrade to Tier 2
                                            </a>
                                            <a class="dropdown-item" data-bs-target="#DialogIconedButtonInline" href="#" data-bs-toggle="modal" data-id="{{ $user->id }}" onclick="deleteUser(this)">Upgrade to Tier 3
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
<script src="{{ asset('dash/js/admin.members.js') }}"></script>
@include('admin.layouts.footer')

<script>
    function suspend(event) {
        SUSPENDINGUSERID = event.dataset.id;
        confirmDialogIconedButtonAction.innerHTML = "SUSPEND"
        IconedButtonInlineHeader.innerHTML = "Suspend User";
        IconedButtonInlineMessage.innerHTML = "User will be suspended!"

        console.log(event.dataset.id)
    }

    function deleteUser(event) {
        DELETINGUSERID = event.dataset.id;
        confirmDialogIconedButtonAction.innerHTML = "DELETE"
        IconedButtonInlineHeader.innerHTML = "Delete User";
        IconedButtonInlineMessage.innerHTML = "User will be permanently deleted, this action cannot be reversed?"

        console.log(event.dataset.id);
    }

    // function suspend(event) {
    //     console.log(event.dataset.id)
    // }
</script>