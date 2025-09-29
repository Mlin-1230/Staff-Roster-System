<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/3daedf892a.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Calendar -->
    <?php
        class Calendar {
            private $year;
            private $month;
            private $start_weekday;
            private $days;

            function __construct() {
                $this->year = isset($_GET['year']) ? $_GET['year'] : date('Y');
                $this->month = isset($_GET['month']) ? $_GET['month'] : date('m');
                $this->start_weekday = date('w', mktime(0, 0, 0, $this->month, 1, $this->year));
                $this->days = date('t', mktime(0, 0, 0, $this->month, 1, $this->year));
            }

            function __toString() {
                $out = '<table class="Calendar">';
                $out .= $this->changeDate();
                $out .= $this->weeksList();
                $out .= $this->daysList();
                $out .= '</table>';
                return $out;
            }

            private function weeksList() {
                $week = array('日', '一', '二', '三', '四', '五', '六');
                $out = '<tr>';
                for ($i = 0; $i < count($week); $i++) {
                    $out .= '<th class="calendar">' . $week[$i] . '</th>';
                }
                $out .= '</tr>';
                return $out;
            }

            private function daysList() {
                require './manage/db.php';
                $event_sql = "SELECT events.Id, events.Date, users.Name
                    FROM events
                    JOIN users ON events.Id = users.Id;";
                $event_result = mysqli_query($link, $event_sql);
                $Event = array();
                while ($row = mysqli_fetch_assoc($event_result)) {
                    $Event[] = $row;
                }

                $train_sql = "SELECT train.Id_1, train.Id_2, u1.Name AS Name1, u2.Name AS Name2, train.Date
                    FROM train
                    JOIN users u1 ON train.Id_1 = u1.Id
                    JOIN users u2 ON train.Id_2 = u2.Id;";
                $train_result = mysqli_query($link, $train_sql);
                $Train = array();
                while ($row = mysqli_fetch_assoc($train_result)) {
                    $Train[] = $row;
                }

                $out = '<tr>';
                for ($j = 0; $j < $this->start_weekday; $j++) {
                    $out .= '<td class=Calendar_day></td>';
                }

                for ($k = 1; $k <= $this->days; $k++) {
                    $j++;

                    $todayClass = ($k == date('d') && $this->month == date('m') && $this->year == date('Y')) ? 'today' : '';
                    $haveEvents = '';

                    if ($k < 10) {
                        $k = '0' . $k;
                    } else {
                        $k = $k;
                    }

                    if (isset($_SESSION['Id'])) {
                        for ($l = 0; $l < count($Event); $l++) {
                            if (($Event[$l]['Id'] == $_SESSION['Id']) && $Event[$l]['Date'] == "{$this->year}-{$this->month}-{$k}") {
                                $haveEvents = 'haveEvents';
                                $todayClass = '';
                            }
                        }
                        for ($l = 0; $l < count($Train); $l++) {
                            if (($Train[$l]['Id_1'] == $_SESSION['Id'] || $Train[$l]['Id_2'] == $_SESSION['Id']) && $Train[$l]['Date'] == "{$this->year}-{$this->month}-{$k}") {
                                $haveEvents = 'haveEvents';
                                $todayClass = '';
                            }
                        }
                    }

                    $out .= '<td class="Calendar_day clickable ' . $todayClass . ' ' . $haveEvents . '"><h4 style="margin: 0 0 10px;">' . $k . '</h4>';

                    $found = false;
                    for ($l = 0; $l < count($Event); $l++) {
                        if ($Event[$l]['Date'] == "{$this->year}-{$this->month}-{$k}") {
                            $out .= $Event[$l]['Name'] . '<br>';
                            $found = true;
                        }
                    }
                    for ($l = 0; $l < count($Train); $l++) {
                        if ($Train[$l]['Date'] == "{$this->year}-{$this->month}-{$k}") {
                            $out .= $Train[$l]['Name1'] . ' / ' . $Train[$l]['Name2'] . '<br>';
                            $found = true;
                        }
                    }
                    $out .= '</td>';

                    if ($j % 7 == 0) {
                        $out .= '</tr><tr>';
                    }
                }

                while ($j % 7 !== 0) {
                    $out .= '<td class=Calendar_day></td>';
                    $j++;
                }
                $out .= '</tr>';
                return $out;
            }

            private function prevYear($year, $month) {
                $year--;
                if ($year < 1970) {
                    $year = 1970;
                }
                return "year={$year}&month={$month}";
            }

            private function prevMonth($year, $month) {
                if ($month == 1) {
                    $year--;
                    if ($year < 1970) {
                        $year = 1970;
                    }
                    $month = 12;
                } else {
                    $month--;
                }
                return "year={$year}&month={$month}";
            }

            private function nextYear($year, $month) {
                $year++;
                if ($year > 2038) {
                    $year = 2038;
                }
                return "year={$year}&month={$month}";
            }

            private function nextMonth($year, $month) {
                if ($month == 12) {
                    $year++;
                    if ($year > 2038) {
                        $year = 2038;
                    }
                    $month = 1;
                } else {
                    $month++;
                }
                return "year={$year}&month={$month}";
            }

            private function changeDate($url='schedule.php') {
                $out = '<tr class="Calendar_header">';
                $out .= '<td><a href="' . $url . '?' . $this->prevYear($this->year, $this->month) . '">';
                $out .= '<i class="fa-solid fa-angles-left" style="color: white;"></i>' . '</a></td>';
                $out .= '<td><a href="' . $url . '?' . $this->prevMonth($this->year, $this->month) . '">';
                $out .= '<i class="fa-solid fa-angle-left" style="color: white;"></i>' . '</a></td>';
                $out .= '<td colspan="3">';
                $out .= '<form class="Calendar_form">';
                $out .= '<select name="year" onchange="window.location=\'' . $url  . '?year=\'+this.options[selectedIndex].value+\'&month=' . $this->month . '\'">';
                for ($sy = 1970; $sy <= 2038; $sy++) {
                    $selected_year = ($sy == $this->year) ? 'selected' : '';
                    $out .= '<option ' . $selected_year . ' value="' . $sy . '">' . $sy . '</option>';
                }
                $out .= '</select>';

                $out .= '<select name="month" onchange="window.location=\'' . $url . '?year=' . $this->year . '&month=\'+this.options[selectedIndex].value+\'\'">';
                for ($sm = 1; $sm <= 12; $sm++) {
                    $selected_month = ($sm == $this->month) ? 'selected' : '';
                    $out .= '<option ' . $selected_month . ' value="' . $sm . '">' . $sm . '</option>';
                }
                $out .= '</select>';
                $out .= '</form>';
                $out .= '</td>';

                $out .= '<td><a href="' . $url . '?' . $this->nextMonth($this->year, $this->month) . '">';
                $out .= '<i class="fa-solid fa-angle-right" style="color: white;"></i>' . '</a></td>';
                $out .= '<td><a href="' . $url . '?' . $this->nextYear($this->year, $this->month) . '">';
                $out .= '<i class="fa-solid fa-angles-right" style="color: white;"></i>' . '</a></td>';
                $out .= '</tr>';
                return $out;
            }
        }
    ?>
</body>
</html>