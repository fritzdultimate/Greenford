@include('user.layouts.header')
<!-- App Header -->
<div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            My Savings
        </div>
        <!-- <div class="right">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#actionSheetForm">
                <ion-icon name="add-outline"></ion-icon>
            </a>
        </div> -->
    </div>
    <!-- * App Header -->

<!-- App Capsule -->
<div id="appCapsule">

<div class="section mt-2 mb-2">

    <div class="goals">

    @foreach($savings as $save)
        <!-- item -->
        <div class="item">
            <div class="in">
                <div>
                    <h4>{{ ucfirst($save->name) }}</h4>
                    <p>{{ ucfirst($save->description) }}</p>
                </div>
                <div class="price">{{ get_currency_symbol($user_settings->currency)  }} {{ currency_conversion($user_settings->currency, $save->target) }}</div>
            </div>
            <div class="progress text-center">
                <div class="progress-bar text-center" role="progressbar" style="width: {{ currency_conversion($user_settings->currency, $save->saved/($save->target/100)) }}%;" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100">{{ currency_conversion($user_settings->currency, $save->saved/($save->target/100)) }}%</div>
            </div>
        </div>
        <!-- * item -->
    @endforeach
        
    </div>

    @if($savings->count() == 0)
        <div class="flex justify-center content-center" style="display: flex; justify-content: center; height: 100%; align-items: center; flex-direction: column; font-size: 15px;">
            You have not created any savings goal yet!

            <div class="form-group basic">
                <a href="/user/savings/create" class="btn btn-primary btn-block btn-lg" data-bs-dismiss="modalk">Create Savings goal</a>
            </div>
        </div>
    @endif

</div>

</div>
<!-- * App Capsule -->
@include('user.layouts.general-scripts')
@include('user.layouts.footer')