<?php
namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Places;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Days;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function homePage($dayId = null)
    {
        session()->put('dayId', $dayId);
        $userId = Auth::id();
        $userName = Auth::user()->name;
        $how_many_reservations = Reservation::where('user_id', $userId)->count();
        session()->put('how_many_reservations', $how_many_reservations);
        $days = Days::all();
        $places = Places::where('day_id', $dayId)
            ->paginate(25);
        $reservations = Reservation::where('day_id', $dayId)->get();
        $users = User::all()->sortByDesc('created_at');
        return view('home.home', compact('userId',
            'userName', 'days', 'places', 'reservations', 'users'));
    }

    public function reservationPage(Request $request)
    {
        $userId = Auth::id();
        $placeId = $request->input('place_id');
        $dayId = session()->get('dayId');
        $rank = Auth::user()->rank;
        $howManyReservations = session()->get('how_many_reservations');

        if ($placeId !== null) {
            $existingReservationOnDay = Reservation::where('user_id', $userId)
                ->where('day_id', $dayId)
                ->exists();

            if ($existingReservationOnDay) {
                $reservationStatus = 'You already have a reservation for this day.';
                $type = 'info';
            } else {
                $existingReservation = Reservation::where('place_id', $placeId)
                    ->where('day_id', $dayId)
                    ->first();

                if ($rank == 'directeur') {
                    $reservedCount = Reservation::where('day_id', $dayId)->count();
                    if ($reservedCount >=50) {
                        try {
                            if ($existingReservation) {
                                $removedUserEmail = User::find($existingReservation->user_id)->email;
                                $directorName = Auth::user()->name;
                                $message = "We regret to inform you that your reservation for this
                                 place has been overridden by Director $directorName.";
                                $subject = "Your Reservation Has Been Overridden by Director $directorName";
                                $this->sendEmail($removedUserEmail, $message, $subject);

                                $existingReservation->delete();
                            }

                            // Create new reservation
                            $reservation = new Reservation();
                            $reservation->user_id = $userId;
                            $reservation->day_id = $dayId;
                            $reservation->place_id = $placeId;
                            $reservation->save();

                            // Update place status
                            $place = Places::find($placeId);
                            $place->reserved = true;
                            $place->save();

                            $reservationStatus = 'success';
                            $type = 'success';
                        }
                        catch (\Exception $e) {
                            $reservationStatus = 'error' . $e->getMessage();
                            $type = 'error';
                        }
                    }else{
                        if (!$existingReservation) {
                            // Create new reservation
                            $reservation = new Reservation();
                            $reservation->user_id = $userId;
                            $reservation->day_id = $dayId;
                            $reservation->place_id = $placeId;
                            $reservation->save();

                            // Update place status
                            $place = Places::find($placeId);
                            $place->reserved = true;
                            $place->save();

                            $reservationStatus = 'success';
                            $type = 'success';
                        }else{
                            $reservationStatus = 'error';
                            $type = 'error';
                        }
                    }

                }
                
                elseif ($rank == 'manager' || $rank == 'responsable') {
//                dd(User::find($existingReservation->user_id)->rank);
                    $reservedCount = Reservation::where('day_id', $dayId)->count();
                    if ($reservedCount >=50) {
                        try {
                            if ($existingReservation) {
                                if (User::find($existingReservation->user_id)->rank != 'directeur'){
                                    $removedUserEmail = User::find($existingReservation->user_id)->email;
                                    $message = "We regret to inform you that your reservation for this place has been overridden by Director.";
                                    $subject = "Your Reservation Has Been Overridden by Director ";
                                    $this->sendEmail($removedUserEmail, $message, $subject);
                                }
                                $existingReservation->delete();
                            }
                            // Create new reservation
                            $reservation = new Reservation();
                            $reservation->user_id = $userId;
                            $reservation->day_id = $dayId;
                            $reservation->place_id = $placeId;
                            $reservation->save();

                            // Update place status
                            $place = Places::find($placeId);
                            $place->reserved = true;
                            $place->save();

                            $reservationStatus = 'success';
                            $type = 'success';
                        }
                        catch (\Exception $e) {
                            $reservationStatus = 'error' . $e->getMessage();
                            $type = 'error';
                        }
                    }else{
                        if (!$existingReservation) {
                            // Create new reservation
                            $reservation = new Reservation();
                            $reservation->user_id = $userId;
                            $reservation->day_id = $dayId;
                            $reservation->place_id = $placeId;
                            $reservation->save();

                            // Update place status
                            $place = Places::find($placeId);
                            $place->reserved = true;
                            $place->save();

                            $reservationStatus = 'success';
                            $type = 'success';
                        }else{
                            $reservationStatus = 'error';
                            $type = 'error';
                        }
                    }
                }

                elseif (($rank == 'consultant' && $howManyReservations >= 1) || (($rank == 'manager' || $rank == 'responsable') && $howManyReservations >= 3)) {
                    $reservationStatus = ($rank == 'consultant') ? 'Consultants are allowed to reserve only once per week.' : 'Managers and Responsables are allowed to reserve three times per week.';
                    $type = 'info';
//                    exit();
                }
                elseif (!$existingReservation) {
                    try {
                        $reservation = new Reservation();
                        $reservation->user_id = $userId;
                        $reservation->day_id = $dayId;
                        $reservation->place_id = $placeId;
                        $reservation->save();

                        $place = Places::find($placeId);
                        $place->reserved = true;
                        $place->save();

                        $reservationStatus = 'success';
                        $type = 'success';
                    } catch (\Exception $e) {
                        $reservationStatus = 'error' . $e->getMessage();
                        $type = 'error';
                    }
                }
                else {
                    $reservationStatus = 'This place is already reserved for this day.';
                    $type = 'error';
                }
            }

            $reservedCount = Reservation::where('day_id', $dayId)->count();
            if ($reservedCount >= 50) {
                $users = User::all();
                foreach ($users as $user) {
                    $dayName = Days::find($dayId)->name;
                    $subject = "All Places Reserved for $dayName";
                    $this->sendEmail($user->email, "All Places Reserved for $dayName", $subject);
                }
                $reservationStatus = 'All places for this day are already reserved.';
                $type = 'info';
            }
        } else {
            $reservationStatus = 'Please select a place to reserve.';
            $type = 'info';
        }

        return redirect()->route('home')->with('flash', ['type' => $type, 'message' => $reservationStatus]);
    }

    public function cancelReservation(Request $request)
        {
            $userId = Auth::id();
            $place_id = $request->input('place_id');
            $dayId = session()->get('dayId');

            if ($place_id !== null) {
                $reservation = Reservation::where('user_id', $userId)
                    ->where('place_id', $place_id)
                    ->where('day_id', $dayId)
                    ->first();

                if ($reservation) {
                    try {
                        $reservation->delete();
                        $place = Places::find($place_id);
                        $place->reserved = false;
                        $place->save();
                    } catch (\Exception $e) {
                    }
                }
            }
            return redirect()->route('home');
        }

    public function sendEmail($email,$message,$subject)
    {
        Mail::to($email)->send(new SendMail($message, $subject));
    }

}
