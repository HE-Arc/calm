<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Ramsey\Uuid\Type\Integer;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'stop',
    ];

    protected $casts = [
        'start' => 'datetime',
        'stop' => 'datetime'
    ];

    public function machine() : BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function duration()
    {
        return $this->stop->diffInMinutes($this->start);
    }

    public function organization()
    {
        return $this->machine->organization();
    }

    public function laundry()
    {
        return $this->machine->laundry();
    }

    private function has_conflict(Reservation $other): bool
    {
        return ($this->start > $other->start && $this->start < $other->stop)
            || ($other->start > $this->start && $other->start < $this->stop);
    }

    private static function get_all_reservation_times(Carbon $date, int $duration){
        $reservations = [];
        $date->hour = 0;
        $date->minute = 0;
        $date->second = 0;

        $current = $date;
        $day = $date->day;

        while($current->day == $day){
            $r = new Reservation();
            $r->start = $current;
            $current->addMinutes($duration);
            $r->stop = $current;
            $reservations[] = $r;
        }

        return $reservations;
    }

    /**
     * Find a list of possible reservations matching the given constraints.
     * @param Carbon $date The date of the reservation
     * @param Integer $duration The duration of the reservation in minutes
     * @param User $user The user wanting to reserve
     * @param Laundry $laundry The laundry to reserve in
     * @return array A list of possible reservations
     */
    public static function find_reservations(Carbon $date, int $duration, User $user, Laundry $laundry, string $type){
        $all = static::get_all_reservation_times($date, $duration);

        $possible_reservations = [];

        $machines = $laundry->machines()->where('type', $type)->get();

        foreach($machines as $machine){
            foreach($all as $res){
                $ok = true;
                foreach($machine->reservations()->get() as $machine_res){
                    if($machine_res->has_conflict($res)){
                        //dump("conflict", $machine, $machine_res, $res);
                        $ok = false;
                        break;
                    }
                }
                if($ok){
                    $r = clone $res;
                    $r->machine_id = $machine->id;
                    $possible_reservations[] = $r;
                }
            }
        }
        return $possible_reservations;
    }
}
