
//-----------------------  FUNCIONES PARA CREDITO PERSONAL --------------------------------﻿
function llenar_tabla_clientenulll(valor) {
    alert("paso8");
    var depto = valor;
//var numero=valor.id.substr(7)
//alert(valor.id);
    if (depto != "") {//alert("paso"+depto);
        $.post("../cuenta_cobrar/llenar_tabla_cliente.php", {libro: depto}, function (mensaje) {
            $('#lista_personas_naturales').html(mensaje).fadeIn();

        });

    }

}



//-----------------------  FIN FUNCIONES PARA CREDITO PERSONAL --------------------------------﻿
  function addfilas(tableID,inte) {
//        var tasa = document.getElementById("tasa_per").value / 100 / 12;
//        var monto = document.getElementById("monto_per").value;
//        var meses = document.getElementById("mese_per").value;
       
        var monto = document.getElementById("monto_per").value;
        var meses = document.getElementById("mese_per").value;
       // var inte = document.getElementById("tasa_per").value
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
//        var cell5 = row.insertCell(4);  COLUMNAS QUE NO SE OCUPAN
//        var element5 = document.createElement("input");
//        element5.type = "text";
//        element5.size = "10";
//        element5.value = "  ";
//        cell5.appendChild(element5);
//        var cell6 = row.insertCell(5);
//        var element6 = document.createElement("input");
//        element6.type = "text";
//        element6.size = "10";
//        element6.value = "  ";
//        cell6.appendChild(element6);
        var cell5 = row.insertCell(4);
        var element7 = document.createElement("input");
        element7.type = "text";
        element7.size = "10";
        element7.value = monto.toString();
        cell5.appendChild(element7);

        var a = document.getElementById("uno");//ESTA VARIABLE ES PARA CUOTA VARIABLE VER EN FUENTE http://elchurqui.com.bo/simulador.aspx
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
//                var cell5 = row.insertCell(4);
//                var element5 = document.createElement("input");
//                element5.type = "text";
//                element5.size = "10";
//                element5.value = cargo.toString();
//                cell5.appendChild(element5);
//                var cell6 = row.insertCell(5);
//                var element6 = document.createElement("input");
//                element6.type = "text";
//                element6.size = "10";
//                element6.value = tot.toString();
//                cell6.appendChild(element6);
                var cell5 = row.insertCell(4);
                var element7 = document.createElement("input");
                element7.type = "text";
                element7.size = "10";
                element7.value = s.toString();
                cell5.appendChild(element7);
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
    //window.addEventListener("load", false);
    
//    $(document).ready(function () {
//   $('.credito_hipotecarioo').submit(function () {
//            //var codigo=$('#codigol').val();
//            
//            var formData = new FormData(document.getElementById('credito_hipotecario'))
//            $.ajax({
//                url: $(this).attr('action'),
//                type: 'POST',
//                dataType: "html",
//                data: formData,
//                cache: false,
//                contentType: false,
//                processData: false
//            }).done(function (resp) {
//                if (resp == 1) {
//                    swal({
//                        title: "Exito",
//                        text: "Autor Registrado",
//                        type: "success"},
//                            function () {
//                                document.getElementById('credito_hipotecario').reset();
//
//                            }
//
//                    );
//
//                } else {
//                    swal("Oops", resp, "error")
//
//                }
//            })
//            return false;
//        })
//    });