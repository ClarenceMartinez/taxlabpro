<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Activities;
use App\Models\Client;
use App\Models\Notes;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Spatie\GoogleCalendar\Event;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (empty(auth()->id()))
        {
            return redirect('/');
        }
        
        if (Auth::user()->type == 1)
        {
            $data['users'] = User::select('id','name', 'avatar')->where('status', 1)->get();
        }

        if (Auth::user()->type == 2)
        {   
            $data['users'] = User::select('id','name', 'avatar')
                                ->where('company_id', Auth::user()->company_id)
                                ->where('status', 1)->get();
        }

        if (Auth::user()->type == 3)
        {
            $data['users'] = User::select('id','name', 'avatar')
                                ->where('company_id', Auth::user()->company_id)
                                ->where('id', auth()->id())
                                ->get();
        }
        // if (Auth::user()->type == 1)
        // {

        // }

        

        $data['title'] = 'Calendar | Plataform TaxlabPro';
        return view('calendar.index', $data);
    }



    public function list_json()
    {
        if (empty(auth()->id()))
        {
            return redirect('/');
        }

        if (Auth::user()->type == 1)
        {
            $activities = Activities::all();
            $notes = Notes::all();
        }

        if (Auth::user()->type == 2)
        {
            $activities = Activities::select('activities.*')
                            ->join('users', 'users.id', 'activities.user_id')
                            ->where('users.company_id', Auth::user()->company_id)->get();
            $notes = Notes::select('notes.*')
                            ->join('users', 'users.id', 'notes.user_id')                
                            ->where('company_id', Auth::user()->company_id)->get();
        }

        if (Auth::user()->type == 3)
        {
            $activities = Activities::select('activities.*')
                            ->join('users', 'users.id', 'activities.user_id')
                            ->where('users.company_id',  Auth::user()->company_id)
                            ->where('user_id',auth()->id())
                            ->get();
            $notes = Notes::select('notes.*')
                            ->join('users', 'users.id', 'notes.user_id')                
                            ->where('company_id', Auth::user()->company_id)
                            ->where('user_id',auth()->id())
                            ->get();
        }
        
        $events     = [];
        $ev         = [];

        if (!empty($activities))
        {   
            $index = 1;
            foreach ($activities as $activity)
            {
                $ini    = $activity['date'].' '.$activity['time'];
                $start  = date("Y-m-d H:i", strtotime("0 days", strtotime($ini)));
                $end    = date("Y-m-d H:i", strtotime("+".$activity['duration'], strtotime($ini)));

                $ev['id'] = $index;
                $ev['idx'] = $activity['id'];
                $ev['url'] = "";
                $ev['title'] = $activity['title'];
                $ev['start'] = $start;
                $ev['end'] = $end;
                $ev['allDay'] = false;
                $ev['extendedProps'] = array(
                                               "calendar" => "Activity",
                                               "description" => $activity['notes'] ,
                                               "guests" => $activity['user_id'],
                                               "user_id" => $activity['client_id']
                                            );
                array_push($events, $ev);
                $index++;
            }
        }

        

        if (!empty($notes))
        {   
            // $index = 1;
            foreach ($notes as $notes)
            {
                $ini = $notes['event_date'];
                $start = date("Y-m-d H:i", strtotime("0 days", strtotime($ini)));

                $ev['id'] = $index;
                $ev['idx'] = $notes['id'];
                $ev['url'] = "";
                $ev['title'] = $notes['description'];
                $ev['start'] = $start;
                $ev['end'] = $start;
                $ev['allDay'] = false;
                $ev['extendedProps'] = array(
                                               "calendar" => "Notes",
                                               "description" => $notes['description'],
                                               "guests" => $notes['user_id'],
                                               "user_id" => $notes['client_id']
                                            );
                array_push($events, $ev);
                $index++;
            }
        }
        return $events;
    }

    public function list_event()
    {
                         
        $retorno['events'] = $this->list_json();
        return response()->json($retorno);
    }


    public function add_event(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
        }

        $items                      = $request->input('items');
        $extendedProps              = $items["extendedProps"];
        if (empty($extendedProps['guests']))
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The field user_id is required',
                'type'      => 'warning'
            ]);
        }






        
        $evento                     = [];
        $evento['id']               = $items['id'];
        $evento['client_id']               = $items['client_id'];
        $evento['url']              = "";
        $evento['title']            = $items['title'];
        $evento['start']            = $items['start'];
        $evento['end']              = $items['end'];
        $evento['allDay']           = false;
        $evento['extendedProps']    =  array('Calendar' => $extendedProps['calendar']);


        $start          = Carbon::parse($evento['start']); // Obtén la hora y los minutos en el formato deseado
        $horaMinutos    = $start->format('H:i'); // Resultado: "07:15"
        $horaMinutos12  = $start->format('h:i A');


        

        $userGuest  = User::infoClient($extendedProps['guests']);
        $userAdmin  = User::getUserAdminByCompany($userGuest->company_id);

        switch ($extendedProps['calendar']) {
            case 'Notes':
                Notes::create([
                    'client_id'     => $evento['client_id'],
                    'user_id'       => $extendedProps['guests'],
                    'event_date'    => $evento['start'],
                    'description'   => $extendedProps['description'],
                ]);

                send_notification($userAdmin[0]->id, 'New  Note', $userGuest->name.' has created a Note.', 'calendar', '📅', 'info');
            break;

            case 'Activity':
                Activities::create([
                    'client_id'     => $evento['client_id'],
                    'user_id'       => $extendedProps['guests'],
                    'title'         => $evento['title'],
                    'date'          => $evento['start'],
                    'type'          => 1,
                    'time'          => $horaMinutos,
                    'notes'         => $extendedProps['description'],
                ]);

                send_notification($userAdmin[0]->id, 'New  Activiy', $userGuest->name.' has created a activity.', 'calendar', '📅', 'info');
            break;
            
        }

        $emailFrom      = $userGuest->email;
        $infoClient     = Client::where('id', $evento['client_id'])->first();
        $emailTo        = $infoClient->tax_payer_email; 
        $attendeesArr   = array();
        if (!empty($emailFrom) && !empty($emailTo))
        {
            $attendees  = array();
            $attendees['email'] = $emailFrom;
            array_push($attendeesArr, $attendees);

            // $attendees['email'] = $emailTo;
            $attendees['email'] = 'clarence.sud@gmai.com';
            array_push($attendeesArr, $attendees);
        }

        // echo "<pre>";
        // print_r($attendeesArr);

        // echo "</pre>";

        $event = Event::create([
                    'name' => $items['title'],
                    'startDateTime' => Carbon::parse($items['start'])->timezone('America/Denver'),
                    'endDateTime' => Carbon::parse($items['end'])->timezone('America/Denver'),
                    'description' => $extendedProps['description'],
                    'timezone' => 'America/Denver',
                    'attendees' => $attendeesArr,
                    'sendUpdates' => 'all',
                ]);

        // echo 'ID del evento: ' . $event->googleEvent->id;
        $events = Event::get();

        // echo "<pre>";
        // print_r($events);
        // echo "</pre>";

        foreach ($events as $event) {
            echo $event->name . ' - ' . $event->startDateTime . '<br>';
        }

        return response()->json([
                'status'    => true,
                'msg'       => 'Successfully registered event',
                'type'      => 'success',
                'title'     =>'Perfect!'
            ]);

    }




    public function update_event(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
        }


        if(empty($request->input('idx')) || $request->input('idx') == 0)
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'Select an Event',
                'type'      => 'warning'
            ]);  
        }

        $extendedProps = $request->input('extendedProps');
        if (empty($extendedProps['guests']))
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The field user_id is required',
                'type'      => 'warning'
            ]);
        }


        // exit();
        $idx                        = $request->input('idx');
        $evento                     = [];
        $evento['client_id']        = $request->input('client_id');
        $evento['url']              = "";
        $evento['title']            = $request->input('title');
        $evento['start']            = $request->input('start');
        $evento['end']              = $request->input('end');
        $evento['allDay']           = false;
        $evento['extendedProps']    =  array('Calendar' => $extendedProps['calendar']);


        $start          = Carbon::parse($evento['start']); // Obtén la hora y los minutos en el formato deseado
        $horaMinutos    = $start->format('H:i'); // Resultado: "07:15"
        $horaMinutos12  = $start->format('h:i A');


        

        $userGuest  = User::infoClient($extendedProps['guests']);
        $userAdmin  = User::getUserAdminByCompany($userGuest->company_id);

            
        switch ($extendedProps['calendar']) {
            case 'Notes':
                $notes = Notes::find($idx);
                $notes->client_id   = $extendedProps['client_id'];
                $notes->user_id     = $extendedProps['guests'];
                $notes->event_date  = $evento['start'];
                $notes->description = $extendedProps['description'];
                $notes->save();
                send_notification($userAdmin[0]->id, 'Update Note', $userGuest->name.' has updated a Note.', 'calendar', '📅', 'info');
            break;

            case 'Activity':
                $activity = Activities::find($idx);
                $activity->client_id    = $extendedProps['client_id'];
                $activity->user_id      = $extendedProps['guests'];
                $activity->title        = $evento['title'];
                $activity->date         = $evento['start'];
                $activity->type         = 1;
                $activity->time         = $horaMinutos;
                $activity->notes        = $extendedProps['description'];
                $activity->save();

                

                send_notification($userAdmin[0]->id, 'Update Activiy', $userGuest->name.' has updated a activity.', 'calendar', '📅', 'info');
            break;
            
        }

        return response()->json([
                'status'    => true,
                'msg'       => 'Successfully updated event',
                'type'      => 'success',
                'title'     =>'Perfect!'
            ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calendar $calendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calendar $calendar)
    {
        //
    }
}
