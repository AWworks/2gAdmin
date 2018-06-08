<!-- Bootstrap core CSS -->
{{--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
      integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
--}}
<link href="{{ asset('assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


<link href="{{ asset('assets/plugins/lobipanel/lobipanel.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/pace/flash.css') }}" rel="stylesheet">
<link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">


<link href="{{ asset('assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet">
<link href="{{ asset('assets/themify-icons/themify-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/emojionearea/emojionearea.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/monthly/monthly.css') }}" rel="stylesheet">
<link href="{{ asset('assets/dist/css/stylecrm.css') }}" rel="stylesheet">


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>

{{--table searching--}}

{{--

--}}
{{--tiny mce--}}{{--

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apikey=d4fjoprhkqza6bvsyjxyswyd8i2n0uws2iqp0bavj5p2srnd"></script>
<script>tinymce.init({
        selector: '#editor',
        height: 300,
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
        image_advtab: true,
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });
</script>

--}}

<link rel="shortcut icon" href="http://bastisapp.com/kmrs/favicon.ico">
<!--FONT AWESOME-->
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
<!--END FONT AWESOME-->


<style type="text/css">
    div.dataTables_wrapper div.dataTables_length select {
        width: 75px;
        display: inline-block;
        padding: 5px;
    }
</style>



<!-- Bootstrap -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- lobipanel -->
<script src="{{ asset('assets/plugins/lobipanel/lobipanel.min.js') }}" type="text/javascript"></script>
<!-- Pace js -->
<script src="{{ asset('assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- FastClick -->
<script src="{{ asset('assets/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
<!-- CRMadmin frame -->
<script src="{{ asset('assets/dist/js/custom.js') }}" type="text/javascript"></script>
<!-- End Core Plugins
   =====================================================================-->
<!-- Start Page Lavel Plugins
   =====================================================================-->

<!-- Counter js -->
<script src="{{ asset('assets/plugins/counterup/waypoints.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
<!-- Monthly js -->
<script src="{{ asset('assets/plugins/monthly/monthly.js') }}" type="text/javascript"></script>
<!-- End Page Lavel Plugins
   =====================================================================-->
<!-- Start Theme label Script
   =====================================================================-->
<!-- Dashboard js -->
<script src="{{ asset('assets/dist/js/dashboard.js') }}" type="text/javascript"></script>
<!-- End Theme label Script
   =====================================================================-->
<script>
    function dash() {
        // single bar chart
        var ctx = document.getElementById("singelBarChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
                datasets: [
                    {
                        label: "My First dataset",
                        data: [40, 55, 75, 81, 56, 55, 40],
                        borderColor: "rgba(0, 150, 136, 0.8)",
                        width: "1",
                        borderWidth: "0",
                        backgroundColor: "rgba(0, 150, 136, 0.8)"
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        //monthly calender
        $('#m_calendar').monthly({
            mode: 'event',
            //jsonUrl: 'events.json',
            //dataType: 'json'
            xmlUrl: 'events.xml'
        });

        //bar chart
        var ctx = document.getElementById("barChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "august", "september", "october", "Nobemver", "December"],
                datasets: [
                    {
                        label: "My First dataset",
                        data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
                        borderColor: "rgba(0, 150, 136, 0.8)",
                        width: "1",
                        borderWidth: "0",
                        backgroundColor: "rgba(0, 150, 136, 0.8)"
                    },
                    {
                        label: "My Second dataset",
                        data: [28, 48, 40, 19, 86, 27, 90, 28, 48, 40, 19, 86],
                        borderColor: "rgba(51, 51, 51, 0.55)",
                        width: "1",
                        borderWidth: "0",
                        backgroundColor: "rgba(51, 51, 51, 0.55)"
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        //counter
        $('.count-number').counterUp({
            delay: 10,
            time: 5000
        });
    }
    dash();
</script>

<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>

