@extends('layouts.master')

@section('masterContent')
    @role('Admin')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-dashboard"></i>
        </div>
        <div class="header-title">
            <h1>CRM Admin Dashboard</h1>
            <small>Very detailed & featured admin.</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox1">
                    <div class="statistic-box">
                        <i class="fa fa-user-plus fa-3x"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number">11</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                        </div>
                        <h3> Active Client</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox2">
                    <div class="statistic-box">
                        <i class="fa fa-user-secret fa-3x"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number">4</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                        </div>
                        <h3> Active Admin</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox3">
                    <div class="statistic-box">
                        <i class="fa fa-money fa-3x"></i>
                        <div class="counter-number pull-right">
                            <i class="ti ti-money"></i><span class="count-number">965</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                        </div>
                        <h3> Total Expenses</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox4">
                    <div class="statistic-box">
                        <i class="fa fa-files-o fa-3x"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number">11</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                        </div>
                        <h3> Running Projects</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Upcoming Events</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="work-touchpoint">
                            <div class="work-touchpoint-date">
                                <span class="day">28</span>
                                <span class="month">Apr</span>
                            </div>
                        </div>
                        <div class="detailswork">
                            <span class="label-custom label label-default pull-right">Email</span>
                            <a href="#" title="headings">Marketing policy</a> <br>
                            <p>Green Road - Dhaka,Bangladesh</p>
                        </div>
                        <div class="work-touchpoint">
                            <div class="work-touchpoint-date">
                                <span class="day">2</span>
                                <span class="month">Apr</span>
                            </div>
                        </div>
                        <div class="detailswork">
                            <span class="label-custom label label-default pull-right">skype</span>
                            <a href="#" title="headings">Accounting policy</a> <br>
                            <p>Kolkata, India</p>
                        </div>
                        <div class="work-touchpoint">
                            <div class="work-touchpoint-date2">
                                <span class="day">17</span>
                                <span class="month">Mrc</span>
                            </div>
                        </div>
                        <div class="detailswork">
                            <span class="label-custom label label-default pull-right">phone</span>
                            <a href="#" title="headings">Marketing policy</a> <br>
                            <p>Madrid - spain</p>
                        </div>
                        <div class="work-touchpoint">
                            <div class="work-touchpoint-date2">
                                <span class="day">3</span>
                                <span class="month">jan</span>
                            </div>
                        </div>
                        <div class="detailswork">
                            <span class="label-custom label label-default pull-right">Mobile</span>
                            <a href="#" title="headings">Finance policy</a> <br>
                            <p>south Australia - Australia</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Running Projects</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="runnigwork">
                            <span class="label-danger label label-default pull-right">Failed</span>
                            <i class="fa fa-dot-circle-o"></i>
                            <a href="#">Database configuration</a><br>
                            <div class="progress runningprogress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%"
                                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip"
                                     data-placement="top" title="" data-original-title="25%"></div>
                            </div>
                        </div>
                        <div class="runnigwork">
                            <span class="label-warning label label-default pull-right">progressing</span>
                            <i class="fa fa-dot-circle-o"></i>
                            <a href="#">Design tool</a><br>
                            <div class="progress runningprogress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 15%"
                                     aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip"
                                     data-placement="top" title="" data-original-title="15%"></div>
                            </div>
                        </div>
                        <div class="runnigwork">
                            <span class="label-success label label-default pull-right">progressing</span>
                            <i class="fa fa-dot-circle-o"></i>
                            <a href="#">Internet configuration</a><br>
                            <div class="progress runningprogress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 45%"
                                     aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip"
                                     data-placement="top" title="" data-original-title="45%"></div>
                            </div>
                        </div>
                        <div class="runnigwork">
                            <span class="label-info label label-default pull-right">progressing</span>
                            <i class="fa fa-dot-circle-o"></i>
                            <a href="#">Banner completation</a><br>
                            <div class="progress runningprogress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 75%"
                                     aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip"
                                     data-placement="top" title="" data-original-title="75%"></div>
                            </div>
                        </div>
                        <div class="runnigwork">
                            <span class="label-success label label-default pull-right">Success</span>
                            <i class="fa fa-dot-circle-o"></i>
                            <a href="#">IT Solution</a><br>
                            <div class="progress runningprogress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 50%"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip"
                                     data-placement="top" title="" data-original-title="50%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Pending Works</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="Pendingwork">
                            <span class="label-warning label label-default pull-right">progressing</span>
                            <i class="fa fa-ban"></i>
                            <a href="#">Database tools</a>
                            <div class="upworkdate">
                                <p>Jul 25, 2017 for Alimul Alrazy</p>
                            </div>
                        </div>
                        <div class="Pendingwork">
                            <span class="label-success label label-default pull-right">success</span>
                            <i class="fa fa-ban"></i>
                            <a href="#">Cabels</a>
                            <div class="upworkdate">
                                <p>Jul 25, 2017 for Alimul</p>
                            </div>
                        </div>
                        <div class="Pendingwork">
                            <span class="label-danger label label-default pull-right">Failed</span>
                            <i class="fa fa-ban"></i>
                            <a href="#">Technologycal tools</a>
                            <div class="upworkdate">
                                <p>Feb 25, 2017 for Alrazy</p>
                            </div>
                        </div>
                        <div class="Pendingwork">
                            <span class="label-warning label label-default pull-right">progressing</span>
                            <i class="fa fa-ban"></i>
                            <a href="#">Transaction</a>
                            <div class="upworkdate">
                                <p>apr 25, 2017 for Mahfuz</p>
                            </div>
                        </div>
                        <div class="Pendingwork">
                            <span class="label-success label label-default pull-right">success</span>
                            <i class="fa fa-ban"></i>
                            <a href="#">Training tools</a>
                            <div class="upworkdate">
                                <p>jun 25, 2017 for Alrazy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Works Deadlines</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="Workslist">
                            <div class="worklistdate">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Task Name</th>
                                        <th>End Deadlines</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="info">
                                        <th scope="row">Alrazy</th>
                                        <td>Feb 25,2017</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jahir</th>
                                        <td>jun 05,2017</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sayeed</th>
                                        <td>Feb 05,2017</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Shipon</th>
                                        <td>jun 25,2017</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Rafi</th>
                                        <td>Jul 15,2017</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Works Announcements</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="Workslist">
                            <div class="worklistdate">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Works Type</th>
                                        <th>Name Of Worker</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="info">
                                        <td>Web Design</td>
                                        <td>Jr. Developer Alrazy</td>
                                    </tr>
                                    <tr>
                                        <td>Networking</td>
                                        <td>Jr. Developer Jahir</td>
                                    </tr>
                                    <tr>
                                        <td>Megento</td>
                                        <td>Jr. Developer Sayeed</td>
                                    </tr>
                                    <tr>
                                        <td>Php,Laravel</td>
                                        <td>Jr. Developer Muhim</td>
                                    </tr>
                                    <tr>
                                        <td>Html,css</td>
                                        <td>Frontend Developer Rafi</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Notice Board</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="Workslist">
                            <div class="worklistdate">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Notice</th>
                                        <th>Published By</th>
                                        <th>Date Added</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="info">
                                        <td>new notice</td>
                                        <td>Mr. Alrazy</td>
                                        <td>20th April 2017</td>
                                    </tr>
                                    <tr>
                                        <td>Urgent notice</td>
                                        <td>Mr. Alrazy</td>
                                        <td>20th june 2017</td>
                                    </tr>
                                    <tr>
                                        <td>Urgent notice</td>
                                        <td>Mr. Jahir</td>
                                        <td>26th june 2017</td>
                                    </tr>
                                    <tr>
                                        <td>Urgent notice</td>
                                        <td>Mr. leo</td>
                                        <td>3rd june 2017</td>
                                    </tr>
                                    <tr>
                                        <td>Notice</td>
                                        <td>Mr. Karim</td>
                                        <td>3rd July 2017</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Barchart -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>This Year Earnings & Expenses(Bar chart)</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <canvas id="barChart" height="150"></canvas>
                    </div>
                </div>
            </div>
            <!-- bar chart -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Weekly Earnings & Expenses</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <canvas id="singelBarChart" height="323"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Google Map</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="google-maps">
                            <iframe src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=15+Springfield+Way,+Hythe,+CT21+5SH&amp;aq=t&amp;sll=52.8382,-2.327815&amp;sspn=8.047465,13.666992&amp;ie=UTF8&amp;hq=&amp;hnear=15+Springfield+Way,+Hythe+CT21+5SH,+United+Kingdom&amp;t=m&amp;z=14&amp;ll=51.077429,1.121722&amp;output=embed"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Calender</h4>
                        </div>
                    </div>
                    <!-- Monthly calender widget -->
                    <div class="panel panel-bd">
                        <div class="panel-body">
                            <div class="monthly_calender">
                                <div class="monthly" id="m_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    </div>
    @endrole
    @role('Merchant')
    <div class="left main_content">
        <div class="inner">
            <div class="breadcrumbs">
                <div class="inner">
                    <h2 class="uk-h2">Dashboard</h2>
                </div>
            </div> <!--breadcrumbs-->
            <div class="content_wrap">
                <form id="frm_table_list" method="POST" class="report uk-form uk-form-horizontal">
                    <h3>New Merchant Registration List For Today <span class="uk-text-success">
Dec 13,2017</span>
                    </h3>

                    <input name="action" id="action" value="newMerchantRegList" type="hidden">
                    <input name="tbl" id="tbl" value="item" type="hidden">
                    <div id="table_list_wrapper" class="dataTables_wrapper" role="grid">
                        <div id="table_list_length" class="dataTables_length"><label>Show <select size="1"
                                                                                                  name="table_list_length"
                                                                                                  aria-controls="table_list">
                                    <option value="10" selected="selected">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label></div>
                        <div class="dataTables_filter" id="table_list_filter"><label>Search: <input
                                        aria-controls="table_list" type="text"></label></div>
                        <div id="table_list_processing" class="dataTables_processing" style="visibility: hidden;">
                            Processing...
                        </div>
                        <table id="table_list"
                               class="uk-table uk-table-hover uk-table-striped uk-table-condensed dataTable"
                               aria-describedby="table_list_info">
                            <caption>Merchant List</caption>
                            <thead>
                            <tr role="row">
                                <th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="table_list"
                                    rowspan="1" colspan="1" style="width: 120px;" aria-sort="descending"
                                    aria-label="MerchantID: activate to sort column ascending" width="2%">MerchantID
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list"
                                    rowspan="1" colspan="1" style="width: 184px;"
                                    aria-label="Merchant Name: activate to sort column ascending" width="6%">Merchant
                                    Name
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list"
                                    rowspan="1" colspan="1" style="width: 118px;"
                                    aria-label="Package Name: activate to sort column ascending" width="3%">Package Name
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list"
                                    rowspan="1" colspan="1" style="width: 95px;"
                                    aria-label="Price: activate to sort column ascending" width="3%">Price
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list"
                                    rowspan="1" colspan="1" style="width: 118px;"
                                    aria-label="Payment Type: activate to sort column ascending" width="3%">Payment Type
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list"
                                    rowspan="1" colspan="1" style="width: 103px;"
                                    aria-label="Status: activate to sort column ascending" width="3%">Status
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list"
                                    rowspan="1" colspan="1" style="width: 91px;"
                                    aria-label="Date: activate to sort column ascending" width="3%">Date
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list"
                                    rowspan="1" colspan="1" style="width: 73px;"
                                    aria-label=": activate to sort column ascending" width="3%"></th>
                            </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <tr class="odd">
                                <td class=" sorting_1">722</td>
                                <td class="">Me You</td>
                                <td class=""></td>
                                <td class="">0.00</td>
                                <td class=""></td>
                                <td class="">pending</td>
                                <td class="">Dec 13,2017 7:50:08</td>
                                <td class=""><a data-id="722" class="edit-merchant-status" href="javascript:">Edit</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="dataTables_info" id="table_list_info">Showing 1 to 1 of 1 entries</div>
                        <div class="dataTables_paginate paging_two_button" id="table_list_paginate"><a
                                    class="paginate_disabled_previous" tabindex="0" role="button"
                                    id="table_list_previous" aria-controls="table_list">Previous</a><a
                                    class="paginate_disabled_next" tabindex="0" role="button" id="table_list_next"
                                    aria-controls="table_list">Next</a></div>
                    </div>
                    <div class="clear"></div>
                </form>

                <div style="padding-top:50px;padding-bottom:20px;">
                    <hr>
                </div>

                <h3>New Merchant Payment List For Today <span class="uk-text-success">
Dec 13,2017</span></h3>

                <form id="frm_table_list2" method="POST" class="report uk-form uk-form-horizontal">
                    <input name="action" id="action" value="rptMerchantPaymentToday" type="hidden">
                    <input name="tbl" id="tbl" value="item" type="hidden">
                    <div id="table_list2_wrapper" class="dataTables_wrapper" role="grid">
                        <div id="table_list2_length" class="dataTables_length"><label>Show <select size="1"
                                                                                                   name="table_list2_length"
                                                                                                   aria-controls="table_list2">
                                    <option value="10" selected="selected">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label></div>
                        <div class="dataTables_filter" id="table_list2_filter"><label>Search: <input
                                        aria-controls="table_list2" type="text"></label></div>
                        <div id="table_list2_processing" class="dataTables_processing" style="visibility: hidden;">
                            Processing...
                        </div>
                        <table id="table_list2"
                               class="uk-table uk-table-hover uk-table-striped uk-table-condensed dataTable"
                               aria-describedby="table_list2_info">
                            <caption>Merchant Payment</caption>
                            <thead>
                            <tr role="row">
                                <th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="table_list2"
                                    rowspan="1" colspan="1" style="width: 95px;" aria-sort="descending"
                                    aria-label="TransID: activate to sort column ascending" width="2%">TransID
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list2"
                                    rowspan="1" colspan="1" style="width: 174px;"
                                    aria-label="Merchant Name: activate to sort column ascending" width="5%">Merchant
                                    Name
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list2"
                                    rowspan="1" colspan="1" style="width: 123px;"
                                    aria-label="Package: activate to sort column ascending" width="3%">Package
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list2"
                                    rowspan="1" colspan="1" style="width: 100px;"
                                    aria-label="Price: activate to sort column ascending" width="3%">Price
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list2"
                                    rowspan="1" colspan="1" style="width: 123px;"
                                    aria-label="Payment Type: activate to sort column ascending" width="3%">Payment Type
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list2"
                                    rowspan="1" colspan="1" style="width: 108px;"
                                    aria-label="Status: activate to sort column ascending" width="3%">Status
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list2"
                                    rowspan="1" colspan="1" style="width: 96px;"
                                    aria-label="Date: activate to sort column ascending" width="3%">Date
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list2"
                                    rowspan="1" colspan="1" style="width: 79px;"
                                    aria-label=": activate to sort column ascending" width="3%"></th>
                            </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <tr class="odd">
                                <td colspan="8" class="dataTables_empty" valign="top">No data available in table</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="dataTables_info" id="table_list2_info">Showing 0 to 0 of 0 entries</div>
                        <div class="dataTables_paginate paging_two_button" id="table_list2_paginate"><a
                                    class="paginate_disabled_previous" tabindex="0" role="button"
                                    id="table_list2_previous" aria-controls="table_list2">Previous</a><a
                                    class="paginate_disabled_next" tabindex="0" role="button" id="table_list2_next"
                                    aria-controls="table_list2">Next</a></div>
                    </div>
                    <div class="clear"></div>
                </form>


                <h3>Incoming orders from merchant for today <span class="uk-text-success">
Dec 13,2017</span></h3>

                <form id="frm_table_list3" method="POST" class="report uk-form uk-form-horizontal">
                    <input name="action" id="action" value="rptIncomingOrders" type="hidden">
                    <input name="tbl" id="tbl" value="item" type="hidden">
                    <div id="table_list3_wrapper" class="dataTables_wrapper" role="grid">
                        <div id="table_list3_length" class="dataTables_length"><label>Show <select size="1"
                                                                                                   name="table_list3_length"
                                                                                                   aria-controls="table_list3">
                                    <option value="10" selected="selected">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label></div>
                        <div class="dataTables_filter" id="table_list3_filter"><label>Search: <input
                                        aria-controls="table_list3" type="text"></label></div>
                        <div id="table_list3_processing" class="dataTables_processing" style="visibility: hidden;">
                            Processing...
                        </div>
                        <table id="table_list3"
                               class="uk-table uk-table-hover uk-table-striped uk-table-condensed dataTable"
                               aria-describedby="table_list3_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="table_list3"
                                    rowspan="1" colspan="1" style="width: 54px;" aria-sort="descending"
                                    aria-label="Ref#: activate to sort column ascending" width="2%">Ref#
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list3"
                                    rowspan="1" colspan="1" style="width: 89px;"
                                    aria-label="Merchant Name: activate to sort column ascending" width="2%">Merchant
                                    Name
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list3"
                                    rowspan="1" colspan="1" style="width: 112px;"
                                    aria-label="Name: activate to sort column ascending" width="6%">Name
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list3"
                                    rowspan="1" colspan="1" style="width: 63px;"
                                    aria-label="Item: activate to sort column ascending" width="3%">Item
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list3"
                                    rowspan="1" colspan="1" style="width: 103px;"
                                    aria-label="TransType: activate to sort column ascending" width="3%">TransType
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list3"
                                    rowspan="1" colspan="1" style="width: 92px;"
                                    aria-label="Payment Type: activate to sort column ascending" width="3%">Payment Type
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list3"
                                    rowspan="1" colspan="1" style="width: 66px;"
                                    aria-label="Total: activate to sort column ascending" width="3%">Total
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list3"
                                    rowspan="1" colspan="1" style="width: 56px;"
                                    aria-label="Tax: activate to sort column ascending" width="3%">Tax
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list3"
                                    rowspan="1" colspan="1" style="width: 73px;"
                                    aria-label="Total W/Tax: activate to sort column ascending" width="3%">Total W/Tax
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list3"
                                    rowspan="1" colspan="1" style="width: 77px;"
                                    aria-label="Status: activate to sort column ascending" width="3%">Status
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list3"
                                    rowspan="1" colspan="1" style="width: 65px;"
                                    aria-label="Date: activate to sort column ascending" width="3%">Date
                                </th>
                            </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <tr class="odd">
                                <td class=" sorting_1">2668</td>
                                <td class="">Demo Pizza Shop</td>
                                <td class="">Onur Kınalı</td>
                                <td class=""><span class="concat-text-table">Fries (Reg)</span></td>
                                <td class="">Delivery</td>
                                <td class="">COD</td>
                                <td class="">12.00</td>
                                <td class="">0.00</td>
                                <td class="">13.00</td>
                                <td class="">Pending</td>
                                <td class="">Dec 13,2017 17:39:25<br><a data-id="2668" class="view-receipt"
                                                                        href="javascript:">View</a></td>
                            </tr>
                            <tr class="even">
                                <td class=" sorting_1">2667</td>
                                <td class="">Bundelkhandi Khana Khazana</td>
                                <td class="">Testa Nutzer</td>
                                <td class=""><span class="concat-text-table">Maggi Pasta</span></td>
                                <td class="">Delivery</td>
                                <td class="">COD</td>
                                <td class="">1381.00</td>
                                <td class="">0.40</td>
                                <td class="">1386.40</td>
                                <td class="">Accepted</td>
                                <td class="">Dec 14,2017 1:49:07<br><a data-id="2667" class="view-receipt"
                                                                       href="javascript:">View</a></td>
                            </tr>
                            <tr class="odd">
                                <td class=" sorting_1">2666</td>
                                <td class="">Cebu Food</td>
                                <td class="">Jfdjk Jkfd</td>
                                <td class=""><span class="concat-text-table">pandesal gagmay</span></td>
                                <td class="">Delivery</td>
                                <td class="">PYP</td>
                                <td class="">3.70</td>
                                <td class="">0.00</td>
                                <td class="">3.70</td>
                                <td class="">Paid</td>
                                <td class="">Dec 13,2017 8:27:14<br><a data-id="2666" class="view-receipt"
                                                                       href="javascript:">View</a></td>
                            </tr>
                            <tr class="even">
                                <td class=" sorting_1">2664</td>
                                <td class="">Food Plaza</td>
                                <td class="">MyKode Zone</td>
                                <td class=""><span class="concat-text-table">Thali</span></td>
                                <td class="">Delivery</td>
                                <td class="">COD</td>
                                <td class="">500.00</td>
                                <td class="">0.00</td>
                                <td class="">500.00</td>
                                <td class="">Pending</td>
                                <td class="">Dec 12,2017 9:12:24<br><a data-id="2664" class="view-receipt"
                                                                       href="javascript:">View</a></td>
                            </tr>
                            <tr class="odd">
                                <td class=" sorting_1">2663</td>
                                <td class="">Mcdonalds</td>
                                <td class="">Cássio Augusto</td>
                                <td class=""><span class="concat-text-table">bigmac,happy mean mcfish</span></td>
                                <td class="">Delivery</td>
                                <td class="">OCR</td>
                                <td class="">28.20</td>
                                <td class="">1.96</td>
                                <td class="">46.80</td>
                                <td class="">Delivered</td>
                                <td class="">Dec 12,2017 5:17:23<br><a data-id="2663" class="view-receipt"
                                                                       href="javascript:">View</a></td>
                            </tr>
                            <tr class="even">
                                <td class=" sorting_1">2662</td>
                                <td class="">Mcdonalds</td>
                                <td class="">Md. Shahidul Islam</td>
                                <td class=""><span class="concat-text-table">bigmac,big n tasty</span></td>
                                <td class="">Delivery</td>
                                <td class="">COD</td>
                                <td class="">64.00</td>
                                <td class="">3.25</td>
                                <td class="">68.25</td>
                                <td class="">Delivered</td>
                                <td class="">Dec 12,2017 2:36:08<br><a data-id="2662" class="view-receipt"
                                                                       href="javascript:">View</a></td>
                            </tr>
                            <tr class="odd">
                                <td class=" sorting_1">2661</td>
                                <td class="">Food Plaza</td>
                                <td class="">Rter Ert</td>
                                <td class=""><span class="concat-text-table">Thali</span></td>
                                <td class="">Delivery</td>
                                <td class="">COD</td>
                                <td class="">250.00</td>
                                <td class="">0.00</td>
                                <td class="">250.00</td>
                                <td class="">Pending</td>
                                <td class="">Dec 12,2017 2:11:25<br><a data-id="2661" class="view-receipt"
                                                                       href="javascript:">View</a></td>
                            </tr>
                            <tr class="even">
                                <td class=" sorting_1">2660</td>
                                <td class="">Food Plaza</td>
                                <td class="">Rter Ert</td>
                                <td class=""><span class="concat-text-table">Thali</span></td>
                                <td class="">Delivery</td>
                                <td class="">COD</td>
                                <td class="">250.00</td>
                                <td class="">0.00</td>
                                <td class="">250.00</td>
                                <td class="">Pending</td>
                                <td class="">Dec 12,2017 2:01:24<br><a data-id="2660" class="view-receipt"
                                                                       href="javascript:">View</a></td>
                            </tr>
                            <tr class="odd">
                                <td class=" sorting_1">2659</td>
                                <td class="">Bundelkhandi Khana Khazana</td>
                                <td class="">Test Test</td>
                                <td class=""><span class="concat-text-table">Maggi Pasta</span></td>
                                <td class="">Delivery</td>
                                <td class="">COD</td>
                                <td class="">2193.00</td>
                                <td class="">0.00</td>
                                <td class="">2193.00</td>
                                <td class="">Accepted</td>
                                <td class="">Dec 12,2017 18:28:18<br><a data-id="2659" class="view-receipt"
                                                                        href="javascript:">View</a></td>
                            </tr>
                            <tr class="even">
                                <td class=" sorting_1">2658</td>
                                <td class="">Subway</td>
                                <td class="">Sgsgs Sbbsbs</td>
                                <td class=""><span class="concat-text-table">sliced chicken,italian b.m.t</span></td>
                                <td class="">Delivery</td>
                                <td class="">PYR</td>
                                <td class="">67.70</td>
                                <td class="">0.00</td>
                                <td class="">73.70</td>
                                <td class="">Paid</td>
                                <td class="">Dec 11,2017 23:44:04<br><a data-id="2658" class="view-receipt"
                                                                        href="javascript:">View</a></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="dataTables_info" id="table_list3_info">Showing 1 to 10 of 100 entries</div>
                        <div class="dataTables_paginate paging_two_button" id="table_list3_paginate"><a
                                    class="paginate_disabled_previous" tabindex="0" role="button"
                                    id="table_list3_previous" aria-controls="table_list3">Previous</a><a
                                    class="paginate_enabled_next" tabindex="0" role="button" id="table_list3_next"
                                    aria-controls="table_list3">Next</a></div>
                    </div>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>{{--inner--}}

    @endrole
@endsection