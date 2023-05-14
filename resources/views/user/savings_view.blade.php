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
                <div class="price">$ {{ number_format($save->target, 2, '.', ',') }}</div>
            </div>
            <div class="progress text-center">
                <div class="progress-bar text-center" role="progressbar" style="width: {{ number_format($save->saved/($save->target/100))  }}%;" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100">{{ number_format($save->saved/($save->target/100), 2)  }}%</div>
            </div>
        </div>
        <!-- * item -->
    @endforeach
        
    </div>

</div>

</div>
<!-- * App Capsule -->
@include('user.layouts.general-scripts')
@include('user.layouts.footer')