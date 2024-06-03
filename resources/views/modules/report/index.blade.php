@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/bootstrap_multiselect.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
    <div class="mb-3">
        <button type="button" class="btn btn-primary btn-labeled btn-labeled-start btn-lg modal_report" data-bs-toggle="modal" data-bs-target="#report" data-subject="reservasi" data-color="primary">
            <span class="btn-labeled-icon bg-black bg-opacity-20">
                <i class="ph-calendar-check ph-lg"></i>
            </span>
            Laporan Reservasi
        </button>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-warning btn-labeled btn-labeled-start btn-lg modal_report" data-bs-toggle="modal" data-bs-target="#report" data-subject="refund" data-color="warning">
            <span class="btn-labeled-icon bg-black bg-opacity-20">
                <i class="ph-arrow-bend-up-left ph-lg"></i>
            </span>
            Laporan Refund
        </button>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-success btn-labeled btn-labeled-start btn-lg modal_report" data-bs-toggle="modal" data-bs-target="#report" data-subject="ticket_presale" data-color="success">
            <span class="btn-labeled-icon bg-black bg-opacity-20">
                <i class="ph-ticket ph-lg"></i>
            </span>
            Laporan Penjualan Tiket Presale
        </button>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-purple btn-labeled btn-labeled-start btn-lg modal_report" data-bs-toggle="modal" data-bs-target="#report" data-subject="ticket_direct" data-color="purple">
            <span class="btn-labeled-icon bg-black bg-opacity-20">
                <i class="ph-ticket ph-lg"></i>
            </span>
            Laporan Penjualan Tiket Direct
        </button>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-teal btn-labeled btn-labeled-start btn-lg modal_report" data-bs-toggle="modal" data-bs-target="#report" data-subject="inventory" data-color="teal">
            <span class="btn-labeled-icon bg-black bg-opacity-20">
                <i class="ph-stack ph-lg"></i>
            </span>
            Laporan Penjualan Inventory
        </button>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-pink btn-labeled btn-labeled-start btn-lg modal_report" data-bs-toggle="modal" data-bs-target="#report" data-subject="summary" data-color="pink">
            <span class="btn-labeled-icon bg-black bg-opacity-20">
                <i class="ph-bookmarks ph-lg"></i>
            </span>
            Laporan Ringkasan
        </button>
    </div>

    <div id="report" class="modal fade" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header text-white border-0">
					<h6 class="modal-title"></h6>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
                    <form id="form_report" method="POST" action="{{ route('laporan.generate') }}">
                        @csrf
                        <div class="row mb-2" id="alertSummary" hidden>
                            <div class="alert alert-pink alert-icon-start alert-dismissible fade show">
                                <span class="alert-icon bg-pink text-white">
                                    <i class="ph-bell-ringing"></i>
                                </span>
                                Laporan ini merupakan ringkasan dari keseluruhan; <span class="fw-semibold">Reservasi (dengan status pembayaran "paid"), Penjualan Tiket, Penjualan Inventory</span>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label class="col-form-label col-lg-4 fw-bold">Periode</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control daterange-basic" name="tanggal" id="tanggal"> 
                            </div>
                        </div>

                        <div id="reservasi" hidden>
                            <div class="row mb-2">
                                <label class="col-form-label col-lg-4">Status Reservasi</label>
                                <div class="col-lg-8">
                                    <select class="form-control multiselect" name="reservation_status[]" id="reservation_status" multiple="multiple" data-include-select-all-option="true">
                                        <option value="aktif">Aktif</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="cancel">Cancel</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-2">
                                <label class="col-form-label col-lg-4">Status Pembayaran</label>
                                <div class="col-lg-8">
                                    <select class="form-control multiselect" name="payment_status[]" id="payment_status" tabindex="-1" multiple="multiple" data-include-select-all-option="true">
                                        <option value="ditinjau">Ditinjau</option>
                                        <option value="paid">Paid</option>
                                        <option value="cancel">Cancel</option>
                                        <option value="expire">Kadaluarsa</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="subject" id="subject" readonly>
                    </form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger close_modal" data-bs-dismiss="modal">Tutup</button>
					<button type="button" class="btn btn_show" onclick="generateReport()">Download Excel</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
    <script>
        $(document).ready(function() {
            $('.daterange-basic').daterangepicker({
                parentEl: '.content-inner',
                locale: {
                    format: 'YYYY-MM-DD', // Set the date format
                    cancelLabel: 'Clear',
                }
            });

            $('.multiselect').multiselect();
        });

        var reportBtns = document.querySelectorAll('.modal_report');
        var divReservasi = document.getElementById('reservasi');
        var divAlertSummary = document.getElementById('alertSummary');

        reportBtns.forEach(function(reportBtn) {
            reportBtn.addEventListener('click', function() {
                let color = reportBtn.getAttribute('data-color');
                let subject = reportBtn.getAttribute('data-subject');
                let subjectInput = document.getElementById('subject');
                subjectInput.value = subject;

                let modalHeader = document.querySelector('.modal-header');
                let modalContent = document.querySelector('.modal-content');
                let modalTitle = document.querySelector('.modal-title');
                let btn_show = document.querySelector('.btn_show');

                modalHeader.className = 'modal-header text-white border-0 bg-' + color;
                btn_show.className = 'btn btn_show btn-' + color;
                modalTitle.textContent = reportBtn.textContent.trim();

                if (subject === 'reservasi') {
                    modalContent.style.height = '550px';
                    modalContent.style.overflowY = 'auto';

                    divAlertSummary.setAttribute('hidden', true);
                    divReservasi.removeAttribute('hidden');
                } else if(subject === 'summary'){
                    divAlertSummary.removeAttribute('hidden');
                    divReservasi.setAttribute('hidden', true);

                    modalContent.style.height = '';
                    modalContent.style.overflowY = '';
                } else{
                    divAlertSummary.setAttribute('hidden', true);
                    divReservasi.setAttribute('hidden', true);

                    modalContent.style.height = '';
                    modalContent.style.overflowY = '';
                }
            });
        });

        function generateReport(){
            document.getElementById('form_report').submit();
        }
    </script>
@endsection