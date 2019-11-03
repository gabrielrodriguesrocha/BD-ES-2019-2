<?php

session_start();

include('../util/splAndState.php');

$state->checkAccess(true);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatorio periodico</title>
</head>
<body>
    <?php include 'template/header.php' ?>
    <h4>Insira o intervalo de datas desejado:</h4>

    <form>
        <label class="startDate">Entre 
            <input type="date" name="Initial Date">
        </label>

        <fieldset class="fallbackDatePicker" hidden>
            <legend class="fallbackLabel">Insira a data inicial:</legend>

            <label>
            Day:
            <select name="day"></select>
            </label>

            <label>
            Month:
            <select name="month">
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
            </select>
            </label>

            <label>
            Year:
            <select name="year"></select>
            </label>
        </fieldset>

        <label class="endDate">e
            <input type="date" name="Final Date">
        </label>

        <fieldset class="fallbackDatePicker" hidden>
            <legend class="fallbackLabel">Insira a data Final:</legend>

            <label>
            Day:
            <select name="day"></select>
            </label>

            <label>
            Month:
            <select name="month">
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
            </select>
            </label>

            <label>
            Year:
            <select name="year"></select>
            </label>
        </fieldset>
    </form>

    <table style="width:30%">
        <tr>
            <th>Mes</th>
            <th>Media (Exames / Paciente)</th>
        </tr>
        <tr>
            <td>Abril 2019</td>
            <td>2</td>
        </tr>
        <tr>
            <td>Maio 2019</td>
            <td>3.5 </td>
        </tr>
    </table> 
</body>
</html>