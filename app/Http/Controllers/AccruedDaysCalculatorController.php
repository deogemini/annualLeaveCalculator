<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;



class AccruedDaysCalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showForm()
    {
        return view('calculator');
    }



    public function calculate1(Request $request){
            // Define the start and end dates
    $start_date = new DateTime( $request->input('start_date'));
    $end_date = new DateTime( $request->input('end_date'));

    // Calculate the number of days in the partial month of the start date
    $start_month_days = $start_date->format('t') - $start_date->format('j') + 1;

    // Calculate the number of days in the partial month of the end date
    $end_month_days = $end_date->format('j');

    // Calculate the total days between start and end dates
    $total_days = $end_date->diff($start_date)->days + 1;

        // If both dates are in the same month
    if ($start_date->format('m') == $end_date->format('m')) {
        // Calculate the number of days between the two dates
        $accrual_days = $total_days;
    } else {
        // Calculate the number of days in the partial month of the start date
        $start_month_days = $start_date->format('t') - $start_date->format('j') + 1;

        // Calculate the number of days in the partial month of the end date
        $end_month_days = $end_date->format('j');

        // Calculate the number of days to accrue for each partial month
        $accrual_days = $start_month_days + $end_month_days;
    }
    // Calculate the portion of the accrual rate
    $accrual_rate = 2.08;
    $accrued_value = ($accrual_days / $start_date->format('t')) * $accrual_rate;



    dd($accrued_value);

    echo "Accrued value for leaves from May 15th to July 15th: $accrued_value";


    }

    public function calculate(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $accrualRate = $request->input('accrual_rate');

        $dateValue =  explode('-', $startDate);

        $startdatevalueNumber = $dateValue[2];
        $startmonthvalueNumber = $dateValue[1];

        $dateValue =  explode('-', $endDate);
        $enddateValueNumber =  $dateValue[2];
        $endmonthValueNumber =  $dateValue[1];

        $d1 = new DateTime($startDate);
        $d2 = new DateTime($endDate);

                // Get the end of the start month
        $endOfStartMonth = (clone $d1)->modify('last day of this month');

        // Calculate days from start date to the end of the start month
        $daysInStartMonth = $d1->diff($endOfStartMonth)->days + 1;

        $calendar = $startDate;
        $calendar2 = $endDate;
        // Parse the date using Carbon
        $carbonDate = Carbon::parse($calendar);
        $carbonDate2 = Carbon::parse($calendar2);

        // Get the number of days in the month
        $start_date_month_numDays = $carbonDate->daysInMonth;
        $end_date_month_numDays = $carbonDate2->daysInMonth;


        if($startmonthvalueNumber == $endmonthValueNumber){
            $days  = ($enddateValueNumber - $startdatevalueNumber)+1;
            $Formula_part_A =  ($days *  $accrualRate) / $start_date_month_numDays;
            $Formula_part_B = 0;
            $Formula_part_C = 0;
            return $Formula_part_A;
           }else{
            $days  = ($start_date_month_numDays - $startdatevalueNumber)+1;
            $Formula_part_A =  ($days *  $accrualRate) / $start_date_month_numDays;
           }

        $endDate = $request->input('end_date');
        $startDateTime = new DateTime($startDate);

        $endDateTime = new DateTime($endDate);

        $startOfEndMonth = (clone $endDateTime)->modify('first day of this month');
        $daysInEndMonth = ($startOfEndMonth->diff($endDateTime)->days)+1;

        $Formula_part_C =    ($daysInEndMonth *  $accrualRate) / $end_date_month_numDays;


         // Get the end of the start month
         $endOfStartMonth = (clone $startDateTime)->modify('last day of this month');

         // Calculate full months in between
         $startOfNextMonth = (clone $endOfStartMonth)->modify('first day of next month');
         $endOfPreviousMonth = (clone $endDateTime)->modify('first day of this month')->modify('last day of previous month');



                // Calculate the month and year differences
        $startMonth = (int)$startDateTime->format('m');
        $startYear = (int)$startDateTime->format('Y');
        $endMonth = (int)$endDateTime->format('m');
        $endYear = (int)$endDateTime->format('Y');

        // Determine if the dates are consecutive months
        $isConsecutiveMonths = false;

        if ($endYear === $startYear && $endMonth === $startMonth + 1) {
            $isConsecutiveMonths = true;
        } elseif ($endYear === $startYear + 1 && $startMonth === 12 && $endMonth === 1) {
            $isConsecutiveMonths = true;
        }

        if ($isConsecutiveMonths) {
            $Formula_part_B  = 0;
        } else {

            $fullMonths = ($startOfNextMonth->diff($endOfPreviousMonth)->m)+1;
            $Formula_part_B =  $fullMonths * $accrualRate;

        }
        $totalAccruedDays =  $Formula_part_A + $Formula_part_B +  $Formula_part_C;
        return $totalAccruedDays;
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
