@extends('layout.layout')

@section('content')

    <style media="screen">
        body {
            background-color: #080710;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%,-50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#1845ad, #23a2f6);
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(to right, #ff512f, #f09819);
            right: -30px;
            bottom: -80px;
        }

        form {
            height: 520px;
            width: 400px;
            background-color: rgba(255,255,255,0.13);
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            padding: 50px 35px;
            display: flex;
            flex-direction: column;
            align-items: center;
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

    </style>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form action="{{ route('register.submit') }}" method="post">
        @csrf
        <h3>Register Here</h3>

        <div class="form-group">
            <input type="text"  name="name" placeholder="Enter your name">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input type="email"  id="email" name="email" placeholder="Enter your email">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input type="password"  id="password" name="password" placeholder="Enter your password">
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="radio-group"><label class="radio-label">
                <input type="radio" name="rank" value="consultant" class="radio-input">
                <span class="radio-custom"></span>
                Consultant
            </label>
            <label class="radio-label">
                <input type="radio" name="rank" value="responsable" class="radio-input">
                <span class="radio-custom"></span>
                Responsable
            </label>
            <label class="radio-label">
                <input type="radio" name="rank" value="manager" class="radio-input">
                <span class="radio-custom"></span>
                Manager
            </label>
            <label class="radio-label">
                <input type="radio" name="rank" value="directeur" class="radio-input">
                <span class="radio-custom"></span>
                Directeur
            </label>

        </div>

        <button type="submit">Register</button>
        <a href="{{ route("login") }}">Already have an account? Login</a>
    </form>

@endsection
