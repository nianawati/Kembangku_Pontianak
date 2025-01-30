<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kembangku pontianak</title>
    @vite([
        // 'resources/css/app.css',
        'resources/vendor/fontawesome-free/css/all.min.css',
        // 'resources/vendor/datatables/dataTables.bootstrap4.css',
        'resources/css/sb-admin-2.min.css',
    ])

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">


    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">

    <style>
        /* HTML: <div class="loader"></div> */
        .loader {
            width: 50px;
            aspect-ratio: 1;
            display: grid;
            border: 4px solid #0000;
            border-radius: 50%;
            border-right-color: rgb(149, 90, 141);
            animation: l15 1s infinite linear;
            scale: 2;
        }

        .loader::before,
        .loader::after {
            content: "";
            grid-area: 1/1;
            margin: 2px;
            border: inherit;
            border-radius: 50%;
            animation: l15 2s infinite;
        }

        .loader::after {
            margin: 8px;
            animation-duration: 3s;
        }

        @keyframes l15 {
            100% {
                transform: rotate(1turn)
            }
        }

        .loader-bg {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: fixed;
            left: 0px;
            z-index: 9999;
            background: white;
            transition: 1s all ease-in-out;
            top: 0px;
        }

        .dancing-script-light {
            font-family: "Dancing Script", serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .dancing-script-medium {
            font-family: "Dancing Script", serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
        }

        .dancing-script-bold {
            font-family: "Dancing Script", serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
        }

        .dancing-script-extrabold {
            font-family: "Dancing Script", serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
        }

        .color-text {
            color: #7d5181;
        }
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
            style="background-color: rgb(149, 90, 141);">

            <!-- Sidebar - Brand -->
            <a style="height:fit-content;word-break:break-word;"
                class="sidebar-brand d-flex align-items-center flex-wrap justify-content-center">
                <div class="sidebar-brand-icon">
                    <img src="/img/logo.jpg" width="50" height="50"
                        style="border-radius:100%; background: transparent; border:1px solid white;">
                </div>
                <div class="sidebar-brand-text-center mx-3">Kembangku Pontianak</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('user') }}">
                    <i class="fas fa-users"></i>
                    <span>User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('supplier') }}">
                    <i class="fas fa-truck"></i>
                    <span>Supplier</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemasuk"
                    aria-expanded="true" aria-controls="collapsemasuk">
                    <i class="fas fa-spa"></i>
                    <span>Bunga</span>
                </a>
                <div id="collapsemasuk" class="collapse" aria-labelledby="headingmasuk" data-parent="#collapsemasuk">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Bunga </h6>
                        <a class="collapse-item" href="{{ route('bunga.masuk') }}">Bunga Masuk</a>
                        <a class="collapse-item" href="{{ route('bunga.keluar') }}">Bunga Keluar</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsekeluar"
                    aria-expanded="true" aria-controls="collapsekeluar">
                    <i class="fas fa-boxes"></i>
                    <span>Barang</span>
                </a>
                <div id="collapsekeluar" class="collapse" aria-labelledby="headingkeluar"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Barang </h6>
                        <a class="collapse-item" href="{{ route('barang.masuk') }}">Barang Masuk</a>
                        <a class="collapse-item" href="{{ route('barang.keluar') }}">Barang Keluar</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseretur"
                    aria-expanded="true" aria-controls="collapseretur">
                    <i class="fas fa-times-circle"></i>
                    <span>Rusak</span>
                </a>
                <div id="collapseretur" class="collapse" aria-labelledby="headingretur"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Rusak </h6>
                        <a class="collapse-item" href="{{ route('rusak.bunga') }}">Bunga Rusak</a>
                        <a class="collapse-item" href="{{ route('rusak.barang') }}">Barang Rusak</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseproduk"
                    aria-expanded="true" aria-controls="collapseproduk">
                    <i class="fab fa-product-hunt"></i>
                    <span>Produk</span>
                </a>
                <div id="collapseproduk" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Produk </h6>
                        <a class="collapse-item" href="{{ route('produk.kategori') }}">Kategori</a>
                        <a class="collapse-item" href="{{ route('produk.unit') }}">Unit</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('pesanan_masuk.pesananMasuk') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Pesanan Masuk</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('laba') }}">
                    <i class="fas fa-sticky-note"></i>
                    <span>Laporan</span>
                </a>
            </li>


            <!-- Heading -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <div class="color-text">
                        <h1 class="dancing-script-medium">Kembangku Pontianak</h1>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ request()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="/foto_profile/{{ request()->foto_profile_show }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                @if (request()->rule_user === 'admin' && request()->route()->getName() !== 'kasir')
                                    <a class="dropdown-item" href="/kasir">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Kasir
                                    </a>
                                @endif

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid pb-5">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">POIN OF SALE</h1>
                        <a href="{{ route('generate-report') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            {{-- <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer --> --}}

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda Yakin Ingin Keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('user.logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="loader-bg loader-show">
        <div class="loader"></div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>


    <!-- Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <!-- Bootstrap core JavaScript-->
    {{-- <script src="/vendor/jquery/jquery.min.js"></script> --}}
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>


    <script>
        const check_all = document.querySelector("#check_all") || document.createElement("input");
        const all_check = document.querySelectorAll(".check");

        check_all.onchange = _ => {
            all_check.forEach(d => {
                d.checked = check_all.checked;
            });
        };

        new DataTable("#table", {
            responsive: true
        });
        document.addEventListener("DOMContentLoaded", () => {

            const loader = document.querySelector(".loader-bg");
            const load = document.querySelector(".loader");
            // load.style.display = "none";
            loader.style.display = "none";

            const laporan = document.querySelector("#laporan");


            const bunga_masuk = document.querySelector("#bunga_masuk");

            if (bunga_masuk) {
                new DataTable("#bunga_masuk", {
                    responsive: true,
                    columnDefs: [{
                        targets: [6, 7],
                        render: function(data, type, rowData, {
                            row,
                            col
                        }) {
                            const formatter = new Intl.NumberFormat("id-ID", {
                                style: "currency",
                                currency: "IDR"
                            });
                            return formatter.format(data);
                        }
                    }]
                });

            }


            if (laporan) {
                new DataTable("#laporan", {
                    headerCallback: function(thead, data, start, end, display) {
                        $(thead).find('th').css('font-size', '12px'); // Set the desired font size
                    },
                    dom: '<"table-container"tr>',
                    columnDefs: [{
                        targets: [0, 1, 2, 3, 4, 5, 6],
                        createdCell: function(td, cellData, rowData, row, col) {

                            $(td).css('font-size', '12px');

                            const modal_bunga = rowData[3];
                            const modal_barang = rowData[4];
                            const laba_kotor_bunga = rowData[5];
                            const laba_kotor_barang = rowData[6];

                            if (col === 0) {
                                $(td).css('color', 'blue');
                            }

                            if (col === 5) {
                                if (parseFloat(laba_kotor_bunga) === 0) {

                                } else {
                                    if (parseFloat(modal_bunga) > parseFloat(
                                            laba_kotor_bunga)) {
                                        $(td).css('color', 'red');
                                    } else {
                                        $(td).css('color', 'green');
                                    }
                                }

                            }

                            if (col === 6) {
                                if (parseFloat(laba_kotor_barang) === 0) {

                                } else {
                                    if (parseFloat(modal_barang) > parseFloat(
                                            laba_kotor_barang)) {
                                        $(td).css('color', 'red');
                                    } else {
                                        $(td).css('color', 'green');
                                    }
                                }
                            }

                            $(td).css('text-align', 'center');
                        },
                        render: function(data, type, rowData, {
                            row,
                            col
                        }) {

                            const modal_bunga = rowData[3];
                            const modal_barang = rowData[4];
                            const laba_kotor_bunga = rowData[5];
                            const laba_kotor_barang = rowData[6];

                            const formatter = new Intl.NumberFormat("id-ID", {
                                style: "currency",
                                currency: "IDR"
                            });

                            if (col === 5) {
                                if (parseFloat(modal_bunga) > parseFloat(laba_kotor_bunga)) {
                                    return `<i class="fas fa-arrow-down"></i> ${formatter.format(data)}`;
                                } else {
                                    return `<i class="fas fa-arrow-up"></i> ${formatter.format(data)}`;
                                }
                            }

                            if (col === 6) {
                                if (parseFloat(modal_barang) > parseFloat(laba_kotor_barang)) {
                                    return `<i class="fas fa-arrow-down"></i> ${formatter.format(data)}`;
                                } else {
                                    return `<i class="fas fa-arrow-up"></i> ${formatter.format(data)}`;
                                }
                            }

                            return formatter.format(data);
                        }
                    }]
                });
            }
            // Tambahkan logika tambahan di sini
        });
    </script>

</body>

</html>
