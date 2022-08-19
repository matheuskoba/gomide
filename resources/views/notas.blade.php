<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teste Gomide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>.paddingTd{padding-right: 30px;}.marginButton{margin-right: 20px;}</style>
  </head>
  <body class="bg-secondary">
    <center>
      <div class="card col-7 mt-3">
        <div class="card-header">
          <form action="{{ route('notas') }}" method="get" class="col-md-12" style="height: 41px;display: flex;flex-direction: row;" >
            @csrf
            <div class="form-group d-flex justify-content-between col-md-12 align-items-center">
                <div class="col-md-8">
                    <label class="text-left font-weight-bold">Selecione o Mês:</label>
                </div>
                <div class="col-md-4 d-flex">
                  <input type="month" class="form-control" name="month" value="{{ session('month') }}">
                  <button style="display: flex;justify-content: center;align-items: center;" class="btn btn-primary" type="submit">Trocar</button>
                </div>
            </div>
          </form>
        </div>
        <div class="card-body">
          <div class="card-header row">
            <div class="d-flex mb-2">
              <label for="pesquisa">Digite a pesquisa: </label>
            </div>
            <div class="col-md-5">
              <form action="{{ route('search') }}" method="GET">
                <input type="text" name="pesquisa" id="pesquisa" class="form-control" placeholder="Ex. Emitente, Serie, UF...">
                @if($errors->all())
                  @foreach($errors->all() as $error)
                      <p style="color: red">{{ $error }}</p>
                  @endforeach
                @endif
              </form>
            </div>
          </div>
            <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nfeEnt active" id="nfeEnt-tab" data-toggle="tab" href="#nfeEnt" role="tab" aria-controls="nfeEnt" aria-selected="true"><i class="fa fa-address-card" aria-hidden="true"></i>Notas </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active mt-3" style="width: 45em; overflow-x: auto; white-space: nowrap;" id="nfeEnt" role="tabpanel" aria-labelledby="nfeEnt-tab">
                  <p style="font-weight: bold; font-size: 25px;" >Notas</p>
                  <table id="tableEnt" style="width:100%" class="col-md-12 table-striped">
                    <thead>
                      @if ( count((array)$notas) > 0)
                      <tr>
                        <th></th>
                        <th width="1"></th>
                        <th>Emitente</th>
                        <th>Série</th>
                        <th>UF</th>
                        <th>Nº</th>
                        <th>Valor</th>
                        <th>Emissão</th>
                      </tr>
                      @else
                      <td>Nenhum documento encontrado</td>
                      @endif
                    </thead>
                    <tbody>
                      @foreach($notas as $nfe)
                        <tr>
                          <td>
                            
                          </td>
                          <td style="width: 60%;">
                            <div class="actions">
                              <div class="text-center" style="display: flex; align-items: center; 
                              justify-content: center; margin-right: 20px;">
                                <button class="btn btn-dark btn-sm btnCopiar marginButton"  onclick="copiarTexto('{{$nfe->id}}');"><i class="fa fa-key"></i>
                                  Chave NFe
                                </button>
                                  <a href="#" target="_blank"><button type="button" class="btn btn-dark btn-sm statusAction actionView marginButton" onclick="setTimeout(() => {
                                    window.location.reload();}, 500);"><i class="fa-solid fa-file-pdf"></i>
                                      Visualizar
                                    </button></a>
                                  <a href="#">
                                  <button type="button" class="btn btn-dark btn-sm statusAction marginButton actionDownload"><i class="fa fa-download"></i>
                                    Download
                                  </button></a>
                                <button type="button" class="btn btn-dark  btn-sm statusAction actionSendEmail marginButton" onclick="getId(this,'{{$nfe->id}}');" data-toggle="modal" data-target="#senMail{{$nfe->id}}">
                                  <i class="fa-regular fa-paper-plane-top"></i>
                                  Enviar e-mail
                                </button>
                                <a href="#">
                                  <button type="button" class="btn btn-dark btn-sm statusAction actionManifest marginButton"><i class="fa fa-gavel"></i>
                                    Manifestar
                                  </button>
                                </a>
                                {{-- @if ($nfe->manifesto != null)
                                  <button type="button" class="btn btn-dark btn-sm statusAction actionEventNote marginButton" data-toggle="modal" data-target="#modalEventos{{$nfe->id}}"><i class="fa fa-exchange"></i>
                                    Eventos da nota
                                  </button>
                                @endif --}}
                                <!---->
                                <a href="#">
                                  <button type="button" class="btn btn-dark btn-sm marginButton" onclick="getId(this,'{{$nfe->id}}');">
                                    <i class="fa fa-refresh"></i> Status
                                  </button>
                                </a>
                                <button type="button" class="btn btn-dark btn-sm marginButton" data-toggle="modal" data-target="#modalProtocolo{{$nfe->id}}"><i class="fa fa-list"></i>
                                  Protocolo
                                </button>
                              </div>
                            </div>
                          </td>
                          <td class="paddingTd"> {{ $nfe->emitente }}</td>
                          <td class="paddingTd">{{ $nfe->serie ?? '1' }}</td>
                          <td class="paddingTd">{{ $nfe->UF }}</td>
                          <td class="paddingTd">{{ $nfe->n }}</td>
                          <td class="paddingTd"><b>{{ number_format(floatval($nfe->valor),2,',','.') }}</b></td>
                          <td class="paddingTd">{{ $nfe->emissao }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="paddingTd">#</th>
                        <th width="1" class="paddingTd"></th>
                        <th class="paddingTd">Emitente</th>
                        <th class="paddingTd">Série</th>
                        <th class="paddingTd">UF</th>
                        <th class="paddingTd">Nº</th>
                        <th class="paddingTd">Valor</th>
                        <th class="paddingTd">Emissão</th>
                        <th class="paddingTd">Status</th>
                        <th class="paddingTd">Manifesto</th>
                        <th class="paddingTd">Exportado</th>
                        <th class="paddingTd">Recolhido</th>
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
  </body>
</html>
