<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>--}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>Helps</title>

    <!-- Styles -->
   <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css" />
{{--    
    <link href="{{ asset('/bootstrap-3.3.7/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bootstrap-3.3.7/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
--}}
   {{-- @if ($_SERVER['REQUEST_URI'] !== "/editt")--}}
        <link href="{{ asset('/plugins/jstree/themes/default/style.min.css') }}" rel="stylesheet" type="text/css" />
    {{--@endif--}}
    <link href="{{ asset('/plugins/ddsmoothmenu/ddsmoothmenu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/plugins/ddsmoothmenu/ddsmoothmenu-v.css') }}" rel="stylesheet" type="text/css" />
    {{--}}<link href="{{ asset('/plugins/') }}" rel="stylesheet" type="text/css" />--}}

    <link href="{{ asset('/plugins/jqcmenu/jquery.contextMenu.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #n {
            line-height: 2;
        }

        #n ul{
            position: relative;
        }
        #n ul li{
            height:40px;
            padding:1px;
        }
        #n a:hover{
           /* background: red; /* For browsers that do not support gradients */
            /* background: -webkit-linear-gradient(red, yellow); /* For Safari 5.1 to 6.0 */
            /*background: -o-linear-gradient(red, yellow); /* For Opera 11.1 to 12.0 */
            /* background: -moz-linear-gradient(red, yellow); /* For Firefox 3.6 to 15 */
            /*background: linear-gradient(red, yellow); /* Standard syntax */
            border: solid 1px #3E78A6;
            background: #dcf3f5;
            background: -moz-linear-gradient(top, #dcf3f5 0%, #0e78a6 38%, #0e78a6 100%);
            /*background: -webkit-gradient(left top, left bottom, color-stop(0%, #dcf3f5), color-stop(38%, #0e78a6), color-stop(100%, #0e78a6));*/
            background: -webkit-linear-gradient(top, #dcf3f5 0%, #0e78a6 38%, #0e78a6 100%);
            background: -o-linear-gradient(top, #dcf3f5 0%, #0e78a6 38%, #0e78a6 100%);
            background: -ms-linear-gradient(top, #dcf3f5 0%, #0e78a6 38%, #0e78a6 100%);
            background: linear-gradient(to bottom, #dcf3f5 0%, #0e78a6 38%, #0e78a6 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dcf3f5', endColorstr='#0e78a6', GradientType=0 );

            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-shadow: #2e2e2e 0 4px 5px;
            text-decoration:none;
            color: white;
            padding: 10px;
        }
        #n a{

            border: solid 1px #C7C7C7;
            background: #ffffff;
            background: -moz-linear-gradient(top, #ffffff 0%, #c7c7c7 38%, #c7c7c7 100%);
            background: -webkit-linear-gradient(top, #ffffff 0%, #c7c7c7 38%, #c7c7c7 100%);
            background: -o-linear-gradient(top, #ffffff 0%, #c7c7c7 38%, #c7c7c7 100%);
            background: -ms-linear-gradient(top, #ffffff 0%, #c7c7c7 38%, #c7c7c7 100%);
            background: linear-gradient(to bottom, #ffffff 0%, #c7c7c7 38%, #c7c7c7 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#c7c7c7', GradientType=0 );

            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            /*text-shadow: #2e2e2e 0 4px 5px;*/
            color: black;
            padding: 10px;
        }

        #n ul li ul{
            position: absolute;
            background: #0fc1d1;
            background: -moz-linear-gradient(top, #0fc1d1 0%, #0e78a6 7%, #9fc0d1 46%, #9fc0d1 52%, #0e78a6 93%, #0fc1d1 100%);

            background: #0e78a6;
            background: -moz-linear-gradient(top, #0e78a6 0%, #0e78a6 7%, #9fc0d1 46%, #9fc0d1 52%, #0e78a6 93%, #0fc1d1 100%);

            background: -webkit-linear-gradient(top, #0e78a6 0%, #0e78a6 7%, #9fc0d1 46%, #9fc0d1 52%, #0e78a6 93%, #0fc1d1 100%);
            background: -o-linear-gradient(top, #0e78a6 0%, #0e78a6 7%, #9fc0d1 46%, #9fc0d1 52%, #0e78a6 93%, #0fc1d1 100%);
            background: -ms-linear-gradient(top, #0e78a6 0%, #0e78a6 7%, #9fc0d1 46%, #9fc0d1 52%, #0e78a6 93%, #0fc1d1 100%);
            background: linear-gradient(to bottom, #0e78a6 0%, #0e78a6 7%, #9fc0d1 46%, #9fc0d1 52%, #0e78a6 93%, #0fc1d1 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0e78a6', endColorstr='#0fc1d1', GradientType=0 );
            widows:100%;
            height:32px;
        }

        #n ul li ul li a{
            background: none;
            border:none;
            color:white;
        }
        #n ul li ul li a:hover{
            background: none;
            border:none;
        }
        #n li{
            list-style: none;
            float: left;
            margin: 0; /*5px 2px 0 2px;*/
        }
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!--<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <?php
        echo '<script type="text/javascript">';

                echo "sid = ";
                if(Session::get("sid")){
                    echo Session::get("sid")."; ";
                }else{
                    echo '0'."; ";
                }

                echo "ssid = ";
                if(Session::get("ssid")){
                    echo Session::get("ssid")."; ";
                }else{
                    echo '0'."; ";
                }

        echo "</script>";
    ?>
</head>