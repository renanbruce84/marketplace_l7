let cardNumber = document.querySelector('input[name=card_number]');
let spanBrand = document.querySelector('span.brand');

cardNumber.addEventListener('keyup', function () {
    if (cardNumber.value.length >= 6) {

        // GetBrand
        PagSeguroDirectPayment.getBrand({

            cardBin: cardNumber.value.substr(0, 6),

            success: function (res) {
                let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png">`;
                spanBrand.innerHTML = imgFlag;

                // envia o NOME do cartão para o elemento hidden card_brand
                document.querySelector('input[name=card_brand]').value = res.brand.name;

                // getInstallments - Esse método é necessário somente para o meio de pagamento cartão de crédito.
                getInstallments(
                    amountTransaction,
                    res.brand.name
                );
            },

            error: function (err) {},

            complete: function (res) {}
        });

    }
});


let submitButton = document.querySelector('button.proccessCheckout');


submitButton.addEventListener('click', function (event) {
    event.preventDefault();
    
    document.querySelector('div.msg').innerHTML = '';

    let buttonTarget = event.target;

    buttonTarget.disabled = true;
    buttonTarget.innerHTML = "Carregando...";

    PagSeguroDirectPayment.createCardToken({
        cardNumber:         document.querySelector('input[name=card_number]').value,
        brand:              document.querySelector('input[name=card_brand]').value,
        cvv:                document.querySelector('input[name=card_cvv]').value,
        expirationMonth:    document.querySelector('input[name=card_month]').value,
        expirationYear:     document.querySelector('input[name=card_year]').value,
        success: function (res) {
            proccessPayment(res.card.token, buttonTarget);
        },
        error: function (err) {
            buttonTarget.disabled = false;
            buttonTarget.innerHTML = "Efetuar Pagamento";
            for (let i in err.errors) {
                document.querySelector('div.msg').innerHTML =
                    showErrorMessages(errorsMapPagseguroJS(i));
            }
        }
    });
});