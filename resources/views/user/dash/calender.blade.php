<!DOCTYPE html>
<html lang="en">
@include('user.include.header')

<body>
<div class="container-scroller">
    @include('user.layouts.nav')
    @include('user.layouts.skin')
    @include('user.layouts.sidebar')
    <div class="main-panel">
        <div class="content-wrapper">
            @include('user.layouts.info')
            <div class="row mt-3">
                <div class="col-xl-12 d-flex grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between">
                                <h5 id="monthTitle" class="card-title mb-3">Month of</h5>
                                <div class="pb-2">
                                    <button class="btn btn-primary mr-2" onclick="previousMonth()">Previous Month</button>
                                    <button class="btn btn-primary mr-2" onclick="nextMonth()">Next Month</button>
                                </div>
                            </div>

                            <table id="calendar" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Sun</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.include.scripts')

<script>
    var currentMonth;
    var currentYear;
    var events = @json($events);

    function populateCalendar(month, year) {
        var calendarBody = document.querySelector('#calendar tbody');
        var daysInMonth = new Date(year, month + 1, 0).getDate();
        var firstDayOfMonth = new Date(year, month, 1).getDay();

        calendarBody.innerHTML = '';

        var dateCounter = 1;
        var calendarRow = document.createElement('tr');

        for (var i = 0; i < firstDayOfMonth; i++) {
            calendarRow.innerHTML += '<td></td>';
        }

        for (var j = firstDayOfMonth; j < 7; j++) {
            calendarRow.innerHTML += '<td>' + dateCounter++ + '</td>';
        }

        calendarBody.appendChild(calendarRow);

        while (dateCounter <= daysInMonth) {
            calendarRow = document.createElement('tr');
            for (var l = 0; l < 7 && dateCounter <= daysInMonth; l++) {
                var eventContent = '';
                events.forEach(function (event) {
                    var eventDate = new Date(event.date);
                    if (eventDate.getDate() === dateCounter && eventDate.getMonth() === month && eventDate.getFullYear() === year) {
                        eventContent += '<div style="color: #FD904B;">' + event.title + '</div>';
                    }
                });
                calendarRow.innerHTML += '<td>' + dateCounter++ + (eventContent ? '<div class="events">' + eventContent + '</div>' : '') + '</td>';
            }
            calendarBody.appendChild(calendarRow);
        }


        document.getElementById('monthTitle').innerText = "Month of " + getCurrentMonthName(currentMonth) + " " + currentYear;
    }

    function nextMonth() {
        if (currentMonth === 11) {
            currentYear++;
            currentMonth = 0;
        } else {
            currentMonth++;
        }
        populateCalendar(currentMonth, currentYear);
    }

    function previousMonth() {
        if (currentMonth === 0) {
            currentYear--;
            currentMonth = 11;
        } else {
            currentMonth--;
        }
        populateCalendar(currentMonth, currentYear);
    }

    function getCurrentMonthName(monthIndex) {
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return months[monthIndex];
    }

    document.addEventListener('DOMContentLoaded', function () {
        var currentDate = new Date();
        currentMonth = currentDate.getMonth();
        currentYear = currentDate.getFullYear();
        populateCalendar(currentMonth, currentYear);
    });
</script>


</body>
</html>
