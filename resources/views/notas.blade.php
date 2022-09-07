<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teste Gomide</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/notas-style.css') }}" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
  </head>
  <body>
    <center>
      <div class="container">
        <img src="{{ asset('images/gomidecontabilidade.jpg') }}" alt='' />
        <div class="card">
          <div class="card-header">
            <form method="GET" action="{{ route('notas') }}">
              @csrf
              <div class="search-date">
                <input type="month" name="month" value="{{ session('month') }}">
                <button type="submit">Filtrar por data</button>
              </div>
            </form>
            <div class="select">
              <select name="menu" id="menu">
                <option value="notas">Notas</option>
              </select>
            </div>
            <form action="{{ route('search') }}" method="GET">
              <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="pesquisa" id="pesquisa" placeholder="Ex. Emitente, Serie, UF...">
              </div>
              @if($errors->all())
                @foreach($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
              @endif
            </form>
          </div>
          <div class="card-body">
            <div class="button-area">
              <button type="button" id="aplica" onclick="copiarTexto('');" disabled><i class="fa fa-key"></i>Chave NFe</button>
              <button type="button" onclick="setTimeout(() => {window.location.reload();}, 500);"><i class="fa-solid fa-file-pdf"></i>Visualizar</button>
              <button type="button"><i class="fa fa-download"></i>Download</button>
              <button type="button" onclick="" data-toggle="modal" data-target="#senMail{{''}}"><i class="fa-solid fa-paper-plane"></i>Enviar e-mail</button>
              <button type="button"><i class="fa fa-gavel"></i>Manifestar</button>
              <button type="button" data-toggle="modal" data-target="#modalEventos{{''}}"><i class="fa fa-exchange"></i>Eventos da nota</button>
              <button type="button" onclick="getId(this,'{{''}}');"><i class="fa fa-refresh"></i> Status</button>
              <button type="button" data-toggle="modal" data-target="#modalProtocolo{{''}}"><i class="fa fa-list"></i>Protocolo</button>
            </div>
            <div class="table-section" id="nfeEnt" role="tabpanel" aria-labelledby="nfeEnt-tab">
              <table id="tableEnt">
                <thead>
                  @if ( count((array)$notas) > 0)
                  <tr>
                    <th><input type="checkbox" id="select-all" name="toggle"/></th>
                    <th>Emitente</th>
                    <th>Série</th>
                    <th>UF</th>
                    <th>Nº</th>
                    <th>Valor</th>
                    <th>Emissão</th>
                    <th>Status</th>
                    <th>Manifesto</th>
                    <th>Exportado</th>
                    <th>Recolhido</th>
                  </tr>
                  @else
                  <td>Nenhum documento encontrado</td>
                  @endif
                </thead>
                <tbody>
                  @foreach($notas as $nfe)
                    <tr>
                      <td><input type="checkbox" name="toggle"/></td>
                      <td>{{ $nfe->emitente }}</td>
                      <td>{{ $nfe->serie ?? '1' }}</td>
                      <td>{{ $nfe->UF }}</td>
                      <td>{{ $nfe->n }}</td>
                      <td><b>{{ number_format(floatval($nfe->valor),2,',','.') }}</b></td>
                      <td>{{ $nfe->emissao }}</td>
                      <td>Ativo</td>
                      <td>Manifesto</td>
                      <td><i class="fa-solid fa-check"></i></td>
                      <td>Recolhido</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Emitente</th>
                    <th>Série</th>
                    <th>UF</th>
                    <th>Nº</th>
                    <th>Valor</th>
                    <th>Emissão</th>
                    <th>Status</th>
                    <th>Manifesto</th>
                    <th>Exportado</th>
                    <th>Recolhido</th>
                  </tr>
                </tfoot>
              </table>
              @if($notas->isEmpty())
                <p style="color: red;" >Nenhuma nota encontrada</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </center>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/92e90f8568.js" crossorigin="anonymous"></script>
    <script>
      document.getElementById('body').onkeyup = function(e) {
        if (e.keyCode === 13) {
          document.getElementById('pesquisa').submit();
        }
        return true;
      }
    </script>
    {{-- check all --}}
    <script>
      // $(document).ready(function(){
      //   $('.check:button').toggle(function(){
      //       $('input:checkbox').attr('checked','checked');
      //       $(this).val('uncheck all')
      //   },function(){
      //       $('input:checkbox').removeAttr('checked');
      //       $(this).val('check all');        
      //   })
      // });
      document.getElementById('select-all').onclick = function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
          checkbox.checked = this.checked;
        }
      }
    </script>
    {{-- Libera o botao se um ou mais checkbox estiver marcado js puro --}}
    <script>
      var checa = document.getElementsByName("toggle");
      var numElementos = checa.length;
      var bt = document.getElementById("aplica");
      for(var x=0; x<numElementos; x++){
        checa[x].onclick = function(){
            // "input[name='toggle']:checked" conta os checkbox checados
            var cont = document.querySelectorAll("input[name='toggle']:checked").length;
            // ternário que verifica se há algum checado.
            // se não há, retorna 0 (false), logo desabilita o botão
            bt.disabled = cont ? false : true;
        }
      }
    </script>
  </body>
</html>
