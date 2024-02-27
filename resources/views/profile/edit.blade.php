@extends('layouts.app')
@section('subtitle')
    | Profile
@endsection
@section('content')
<div class="d-lg-flex align-items-lg-start">

    <!-- Left sidebar component -->
    <div class="sidebar sidebar-component sidebar-expand-lg bg-transparent shadow-none me-lg-3">

        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- Navigation -->
            <div class="card">
                <div class="sidebar-section-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img class="img-fluid rounded-circle" src="../../../assets/images/demo/users/face11.jpg" width="150" height="150" alt="">
                        <div class="card-img-actions-overlay card-img rounded-circle">
                            <a href="#" class="btn btn-outline-white btn-icon rounded-pill">
                                <i class="ph-pencil"></i>
                            </a>
                        </div>
                    </div>

                    <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                    <span class="text-muted">{{ auth()->user()->roles->pluck('name')[0] }}</span>
                </div>
            </div>
            <!-- /navigation -->
        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /left sidebar component -->


    <!-- Right content -->
    <div class="tab-content flex-fill">
        <div class="tab-pane fade active show" id="profile">

            <!-- Profile info -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Profile</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input name="name" id="name" type="text" value="{{ old('name', $user->name) }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input name="email" id="email" type="text" value="{{ old('email', $user->email) }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /profile info -->


            <!-- Account settings -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Reset Password</h5>
                </div>

                <div class="card-body">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Password Sekarang</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Password Baru</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /account settings -->

        </div>
    </div>
    <!-- /right content -->
</div>
@endsection