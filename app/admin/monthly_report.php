<?php

session_start();

include('../util/splAndState.php');

$state->checkAccess(true);

$monthlyReportService = MonthlyReportService::getInstance();

//$temp = json_encode(array_map(function ($i) { return $monthlyReportService->getDados($i); }, range(1,12)));
$temp = json_encode(array_map(function ($i) { return MonthlyReportService::getDados($i); }, range(1,12)));

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório Mensal</title>
    <!-- Carregar a API do google -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Preparar a geracao do grafico -->
    <script type="text/javascript">

      vet = <?php echo $temp; ?>;
      var a = vet[0];
      // Carregar a API de visualizacao e os pacotes necessarios.
      google.charts.load('current', {'packages':['line']});
      google.charts.load('current', {'packages':['table']});

      google.setOnLoadCallback(desenharGrafico);
      google.setOnLoadCallback(DesenhaTabela);

    function getdados(){
        var dados = new google.visualization.DataTable();
        dados.addColumn('string', 'Mês');
        a.forEach((item,index)=>
        {
            dados.addColumn('number', item['Nome']);
        });

        linhas = [];
        linha=[];
        vet.forEach((item,index)=>
        {
          linha=[];
          switch(index){
            case 1:
              linha.push('Fevereiro');
            break;
            case 2:
              linha.push('Março');
            break;
            case 3:
              linha.push('Abril');
            break;
            case 4:
              linha.push('Maio');
            break;
            case 5:
              linha.push('Junho');
            break;
            case 6:
              linha.push('Julho');
            break;
            case 7:
              linha.push('Agosto');
            break;
            case 8:
              linha.push('Setembro');
            break;
            case 9:
              linha.push('Outubro');
            break;
            case 10:
              linha.push('Novembro');
            break;
            case 11:
              linha.push('Dezembro');
            break;
            case 0:
              linha.push('Janeiro');
            break;

          }

          item.forEach((itemm,index)=>
          {
            linha.push(parseInt(itemm['Contagem']));
          });
          linhas.push(linha);
        });
        dados.addRows(linhas);
        return dados;
    }
      function desenharGrafico() {
        // Montar os dados usados pelo grafico
        var dados = getdados();

        // Configuracoes do grafico
        var config = {
            'title':'Quantidade de exames por meses',
            'width':1000,
            'height':450
        };

        // Instanciar o objeto de geracao de graficos de pizza,
        // informando o elemento HTML onde o grafico sera desenhado.
        var chart = new google.charts.Line(document.getElementById('grafico'));
        
        // Desenhar o grafico (usando os dados e as configuracoes criadas)
        chart.draw(dados, config);
        
      }
      
      function DesenhaTabela(){
        var dados = getdados();

        var config = {
            'width':1000,
            'height':500
        };
        var chart2 = new google.visualization.Table(document.getElementById('tabela'));

        chart2.draw(dados, config);

      }
    </script>
  </head>

    <body> 
    <?php include 'template/header.php' ?>  
        <fieldset id="fie" style="height: 80%; align-items: center; justify-content: center;">
            <legend>Relatório Mensal</legend><br />
            <div id="grafico"></div><br />
            <fieldset id="fie" style="height: 80%; display: flex; align-items: center; justify-content: center;">
                <legend>Quantidade de exames pelos meses</legend><br />
                <div id="tabela"></div>
            </fieldset>
        </fieldset>
    </body>
</html>