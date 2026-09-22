@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>My Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            {{-- Profile header --}}
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3 pt-4">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fw-bold" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="mb-0 fw-semibold">{{ $user->name }}</h5>
                        <small class="text-muted"><i class="bi bi-envelope me-1"></i>{{ $user->email }}</small>
                    </div>
                </div>
            </div>

            {{-- 1. Profile information --}}
            <div class="card">
                <div class="card-body">
                    <div class="section-title border-bottom pb-2 mb-4">
                        <h5 class="fw-semibold"><i class="bi bi-person-vcard me-2"></i>1. Profile Information</h5>
                    </div>
                    <p class="text-muted small">Update your account's name and email address.</p>

                    @if (session('status') === 'profile-updated')
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle me-2"></i> Profile updated successfully.
                    </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" required autofocus autocomplete="name">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" required autocomplete="username">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="alert alert-warning mt-3 mb-0 d-flex align-items-center flex-wrap gap-2">
                            <i class="bi bi-exclamation-triangle me-1"></i> Your email address is unverified.
                            <button form="send-verification" class="btn btn-sm btn-outline-dark">
                                <i class="bi bi-envelope-arrow-up me-1"></i> Re-send Verification Email
                            </button>
                        </div>
                        @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success mt-3 mb-0">
                            <i class="bi bi-check-circle me-2"></i> A new verification link has been sent to your email address.
                        </div>
                        @endif
                        @endif

                        <div class="border-top mt-4 pt-4 d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>

                    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">@csrf</form>
                </div>
            </div>

            {{-- 2. Update password --}}
            <div class="card">
                <div class="card-body">
                    <div class="section-title border-bottom pb-2 mb-4">
                        <h5 class="fw-semibold"><i class="bi bi-shield-lock me-2"></i>2. Update Password</h5>
                    </div>
                    <p class="text-muted small">Ensure your account is using a long, random password to stay secure.</p>

                    @if (session('status') === 'password-updated')
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle me-2"></i> Password updated successfully.
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Current Password <span class="text-danger">*</span></label>
                                <input type="password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                                @error('current_password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">New Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                                @error('password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                                @error('password_confirmation', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="border-top mt-4 pt-4 d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- 3. Delete account --}}
            <div class="card border-danger">
                <div class="card-body">
                    <div class="section-title border-bottom border-danger pb-2 mb-4">
                        <h5 class="fw-semibold text-danger"><i class="bi bi-exclamation-octagon me-2"></i>3. Delete Account</h5>
                    </div>
                    <p class="text-muted small mb-4">
                        Once your account is deleted, all of its resources and data will be permanently deleted.
                        Before deleting your account, please download any data or information you wish to retain.
                    </p>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            <i class="bi bi-trash me-1"></i> Delete Account
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Delete account confirmation modal --}}
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Account Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted small">
                        Once your account is deleted, all of its resources and data will be permanently deleted.
                        Please enter your password to confirm you would like to permanently delete your account.
                    </p>
                    <div class="mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Enter your password to confirm">
                        @error('password', 'userDeletion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-arrow-left me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->userDeletion->isNotEmpty())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new bootstrap.Modal(document.getElementById('deleteAccountModal')).show();
    });
</script>
@endif

@endsection