@include('visitor.layouts.head')
@include('visitor.layouts.header')

<div id="wrapper" class="plan-bg" style="    padding-bottom: 50px;">
	<div class="wrap">
    	<div class="plan">
        <div class="main_headline">
            <div class="container">
                <div class="bg_line bg_line_29 line_move_2">
                    <span class="long_line long_line_8"></span>
                    <span class="bg_round"></span>
                </div>
                <div class="bg_line bg_line_30 line_move">
                    <span class="long_line long_line"></span>
                </div>
                
                <div class="bg_line bg_line_31 line_move_3">
                    <span class="bg_round"></span>
                    <span class="bg_round"></span>
                    <span class="long_line long_line_10"></span>
                </div>
                
                <div class="bg_line bg_line_32 line_move">
                    <span class="long_line long_line_10"></span>
                </div>
                
                <div class="bg_line bg_line_33 line_move_2">
                    <span class="bg_round"></span>
                    <span class="bg_round"></span>
                    <span class="long_line long_line_10"></span>
                </div>
                
                <div class="bg_line bg_line_34 line_move_3">
                    <span class="bg_round bg_round_1"></span>
                    <span class="long_line"></span>
                    <span class="bg_round"></span>
                </div>
                
                <div class="bg_line bg_line_35 line_move">
                    <span class="long_line long_line_10"></span>
                    <span class="bg_round"></span>
                    <span class="bg_round"></span>
                </div>
                
                <div class="bg_line bg_line_36 line_move_3">
                    <span class="bg_round"></span>
                    <span class="long_line"></span>
                </div>
                
                <div class="bg_line bg_line_37 line_move_2">
                    <span class="long_line"></span>
                    <span class="bg_round"></span>
                </div>
            </div>
            
			<div class="text-center">
                <h1 class="wow slideInUp" style="visibility: visible; animation-name: slideInUp;">Investment Plan</h1>
            </div>
        </div>
			<div class="plan-head">
            	<h2 class="line">
                	<span> Investment Profit </span>
                </h2>
            </div>
            
            @include('visitor.layouts.plans-template')
            
		</div>
    </div>
</div><div class="clear"></div>

@include('visitor.layouts.footer')