<style>
    .days {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 20px;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 20%;

    }

    .day-link {
        text-decoration: none;
        color: white;
        transition: transform 0.2s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .day {
        padding: 10px 20px;
        /*background-color: #f0f0f0; !* Background color for each day *!*/
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); /* Add a subtle shadow */
        transition: background-color 0.2s ease-in-out;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: xx-large;
    }

    .day:hover {
        background-color: #e0e0e0; /* Darker background color on hover */
    }

    .text{
        color: white;
        font-size: xx-large;
        margin-top: 29%;
        align-items: center;
        display: flex;
        justify-content: center;
        background-image: linear-gradient(#1845ad, #23a2f6);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    @media only screen and (max-width: 1000px) {
        .days {
            margin: 10px;
            font-size: 20px;
            position: fixed;
            display: flex;
        }
        .text{
            font-size: 20px;
        }
        .day{
            font-size: 20px;
        }
    }



</style>

<div class="days">
    <div class="text" >Week Days</div>
    @foreach ($days as $day)
        <a href="{{ route('home.showDays', ['dayId' => $day->id]) }}" class="day-link" data-id="{{ $day->id }}" data-day="{{ $day->day_name }}">
            <div class="day">
                {{ $day->day_name }}
            </div>
        </a>
    @endforeach
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.day').click(function() {
            var dayId = $(this).data('id');
            sendDataToController(dayId);
        });
    });

    // Function to send day ID to controller
    function sendDataToController(dayId) {
        $.ajax({
            url: '/home/' + dayId, // URL of your controller method
            method: 'GET',
            success: function(response) {
                // Handle the response here if needed
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }
</script>

