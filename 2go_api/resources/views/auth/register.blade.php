@extends('layouts.master')

@section('masterContent')
    <div class="left main_content">
        <div class="inner">
            <div class="breadcrumbs">
                <div class="inner">
                    <h2 class="uk-h2">User Add</h2>
                </div>
            </div> <!--breadcrumbs-->

            <div class="content_wrap">

                <div class="uk-width-1">
                    <a href="admin/userList/Do/Add" class="uk-button"><i class="fa fa-plus"></i> Add New</a>
                    <a href="admin/userList" class="uk-button"><i class="fa fa-list"></i> List</a>
                </div>

                <div class="spacer"></div>
                <form class="uk-form uk-form-horizontal forms" id="forms" method="POST"
                      action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <input type="hidden" value="addAdminUser" name="action" id="action"/><input type="hidden" value=""
                                                                                                name="id"
                                                                                                id="id"/><input
                            type="hidden" value="admin/userList/Do/Add" name="redirect" id="redirect"/><input
                            type="hidden" value="eb82d2bdfa475b4f9894d5c5546f554507f899a8" name="YII_CSRF_TOKEN"
                            id="YII_CSRF_TOKEN"/>
                    <div class="form-group">
                        <label>First Name</label>
                        <input id="firstName" type="text" class="form-control" name="firstName"
                               value="{{ old('firstName') }}" required autofocus>

                        @if ($errors->has('firstName'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>

                        <input id="lastName" type="text" class="form-control" name="lastName"
                               value="{{ old('lastName') }}" required autofocus>

                        @if ($errors->has('lastName'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Email address</label>

                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Mobile</label>
                        <input class="form-control" type="number"
                               name="mobile" id="mobile" required/>
                        @if ($errors->has('mobile'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Address(Optional)</label>
                        <input class="form-control" type="text"
                               name="address" id="address"/>
                        @if ($errors->has('address'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Pincode(Optional)</label>
                        <input class="form-control" type="text"
                               name="pincode" id="pincode"/>
                        @if ($errors->has('pincode'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('pincode') }}</strong>
                                    </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>


                    {{--<h4>User Access</h4>

                    <a href="javascript:;" class="admin-select-access">Select All</a>
                    |
                    <a href="javascript:;" class="admin-unselect-access">Unselect All</a>

                    <ul class="admin-access-list">
                        <li>
                            <input value="autologin" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/>Merchant Auto login
                        </li>
                        <li>
                            <input value="dashboard" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-home"></i>Dashboard

                        </li>
                        <li>
                            <input value="merchant" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-cutlery"></i>Merchant List

                        </li>
                        <li>
                            <input value="sponsoredMerchantList" class="icheck admin-acess" type="checkbox"
                                   name="user_access[]" id="user_access"/><i class="fa fa-list-alt"></i>Sponsored
                            Listing

                        </li>
                        <li>
                            <input value="packages" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Packages

                        </li>
                        <li>
                            <input value="Cuisine" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Cuisine

                        </li>
                        <li>
                            <input value="dishes" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Dishes

                        </li>
                        <li>
                            <input value="OrderStatus" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Order Status

                        </li>
                        <li>
                            <input value="settings" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Settings

                        </li>
                        <li>
                            <input value="themesettings" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Theme settings

                        </li>
                        <li>
                            <input value="zipcode" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Post codes

                        </li>
                        <li>
                            <input value="commisionsettings" class="icheck admin-acess" type="checkbox"
                                   name="user_access[]" id="user_access"/><i class="fa fa-list-alt"></i>Commission
                            Settings

                        </li>
                        <li>
                            <input value="voucher" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Voucher

                        </li>
                        <li>
                            <input value="merchantcommission" class="icheck admin-acess" type="checkbox"
                                   name="user_access[]" id="user_access"/><i class="fa fa-list-alt"></i>Merchant
                            Commission

                        </li>
                        <li>
                            <input value="withdrawal" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-university"></i>Withdrawal
                            <ul>
                                <li>
                                    <input value="incomingwithdrawal" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Withdrawal
                                    List
                                </li>
                                <li>
                                    <input value="withdrawalsettings" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Settings
                                </li>
                            </ul>

                        </li>
                        <li>
                            <input value="emailsettings" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Mail & SMTP Settings

                        </li>
                        <li>
                            <input value="emailtpl" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Email Template

                        </li>
                        <li>
                            <input value="customPage" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Custom Page

                        </li>
                        <li>
                            <input value="Ratings" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-star-o"></i>Ratings

                        </li>
                        <li>
                            <input value="ContactSettings" class="icheck admin-acess" type="checkbox"
                                   name="user_access[]" id="user_access"/><i class="fa fa-list-alt"></i>Contact Settings

                        </li>
                        <li>
                            <input value="SocialSettings" class="icheck admin-acess" type="checkbox"
                                   name="user_access[]" id="user_access"/><i class="fa fa-list-alt"></i>Social Settings

                        </li>
                        <li>
                            <input value="ManageCurrency" class="icheck admin-acess" type="checkbox"
                                   name="user_access[]" id="user_access"/><i class="fa fa-usd"></i>Manage Currency

                        </li>
                        <li>
                            <input value="ManageLanguage" class="icheck admin-acess" type="checkbox"
                                   name="user_access[]" id="user_access"/><i class="fa fa-flag-o"></i>Manage Language

                        </li>
                        <li>
                            <input value="Seo" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>SEO

                        </li>
                        <li>
                            <input value="addons" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-plus-circle"></i>Add-ons
                            <ul>
                                <li>
                                    <input value="addonexport" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa"></i>Export/Import
                                </li>
                                <li>
                                    <input value="mobileapp" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa"></i>MobileApp
                                </li>
                                <li>
                                    <input value="pointsprogram" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa"></i>Loyalty Points
                                    Program
                                </li>
                                <li>
                                    <input value="merchantapp" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa"></i>MerchantApp
                                </li>
                            </ul>

                        </li>
                        <li>
                            <input value="analytics" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Analytics

                        </li>
                        <li>
                            <input value="customerlist" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Customer List

                        </li>
                        <li>
                            <input value="subscriberlist" class="icheck admin-acess" type="checkbox"
                                   name="user_access[]" id="user_access"/><i class="fa fa-list-alt"></i>Subscriber List

                        </li>
                        <li>
                            <input value="reviews" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Reviews

                        </li>
                        <li>
                            <input value="bankdeposit" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Receive Bank Deposit

                        </li>
                        <li>
                            <input value="paymentgatewaysettings" class="icheck admin-acess" type="checkbox"
                                   name="user_access[]" id="user_access"/><i class="fa fa-list-alt"></i>Payment Gateway
                            Settings

                        </li>
                        <li>
                            <input value="paymentgateway" class="icheck admin-acess" type="checkbox"
                                   name="user_access[]" id="user_access"/><i class="fa fa-usd"></i>Payment Gateway
                            <ul>
                                <li>
                                    <input value="paypalSettings" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Paypal
                                </li>
                                <li>
                                    <input value="cardpaymentsettings" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Offline
                                    Credit Card Payment
                                </li>
                                <li>
                                    <input value="stripeSettings" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Stripe
                                </li>
                                <li>
                                    <input value="mercadopagoSettings" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Mercadopago
                                </li>
                                <li>
                                    <input value="sisowsettings" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Sisow
                                </li>
                                <li>
                                    <input value="payumonenysettings" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>PayUMoney
                                </li>
                                <li>
                                    <input value="obdsettings" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Offline
                                    Bank Deposit
                                </li>
                                <li>
                                    <input value="payserasettings" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Paysera
                                </li>
                                <li>
                                    <input value="payondelivery" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Pay On
                                    Delivery settings
                                </li>
                                <li>
                                    <input value="barclay" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Barclaycard
                                </li>
                                <li>
                                    <input value="epaybg" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>EpayBg
                                </li>
                                <li>
                                    <input value="authorize" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Authorize.net
                                </li>
                                <li>
                                    <input value="braintree" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Braintree
                                </li>
                                <li>
                                    <input value="razor" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                           id="user_access"/><i class="fa fa-paypal"></i>Razorpay
                                </li>
                            </ul>

                        </li>
                        <li>
                            <input value="sms" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>SMS
                            <ul>
                                <li>
                                    <input value="smsSettings" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>SMS
                                    Settings
                                </li>
                                <li>
                                    <input value="smsPackage" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>SMS
                                    Package
                                </li>
                                <li>
                                    <input value="smstransaction" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>SMS
                                    Transaction
                                </li>
                                <li>
                                    <input value="smslogs" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>SMS Logs
                                </li>
                            </ul>

                        </li>
                        <li>
                            <input value="fax" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-fax"></i>Fax service
                            <ul>
                                <li>
                                    <input value="faxtransaction" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Fax
                                    Payment Transaction
                                </li>
                                <li>
                                    <input value="faxpackage" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Fax
                                    Package
                                </li>
                                <li>
                                    <input value="faxlogs" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Fax Logs
                                </li>
                                <li>
                                    <input value="faxsettings" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Settings
                                </li>
                            </ul>

                        </li>
                        <li>
                            <input value="reports" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-list-alt"></i>Reports
                            <ul>
                                <li>
                                    <input value="rptMerchantReg" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Merchant
                                    Registration
                                </li>
                                <li>
                                    <input value="rptMerchantPayment" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Merchant
                                    Payment
                                </li>
                                <li>
                                    <input value="rptMerchanteSales" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Merchant
                                    Sales Report
                                </li>
                                <li>
                                    <input value="rptmerchantsalesummary" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Merchant
                                    Sales Summary Report
                                </li>
                                <li>
                                    <input value="rptbookingsummary" class="icheck admin-acess" type="checkbox"
                                           name="user_access[]" id="user_access"/><i class="fa fa-paypal"></i>Booking
                                    Summary Report
                                </li>
                            </ul>

                        </li>
                        <li>
                            <input value="userList" class="icheck admin-acess" type="checkbox" name="user_access[]"
                                   id="user_access"/><i class="fa fa-users"></i>User List

                        </li>
                        <li>
                    </ul>--}}

                    <div class="form-group">
                        <label></label>
                        <input type="submit" value="Register" class="btn btn-success">
                    </div>

                </form>
            </div>

        </div> <!--INNER-->
    </div>
@endsection
{{--


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
--}}
