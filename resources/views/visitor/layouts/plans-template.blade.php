<div class="planbg">
    @foreach($plans as $plan)
    <div class="{{ ($plan->name == "GAS") ? "planbg1" : ( ($plan->name == "PETROLEUM") ? "planbg2" : ( ($plan->name == "ENERGY") ? "planbg3" : ($plan->name == "AGRO CHEMICAL" ? "planbg4" : "planbg5"))) }}">
        <div class="plan-head1">{{ $plan->name }}</div>
        <div class="plan-per">{{ round($plan['interest_rate']) * $plan['duration'] }}%</div>
        <div class="plan-day">After {{ $plan['duration'] }} day(s)</div>
        <div class="plan-min"><img src="images/tik.png"> Min : ${{ round($plan['minimum_amount']) }}</div>
        <div class="plan-max"><img src="images/tik.png"> Max : ${{ round($plan['maximum_amount']) }}</div> 
        <div class="plan-but">
            <a href="/signup">INVEST</a>
        </div>                	
    </div>
    @endforeach
</div>