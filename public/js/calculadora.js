const { has } = require("lodash");

function calcular(){
    hide_results()
    hide_error()
    var  has_error      = false;


    var  cost           = document.getElementById('cost').value;
    var  downpayment    = document.getElementById('downpayment').value;
    var  rate           =  document.getElementById('rate').value;
    var  plazo          = document.getElementById('plazo').value;
    var  plazo_ctc      = document.getElementById('plazo_ctc').value;
    var  downpayment_ctc= document.getElementById('ctc_downpayment').value;



    // Valida Costo Vehículo
    unmark_error('cost');
    if (!cost) {
        mark_error('cost','Indique el costo del vehículo')
        has_error = true;
        return;
    }else{
        if (Number.isInteger(cost)) {
            mark_error('cost','Introduzca un valor entero')
            has_error = true
            return
          }
        has_error = false;
    }

    // Enganche de Coast To Coast
    unmark_error('downpayment_ctc')
    if(!downpayment_ctc){
        var downpayment_ctc = redondear( cost * 20/100).toFixed(0);
        document.getElementById('ctc_downpayment').value = downpayment_ctc;
    }

    if(downpayment_ctc && downpayment_ctc < redondear( cost * .20/100).toFixed(0)){
        mark_error('downpayment_ctc','Enganche Coast To Coast debe ser al menos del 20% del Costo del Vehículo')
        document.getElementById('downpayment_ctc').style
        hide_show_element(amount_ctc);
        has_error = true
        return
    }else{
        has_error = false;
    }
    unmark_error('downpayment_ctc')
    var amount_ctc = cost - downpayment_ctc;
    document.getElementById('amount_ctc').value =amount_ctc ;

    // Valida Enganche
    unmark_error('downpayment')
    if (!downpayment) {
        mark_error('downpayment','Indique el Enganche')
        has_error = true;
        return;
    }else{
        has_error = false;
    }

     var  amount     = cost - downpayment
     document.getElementById('amount').value =amount;

    // Valida Tasa de Interés
    unmark_error('rate')
    if (!rate) {
        mark_error('rate','Indique tasa de interés anual');
        has_error = true;
        return;
    }else{
        has_error = false;
    }

    // Valida Plazo
    unmark_error('plazo')
    if (!plazo) {
        mark_error('plazo','Indique plazo en meses');
        has_error = true;
        return;
    }else{
        has_error = false;
    }

    if (parseInt(plazo) < 1) {
        mark_error('plazo','El plazo  deben ser de mayor que 1');
        has_error = true;
        return;
    }else{
        hide_error();
        has_error = false;
    }


    if(has_error){
        hide_results()
    }else{
        results =  document.getElementById('errors');
        results.style.display = 'none'
        otros_pago_mensual  = calcular_pago_mensual(rate,plazo,amount);
        pago_mensual_coast = calcular_pago_mensual(0,plazo_ctc,amount_ctc);
        otros_pago_total    = otros_pago_mensual * plazo;
        document.getElementById('month_others').value = otros_pago_mensual;
        document.getElementById('month_ctc').value = pago_mensual_coast;
        document.getElementById('total_others').value = redondear(otros_pago_mensual * plazo);
        document.getElementById('total_ctc').value = redondear(pago_mensual_coast * plazo_ctc);
        show_results()
    }


}


function show_results(){
   results =  document.getElementById('results');
   results.style.display = ''
}

function hide_results(){
    results =  document.getElementById('results');
    results.style.display = 'none'
}

function show_error(error){
    document.getElementById('errors').innerHTML = '<h2>' + error + '</h2>';
    document.getElementById('errors').style = "block";
    hide_results()
}


function hide_error(){
    document.getElementById('errors').innerHTML = '';
    document.getElementById('errors').style = "none";
}


/*+---------------------------------+
  | rate    =  Tasa de interés      |
  | plazo   = Plazo (meses)         |
  | amount  = Importe a Financiar   |
  +---------------------------------+
*/

function calcular_pago_mensual(rate, plazo, amount) {
        if(rate == 0  ) return  redondear(amount / plazo);
        return  redondear((rate/100/12 * amount)/(1 - Math.pow(1 + rate/100/12,-plazo)))

}


function redondear(num) {
    var m = Number((Math.abs(num) * 100).toPrecision(15));
    return Math.ceil( Math.round(m) / 100 * Math.sign(num).toFixed(0));
}

// Validar
function filterFloat(evt,input){

    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;

    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0 || key == 9) {
              return true;
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{
                    return true;
                }
          }else{
              return false;
          }
    }
}

// Marca Error
function mark_error(object,msg_error){
    var element = document.getElementById(object);
    element.classList.add("error_element");
    show_error(msg_error);
    element.focus();
}

// Desmarca Error
function unmark_error(object){
    var element = document.getElementById(object);
    element.classList.remove("error_element");
    hide_error();
}

// Mustra u oculta elemento
function hide_show_element(object,show=true){
    var element = document.getElementById(object);
    if(show){
        element.style = '';
        return;
    }

    element.style = "none";

}
