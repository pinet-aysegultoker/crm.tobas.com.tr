<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="msapplication-TileColor" content="#ffa20d" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/icons/ms-icon-144x144.png') }}" />
    <meta name="theme-color" content="#ffa20d" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/icons/apple-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/icons/apple-icon-60x60.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/icons/apple-icon-72x72.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/icons/apple-icon-76x76.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/icons/apple-icon-114x114.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/icons/apple-icon-120x120.png') }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/icons/apple-icon-144x144.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/icons/apple-icon-152x152.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/icons/apple-icon-180x180.png') }}" />
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/icons/android-icon-192x192.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icons/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/icons/favicon-96x96.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/icons/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('assets/icons/manifest.json') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/css/datetimepicker.min.css') }}" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/css/select.min.css') }}" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/css/select.bootstrap.min.css') }}" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}" crossorigin="anonymous" />
    <title>@yield('title') | {{ Config::get('app.name') }}</title>
    <script src="{{ asset('assets/js/common/jquery-3.2.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/common/ajax-form.min.js') }}" crossorigin="anonymous"></script>
    <script>
        $(window).on('load', function() {
            $(".loading").show().fadeOut("slow");
        });
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/fusioncharts/fusioncharts.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/fusioncharts/fusioncharts.charts.js') }}" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://momentjs.com/downloads/moment-with-locales.min.js" crossorigin="anonymous"></script>
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/common/datetimepicker.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/common/select.min.js') }}" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('.table-crm').dataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Turkish.json"
                },
                "aaSorting": []
            });
            $("select").select2();
            $(function () {
                $('.btn.btn-xs.btn-info').tooltip({
                    placement: 'top',
                    title: 'Görüntüleme',
                })
                $('.btn.btn-xs.btn-warning').tooltip({
                    placement: 'top',
                    title: 'Düzenleme',
                })
                $('.btn.btn-xs.btn-danger').tooltip({
                    placement: 'top',
                    title: 'Silme',
                })
            });
            $(":input").inputmask();
            $('.currency-control').inputmask("numeric", {
                radixPoint: ",",
                groupSeparator: ".",
                digits: 2,
                autoGroup: true,
                rightAlign: false,
                oncleared: function () { self.Value(''); }
            });
        });
    </script>
    @yield('style')
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="loading">
    <div class="loading-image"></div>
</div>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#crm-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Uyarlanmış Menü</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                <img alt="Brand" src="{{ asset('assets/images/nav-logo.png') }}">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="crm-navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('personal-report.index') }}"><i class="fa fa-line-chart" aria-hidden="true"></i> Kişisel Raporlar</a></li></li>
                <li><a href="{{ route('sales.index') }}"><i class="fa fa-bookmark-o" aria-hidden="true"></i> Satışlar</a></li></li>
                <li><a href="{{ route('offer.index') }}"><i class="fa fa-turkish-lira" aria-hidden="true"></i> Teklifler</a></li></li>
                <li><a href="{{ route('reserved.index') }}"><i class="fa fa-lock" aria-hidden="true"></i> Rezerve </a></li></li>
                <li><a href="{{ route('customer.index') }}"><i class="fa fa-users" aria-hidden="true"></i> Müşteriler</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building" aria-hidden="true"></i> Konutlar <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Konutlar</li>
                        <li><a href="{{ route('apartment.index') }}">Konutlar</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Bloklar</li>
                        <li><a href="{{ route('building.index') }}">Bloklar</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Projeler</li>
                        <li><a href="{{ route('project.index') }}">Projeler</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('call.index') }}"><i class="fa fa-phone" aria-hidden="true"></i> Çağrı Merkezi</a></li>
                @if(Auth::user()->group_id==1 || Auth::user()->group_id==2)

                    <li><a href="{{ route('form.index') }}"><i class="fa fa-wpforms" aria-hidden="true"></i> KuzeyKent Bilgi Formu</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i> Sistem <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Sistem Kullanıcısı İşlemleri</li>
                            <li><a href="{{ route('system.users.index') }}">Sistem Kullanıcılarını Görüntüle</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Sistem Yönetimi İşlemleri</li>
                            <li><a href="{{ route('system.logs.index') }}">Sistem Günlüğünü Görüntüle</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Sistem Müşteri İşlemleri</li>
                            <li><a href="{{ route('customer.detail') }}">Sistem Müşteri Detay Alanı Görüntüle</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Hesap İşlemleri</li>
                        <li><a href="{{ route('profile.index') }}">Hesap İşlemleri</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Kılavuzlar</li>
                        <li><a href="http://crm.tobas.com.tr/files/kilavuz.pdf" target="_blank">CRM Kullanım Kılavuzu</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Sistemden Çıkış İşlemleri</li>
                        <li><a href="{{ route('auth.logout') }}">Çıkış Yap</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
        @if ($errors->any())
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
</div>
@yield('content')
<footer class="footer">
    <div class="container">
        <p class="copyright">KuzeyKent Konut Projesi © Copyright {{ date('Y') }}</p>
    </div>
</footer>
@if (Session::has('error'))
    <div class="modal fade" tabindex="-1" role="dialog" id="errorModal">
        <div class="modal-dialog">
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ Session::get('error') }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(window).on('load', function(){
            $('#errorModal').modal('show');
        });
    </script>
@endif
@if (Session::has('success'))
    <div class="modal fade" tabindex="-1" role="dialog" id="successModal">
        <div class="modal-dialog">
            <div class="col-sm-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(window).on('load', function(){
            $('#successModal').modal('show');
        });
    </script>
@endif
</body>
</html>
