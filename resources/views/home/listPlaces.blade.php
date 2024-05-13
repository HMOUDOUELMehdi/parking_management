<style>
    .place {
        width: calc(100% / 5); /* Adjust the number 5 based on the number of places you want to display per row */
        /*max-width: calc(100% / 5); !* Ensure each place doesn't exceed this width *!*/
        height: calc(100vh / 5); /* Adjust the height based on the number of rows you want */
        background-color: rgba(255,255,255,0.13);
        display: inline-block;
        margin: 10px;
    }
    .places {
        position: absolute;
        left: 23%;
        color: white;
        top: 24%;
        width: 75%;
    }
    .text1 {
        color: white;
        font-size: xx-large;
        margin-top: -4%;
        margin-bottom: 20px;
        align-items: center;
        display: flex;
        justify-content: center;
    }

    input{
        width: 100%;
        position: relative;
        top: 30%;
    }
    .user-name {
        max-height: 50px;
        overflow: auto;
        background-image: linear-gradient(#ff512f,#f09819);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    button {
        position: absolute;
        top: -2%;
        left: 80%;
        padding: 10px 20px;
        background: linear-gradient(
            #1845ad,
            #23a2f6
        );
        color: white;
        border: none;
        border-radius: 5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease;
    }

    @media screen and (max-width: 768px) {
        .place {
            width: calc(100% / 2); /* Adjust the number 2 for smaller screens */
            max-width: calc(100% / 2);
            height: calc(100vh / 12);
        }
        .text1{
            font-size: 20px;
            position: absolute;
            left: -14%;
            top: -1%;
        }
        button{
            margin-left: -30px;
        }
    }

    @media screen and (max-width:340px) {
        .days{
            margin-top: 20%;
        }
        .day{
            font-size: 15px;
        }
        input{
            position: relative;
            left: 30%;
            width: auto;
        }
    }
</style>

<div class="places">
    <div class="text1">Available places on this day</div>
    <form action="{{ route('home.reservation') }}" method="POST">
        @csrf
        @php
            $counter = 0;
        @endphp
        @foreach ($places as $place)
            @php
                $reserved = $reservations->contains('place_id', $place->id);
                $userIds = $reservations->where('place_id', $place->id)->pluck('user_id');
                foreach ($userIds as $id)
                    $user = $users->where('id',$id)->pluck('name','runk')->first();
            @endphp

            <div class="place" data-id="{{ $place->id }}">
                @if($reserved)
                    <div class="user-name">
                        @if(isset($user))
                            {{$user}}
                        @else
                            unknown
                        @endif
                    </div>
                @endif
                <input type="radio" name="place_id" value="{{ $place->id }}">
            </div>
            @php
                $counter++;
                if ($counter % 8 === 0) {
                    echo '<br>';
                }
            @endphp
        @endforeach
        <div >{!! $places->links() !!}</div>
        <button type="submit">Book Place</button>
    </form>
</div>
