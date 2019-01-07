<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
include_once '../plantilla/barra_lateral_usuario.php';
?>
<body>
    <div class="container" id="mmenu">
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <ol class="breadcrumb">
            <li><a href="./" title="Ir a la página de inicio">Inicio</a></li>
            <li class="active">Calcula tu cuota</li>
          </ol>

          <img src="img/banners/calcula-tu-cuota.jpg" class="img-responsive" alt="Estamos para servirte">
          
          <div class="titulo-seccion text-center">
            <h2 class="titulo">¿Cuánto dinero necesitas?</h2>
            <p class="subtitulo">Calcula tu cuota aquí</p>
          </div>


          <ul class="nav nav-tabs" role="tablist" id="calculadoras-tabs">
            <li role="presentation" class="active"><a href="#pils" title="Calcula la cuota de tu Préstamo Personal" aria-controls="pils" role="tab" data-toggle="tab">Préstamo Personal</a></li>
            <li role="presentation"><a href="#extrafinanciamiento" title="Calcula la cuota de tu Extrafinanciamiento" aria-controls="extrafinanciamiento" role="tab" data-toggle="tab" id="extra-bt">Extrafinanciamiento</a></li>
            <!-- <li role="presentation"><a href="#hipotecario" title="Calcula la cuota de tu Préstamo Hipotecario" aria-controls="hipotecario" role="tab" data-toggle="tab" id="hipo-bt">Préstamo Hipotecario</a></li> -->
          </ul>

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="pils">
              <div class="calculadora-bloque">
                <div class="row">
                  <div class="col-sm-2 text-center">Monto</div>
                  <div class="col-sm-4 hidden-xs">
                    <input id="pils-monto-slider" data-slider-id='montoSlider' type="text" data-slider-min="1500" data-slider-max="50000" data-slider-step="500" data-slider-value="5000"/>
                  </div>
                  <div class="col-sm-6 hidden-xs">
                    <input id="pils-monto" type="text" value="$5,000.00" disabled="1" />
                  </div>
                  <div class="col-xs-12 visible-xs">
                    <input id="pils-monto-mobile" type="number" value="5000" min="1500" max="50000" class="form-control">
                  </div>
                </div>
              </div>

              <div class="calculadora-bloque">
                <div class="row">
                  <div class="col-sm-2 text-center">Tiempo</div>
                  <div class="col-sm-4 hidden-xs">
                    <input id="pils-tiempo-slider" data-slider-id='tiempoSlider' type="text" data-slider-min="1" data-slider-max="8" data-slider-step="1" data-slider-value="5"/>
                  </div>
                  <div class="col-sm-6 hidden-xs">
                    <input id="pils-tiempo" type="text" value="5" disabled="1" /> Años
                  </div>
                  <div class="col-xs-12 visible-xs">
                    <div class="input-group">
                      <input id="pils-tiempo-mobile" type="number" value="5" min="1" max="8" class="form-control">
                      <span class="input-group-addon" id="basic-addon2">años</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="calculadora-bloque">
                <div class="row">
                  <div class="col-sm-2 text-center">Tasa</div>
                  <div class="col-sm-4 hidden-xs">
                    <input id="pils-tasa-slider" data-slider-id='tasaSlider' type="text" data-slider-min="9.95" data-slider-max="19.95" data-slider-step="0.05" data-slider-value="11.95"/>
                  </div>
                  <div class="col-sm-6 hidden-xs">
                    <input id="pils-tasa" type="text" value="11.95" disabled="1" /> %
                  </div>
                  <div class="col-xs-12 visible-xs">
                    <div class="input-group">
                      <input id="pils-tasa-mobile" type="number" value="11.95" min="9.95" max="19.95" class="form-control">
                      <span class="input-group-addon" id="basic-addon2">%</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="calculadora-resultados">
                <div class="row">
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Cuota Mensual</div>
                    </div>
                    <p id="pils-cuota-txt">$138.89</p>
                  </div>
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Monto de Préstamo</div>
                    </div>
                    <p id="pils-monto-txt">$5,000.00</p>
                  </div>
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Plazo</div>
                    </div>
                    <p id="pils-tiempo-txt">60 meses</p>
                  </div>
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Tasa</div>
                    </div>
                    <p id="pils-tasa-txt">9.95%</p>
                  </div>
                </div>
              </div>

              <div class="bloque-azul bloque-60">
                <a href="https://www.bancocuscatlan.com.sv/banca-de-personas/solicitud_credito.aspx" title="Aplica a tu Préstamo">Solicita tu Préstamo</a>
              </div>

              <p style="margin-top:2em">Ponemos a su disposición esta calculadora para realizar simulaciones de cálculos de cuotas de amortización de préstamos personales. Esta simulación es referencial de acuerdo a los datos ingresados. Las cuotas son aproximadas. Los términos y condiciones definitivas del crédito se encuentran sujetas a evaluación y aprobación crediticia.</p>
              <p>Comisión por Estructuración máximo del 2.5% sobre el monto desembolsado. *Tasa de interés a otorgar dependerá del perfil de solicitante. Para este cálculo se ha tomado una tasa de referencia promedio la cual puede variar al recibir la información del solicitante. * Al valor de cuota mensual se debe adicionar el valor de Seguro de Vida más Desempleo o Incapacidad Total Temporal de $13.85 anual por millar, emitido por SISA Vida, Seguros de Personas, S.A. Tasa de interés nominal: desde el 9.95% hasta el 19.95% Anual, tasa de interés efectiva máxima correspondiente: desde el 12.89% hasta el 31.02% Anual. Comisión por estructuración mínima de $99 dólares, y máxima 2.5% sobre el monto otorgado. Las Cuotas de amortización mensual incluyen Seguro de Vida con cobertura de Desempleo o Incapacidad total temporal, con una prima correspondiente al 13.85% por millar anual, emitido por SISA Vida, Seguros de Personas, S.A. La aprobación de préstamos personales está sujeta a evaluación crediticia.</p>
            </div>

            <div role="tabpanel" class="tab-pane" id="extrafinanciamiento">
              <div class="calculadora-bloque">
                <div class="row">
                  <div class="col-sm-2 text-center">Monto</div>
                  <div class="col-sm-4 hidden-xs">
                    <input id="extra-monto-slider" type="text" data-slider-min="200" data-slider-max="20000" data-slider-step="100" data-slider-value="5000"/>
                  </div>
                  <div class="col-sm-6 hidden-xs">
                    <input id="extra-monto" type="text" value="$5,000.00" disabled="1" />
                  </div>
                  <div class="col-xs-12 visible-xs">
                    <input id="extra-monto-mobile" type="number" value="5000" min="200" max="20000" class="form-control">
                  </div>
                </div>
              </div>

              <div class="calculadora-bloque">
                <div class="row">
                  <div class="col-sm-2 text-center">Tiempo</div>
                  <div class="col-sm-4 hidden-xs">
                    <input id="extra-tiempo-slider" type="text" data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="3"/>
                  </div>
                  <div class="col-sm-6 hidden-xs">
                    <input id="extra-tiempo" type="text" value="3" disabled="1" /> Años
                  </div>
                  <div class="col-xs-12 visible-xs">
                    <div class="input-group">
                      <input id="extra-tiempo-mobile" type="number" value="3" min="1" max="5" class="form-control">
                      <span class="input-group-addon" id="basic-addon2">años</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="calculadora-bloque">
                <div class="row">
                  <div class="col-sm-2 text-center">Tasa</div>
                  <div class="col-sm-4 hidden-xs">
                    <input id="extra-tasa-slider" type="text" data-slider-min="9.90" data-slider-max="44.90" data-slider-step="0.1" data-slider-value="29.3"/>
                  </div>
                  <div class="col-sm-6 hidden-xs">
                    <input id="extra-tasa" type="text" value="29.3" disabled="1" /> %
                  </div>
                  <div class="col-xs-12 visible-xs">
                    <div class="input-group">
                      <input id="extra-tasa-mobile" type="number" value="29.3" min="9.90" max="44.90" class="form-control">
                      <span class="input-group-addon" id="basic-addon2">%</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="calculadora-resultados mb-1">
                <div class="row">
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Cuota Mensual</div>
                    </div>
                    <p id="extra-cuota-txt">$138.89</p>
                  </div>
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Monto de Extrafinanciamiento</div>
                    </div>
                    <p id="extra-monto-txt">$5,000.00</p>
                  </div>
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Plazo</div>
                    </div>
                    <p id="extra-tiempo-txt">60 meses</p>
                  </div>
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Tasa</div>
                    </div>
                    <p id="extra-tasa-txt">29.3%</p>
                  </div>
                </div>
              </div>

              <div class="bloque-azul bloque-60">
                <a href="./banca-de-personas/solicitud_extrafin.aspx" title="Aplicar tu Extrafinanciamiento">Solicita tu Extrafinanciamiento</a>
              </div>

              <p style="margin-top:2em">Ponemos a su disposición esta calculadora para realizar simulaciones de cálculos de cuotas de amortización de Extrafinanciamientos. Esta simulación es referencial de acuerdo a los datos ingresados. Las cuotas son aproximadas. Los términos y condiciones definitivas del crédito se encuentran sujetas a evaluación y aprobación crediticia.</p>
              <p>Solicita tu Extrafinanciamiento llamando al 2212-2000 o visita tu agencia más cercana. La tasa de interés a otorgar varía según la tarjeta de crédito. Tasa de interés nominal máxima de hasta 44.90% Anual. Tasa de interés efectiva máxima de hasta 65.4% Anual. Aplica pago de Comisión por Estructuración de Extrafinanciamiento del 1.9% por monto retirado +IVA. Comisión por Estructuración mínima de $99 dólares. Seguro de Vida para pago de deuda de acuerdo a la póliza colectiva contratada con SISA Vida, S.A. Seguros de Personas, que corresponde al 0.02% mensual del monto adeudado.</p>
            </div>

            <div role="tabpanel" class="tab-pane" id="hipotecario">
              <div class="calculadora-bloque">
                <div class="row">
                  <div class="col-sm-2 text-center">Monto</div>
                  <div class="col-sm-4 hidden-xs">
                    <input id="hipo-monto-slider" type="text" data-slider-min="30000" data-slider-max="1000000" data-slider-step="1000" data-slider-value="50000"/>
                  </div>
                  <div class="col-sm-6 hidden-xs">
                    <input id="hipo-monto" type="text" value="$50,000.00" disabled="1" />
                  </div>
                  <div class="col-xs-12 visible-xs">
                    <input id="hipo-monto-mobile" type="number" value="50000" min="30000" max="1000000" class="form-control">
                  </div>
                </div>
              </div>

              <div class="calculadora-bloque">
                <div class="row">
                  <div class="col-sm-2 text-center">Tiempo</div>
                  <div class="col-sm-4 hidden-xs">
                    <input id="hipo-tiempo-slider" type="text" data-slider-min="1" data-slider-max="30" data-slider-step="1" data-slider-value="20"/>
                  </div>
                  <div class="col-sm-6 hidden-xs">
                    <input id="hipo-tiempo" type="text" value="3" disabled="1" /> Años
                  </div>
                  <div class="col-xs-12 visible-xs">
                    <div class="input-group">
                      <input id="hipo-tiempo-mobile" type="number" value="20" min="1" max="30" class="form-control">
                      <span class="input-group-addon" id="basic-addon2">años</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="calculadora-bloque">
                <div class="row">
                  <div class="col-sm-2 text-center">Tasa</div>
                  <div class="col-sm-4 hidden-xs">
                    <input id="hipo-tasa-slider" type="text" data-slider-min="7" data-slider-max="11" data-slider-step="0.1" data-slider-value="8.50"/>
                  </div>
                  <div class="col-sm-6 hidden-xs">
                    <input id="hipo-tasa" type="text" value="8.50" disabled="1" /> %
                  </div>
                  <div class="col-xs-12 visible-xs">
                    <div class="input-group">
                      <input id="hipo-tasa-mobile" type="number" value="8.50" min="7" max="11" class="form-control">
                      <span class="input-group-addon" id="basic-addon2">%</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="calculadora-resultados">
                <div class="row">
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Cuota Mensual</div>
                    </div>
                    <p id="hipo-cuota-txt">$138.89</p>
                  </div>
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Monto de Crédito Hipotecario</div>
                    </div>
                    <p id="hipo-monto-txt">$5,000.00</p>
                  </div>
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Plazo</div>
                    </div>
                    <p id="hipo-tiempo-txt">60 meses</p>
                  </div>
                  <div class="col-sm-3 resultado">
                    <div class="big-bullet">
                      <div class="bullet"><img src="img/bullet-01.png"></div>
                      <div class="contenido text-120">Tasa</div>
                    </div>
                    <p id="hipo-tasa-txt">9.95%</p>
                  </div>
                </div>
              </div>
              <p style="margin-top:2em">Ponemos a su disposición esta calculadora para realizar simulaciones de cálculos de cuotas de amortización de préstamos personales. Esta simulación es referencial de acuerdo a los datos ingresados. Las cuotas son aproximadas. Los términos y condiciones definitivas del crédito se encuentran sujetas a evaluación y aprobación crediticia.</p>
              <p>Comisión por Estructuración máximo del 2.5% sobre el monto desembolsado. *Tasa de interés a otorgar dependerá del perfil de solicitante. Para este cálculo se ha tomado una tasa de referencia promedio la cual puede variar al recibir la información del solicitante. * Al valor de cuota mensual se debe adicionar el valor de Seguro de Vida más Desempleo o Incapacidad Total Temporal de $13.85 anual por millar, emitido por SISA Vida, Seguros de Personas, S.A. Banco Citibank de El Salvador, S.A. CITI y el diseño del Arco es una marca registrada de servicios de Citigroup Inc. Tasa de interés nominal: desde el 9.95% hasta el 19.95% Anual, tasa de interés efectiva máxima correspondiente: desde el 12.89% hasta el 31.02% Anual. Comisión por estructuración mínima de $99 dólares, y máxima 2.5% sobre el monto otorgado. Las Cuotas de amortización mensual incluyen Seguro de Vida con cobertura de Desempleo o Incapacidad total temporal, con una prima correspondiente al 13.85% por millar anual, emitido por SISA Vida, Seguros de Personas, S.A. La aprobación de préstamos personales está sujeta a evaluación crediticia.</p>
            </div>
          </div>

        </div>
      </div>
      
      <hr>

      <footer id="footer">
      </footer>
    </div>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-slider.css">
    <link rel="stylesheet" href="css/main.css?v=160620">

    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <script src="js/vendor/jquery-1.11.2.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/bootstrap-slider.js"></script>
    <script src="js/main.js?v=160620"></script>
    <script type="text/javascript">

    var pilsMontoSlider, pilsTiempoSlider, pilsTasaSlider;
    var extraMontoSlider, extraTiempoSlider, extraTasaSlider;
    var hipoMontoSlider, hipoTiempoSlider, hipoTasaSlider;

    function calcular_pils( es_movil )
    {
      var iMonto, iTiempo, iTasa;

      if ( es_movil )
      {
        iMonto = $( '#pils-monto-mobile' ).val( );
        iTiempo = $( '#pils-tiempo-mobile' ).val( );
        iTasa = $( '#pils-tasa-mobile' ).val( );
      } else
      {
        iMonto = pilsMontoSlider.slider('getValue');
        iTiempo = pilsTiempoSlider.slider('getValue');
        iTasa = pilsTasaSlider.slider('getValue');
      }

      $('#pils-monto').val( '$' + numberWithCommas( iMonto ) );
      $('#pils-monto-txt').text( '$' + numberWithCommas( iMonto ) );

      $('#pils-tiempo').val( iTiempo );
      $('#pils-tiempo-txt').text( iTiempo * 12 + " meses" );

      $('#pils-tasa').val( iTasa );
      $('#pils-tasa-txt').text( iTasa +"%" );

      var tasa = $( '#pils-tasa' ).val( ) / 100 / 12;
      var monto = cleanNumber( $('#pils-monto').val( ) );
      var meses = $( '#pils-tiempo' ).val( ) * 12;
      var cuota = 0;

      cuota = monto * ( ( Math.pow( 1 + tasa, meses ) * tasa ) / ( Math.pow( 1 + tasa, meses ) - 1 ) );
      // cuota = monto * Math.pow( 1 + tasa, meses ) / meses;

      $( '#pils-cuota-txt' ).text( '$' + numberWithCommas( cuota ) );
    }

    function calcular_extra( es_movil )
    {
      var iMonto, iTiempo, iTasa;

      if ( es_movil )
      {
        iMonto = $( '#extra-monto-mobile' ).val( );
        iTiempo = $( '#extra-tiempo-mobile' ).val( );
        iTasa = $( '#extra-tasa-mobile' ).val( );
      } else
      {
        iMonto = extraMontoSlider.slider('getValue');
        iTiempo = extraTiempoSlider.slider('getValue');
        iTasa = extraTasaSlider.slider('getValue');
      }

      $('#extra-monto').val( '$' + numberWithCommas( iMonto ) );
      $('#extra-monto-txt').text( '$' + numberWithCommas( iMonto ) );

      $('#extra-tiempo').val( iTiempo );
      $('#extra-tiempo-txt').text( iTiempo * 12 + " meses" );

      $('#extra-tasa').val( iTasa );
      $('#extra-tasa-txt').text( iTasa +"%" );

      var tasa = $( '#extra-tasa' ).val( ) / 100 / 12;
      var monto = cleanNumber( $('#extra-monto').val( ) );
      var meses = $( '#extra-tiempo' ).val( ) * 12;
      var cuota = 0;

      cuota = monto * ( ( Math.pow( 1 + tasa, meses ) * tasa ) / ( Math.pow( 1 + tasa, meses ) - 1 ) );
      // cuota = monto * Math.pow( 1 + tasa, meses ) / meses;

      $( '#extra-cuota-txt' ).text( '$' + numberWithCommas( cuota ) );
    }

    function calcular_hipo( es_movil )
    {
      var iMonto, iTiempo, iTasa;

      if ( es_movil )
      {
        iMonto = $( '#hipo-monto-mobile' ).val( );
        iTiempo = $( '#hipo-tiempo-mobile' ).val( );
        iTasa = $( '#hipo-tasa-mobile' ).val( );
      } else
      {
        iMonto = hipoMontoSlider.slider('getValue');
        iTiempo = hipoTiempoSlider.slider('getValue');
        iTasa = hipoTasaSlider.slider('getValue');
      }

      $('#hipo-monto').val( '$' + numberWithCommas( iMonto ) );
      $('#hipo-monto-txt').text( '$' + numberWithCommas( iMonto ) );

      $('#hipo-tiempo').val( iTiempo );
      $('#hipo-tiempo-txt').text( iTiempo * 12 + " meses" );

      $('#hipo-tasa').val( iTasa );
      $('#hipo-tasa-txt').text( iTasa +"%" );

      var tasa = $( '#hipo-tasa' ).val( ) / 100 / 12;
      var monto = cleanNumber( $('#hipo-monto').val( ) );
      var meses = $( '#hipo-tiempo' ).val( ) * 12;
      var cuota = 0;

      cuota = monto * ( ( Math.pow( 1 + tasa, meses ) * tasa ) / ( Math.pow( 1 + tasa, meses ) - 1 ) );
      // cuota = monto * Math.pow( 1 + tasa, meses ) / meses;

      $( '#hipo-cuota-txt' ).text( '$' + numberWithCommas( cuota ) );
    }

    $( function( )
    {
      var producto =  getParameterByName( 'producto' );
      if ( producto == 'extrafinanciamiento' ) $( '#extra-bt' ).tab( 'show' );
      else if ( producto == 'credito-hipotecario' ) $( '#hipo-bt' ).tab( 'show' );

      pilsMontoSlider = $( '#pils-monto-slider' ).slider( ).on( 'slide, slideStop', function ( e ) { calcular_pils( false ) } );
      pilsTiempoSlider = $( '#pils-tiempo-slider' ).slider( ).on( 'slide, slideStop', function ( e ) { calcular_pils( false ) } );
      pilsTasaSlider = $( '#pils-tasa-slider' ).slider( ).on( 'slide, slideStop', function ( e ) { calcular_pils( false ) } );

      $( '#pils-monto-mobile, #pils-tiempo-mobile, #pils-tasa-mobile' ).on( 'change, keyup', function ( ){ calcular_pils( true ) } );

      extraMontoSlider = $( '#extra-monto-slider' ).slider( ).on( 'slide, slideStop', function ( e ) { calcular_extra( false ) } );
      extraTiempoSlider = $( '#extra-tiempo-slider' ).slider( ).on( 'slide, slideStop', function ( e ) { calcular_extra( false ) } );
      extraTasaSlider = $( '#extra-tasa-slider' ).slider( ).on( 'slide, slideStop', function ( e ) { calcular_extra( false ) } );

      $( '#extra-monto-mobile, #extra-tiempo-mobile, #extra-tasa-mobile' ).on( 'change, keyup', function ( ){ calcular_extra( true ) } );

      hipoMontoSlider = $( '#hipo-monto-slider' ).slider( ).on( 'slide, slideStop', function ( e ) { calcular_hipo( false ) } );
      hipoTiempoSlider = $( '#hipo-tiempo-slider' ).slider( ).on( 'slide, slideStop', function ( e ) { calcular_hipo( false ) } );
      hipoTasaSlider = $( '#hipo-tasa-slider' ).slider( ).on( 'slide, slideStop', function ( e ) { calcular_hipo( false ) } );

      $( '#hipo-monto-mobile, #hipo-tiempo-mobile, #hipo-tasa-mobile' ).on( 'change, keyup', function ( ){ calcular_hipo( true ) } );

      calcular_pils( );
      calcular_extra( );
      calcular_hipo( );

    });
    </script>

    <script type="application/ld+json">
    [
      {
      "@context": "http://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "item": {
          "@id": "http://www.bancocuscatlan.com",
          "name": "Inicio"
          }
        },
        {
          "@type": "ListItem",
          "position": 2,
          "item": {
            "@id": "http://www.bancocuscatlan.com/calcula-tu-cuota",
            "name": "Calcula tu cuota"
          }
        }]
      }
    ]
    </script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-80122808-1', 'auto');
      ga('send', 'pageview');
    </script>
  </body>