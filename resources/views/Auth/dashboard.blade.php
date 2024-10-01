<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            /* Stack elements vertically */
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: -18px;
        }

        .button-container {
            display: flex;
            gap: 20px;
            /* Gap between the buttons */
        }

        .button-54 {
            font-family: "Open Sans", sans-serif;
            font-size: 20px;
            /* Increased font size */
            letter-spacing: 2px;
            text-decoration: none;
            text-transform: uppercase;
            color: #000;
            cursor: pointer;
            border: 3px solid;
            padding: 0.5em 1.5em;
            /* Increased padding */
            box-shadow: 1px 1px 0px 0px, 2px 2px 0px 0px, 3px 3px 0px 0px, 4px 4px 0px 0px, 5px 5px 0px 0px;
            position: relative;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .button-54:active {
            box-shadow: 0px 0px 0px 0px;
            top: 5px;
            left: 5px;
        }

        @media (min-width: 768px) {
            .button-54 {
                padding: 0.75em 2em;
                /* Adjust padding for larger screens */
            }
        }

        /* Smaller logout button */
        .logout-button {
            font-size: 18px;
            /* Smaller font size */
            padding: 0.5em 1.5em;
            /* Smaller padding */
            margin-top: 5px;
        }

        /* Center the logout button */
        .logout-container {
            display: flex;
            justify-content: center;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="button-container">
        <a href="{{ route('login') }}" class="button-54" role="button">Login</a>
        <a href="{{ route('register') }}" class="button-54" role="button">Sign-up</a>
    </div>

    <!-- Auth::user() will now appear below the buttons -->
    <div style="margin-top: 20px;">
        @if(Auth::user())
        <h1>Hello, {{ Auth::user()->name }}!</h1>

        <!-- Centered and smaller logout button -->
        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <!-- Include CSRF token -->
                <button type="submit" class="button-54 logout-button">Logout</button>
            </form>
        </div>
        @endif
    </div>

</body>

</html>