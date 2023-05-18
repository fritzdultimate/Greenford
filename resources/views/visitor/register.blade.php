@include('visitor.layouts.head')
@include('visitor.layouts.header')
    <div class="content-wrapper">

        <div class="breadcrumb-wrap bg-spring">
            <img src="assets/img/breadcrumb/br-shape-1.png" alt="Image" class="br-shape-one xs-none">
            <img src="assets/img/breadcrumb/br-shape-2.png" alt="Image" class="br-shape-two xs-none">
            <img src="assets/img/breadcrumb/br-shape-3.png" alt="Image" class="br-shape-three moveHorizontal sm-none">
            <img src="assets/img/breadcrumb/br-shape-4.png" alt="Image" class="br-shape-four moveVertical sm-none">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-8 col-sm-8">
                        <div class="breadcrumb-title">
                            <h2>Open Account</h2>
                            <ul class="breadcrumb-menu list-style">
                                <li><a href="/">Home </a></li>
                                <li>Open Accounti>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-4 col-sm-4 xs-none">
                        <div class="breadcrumb-img">
                            <img src="assets/img/breadcrumb/br-shape-5.png" alt="Image" class="br-shape-five animationFramesTwo">
                            <img src="assets/img/breadcrumb/br-shape-6.png" alt="Image" class="br-shape-six bounce">
                            <img src="assets/img/breadcrumb/breadcrumb-3.png" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="account-wrap ptb-100">
            <div class="container">
                <div class="section-title style1 text-center mb-40">
                    <span>Open Account</span>
                    <h2>Account Open Form</h2>
                </div>

                @if ($errors->any())
                <div class="text-center alert-danger p-3 rounded" style="font-size: 20px">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    
                </div>
                @endif

                @if (session('success'))
                <div class="text-center alert-success p-3 rounded" style="font-size: 20px">
                    {{ session('success') }}
                    
                </div>
                @endif


                <form action="/register" class="account-form" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname">Full name</label>
                                <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile_number">Mobile Number</label>
                                <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account_type">Account Type</label>
                                <select name="account_type" id="account_type">
                                    <option disabled>Account Type</option>
                                    <option value="savings account" {{ old('account_type') == 'savings account' ? "selected" : ''}}>Savings Account</option>
                                    <option value="current account" {{ old('account_type') == 'current account' ? "selected" : ''}}>Current Account</option>
                                    <option value="bussiness account" {{ old('account_type') == 'bussiness account' ? "selected" : ''}}>Bussiness Account</option>
                                    <option value="joint account" {{ old('account_type') == 'bussiness account' ? "selected" : ''}}>Joint Account</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob">Date Of Birth</label>
                                <input type="date" id="dob" name="dob" value="{{ old('dob') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender">
                                    <option disabled>Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? "selected" : ''}}>Male </option>
                                    <option value="female" {{ old('gender') == 'female' ? "selected" : ''}}>Female </option>
                                    <option value="others" {{ old('gender') == 'others' ? "selected" : ''}}>Others </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="father_name">Father's name</label>
                                <input type="text" id="father_name" name="father_name" value="{{ old('father_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mother_maiden_name">Mother's name</label>
                                <input type="text" id="mother_maiden_name" name="mother_maiden_name" value="{{ old('mother_maiden_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marital_status">Marital Status</label>
                                <select name="marital_status" id="marital_status">
                                    <option disabled>---</option>
                                    <option value="single" {{ old('marital_status') == 'single' ? "selected" : ''}} >Single</option>
                                    <option {{ old('marital_status') == 'married' ? "selected" : ''}} value="married" >Married</option>
                                    <option value="divorced" {{ old('marital_status') == 'divorced' ? "selected" : ''}}>Divorced</option>
                                    <option value="widow" {{ old('marital_status') == 'widow' ? "selected" : ''}}>Widow</option>
                                    <option value="widower" {{ old('marital_status') == 'widower' ? "selected" : ''}}>Widower</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="spouse_name">Spouse's name</label>
                                <input type="text" id="spouse_name" name="spouse_name" value="{{ old('spouse_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <input type="text" id="nationality" name="nationality" value="{{ old('nationality') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="occupation">Ocupation</label>
                                <input type="text" id="occupation" name="occupation" value="{{ old('occupation') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="monthly_income">Monthly Income</label>
                                <input type="text" id="monthly_income" name="monthly_income" value="{{ old('monthly_income') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="source_of_income">Source Of Income</label>
                                <input type="text" id="source_of_income" name="source_of_income" value="{{ old('source_of_income') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4>Address</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address_1">Address 1</label>
                                <textarea name="address_1" id="address_1" cols="30" rows="10">{{ old('address_1') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address_2">Address 2</label>
                                <textarea name="address_2" id="address_2" cols="30" rows="10">{{ old('address_2') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" value="{{ old('city') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" value="{{ old('state') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="zip_code">ZIP Code</label>
                                <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country" value="{{ old('country') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="repassword" id="confirm_password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn style1 w-100 d-block"> 
                                Open Account
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>
@include('visitor.layouts.footer')