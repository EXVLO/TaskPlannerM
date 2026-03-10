{{--
    Modify Account Page

    This page allows users to update their display name, change their password
    and delete their account. It uses a dark theme consistent with the rest
    of the application and simple card layouts. Place this file at
    `resources/views/modify-account.blade.php` in your Laravel application
    and create corresponding routes and controller methods to handle the
    form submissions. Ensure routes are protected with the `auth` middleware.
--}}

@extends('layouts.app')

@section('title', 'Modify Account')

@push('styles')
    <style>
        .modify-wrapper{
            max-width:700px;
            margin:0 auto;
            padding:40px 20px;
        }
        .modify-header{
            text-align:center;
            margin-bottom:32px;
        }
        .modify-header h1{
            font-size:2rem;
            font-weight:700;
            color:#f1f5f9;
            margin-bottom:8px;
        }
        .modify-header p{
            color:#94a3b8;
            font-size:1rem;
        }
        .modify-card{
            background:#1e293b;
            border-radius:10px;
            padding:24px;
            box-shadow:0 4px 14px rgba(0,0,0,0.35);
            margin-bottom:32px;
        }
        .modify-card h2{
            color:#f1f5f9;
            font-size:1.4rem;
            margin-bottom:16px;
        }
        .modify-card label{
            display:block;
            color:#cbd5e1;
            margin-bottom:4px;
            font-size:0.9rem;
        }
        .modify-card input{
            width:100%;
            padding:10px 14px;
            border-radius:6px;
            border:none;
            margin-bottom:16px;
            background:#334155;
            color:#f1f5f9;
        }
        .modify-card button{
            display:inline-block;
            padding:10px 20px;
            border-radius:8px;
            font-weight:700;
            border:none;
            cursor:pointer;
            transition:opacity 0.3s ease;
            text-decoration:none;
        }
        .modify-card button.primary{
            background:linear-gradient(135deg,#2563eb,#7c3aed);
            color:white;
            margin-right:8px;
        }
        .modify-card button.secondary{
            background:linear-gradient(135deg,#15803d,#22c55e);
            color:white;
        }
        .modify-card button.danger{
            background:linear-gradient(135deg,#b91c1c,#ef4444);
            color:white;
        }
        .modify-card button:hover{
            opacity:0.85;
        }
        form.delete-form{
            text-align:center;
        }
    </style>
@endpush

@section('content')
    <div class="modify-wrapper">
        <div class="modify-header">
            <h1>Manage Your Account</h1>
            <p>Update your name, change your password or delete your account.</p>
        </div>
        {{-- Update Name --}}
        <div class="modify-card">
            <h2>Change Name</h2>
            <form method="POST" action="{{ route('account.update') }}">
                @csrf
                @method('POST')
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', Auth::user()->name) }}" required>
                <button type="submit" class="primary">Update Name</button>
            </form>
        </div>
        {{-- Change Password --}}
        <div class="modify-card">
            <h2>Change Password</h2>
            <form method="POST" action="{{ route('account.updatePassword') }}">
                @csrf
                @method('POST')
                <label for="current_password">Current Password</label>
                <input id="current_password" name="current_password" type="password" required>
                <label for="password">New Password</label>
                <input id="password" name="password" type="password" required>
                <label for="password_confirmation">Confirm New Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required>
                <button type="submit" class="secondary">Update Password</button>
            </form>
        </div>
        {{-- Delete Account --}}
        <div class="modify-card">
            <h2>Delete Account</h2>
            <p class="details-item" style="color:#f87171;margin-bottom:16px;">Once your account is deleted, all data will be permanently removed.</p>
            <form method="POST" action="{{ route('account.destroy') }}" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="danger">Delete My Account</button>
            </form>
        </div>
    </div>
@endsection
