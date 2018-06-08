@extends('layouts.master')

@section('content')
    <div class="left main_content">
        <div class="inner">
            <div class="breadcrumbs">
                <div class="inner">
                    <h2 class="uk-h2">Merchant Add</h2>
                    <div data-uk-dropdown="{mode:'click'}" class="uk-button-dropdown language-wrapper">
                        <button class="uk-button uk-button-success"><i class="fa fa-globe"></i> <i
                                    class="uk-icon-caret-down"></i></button>
                        <div class="uk-dropdown">
                            <ul class="uk-nav uk-nav-dropdown">
                                <li>
                                    <a href="admin/Setlanguage/Id/-9999">
                                        <img class="flags" src="assets/images/flags/us.png" alt="United States"
                                             title="United States"/> English </a>
                                </li>

                                <li>
                                    <a href="admin/Setlanguage/Id/1">
                                        <img class="flags" src="assets/images/flags/es.png" alt="Spain" title="Spain"/>
                                        Spanish </a>
                                </li>

                                <li>
                                    <a href="admin/Setlanguage/Id/2">
                                        <img class="flags" src="assets/images/flags/bg.png" alt="Bulgaria"
                                             title="Bulgaria"/> Bulgarian </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!--breadcrumbs-->

            <div class="content_wrap">


                <div class="uk-width-1">
                    <a href="{{route('restaurant.index')}}" class="uk-button"><i class="fa fa-list"></i> List</a>

                </div>
                <div class="spacer"></div>
                <div class="clear"></div>

                <ul data-uk-tab="{connect:'#tab-content'}" class="uk-tab uk-active">
                    <li class="uk-active"><a href="#">Restaurant Information</a></li>
                    {{--<li class=""><a href="#">Login Information</a></li>
                    <li class=""><a href="#">Membership</a></li>
                    <li class=""><a href="#">Featured</a></li>
                    <li class=""><a href="#">Payment History</a></li>
                    <li class=""><a href="#">Commission Settings</a></li>
                    <li class=""><a href="#">Google Map</a></li>--}}
                </ul>

                <form class="uk-form uk-form-horizontal forms" id="forms">
                    <input type="hidden" value="addMerchant" name="action" id="action"/><input type="hidden" value=""
                                                                                               name="id" id="id"/><input
                            type="hidden" value="" name="old_status" id="old_status"/><input type="hidden"
                                                                                             value="admin/merchantAdd"
                                                                                             name="redirect"
                                                                                             id="redirect"/><input
                            type="hidden" value="2d2c9f53b104e7a31bb1a9e7599a3271ff2f71ca" name="YII_CSRF_TOKEN"
                            id="YII_CSRF_TOKEN"/>
                    <ul class="uk-switcher uk-margin " id="tab-content">
                        <li class="uk-active">
                            <fieldset>


                                <div class="form-group">
                                    <label>Restaurant Slug</label>
                                    <input class="form-control" data-validation="required" type="text" value=""
                                           name="restaurant_slug" id="restaurant_slug"/></div>

                                <div class="form-group">
                                    <label>Restaurant name</label>
                                    <input class="form-control" data-validation="required" type="text" value=""
                                           name="restaurant_name" id="restaurant_name"/></div>


                                <div class="form-group">
                                    <label>Restaurant phone</label>
                                    <input class="form-control" type="text" value="" name="restaurant_phone"
                                           id="restaurant_phone"/></div>
                                <div class="form-group">
                                    <label>Contact name</label>
                                    <input class="form-control" data-validation="required" type="text" value=""
                                           name="contact_name" id="contact_name"/></div>
                                <div class="form-group">
                                    <label>Contact phone</label>
                                    <input class="form-control" data-validation="required" type="text" value=""
                                           name="contact_phone" id="contact_phone"/></div>
                                <div class="form-group">
                                    <label>Contact email</label>
                                    <input class="form-control" data-validation="required" type="text" value=""
                                           name="contact_email" id="contact_email"/></div>
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" data-validation="required" name="country_code"
                                            id="country_code">
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua and Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="BQ">British Antarctic Territory</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="VG">British Virgin Islands</option>
                                        <option value="BN">Brunei</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CT">Canton and Enderbury Islands</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos [Keeling] Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo - Brazzaville</option>
                                        <option value="CD">Congo - Kinshasa</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="CI">Côte d’Ivoire</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="NQ">Dronning Maud Land</option>
                                        <option value="DD">East Germany</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="FQ">French Southern and Antarctic Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard Island and McDonald Islands</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong SAR China</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IM">Isle of Man</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JE">Jersey</option>
                                        <option value="JT">Johnston Island</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Laos</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macau SAR China</option>
                                        <option value="MK">Macedonia</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="FX">Metropolitan France</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia</option>
                                        <option value="MI">Midway Islands</option>
                                        <option value="MD">Moldova</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar [Burma]</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NT">Neutral Zone</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="KP">North Korea</option>
                                        <option value="VD">North Vietnam</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PC">Pacific Islands Trust Territory</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PS">Palestinian Territories</option>
                                        <option value="PA">Panama</option>
                                        <option value="PZ">Panama Canal Zone</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="YD">People&#039;s Democratic Republic of Yemen</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn Islands</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russia</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="RE">Réunion</option>
                                        <option value="BL">Saint Barthélemy</option>
                                        <option value="SH">Saint Helena</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint Lucia</option>
                                        <option value="MF">Saint Martin</option>
                                        <option value="PM">Saint Pierre and Miquelon</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="CS">Serbia and Montenegro</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                        <option value="KR">South Korea</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syria</option>
                                        <option value="ST">São Tomé and Príncipe</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TL">Timor-Leste</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UM">U.S. Minor Outlying Islands</option>
                                        <option value="PU">U.S. Miscellaneous Pacific Islands</option>
                                        <option value="VI">U.S. Virgin Islands</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="SU">Union of Soviet Socialist Republics</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="ZZ">Unknown or Invalid Region</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VA">Vatican City</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Vietnam</option>
                                        <option value="WK">Wake Island</option>
                                        <option value="WF">Wallis and Futuna</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                        <option value="AX">Åland Islands</option>
                                    </select></div>
                                <div class="form-group">
                                    <label>Street address</label>
                                    <input class="form-control" data-validation="required" type="text" value=""
                                           name="street" id="street"/></div>

                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" data-validation="required" type="text" value=""
                                           name="city" id="city"/></div>
                                <div class="form-group">
                                    <label>Post code/Zip code</label>
                                    <input class="form-control" data-validation="required" type="text" value=""
                                           name="post_code" id="post_code"/></div>

                                <div class="form-group">
                                    <label>State/Region</label>
                                    <input class="form-control" data-validation="required" type="text" value=""
                                           name="state" id="state"/></div>

                                <div class="form-group">
                                    <label>Cuisine</label>
                                    <select class="uk-form-width-large chosen" multiple="multiple"
                                            data-validation="required" name="cuisine[]" id="cuisine">
                                        <option value="2">Deli</option>
                                        <option value="3">Indian</option>
                                        <option value="5">Sandwiches</option>
                                        <option value="6">Barbeque</option>
                                        <option value="4">Mediterranean</option>
                                        <option value="1">American</option>
                                        <option value="7">Diner</option>
                                        <option value="8">Italian</option>
                                        <option value="9">Mexican</option>
                                        <option value="11">Burgers</option>
                                        <option value="10">Sushi</option>
                                        <option value="13">Japanese</option>
                                        <option value="14">Middle Eastern</option>
                                        <option value="12">Greek</option>
                                        <option value="15">Thai</option>
                                        <option value="16">Chinese</option>
                                        <option value="18">Korean</option>
                                        <option value="17">Healthy</option>
                                        <option value="20">Vegetarian</option>
                                        <option value="19">Pizza</option>
                                    </select></div>
                                <div class="form-group">
                                    <label>Pick Up or Delivery?</label>
                                    <select class="form-control" data-validation="required" name="service"
                                            id="service">
                                        <option value="1">Delivery &amp; Pickup</option>
                                        <option value="2">Delivery Only</option>
                                        <option value="3">Pickup Only</option>
                                    </select></div>

                                <div class="form-group">
                                    <label>Published Merchant</label>
                                    <input value="2" class="icheck" type="checkbox" name="is_ready" id="is_ready"/>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" data-validation="required" name="status"
                                            id="status">
                                        <option value="pending">pending for approval</option>
                                        <option value="active">active</option>
                                        <option value="suspended">suspended</option>
                                        <option value="blocked">blocked</option>
                                        <option value="expired">expired</option>
                                    </select></div>


                            </fieldset>
                        </li>
                    {{--

                                            <li>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input class="form-control" type="text" value="" name="username" id="username"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" autocomplete="off" type="password" value=""
                                                           name="password" id="password"/></div>
                                            </li>

                                            <li>
                                                <div class="form-group">
                                                    <!--<label>Package Name</label>
                                                    <span class="uk-text-bold">Not Available</span>-->
                                                    <label>Package Name</label>
                                                    <select name="package_id" id="package_id">
                                                        <option value="2">Premium Package</option>
                                                        <option value="1">Free Package</option>
                                                    </select></div>

                                                <div class="form-group">
                                                    <label>Package Price</label>
                                                    <span class="uk-text-primary">$0.00</span>
                                                </div>

                                                <div class="form-group">
                                                    <label>Membership Expired On</label>
                                                    <span class="uk-text-success">
                      <input type="hidden" name="membership_expired" id="membership_expired"/><input class="j_date"
                                                                                                     data-validation="requiredx"
                                                                                                     data-id="membership_expired"
                                                                                                     type="text" value=""
                                                                                                     name="membership_expired1"
                                                                                                     id="membership_expired1"/></div>
                                            </li>

                                            <li>
                                                <div class="form-group">
                                                    <label>Featured?</label>
                                                    <input class="icheck" value="2" type="checkbox" name="is_featured" id="is_featured"/>
                                                    <p class="uk-text-muted">Check this if you want this merchant featured on homepage</p>
                                                </div>
                                            </li>

                                            <li>

                                                <p class="uk-text-warning">No Payment records</p>
                                            </li>

                                            <li>

                                                <div class="form-group">
                                                    <label>Enabled Commission?</label>
                                                    <input value="2" class="icheck" type="checkbox" name="is_commission"
                                                           id="is_commission"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>commission on orders</label>
                                                    <select name="commision_type" id="commision_type">
                                                        <option value="fixed">Fixed</option>
                                                        <option value="percentage">Percentage</option>
                                                    </select><input class="uk-form-width-small" type="text" value="2.00"
                                                                    name="percent_commision" id="percent_commision"/></div>

                                                <p class="uk-text-danger">
                                                    Note: If this is ticked, the merchant will be charged commission per order and
                                                    membership package will be ignored</p>


                                                <h3>Offline Payment Option</h3>

                                                <div class="form-group">
                                                    <label>Disabled Cash On delivery?</label>
                                                    <input value="2" class="icheck" type="checkbox" name="merchant_switch_master_cod"
                                                           id="merchant_switch_master_cod"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Disabled Offline Credit Card Payment?</label>
                                                    <input value="2" class="icheck" type="checkbox" name="merchant_switch_master_ccr"
                                                           id="merchant_switch_master_ccr"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Disabled Pay On Delivery?</label>
                                                    <input value="2" class="icheck" type="checkbox" name="merchant_switch_master_pyr"
                                                           id="merchant_switch_master_pyr"/>
                                                </div>

                                            </li>


                                            <li>


                                                <div class="form-group">
                                                    <label>Latitude</label>
                                                    <input class="form-control" type="text" value="" name="merchant_latitude"
                                                           id="merchant_latitude"/></div>

                                                <div class="form-group">
                                                    <label>Longitude</label>
                                                    <input class="form-control" type="text" value="" name="merchant_longtitude"
                                                           id="merchant_longtitude"/></div>
                                            </li>

                                        </ul>

                    --}}
                    {{--
                                        <div class="form-group">
                                            <label></label>
                                            <input type="submit" value="Save" class="btn btn-success">
                                        </div>
                    --}}

                </form>
            </div>

        </div> <!--INNER-->
    </div>
@endsection