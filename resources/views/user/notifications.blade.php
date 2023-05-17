@include('user.layouts.header')

    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Notifications
        </div>
        <div class="right">
            <a href="#" class="headerButton" onclick="toastbox('toast-example-1', 3000)">
                <ion-icon name="notifications-off-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- toast bottom iconed -->
    <div id="toast-example-1" class="toast-box toast-bottom bg-primary">
        <div class="in">
            <ion-icon name="notifications-off-outline"></ion-icon>
            <div class="text">
                Notification sounds have been muted
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-text-light close-button">OK</button>
    </div>
    <!-- * toast bottom iconed -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section full">

            <ul class="listview image-listview flush">
                @foreach($notifications as $notification)
                <li class="{{ $notification->seen ? '' : 'active' }}">
                    <a href="#" class="item">
                        
                        @if($notification->type == 'credit')
                        <div class="icon-box bg-primary">
                            <ion-icon name="arrow-down-outline"></ion-icon>
                        </div>
                        @elseif($notification->type == 'debit')
                        <div class="icon-box bg-success">
                            <ion-icon name="arrow-forward-outline"></ion-icon>
                        </div>
                        @else
                        <div class="icon-box bg-danger">
                            <ion-icon name="key-outline"></ion-icon>
                        </div>
                        @endif
                        <div class="in">
                            <div>
                                <div class="mb-05"><strong>{{ ucfirst($notification->title) }}</strong></div>
                                <div class="text-small mb-05">{{ ucfirst($notification->message) }}</div>
                                <div class="text-xsmall">{{ get_day_name($notification->created_at) }}</div>
                            </div>
                            <span class="{{ $notification->seen ? '' : 'badge badge-primary badge-empty' }}"></span>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>

        </div>

    </div>
    <!-- * App Capsule -->

@include('user.layouts.general-scripts')
@include('user.layouts.footer')