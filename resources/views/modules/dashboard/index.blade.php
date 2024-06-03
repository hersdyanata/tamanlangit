@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script> 
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script>
    
    {{-- Echarts --}}
    <script src="{{ asset('assets/js/vendor/visualization/echarts/echarts.min.js') }}"></script>

    {{-- C3 Charts --}}
    <script src="{{ asset('assets/js/vendor/visualization/d3/d3v5.min.js') }}"></script>
	<script src="{{ asset('assets/js/vendor/visualization/c3/c3.min.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
@php
    // $start_date = '2024-03-01';
    // $end_date = '2024-04-30';
    $start_date = date('Y-m-01');
    $end_date = date('Y-m-d');
@endphp
@cannot('dashboard-widget')
<div class="row col-xl-12">
    <h1>Selamat datang kembali🙂</h1>
</div>
@endcannot
@can('dashboard-widget')
    <div class="col-lg-5 mb-3">
        <label class="form-label">Periode:</label>
        <input type="text" class="form-control input-sm" placeholder="Periode..." id="tanggal" name="tanggal" autocomplete="off" value="{{ $start_date.' - '.$end_date }}">
    </div>

    <div class="row col-xl-12">
        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-primary text-white">
                <div class="d-flex align-items-center">
                    <div class="flex-fill">
                        <h3 class="mb-0" id="disp_reservation">-</h3>
                        <span class="fst-italic">reservasi</span>
                    </div>

                    <i class="ph-calendar-check ph-3x text-primary ms-3"></i>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-success text-white">
                <div class="d-flex align-items-center">
                    <div class="flex-fill">
                        <h3 class="mb-0" id="disp_ticket">-</h3>
                        <span class="fst-italic">penjualan tiket</span>
                    </div>

                    <i class="ph-ticket ph-3x text-success ms-3"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-warning text-white">
                <div class="d-flex align-items-center">
                    <div class="flex-fill">
                        <h3 class="mb-0" id="disp_inventory">-</h3>
                        <span class="fst-italic">penjualan inventory</span>
                    </div>

                    <i class="ph-archive ph-3x text-warning ms-3"></i>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-pink text-white">
                <div class="d-flex align-items-center">
                    <div class="flex-fill">
                        <h3 class="mb-0" id="disp_purchase">-</h3>
                        <span class="fst-italic">pembelian</span>
                    </div>

                    <i class="ph-truck ph-3x text-pink ms-3"></i>
                </div>
            </div>
        </div>
    </div>
@endcan

@can('dashboard-graph')
    <div class="row col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Grafik Income - Expense</h5>
            </div>

            <div class="card-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="chartThis"></div>
                </div>
            </div>
        </div>
    </div>
@endcan

@can('dashboard-table')
    <div class="row col-xl-12">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Sedang Check-in</h5>
                </div>

                <div class="card-body">
                    <table class="table datatable-basic table-hover table-xs" id="tableCheckIn">
                        <thead>
                            <tr class="table-border-double bg-teal bg-opacity-20">
                                <th class="text-center">#</th>
                                <th>Nomor Tiket</th>
                                <th>Wahana / Tenda</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Akan Datang</h5>
                </div>

                <div class="card-body">
                    <table class="table datatable-basic table-hover table-xs" id="tableUpcoming">
                        <thead>
                            <tr class="table-border-double bg-teal bg-opacity-20">
                                <th class="text-center">#</th>
                                <th>Nomor Tiket</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Kupon Aktif</h5>
                </div>

                <div class="card-body">
                    <table class="table datatable-basic table-hover table-xs" id="tableCoupon">
                        <thead>
                            <tr class="table-border-double bg-teal bg-opacity-20">
                                <th class="text-center">#</th>
                                <th>Kode</th>
                                <th>Quantity</th>
                                <th>Jenis</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endcan
@endsection

@section('page_js')
<script>
    @can('dashboard-widget')
        sidebar_collapsed();
        $('#tanggal').daterangepicker({
            parentEl: '.content-inner',
            locale: {
                format: 'YYYY-MM-DD', // Set the date format
                cancelLabel: 'Clear',
            },
        });

        let dispReservation = document.getElementById('disp_reservation');
        let dispTicket = document.getElementById('disp_ticket');
        let dispInventory = document.getElementById('disp_inventory');
        let dispPurchase = document.getElementById('disp_purchase');

        widgets();

        $('#tanggal').on('change', function (){
            widgets();
        });
    @endcan

    @can('dashboard-table')
        var tableCheckIn;
        var tableUpcoming;
        var tableCoupon;
        $(document).ready(function() {
            tableCheckIn = $('#tableCheckIn').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                    searchPlaceholder: 'Ketik untuk mencari...',
                    lengthMenu: '<span class="me-3">Tampilkan:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
                },
                ajax: {
                    url: "{{ route('transaksi.cash-reservasi.index') }}",
                    data: function (d) {
                        d.dashboard = 'Y';
                        d.subject = 'checkin';
                    }
                },
                serverSide: true,
                processing: true,
                searching: false,
                columns: [
                    { data: 'DT_RowIndex', class: 'text-center', orderable: false, searchable: false, name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
                    { data: 'a_tiket', orderable: false, searchable: false, name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
                    {
                        data: 'wahana.name',
                        orderable: false, searchable: false,
                        render: function(data, type, row) {
                            return data + ' / ' + row.room.name;
                        }
                    }
                ],
                order: [[0, 'asc']],
                drawCallback: function (setting) {
                    $('.tooltiped').tooltip({
                        "html": true,
                        trigger: 'hover',
                        placement: 'top',
                    });
                },
            });
            
            tableUpcoming = $('#tableUpcoming').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                    searchPlaceholder: 'Ketik untuk mencari...',
                    lengthMenu: '<span class="me-3">Tampilkan:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
                },
                ajax: {
                    url: "{{ route('transaksi.cash-reservasi.index') }}",
                    data: function (d) {
                        d.dashboard = 'Y';
                        d.subject = 'upcoming';
                    }
                },
                serverSide: true,
                processing: true,
                searching: false,
                columns: [
                    { data: 'DT_RowIndex', class: 'text-center', orderable: false, searchable: false, name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
                    { data: 'a_tiket', orderable: false, searchable: false, name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
                    {
                        data: 'start_date',
                        orderable: false, searchable: false,
                        render: function(data, type, row) {
                            return moment(data).format('DD.MM.YYYY');
                        }
                    },
                ],
                order: [[0, 'asc']],
                drawCallback: function (setting) {
                    $('.tooltiped').tooltip({
                        "html": true,
                        trigger: 'hover',
                        placement: 'top',
                    });
                },
            });

            tableCoupon = $('#tableCoupon').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                    searchPlaceholder: 'Ketik untuk mencari...',
                    lengthMenu: '<span class="me-3">Tampilkan:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
                },
                ajax: {
                    url: "{{ route('wahana.kupon.index') }}",
                },
                serverSide: true,
                processing: true,
                searching: false,
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
                    { data: 'code', name: 'code', orderable: false, searchable: false, sortable: false },
                    { data: 'qty_balance', name: 'qty_balance', orderable: false, searchable: false, sortable: false },
                    { data: 'discount_type', name: 'discount_type', orderable: false, searchable: false, sortable: false },
                ],
                order: [[0, 'asc']],
                drawCallback: function (setting) {
                    $('.tooltiped').tooltip({
                        "html": true,
                        trigger: 'hover',
                        placement: 'top',
                    });
                },
            });
        });
    @endcan

    @can('dashboard-widget')

        let sideBarToggle = $('.sidebar-main');
        var area_chart_element = document.getElementById('chartThis');
        let area_chart;

        sideBarToggle.on('click', function() {
            area_chart.resize();
        });

        function widgets(){
            $.ajax({
                type: "POST",
                url: "{{ route('dashboard.chart') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    daterange: $('#tanggal').val(),
                },
                // beforeSend: function(){
                //     $('#loader').show();
                // },
                success: function (s) {
                    // sw_success(s);
                    dispReservation.innerHTML = formatCurrency(s.reservation_count) + ' / ' + formatCurrency(s.reservation_omzet);
                    dispTicket.innerHTML = formatCurrency(s.ticket_count) + ' / ' + formatCurrency(s.ticket_omzet);
                    dispInventory.innerHTML = formatCurrency(s.inventory_count) + ' / ' + formatCurrency(s.inventory_omzet);
                    dispPurchase.innerHTML = formatCurrency(s.purchase_count) + ' / ' + formatCurrency(s.purchase_expense);
                    // areaEchart(s.chart);
                    areaC3Chart(s.c3Chart);
                },
                error: function(e){
                    sw_single_error(e);
                },
                // complete: function(){
                //     // 
                // }
            });
        }
    @endcan

    @can('dashboard-graph')
        function areaEchart(resource){
            var area_stacked_element = document.getElementById('chartThis');
            if (area_stacked_element) {
                var area_stacked = echarts.init(area_stacked_element, null, { renderer: 'svg' });
                area_stacked.setOption({
                    color: ['#2ec7c9','#d87a80'],
                    textStyle: {
                        fontFamily: 'var(--body-font-family)',
                        color: 'var(--body-color)',
                        fontSize: 14,
                        lineHeight: 22,
                        textBorderColor: 'transparent'
                    },
                    animationDuration: 750,
                    grid: {
                        left: 10,
                        right: 40,
                        top: 35,
                        bottom: 5,
                        containLabel: true
                    },
                    legend: {
                        data: ['Income', 'Expense'],
                        itemHeight: 8,
                        itemGap: 30,
                        textStyle: {
                            color: 'var(--body-color)'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        className: 'shadow-sm rounded',
                        backgroundColor: 'var(--white)',
                        borderColor: 'var(--gray-400)',
                        padding: 15,
                        textStyle: {
                            color: '#000'
                        }
                    },
                    xAxis: [{
                        type: 'category',
                        boundaryGap: false,
                        data: resource.tanggal,
                        axisLabel: {
                            color: 'rgba(var(--body-color-rgb), .65)'
                        },
                        axisLine: {
                            lineStyle: {
                                color: 'var(--gray-500)'
                            }
                        },
                        splitLine: {
                            show: true,
                            lineStyle: {
                                color: 'var(--gray-300)',
                                type: 'dashed'
                            }
                        }
                    }],
                    yAxis: [{
                        type: 'value',
                        axisLabel: {
                            color: 'rgba(var(--body-color-rgb), .65)'
                        },
                        axisLine: {
                            show: true,
                            lineStyle: {
                                color: 'var(--gray-500)'
                            }
                        },
                        splitLine: {
                            lineStyle: {
                                color: 'var(--gray-300)'
                            }
                        },
                        splitArea: {
                            show: true,
                            areaStyle: {
                                color: ['rgba(var(--white-rgb), .01)', 'rgba(var(--black-rgb), .01)']
                            }
                        }
                    }],
                    axisPointer: [{
                        lineStyle: {
                            color: 'var(--gray-600)'
                        }
                    }],
                    series: [
                        {
                            name: 'Income',
                            type: 'line',
                            stack: 'Total',
                            areaStyle: {
                                normal: {
                                    opacity: 0.25
                                }
                            },
                            smooth: true,
                            symbol: 'circle',
                            symbolSize: 8,
                            data: resource.income
                        },
                        {
                            name: 'Expense',
                            type: 'line',
                            stack: 'Total',
                            areaStyle: {
                                normal: {
                                    opacity: 0.25
                                }
                            },
                            smooth: true,
                            symbol: 'circle',
                            symbolSize: 8,
                            data: resource.expense
                        },
                    ]
                });
            }
        }

        function areaC3Chart(resource){
            area_chart = c3.generate({
                bindto: area_chart_element,
                size: { height: 400 },
                point: {
                    r: 4
                },
                color: {
                    pattern: ['#2ec7c9','#d87a80']
                },
                data: {
                    x: 'x',
                    columns: [
                        resource.tanggal,
                        resource.income,
                        resource.expense
                    ],
                    // types: 'area-spline',
                    types: {
                        income: 'area-spline',
                        expense: 'area-spline'
                    }
                },
                axis: {
                    x: {
                        type: 'timeseries',
                        tick: {
                            format: resource.dateFormat
                        }
                    },
                    y: {
                        tick: {
                            format: d3.format(",")
                            // format: function(d) {
                            //     if(d >= 10000 && d < 100000){
                            //         return d / 1000 + ' Rb';
                            //     }else if (d >= 100000 && d < 1000000){
                            //         return d / 1000 + ' Rb';
                            //     }else if(d >= 1000000) {
                            //         return d / 1000000 + ' Jt';
                            //     } else {
                            //         return d;
                            //     }
                            // }
                        }
                    }
                },
                grid: {
                    y: {
                        show: true
                    },
                    x: {
                        show: true
                    }
                }
            });
        }
    @endcan
</script>
@endsection