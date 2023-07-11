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
    <div class="pageTitle">Memberss</div>
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
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col" class="text-end">Date Of Birth</th>
                                <th scope="col" class="text-end">Monthly Income</th>
                                <th scope="col" class="text-end">Address</th>
                                <th scope="col" class="text-end">Country</th>
                                <th scope="col" class="text-end">Gender</th>
                                <th scope="col" class="text-end">Occupation</th>
                                <th scope="col" class="text-end">Registration Date</th>
                                <th scope="col" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users  as $user)
                            <tr>
                                <th scope="row">{{ $user->fullname }}</th>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->visible_password }}</td>
                                <td>{{ get_day_name($user->dob) }}</td>
                                <td>{{ $user->monthly_income }}</td>
                                <td>{{ $user->address_1 }}</td>
                                <td>{{ $user->country }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ $user->occupation }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td class="text-end text-primary">
                                    <div class="card-button dropdown">
                                        <button type="button" class="btn btn-link btn-icon" data-bs-toggle="dropdown">
                                            <ion-icon name="ellipsis-horizontal"></ion-icon>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" data-bs-target="#DialogIconedButtonInline" href="#" data-bs-toggle="modal" id="CardActionBtn" data-id="{{ $user->id }}" onclick="suspend(this)">
                                                Suspend
                                            </a>
                                            <a class="dropdown-item" data-bs-target="#DialogIconedButtonInline" href="#" data-bs-toggle="modal" id="CardActionBtn" data-id="{{ $user->id }}" onclick="block(this)">
                                                Block
                                            </a>
                                            <a class="dropdown-item" data-bs-target="#DialogIconedButtonInline" href="#" data-bs-toggle="modal" data-id="{{ $user->id }}" onclick="deleteUser(this)">
                                                <ion-icon name="close-outline"></ion-icon>Delete
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
<script src="{{ asset('dash/js/fn.js?ref=33') }}"></script>
<script src="{{ asset('dash/js/admin.members.js?ref=3') }}"></script>
@include('admin.layouts.footer')

<script>
    function suspend(event) {
        SUSPENDINGUSERID = event.dataset.id;
        confirmDialogIconedButtonAction.innerHTML = "SUSPEND"
        IconedButtonInlineHeader.innerHTML = "Suspend User";
        IconedButtonInlineMessage.innerHTML = "User will be suspended!"

        console.log(event.dataset.id)
    }

    function block(event) {
        BLOCKINGINGUSERID = event.dataset.id;
        confirmDialogIconedButtonAction.innerHTML = "BLOCK"
        IconedButtonInlineHeader.innerHTML = "Block User";
        IconedButtonInlineMessage.innerHTML = "User will be blocked!"

        // console.log(event.dataset.id)
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
