<!DOCTYPE html>
<html lang="en">

@include('head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/logout" role="button">
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        @include('tree')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="card p-2">
                    <div class="row m-2">
                        <button class="btn btn-primary ml-auto" id="btnNew">New</button>
                    </div>
                    <div class="container">
                        <table class="table table-border mt-2" id="main_table">
                            <thead class="bg-dark">
                                <th>No.</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div><!-- /.container-fluid -->
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalUser" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="saveType">
                    <input type="hidden" id="dataId">
                    <div class="form-group">
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" required class="form-control" id="name">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label for="noRek">No Rekening</label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" required class="form-control" id="noRek">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label for="bank">Bank</label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" required class="form-control" id="bank">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-md-12">
                                <input type="email" required class="form-control" id="email">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-md-12">
                                <input type="password" required class="form-control" id="password">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label for="role">Role</label>
                            </div>
                            <div class="col-md-12">
                                <select id="role" class="form-control" required></select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="save" type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->

    @include('script')
    <script src="{{ asset('js/user.js') }}"></script>
</body>

</html>
