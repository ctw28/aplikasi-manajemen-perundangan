<!DOCTYPE html>
<html lang="en">

@include('part.head')

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('part.side')

            @include('part.top-nav')
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <div class="x_content">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            @include('part.footer')
        </div>
    </div>
    @include('part.script-bottom')

</body>

</html>