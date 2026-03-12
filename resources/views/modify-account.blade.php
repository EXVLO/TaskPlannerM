@extends('layouts.app')

@section('title', 'Modify Account')

@push('styles')
    <style>

        .modify-wrapper{
            max-width:720px;
            margin:0 auto;
            padding:50px 20px;
        }

        .modify-header{
            text-align:center;
            margin-bottom:50px;
        }

        .modify-header h1{
            font-size:34px;
            font-weight:800;
            letter-spacing:-0.5px;
            background:linear-gradient(90deg,#60a5fa,#a78bfa,#22d3ee);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            margin-bottom:10px;
        }

        .modify-header p{
            color:#9ca3af;
            font-size:15px;
        }

        /* CARD */

        .modify-card{
            background:linear-gradient(145deg,#111827,#1f2937);
            border:1px solid #374151;
            border-radius:16px;
            padding:28px;
            margin-bottom:26px;

            backdrop-filter:blur(8px);

            box-shadow:
                0 10px 30px rgba(0,0,0,0.45),
                inset 0 1px 0 rgba(255,255,255,0.05);

            transition:transform .25s ease, box-shadow .25s ease;
        }

        .modify-card:hover{
            transform:translateY(-3px);
            box-shadow:
                0 14px 60px rgba(0,0,0,0.55),
                0 0 20px rgba(99,102,241,0.12);
        }

        .modify-card h2{
            font-size:20px;
            font-weight:700;
            color:#f3f4f6;
            margin-bottom:18px;
            border-left:4px solid #6366f1;
            padding-left:12px;
        }

        /* LABELS */

        .modify-card label{
            display:block;
            font-size:13px;
            font-weight:600;
            color:#9ca3af;
            margin-bottom:6px;
        }

        /* INPUTS */

        .modify-card input{
            width:100%;
            max-width:640px;
            padding:10px 12px;
            border-radius:8px;
            border:1px solid #374151;
            background:#020617;
            color:#e5e7eb;
            margin-bottom:16px;
            font-size:14px;
            transition:border .2s ease, box-shadow .2s ease;
        }

        .modify-card input::placeholder{
            color:#6b7280;
        }

        .modify-card input:focus{
            outline:none;
            border-color:#6366f1;
            box-shadow:0 0 0 2px rgba(99,102,241,0.25);
        }

        /* BUTTONS */

        .modify-card button{
            border:none;
            padding:11px 22px;
            border-radius:10px;
            font-weight:700;
            cursor:pointer;
            transition:all .25s ease;
            letter-spacing:.3px;
        }

        .modify-card button.primary{
            background:linear-gradient(135deg,#3b82f6,#6366f1);
            color:white;
        }

        .modify-card button.secondary{
            background:linear-gradient(135deg,#22c55e,#16a34a);
            color:white;
        }

        .modify-card button.danger{
            background:linear-gradient(135deg,#ef4444,#b91c1c);
            color:white;
        }

        .modify-card button:hover{
            transform:translateY(-2px);
            box-shadow:0 6px 18px rgba(0,0,0,0.35);
            opacity:.95;
        }

        .danger-note{
            color:#f87171;
            font-size:14px;
            margin-bottom:18px;
        }

        form.delete-form{
            text-align:center;
        }

        .back-link{
            color:#60a5fa;
            text-decoration:none;
            font-weight:700;
        }

        .back-link:hover{
            opacity:0.8;
        }

    </style>
@endpush

{{--------- --------- ---------}}
{{--------- Main Part ---------}}
{{--------- --------- ---------}}

@section('content')

    <div class="modify-wrapper">

        <div class="modify-header">
            <h1>Account Settings</h1>
            <p>Manage your profile information and security settings</p>
        </div>

        {{-- CHANGE NAME --}}
        <div class="modify-card">

            <h2>Update Display Name</h2>

            <form method="POST" action="{{ route('account.update') }}">
                @csrf

                <label for="name">Display Name</label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Enter your name"
                    value="{{ old('name', Auth::user()->name) }}"
                    required
                >

                <button type="submit" class="primary">
                    Update Name
                </button>

            </form>

        </div>


        {{-- CHANGE PASSWORD --}}
        <div class="modify-card">

            <h2>Change Password</h2>

            <form method="POST" action="{{ route('account.updatePassword') }}">

                @csrf

                <label for="current_password">Current Password</label>

                <input
                    id="current_password"
                    name="current_password"
                    type="password"
                    placeholder="Enter current password"
                    required
                >

                <label for="password">New Password</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Enter new password"
                    required
                >

                <label for="password_confirmation">Confirm New Password</label>

                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="Confirm new password"
                    required
                >

                <button type="submit" class="secondary">
                    Update Password
                </button>

            </form>

        </div>


        {{-- DELETE ACCOUNT --}}
        <div class="modify-card">

            <h2>Delete Account</h2>

            <p class="danger-note">
                Once your account is deleted, all tasks, task managers and data will be permanently removed.
            </p>

            <form method="POST"
                  action="{{ route('account.destroy') }}"
                  class="delete-form"
                  onsubmit="return confirm('Are you sure you want to delete?')">

                @csrf
                @method('DELETE')

                <button type="submit" class="danger">
                    Delete My Account
                </button>

            </form>

        </div>

        <a href="{{ route('appsettings') }}" class="back-link">
            ← Back to Settings
        </a>

    </div>

@endsection
