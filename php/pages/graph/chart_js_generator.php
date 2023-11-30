<?php

if (!isset($_SESSION)) { 
    session_start(); 
}
if (!isset($_SESSION['username'])) {
    navigate_to_pages('login', "Not logged in");
    exit();
} 
else 
{
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
    
    $query = get_total_balance_graph_data($conn, $user_id);
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        show_alert("Data could not be fetched!");
    } else {
        open_js_block();
        generate_balance_line_chart_js_from_result($result);
        close_js_block();
    }

    $query_cash = get_cash_balance_graph_data($conn, $user_id);
    $result_cash = mysqli_query($conn, $query_cash);
  
    if (!$result_cash) {
        show_alert("Cash Data could not be fetched!");
    } else {
        open_js_block();
        generate_cash_balance_line_chart_js_from_result($result_cash);
        close_js_block();
    }

    $query_bank = get_bank_balance_graph_data($conn, $user_id);
    $result_bank = mysqli_query($conn, $query_bank);
  
    if (!$result_bank) {
        show_alert("Bank Data could not be fetched!");
    } else {
        open_js_block();
        generate_bank_balance_line_chart_js_from_result($result_bank);
        close_js_block();
    }
}

function open_js_block() {
    echo '<script type="text/javascript">';
    init_charts();
}

function init_charts() {
    $js = "google.charts.load('current', {packages: ['corechart','table']}); google.charts.setOnLoadCallback(drawBalanceLineChart);";
    echo "$js";
}

function generate_balance_line_chart_js_from_result($result) {
  $js = " function drawBalanceLineChart() { var data = new google.visualization.DataTable(); data.addColumn('date', 'Date'); data.addColumn('number', 'Total Balance'); data.addRows([ ";
  while($row = mysqli_fetch_assoc($result)) {
    $balance = $row["total_balance"];
    $date = date_create_from_format( "Y-m-d H:i:s", $row["log_date"], timezone_open('IST'));
    $js_date = date_format($date,"Y-m-d H:i:s");
    $js .= "[new Date('$js_date'), $balance], ";
  }
  $js .= " ]); var options = { hAxis: { title: 'Time' }, vAxis: { title: 'Amount' }, explorer: { axis: 'horizontal', keepInBounds: true, maxZoomIn: 4.0 },  legend: { position: 'none' }, pointSize: 5 }; var chart = new google.visualization.LineChart(document.getElementById('div_balance_line_chart_1')); chart.draw(data, options); } "; 
  echo "$js";
}

function generate_cash_balance_line_chart_js_from_result($result) {
    $js = " function drawBalanceLineChart() { var data = new google.visualization.DataTable(); data.addColumn('date', 'Date'); data.addColumn('number', 'Cash Balance'); data.addRows([ ";
    while($row = mysqli_fetch_assoc($result)) {
        $balance = $row["balance_after"];
        $date = date_create_from_format("Y-m-d H:i:s", $row["log_date"], timezone_open('IST'));
        $js_date = date_format($date, "Y-m-d H:i:s");
        $js .= "[new Date('$js_date'), $balance], ";
    }
    $js .= " ]); var options = { hAxis: { title: 'Time' }, vAxis: { title: 'Amount' }, explorer: { axis: 'horizontal', keepInBounds: true, maxZoomIn: 4.0 }, legend: { position: 'none' }, pointSize: 5 }; var chart = new google.visualization.LineChart(document.getElementById('div_balance_line_chart_2')); chart.draw(data, options); } "; 
    echo "$js";
}

function generate_bank_balance_line_chart_js_from_result($result) {
    $js = " function drawBalanceLineChart() { var data = new google.visualization.DataTable(); data.addColumn('date', 'Date'); data.addColumn('number', 'Bank Balance'); data.addRows([ ";
    while($row = mysqli_fetch_assoc($result)) {
        $balance = $row["balance_after"];
        $date = date_create_from_format("Y-m-d H:i:s", $row["log_date"], timezone_open('IST'));
        $js_date = date_format($date, "Y-m-d H:i:s");
        $js .= "[new Date('$js_date'), $balance], ";
    }
    $js .= " ]); var options = { hAxis: { title: 'Time' }, vAxis: { title: 'Amount' }, explorer: { axis: 'horizontal', keepInBounds: true, maxZoomIn: 4.0 }, legend: { position: 'none' }, pointSize: 5 }; var chart = new google.visualization.LineChart(document.getElementById('div_balance_line_chart_3')); chart.draw(data, options); } "; 
    echo "$js";
}

function setup_js_event_handlers() {
  $js = "if (window.addEventListener){ window.addEventListener('resize', drawBalanceLineChart);} else { window.attachEvent('onresize', drawBalanceLineChart);}";
  echo "$js";
}

function close_js_block() {  
  echo '</script>';
}

?>