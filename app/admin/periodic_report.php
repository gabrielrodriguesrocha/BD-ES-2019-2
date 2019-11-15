<?php

session_start();

include('../util/splAndState.php');

$state->checkAccess(true);

$periodicReportService = PeriodicReportService::getInstance();

if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
    if (empty($_GET['startDate']) || empty($_GET['endDate']))
        $msgError = "É necessário preencher ambas datas";
    else
        $result = $periodicReportService->getDados($_GET['startDate'], $_GET['endDate']);
}

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
    <h4>Relatório de média de exames por paciente</h4>

    <form method="get">
        <label class="startDate">Entre
            <input type="date" name="startDate">
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
            <input type="date" name="endDate">
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
        <input type="submit" value="Obter">
    </form>

    <?php if (isset($msgError)) {?>
        <span style="color: red"><?php echo $msgError; ?></span>
    <?php } ?>

    <?php if (isset($result)) { ?>
    <table style="width:30%">
        <thead>
        <tr>
            <th>Intervalo</th>
            <th>Media (Exames / Paciente)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $_GET['startDate']; ?> ~ <?php echo $_GET['endDate']; ?> </td>
            <td><?php echo $result; ?></td>
        </tr>
        </tbody>
    </table>
    <?php } ?>

    <button onclick="window.print();">Salvar</button>
</body>
</html>