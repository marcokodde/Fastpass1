function calcular(){
    hide_results()
    hide_error()

    var  has_error  = false;
    var  cost       = document.getElementById('cost').value;
    var  downpayment= document.getElementById('downpayment').value;
    var  rate       =  document.getElementById('rate').value;
    var  plazo      = document.getElementById('plazo').value;
    var  plazo_ctc  = document.getElementById('plazo_ctc').value;



    if (!cost) {
        show_error('Indique el costo del vehículo');
        document.getElementById('cost').focus();
        has_error = true;
        return;
    }else{
        var downpayment_ctc = redondear( cost * .2).toFixed(2);
        var amount_ctc = cost - downpayment_ctc;
        document.getElementById('downpayment_ctc').value = downpayment_ctc;
        document.getElementById('amount_ctc').value =amount_ctc ;
        hide_error();
        has_error = false;
    }


    if (!downpayment) {
        show_error('Indique el enganche');
        document.getElementById('downpayment').focus();
        has_error = true;
        return;
    }else{
        var  amount     = cost-downpayment
        document.getElementById('amount').value = amount;
        if(downpayment > downpayment_ctc){
            var downpayment_ctc = redondear( downpayment).toFixed(2);
            var amount_ctc = cost - downpayment_ctc;
            document.getElementById('downpayment_ctc').value = downpayment_ctc;
            document.getElementById('amount_ctc').value =amount_ctc ;
        }
        hide_error();

        has_error = false;
    }

    if (!rate) {
        show_error('Indique tasa de interés anual');
        document.getElementById('rate').focus();
        has_error = true;
        return;
    }else{
        hide_error();
        has_error = false;
    }

    if (!plazo) {
        show_error('Indique plazo en meses');
        document.getElementById('plazo').focus();
        has_error = true;

        return;
    }else{
        hide_error();
        has_error = false;
    }

    if (parseInt(plazo) < 1) {
        show_error('El plazo  deben ser de mayor que 1');
        has_error = true;
        return;
    }else{
        hide_error();
        has_error = false;
    }


    if(has_error){
        hide_results()
    }else{




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
    return Math.round(m) / 100 * Math.sign(num).toFixed(0);
}
