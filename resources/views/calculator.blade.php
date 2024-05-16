<!-- resources/views/calculator.blade.php -->

<form class="form" action="/calculator" method="post">
    @csrf
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" required><br><br>
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" required><br><br>
    <label for="accrual_rate">Accrual Rate:</label>
    <input type="number" step="0.001" id="accrual_rate" name="accrual_rate" required><br><br>
    <label for="days_in_month">Working Days in a Month:</label>
    <input type="number" step="0.001" id="days_in_month" name="days_in_month" required><br><br>
    <button type="submit">Calculate</button>
</form>

@isset($accruedDays)
    <p>Accrued Days: {{ $accruedDays }}</p>
@endisset
