<div>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport"content="width=device-width, user-scaable=no, initial-scale=1.0 maximum-scale=1.0, minimum-scale=1.0"/>
        <title>MCR Soft</title>
        <link rel="stylesheet" href="/css/estilosMario.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- incorporacion de Letra Jockey One -->
        {{-- <link rel="preconnect" href="https://fonts.googleapis.com" /> --}}
        {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> --}}
        <!-- <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    
        {{-- <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script> --}}
        <!--     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">  -->
      </head>
    
      <body>
        {{-- <header>
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand ms-3" href="#">MCR Soft 7/7/24 FlexBoxa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Empresas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Cobradores</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Clientes</a>
                </li>
              </ul>
            </div>
          </nav>
        </header> --}}
    
        <main>
          <!-- desde aca o anterior -->
          <div cass="container">
            <div>
              <div class="text-center">
                @if(session()->has('message')) 
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                        role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-xm bg-lightgreen">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="pelotero">

                  <a href="VentaSimple?Compras">
                    <div class="pelotitaE">
                      <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-emoji-astonished-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.884-3.978a2.1 2.1 0 0 1 .53.332.5.5 0 0 0 .708-.708h-.001v-.001a2 2 0 0 0-.237-.197 3 3 0 0 0-.606-.345 3 3 0 0 0-2.168-.077.5.5 0 1 0 .316.948 2 2 0 0 1 1.458.048m-4.774-.048a.5.5 0 0 0 .316-.948 3 3 0 0 0-2.167.077 3.1 3.1 0 0 0-.773.478q-.036.03-.07.064l-.002.001a.5.5 0 1 0 .728.689 2 2 0 0 1 .51-.313 2 2 0 0 1 1.458-.048M7 6.5C7 5.672 6.552 5 6 5s-1 .672-1 1.5S5.448 8 6 8s1-.672 1-1.5m4 0c0-.828-.448-1.5-1-1.5s-1 .672-1 1.5S9.448 8 10 8s1-.672 1-1.5m-5.247 4.746c-.383.478.08 1.06.687.98q1.56-.202 3.12 0c.606.08 1.07-.502.687-.98C9.747 10.623 8.998 10 8 10s-1.747.623-2.247 1.246"/>
                      </svg>
                    </div>
                  </a>
                  <div class="col-1"></div>

                  <div class="pelotitaI">
                    <a href="VentaSimple?Ventas">
                      <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-emoji-heart-eyes" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M11.315 10.014a.5.5 0 0 1 .548.736A4.5 4.5 0 0 1 7.965 13a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .548-.736h.005l.017.005.067.015.252.055c.215.046.515.108.857.169.693.124 1.522.242 2.152.242s1.46-.118 2.152-.242a27 27 0 0 0 1.109-.224l.067-.015.017-.004.005-.002zM4.756 4.566c.763-1.424 4.02-.12.952 3.434-4.496-1.596-2.35-4.298-.952-3.434m6.488 0c1.398-.864 3.544 1.838-.952 3.434-3.067-3.554.19-4.858.952-3.434"/>
                      </svg>
                    </a>
                  </div>
                  
                  <div class="col-1"></div>
                  <div class="pelotitaP">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                      <path d="M2 2h2v2H2z" />
                      <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z" />
                      <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z" />
                      <path d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
                      <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z" />
                    </svg>
                  </div>
                    </a>
                </div>
    
                <input wire:model="monto_simple" class="Monto" type="text" value="0,00" placeholder="Monto $" autofocus/><br />
                <input class="fecha" type="date" value="{{ $fecha_simple }}" placeholder="dd/mm/aaaa"/><br />
    
                <!-- Botón para abrir el formulario emergente -->
    
                <!-- Cliente -->
                @if($modulo=="Ventas")
                    <select class="Clientes" wire:model="cliente_simple">
                    <option value="">Seleccione un Cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                        @endforeach
                    </select>
                @else
                    <select class="Proveedores" wire:model="proveedor_simple">
                        <option value="">Seleccione un Proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->name }}</option>
                        @endforeach
                    </select>
                @endif
                <br />
    
                <!-- Area -->
                <select class="areas" wire:model="area_simple">
                  <option value="">Seleccione un Área</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
                <br />
    
                <!-- Cuenta  -->
                <select class="cuentas" wire:model="cuenta_simple">
                  <option value="">Seleccione una Cuenta</option>
                  @foreach ($cuentas as $cuenta)
                    <option value="{{ $cuenta->id }}">{{ $cuenta->name }}</option>
                  @endforeach
                </select>
                <br />
    
                <!-- Destacado de Ingresos  -->
              </div>
              @if($modulo=="Ventas")
              <div style="text-align: center">
                <label class=""><b>Ingresos</b></label>
                <br />
                <input class="Guardar" type="button" value="Guardar" wire:click="GuardarVentaSimple"/>
              </div>
              @else
              <div style="text-align: center">
                <label class="" style="color: brown"><b>Egresos</b></label>
                <br />
                <input class="Guardar" type="button" value="Guardar" wire:click="GuardarCompraSimple"/>
              </div>
              @endif
            </div>
          </div>
        </main>
    
        <footer>
          <div>
          </div>
        </footer>
    
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
        @if ($this->ModalGuardado)
          <div class="inset-0 fixed">
            <div class="absolute flex justify-center w-full mt-10 p-18">
              <div class=" bg-gray-400 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-2 shadow-lg my-2" role="dialog">
                <div class=" bg-gray-400 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  Los datos se guardaron correctamente
              </div>
                <div class="flex justify-end">
                  <!-- Botón de Cerrar -->
                  <button class="rounded-md border m-6 px-4 py-2 bg-yellow-300 text-base leading-6 font-bold text-gray-900 shadow-sm hover:bg-yellow-400 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5" wire:click="closeModal()">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
        @endif
</div>