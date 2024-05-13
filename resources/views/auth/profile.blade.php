@extends('layout.layout')

<style>
    body{
        background-image: radial-gradient(circle at center center, transparent 0%,rgb(0,0,0) 85%),linear-gradient(78deg, rgba(192, 192, 192,0.05) 0%, rgba(192, 192, 192,0.05) 50%,rgba(60, 60, 60,0.05) 50%, rgba(60, 60, 60,0.05) 100%),linear-gradient(227deg, rgba(97, 97, 97,0.05) 0%, rgba(97, 97, 97,0.05) 50%,rgba(52, 52, 52,0.05) 50%, rgba(52, 52, 52,0.05) 100%),linear-gradient(240deg, rgba(98, 98, 98,0.05) 0%, rgba(98, 98, 98,0.05) 50%,rgba(249, 249, 249,0.05) 50%, rgba(249, 249, 249,0.05) 100%),linear-gradient(187deg, rgba(1, 1, 1,0.05) 0%, rgba(1, 1, 1,0.05) 50%,rgba(202, 202, 202,0.05) 50%, rgba(202, 202, 202,0.05) 100%),linear-gradient(101deg, rgba(61, 61, 61,0.05) 0%, rgba(61, 61, 61,0.05) 50%,rgba(254, 254, 254,0.05) 50%, rgba(254, 254, 254,0.05) 100%),linear-gradient(176deg, rgba(237, 237, 237,0.05) 0%, rgba(237, 237, 237,0.05) 50%,rgba(147, 147, 147,0.05) 50%, rgba(147, 147, 147,0.05) 100%),linear-gradient(304deg, rgba(183, 183, 183,0.05) 0%, rgba(183, 183, 183,0.05) 50%,rgba(57, 57, 57,0.05) 50%, rgba(57, 57, 57,0.05) 100%),radial-gradient(circle at center center, hsl(351,4%,12%),hsl(351,4%,12%));
    }
</style>

@section('content')
    @include('home.navbar')

    <style media="screen">

        form {
            height: 480px;
            width: 400px;
            background-color: rgba(255,255,255,0.13);
            position: absolute;
            transform: translate(-50%,-50%);
            top: 57%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            padding: 50px 35px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
        }

        form h3 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            width: 100%;
            margin-bottom: 20px;
        }

        input {
            height: 50px;
            width: 100%;
            background-color: rgba(255,255,255,0.07);
            border-radius: 3px;
            padding: 0 15px;
            font-size: 16px;
            font-weight: 400;
            color: #ffffff;
            border: 1px solid transparent;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #23a2f6;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 500;
        }

        button {
            width: 100%;
            background-color: #23a2f6;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1845ad;
        }

        a {
            margin-top: 20px;
            font-size: 14px;
            text-decoration: none;
            color: #ffffff;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #23a2f6;
        }
        .radio-label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .radio-input {
            display: none;
        }

        .radio-custom {
            position: relative;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 50%;
            border: 2px solid #23a2f6;
        }

        .radio-custom::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            background-color: transparent;
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .radio-input:checked + .radio-custom::before {
            background-color: #23a2f6;
            opacity: 1;
        }

        .radio-group{
            display: ruby;
        }

        @media screen and (max-width: 600px) {
            form {
                width: 90%;
                padding: 30px 20px;
            }

            input {
                height: 40px;
                font-size: 14px;
            }

            button {
                font-size: 16px;
            }

            .radio-label {
                font-size: 14px;
            }
        }

    </style>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form action="{{ route('profile.update') }}" method="post">
        @csrf
        <h3>Profile</h3>

        <div class="form-group">
            <input type="text"  name="name" value="{{ $user->name }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input type="email"  id="email" name="email"  value="{{ $user->email }}">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input type="password"  id="password" name="password" value="{{ $user->password }}">
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="radio-group">
            <label class="radio-label">
                <input type="radio" name="rank" value="consultant" class="radio-input"
                       @if($user->rank === 'consultant') checked @endif>
                <span class="radio-custom"></span>
                Consultant
            </label>
            <label class="radio-label">
                <input type="radio" name="rank" value="responsable" class="radio-input"
                       @if($user->rank === 'responsable') checked @endif>
                <span class="radio-custom"></span>
                Responsable
            </label>
            <label class="radio-label">
                <input type="radio" name="rank" value="manager" class="radio-input"
                       @if($user->rank === 'manager') checked @endif>
                <span class="radio-custom"></span>
                Manager
            </label>
            <label class="radio-label">
                <input type="radio" name="rank" value="directeur" class="radio-input"
                       @if($user->rank === 'directeur') checked @endif>
                <span class="radio-custom"></span>
                Directeur
            </label>
            <div class="form-group">
                <label for="prevRank">Previous Rank:</label>
                <input type="text" id="prevRank" name="prevRank" value="{{ $user->rank }}" readonly>
            </div>
        </div>

        <button type="submit">update</button>
@endsection
