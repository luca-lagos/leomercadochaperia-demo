<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema POS de abarrotes">
    <meta name="author" content="LucaLagos">

    <title>Sistema POS de abarrotes - "@yield('title')"</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/template.css') }}" rel="stylesheet">
    @stack('css')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    
    <div id="wrapper">
        <x-navigation-sidebar/>
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
    
                <!-- Topbar -->
                <x-navigation-header/>
                <!-- End of Topbar -->
    
                <!-- Begin Page Content -->
                <div class="container-fluid px-4">
                    @yield('content')
                </div>
                <x-footer/>
                
                <!-- /.container-fluid -->
    
            </div>
            <!-- End of Main Content -->
    
            <!-- Footer -->
            
            <!-- End of Footer -->
    
        </div>
        
    </div>

    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <x-logout-modal/>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/scripts.js') }}"></script>
    @stack('js')

</body>

</html>