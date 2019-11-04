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

      // Carregar a API de visualizacao e os pacotes necessarios.
      google.charts.load('current', {'packages':['line']});
      google.charts.load('current', {'packages':['table']});

      google.setOnLoadCallback(desenharGrafico);
      google.setOnLoadCallback(DesenhaTabela);

      /**
       * Funcao que preenche os dados do grafico
       */
      function desenharGrafico() {
        // Montar os dados usados pelo grafico
        var dados = new google.visualization.DataTable();
        dados.addColumn('string', 'Mês');
        dados.addColumn('number', 'Exame A');
        dados.addColumn('number', 'Exame B');
        dados.addColumn('number', 'Exame C');
        dados.addColumn('number', 'Exame D');
        dados.addColumn('number', 'Exame E');
        dados.addColumn('number', 'Exame F');
        dados.addRows([
          ['Janeiro'    , 14,12,3,32,6,45],
          ['Fevereiro'  , 22,13,66,22,67,34],
          ['Março'      , 33,2,43,91,3,74],
          ['Abril'      , 4,3,43,55,14,66],
          ['Maio'       , 51,45,32,86,51,41],
          ['Junho'      , 42,55,23,13,71,12],
          ['Julho'      , 64,6,57,22,12,13],
          ['Agosto'     , 44,41,28,55,12,5],
          ['Setembro'   , 33,1,96,64,11,5],
          ['Outubro'    , 33,11,43,75,36,26],
          ['Novembro'   , 22,38,14,73,61,36],
          ['Dezembro'   , 51,71,26,71,75,37]
        ]);

        // Configuracoes do grafico
        var config = {
            'title':'Quantidade de exames por meses',
            'width':1300,
            'height':600
        };

        // Instanciar o objeto de geracao de graficos de pizza,
        // informando o elemento HTML onde o grafico sera desenhado.
        var chart = new google.charts.Line(document.getElementById('grafico'));
        
        // Desenhar o grafico (usando os dados e as configuracoes criadas)
        chart.draw(dados, config);
        
      }
      function DesenhaTabela(){
        var dados = new google.visualization.DataTable();
        dados.addColumn('string','Mês');
        dados.addColumn('number', 'Exame A');
        dados.addColumn('number', 'Exame B');
        dados.addColumn('number', 'Exame C');
        dados.addColumn('number', 'Exame D');
        dados.addColumn('number', 'Exame E');
        dados.addColumn('number', 'Exame F');
        dados.addRows([
          ['Janeiro'    , 14,12,3,32,6,45],
          ['Fevereiro'  , 22,13,66,22,67,34],
          ['Março'      , 33,2,43,91,3,74],
          ['Abril'      , 4,3,43,55,14,66],
          ['Maio'       , 51,45,32,86,51,41],
          ['Junho'      , 42,55,23,13,71,12],
          ['Julho'      , 64,6,57,22,12,13],
          ['Agosto'     , 44,41,28,55,12,5],
          ['Setembro'   , 33,1,96,64,11,5],
          ['Outubro'    , 33,11,43,75,36,26],
          ['Novembro'   , 22,38,14,73,61,36],
          ['Dezembro'   , 51,71,26,71,75,37]
        ]);

        var config = {
            'width':500,
            'height':500
        };
        var chart2 = new google.visualization.Table(document.getElementById('tabela'));

        chart2.draw(dados, config);

      }
    </script>
  </head>

  <body>   
    <div id="grafico"></div>
    <fieldset id="fie" style="height: 80%; display: flex; align-items: center; justify-content: center;">
        <legend>Quantidade de exames pelos meses</legend><br />
        <div id="tabela"></div>
    </fieldset>
    </body>
</html>