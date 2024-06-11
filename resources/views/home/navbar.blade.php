

<style>
    * {
        margin: 0%;
        padding: 0%;
        font-family: Arial, Helvetica, sans-serif;
    }

    header {
        background-color: #080710;
        background-size: cover;
        border-bottom-right-radius: 45px;
        border-bottom-left-radius: 45px;
        position: fixed;
        z-index: 88;
        width: 100%;
    }

    .brand {
        font-size: 2rem;
        color: white;
        text-decoration: none;
    }

    .navbar {
        height: 90px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 25px;
        padding-right: 4%;
        position: relative; /* Added position relative */
    }

    li {
        list-style: none;
    }

    .nav-link {
        text-decoration: none;
        color: white;
    }

    .menu {
        /*gap: 50px;*/
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .nav-link {
        transition: 0.7s ease;
    }

    .nav-link:hover {
        color: blueviolet;
    }

    .nav-span {
        display: none;
        cursor: pointer;
    }

    .nav {
        display: block;
        width: 27px;
        height: 3px;
        margin: 5px auto;
        -webkit-transition: all 0.4s ease-in-out;
        transition: all 0.4s ease-in-out;
        background-color: white;
        border-radius: 7px;
    }

    .nav:nth-child(1) {
        width: 33px;
    }

    .nav:nth-child(3) {
        width: 33px;
    }

    .nav:nth-child(2) {
        margin-left: 0px;
    }

    .shape1 {
        left: 5%;
        height: 90px;
        width: 90px;
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(
            #1845ad,
            #23a2f6
        );
    }
    .shape3 {
        left: 15%;
        height: 90px;
        width: 90px;
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(
            #1845ad,
            #23a2f6
        );
    }
    .shape2 {
        height: 90px;
        left: 10%;
        width: 90px;
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(
            to right,
            #ff512f,
            #f09819
        );
    }
    .shape4 {
        height: 90px;
        left: 20%;
        width: 90px;
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(
            to right,
            #ff512f,
            #f09819
        );
    }
    .nav-link{
        font-size:30px ;
    }
    .checkbox{
        display: none;
    }
    @media only screen and (max-width: 1134px) {
        .navbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .menu {
            flex-direction: column;
            align-items: flex-start;
            padding-top: 20px;
            gap: 0px;
        }

        .nav-link {
            font-size: 20px;
        }

        .nav-span {
            display: block;
        }

        .nav {
            display: none;
        }

        .shape1,
        .shape2,
        .shape3,
        .shape4 {
            height: 60px;
            width: 60px;
        }
        .brand{
            font-size: 25px !important;
            margin-top: 10px;
        }

        .checkbox{
            display: block;
            position: absolute;
            width: 50px;
            height: 50px;
            top: 10px;
            right: 5px;
            margin: auto;
            opacity: 0;
            z-index: 2;
            cursor: pointer;
        }

         #label{
            position: absolute;
            width: 45px;
            height: 5px;
            top: 30px;
             right: 10px;
            margin: auto;
             background: linear-gradient(
                 to right,
                 #ff512f,
                 #f09819
             );
            border-radius: 5px;
            display: block;
            z-index: 1;
            transition: all .5s ease;
        }

         #label::after ,  #label::before{
            content: " ";
            position: absolute;
            width: 45px;
            height: 5px;
             background: linear-gradient(
                 to right,
                 #ff512f,
                 #f09819
             );
            border-radius: 5px;
            display: block;
            z-index: 1;
            transition: all .5s ease;
        }

         #label::after {
            top: -12px;

        }

         #label::before {
            top: 12px;

        }

        .checkbox:checked + #label{
            background: transparent;
            transition: all .5s ease;
        }

        .checkbox:checked + #label::after,
        .checkbox:checked + #label::before{
            width: 45px;
            top: 0;
            transition: all .5s ease;
        }

        .checkbox:checked + #label::after{
            transform: rotate(45deg);

        }

        .checkbox:checked + #label::before{
            transform: rotate(-45deg);
        }

        .menu{
            display: none;
        }

        .checkbox:checked ~ .menu{
            display: block;
            height: 230px;
            background-color: #080710;
        }


    }

    @media screen and (max-width:500px) {
        .checkbox:checked ~ .menu{
            display: block;
            height: 190px;
            background-color: #080710;
            position: absolute;
            left: 10%;
            top: 30%;
        }
        .brand{
            font-size: 15px !important;
            margin-top: 10px;
        }
    }
    @media screen and (max-width: 330px) {
        .checkbox{
            position: absolute;
            left: 78%;
        }
    }

</style>

<header>
    <nav class="navbar" id="navbar">
            <div class="shape1"></div>
            <div class="shape2"></div>
            <div class="shape3"></div>
            <div class="shape4"></div>
        <a class="brand" href="{{route('home')}}" style="font-size: 35px; cursor: pointer;z-index: 1">
            FORTIWAVE_PARKING</a>
        <input type="checkbox" name="checkbox" class="checkbox">
        <label id="label" for="checkbox"></label>
        <ul class="menu">
            <li class="nav-link" style="display: flex; color: #ff512f">Welcome, <div style="color: #23a2f6" >
                    {{ $userName }}</div> </li>
            <li><a class="nav-link" href="{{route('profile')}}"  >
                    Profile</a></li>
            <li><a class="nav-link" href="{{route('logout')}}"  >
                    Log Out</a></li>
        </ul>
    </nav>
</header>
