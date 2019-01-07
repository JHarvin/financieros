<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <script>
            function imprSelec() {
                des = document.getElementById("nav");
                des2 = document.getElementById("footer");
                des.style.display = 'none';
                des2.style.display = 'none';
                //se imprime la pagina
                window.print();
                //reaparece el boton
                des.style.display = 'inline';
                des2.style.display = 'inline';
            }

            function iniciar() {
                numero1 = document.getElementById("monto");
                numero2 = document.getElementById("plazo");
                numero3 = document.getElementById("interes");
            }
            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }
            function addfilas(tableID) {
                var monto = parseInt(numero1.value);
                var meses = parseInt(numero2.value);
                var inte = parseInt(numero3.value);
                var p = inte;
                var capi = 0;
                var cargo = 0.00;
                var tot = 0.00;
                inte = (inte / 12) / 100;
                var cuota = monto * ((inte * Math.pow(1 + inte, meses)) / ((Math.pow(1 + inte, meses)) - 1));
                var interes = 0.00;
                //alert("aqui si");
                cuota = Math.round(cuota * 100) / 100;
                var s = monto;
                var table = document.getElementById(tableID);



                while (table.rows.length > 1) {
                    table.deleteRow(table.rows.length - 1)
                }

                var rowCount = table.rows.length;
                var row = table.insertRow(rowCount);
                var cell1 = row.insertCell(0);
                var element1 = document.createElement("input");
                element1.type = "text";
                element1.value = "0";
                element1.size = "5";
                cell1.appendChild(element1);
                var cell2 = row.insertCell(1);
                var element2 = document.createElement("input");
                element2.type = "text";
                element2.size = "10";
                element2.value = "   ";
                cell2.appendChild(element2);
                var cell3 = row.insertCell(2);
                var element3 = document.createElement("input");
                element3.type = "text";
                element3.size = "10";
                element3.value = "   ";
                cell3.appendChild(element3);
                var cell4 = row.insertCell(3);
                var element4 = document.createElement("input");
                element4.type = "text";
                element4.size = "10";
                element4.value = "  ";
                cell4.appendChild(element4);
                var cell5 = row.insertCell(4);
                var element5 = document.createElement("input");
                element5.type = "text";
                element5.size = "10";
                element5.value = "  ";
                cell5.appendChild(element5);
                var cell6 = row.insertCell(5);
                var element6 = document.createElement("input");
                element6.type = "text";
                element6.size = "10";
                element6.value = "  ";
                cell6.appendChild(element6);
                var cell7 = row.insertCell(6);
                var element7 = document.createElement("input");
                element7.type = "text";
                element7.size = "10";
                element7.value = monto.toString();
                cell7.appendChild(element7);

                var a = document.getElementById("uno");
                if (a.checked) {

                    for (var i = 1; i <= meses; i++) {
                        interes = (s * 30 * p) / 36000;
                        interes = Math.round(interes * 100) / 100;
                        capi = cuota - interes;
                        capi = Math.round(capi * 100) / 100;
                        cargo = s * 0.0006;
                        cargo = Math.round(cargo * 100) / 100;
                        tot = cuota + cargo;
                        tot = Math.round(tot * 100) / 100;
                        s = s - capi;
                        s = Math.round(s * 100) / 100;
                        var rowCount = table.rows.length;
                        var row = table.insertRow(rowCount);
                        var cell1 = row.insertCell(0);
                        var element1 = document.createElement("input");
                        element1.type = "text";
                        element1.size = "5";
                        element1.value = i.toString();
                        cell1.appendChild(element1);
                        var cell2 = row.insertCell(1);
                        var element2 = document.createElement("input");
                        element2.type = "text";
                        element2.size = "10";
                        element2.value = capi.toString();
                        cell2.appendChild(element2);
                        var cell3 = row.insertCell(2);
                        var element3 = document.createElement("input");
                        element3.type = "text";
                        element3.size = "10";
                        element3.value = interes.toString();
                        cell3.appendChild(element3);
                        var cell4 = row.insertCell(3);
                        var element4 = document.createElement("input");
                        element4.type = "text";
                        element4.size = "10";
                        element4.value = cuota.toString();
                        cell4.appendChild(element4);
                        var cell5 = row.insertCell(4);
                        var element5 = document.createElement("input");
                        element5.type = "text";
                        element5.size = "10";
                        element5.value = cargo.toString();
                        cell5.appendChild(element5);
                        var cell6 = row.insertCell(5);
                        var element6 = document.createElement("input");
                        element6.type = "text";
                        element6.size = "10";
                        element6.value = tot.toString();
                        cell6.appendChild(element6);
                        var cell7 = row.insertCell(6);
                        var element7 = document.createElement("input");
                        element7.type = "text";
                        element7.size = "10";
                        element7.value = s.toString();
                        cell7.appendChild(element7);
                    }
                }
                else {
                    capi = monto / meses;
                    capi = Math.round(capi * 100) / 100;
                    for (var i = 1; i <= meses; i++) {
                        interes = s * inte;
                        interes = Math.round(interes * 100) / 100;
                        cargo = s * 0.0003;
                        cargo = Math.round(cargo * 100) / 100;
                        cuota = capi + interes;
                        cuota = Math.round(cuota * 100) / 100;
                        tot = cuota + cargo;
                        tot = Math.round(tot * 100) / 100;
                        s = s - capi;
                        s = Math.round(s * 100) / 100;
                        var rowCount = table.rows.length;
                        var row = table.insertRow(rowCount);
                        var cell1 = row.insertCell(0);
                        var element1 = document.createElement("input");
                        element1.type = "text";
                        element1.size = "5";
                        element1.value = i.toString();
                        cell1.appendChild(element1);
                        var cell2 = row.insertCell(1);
                        var element2 = document.createElement("input");
                        element2.type = "text";
                        element2.size = "10";
                        element2.value = capi.toString();
                        cell2.appendChild(element2);
                        var cell3 = row.insertCell(2);
                        var element3 = document.createElement("input");
                        element3.type = "text";
                        element3.size = "10";
                        element3.value = interes.toString();
                        cell3.appendChild(element3);
                        var cell4 = row.insertCell(3);
                        var element4 = document.createElement("input");
                        element4.type = "text";
                        element4.size = "10";
                        element4.value = cuota.toString();
                        cell4.appendChild(element4);
                        var cell5 = row.insertCell(4);
                        var element5 = document.createElement("input");
                        element5.type = "text";
                        element5.size = "10";
                        element5.value = cargo.toString();
                        cell5.appendChild(element5);
                        var cell6 = row.insertCell(5);
                        var element6 = document.createElement("input");
                        element6.type = "text";
                        element6.size = "10";
                        element6.value = tot.toString();
                        cell6.appendChild(element6);
                        var cell7 = row.insertCell(6);
                        var element7 = document.createElement("input");
                        element7.type = "text";
                        element7.size = "10";
                        element7.value = s.toString();
                        cell7.appendChild(element7);
                    }
                }
            }
            window.addEventListener("load", iniciar, false);
            //history.back();


        </script>



        <div id="header">


        </div>

        

        <div id="main">
            <!-- wrapper-main -->
            <div class="wrapper">
                <!-- content -->
                <div id="content">
                    <!-- title -->
                    <div id="page-title">
                        <span class="title">Crédito</span>
                        
                    </div>
                    <!-- ENDS title -->
                    <!-- page-content -->

                    <div id="imp">	
                        <form method="post" action="./simulador.aspx" id="form1">
                            <div class="aspNetHidden">
                                <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwULLTE5OTAzNjA2NTBkZIcXSzLd3Jk7VYDagYzbgj4qvH0y0MuAqq9OgNWj9sOP" />
                            </div>

                            <div class="aspNetHidden">

                                <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="5CBC5FA3" />
                            </div>      	
                            <b>MONTO</b>
                            <input type="number" name="monto" id="monto" onkeypress="return isNumberKey(event)" min="1000" max="100000" >
                            <b>&nbsp;&nbsp; PLAZO</b>
                            <input type="number" name="plazo" id="plazo" onkeypress="return isNumberKey(event)" min="10" max="100">
                            <b>meses&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INTERES</b>
                            <input type="number" name="interes" id="interes" onkeypress="return isNumberKey(event)" min="5" max="30"">
                            <b>% anual</b><br />
                            <input type="radio" name="tipo" id ="uno" checked>
                            <b>Cuota Fija</b>
                            <input type="radio" name="tipo" id ="dos">
                            <b>Cuota Variable</b>
                            <INPUT type="button" id="agregar" value="Calcular" onclick="addfilas('dataTable');" />
                            <table id="dataTable">				
                                <tbody>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Capital</th>
                                        <th>Interes</th>
                                        <th>Cuota</th>
                                        <th>Cargos</th>
                                        <th>Total</th>
                                        <th>Saldo</th>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="button" name="imprimir" value="Imprimir" onclick="imprSelec('impr')" />

                        </form>
                    </div>	
                    <!-- ENDS table -->		


                    <!-- ENDS page-content -->	
                </div>
                <!-- ENDS content -->
            </div>
            <!-- ENDS wrapper-main -->
        </div>



        
        
        
    </body>

    <script>

    </script>

</html>