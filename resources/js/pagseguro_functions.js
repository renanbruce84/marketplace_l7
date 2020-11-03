  // Eviando os dados atraves de uma variável chamada data
  function proccessPayment(token, buttonTarget) {

      let data = {
          card_token: token,
          hash: PagSeguroDirectPayment.getSenderHash(),
          installment: document.querySelector('select.select_installments').value,
          card_name: document.querySelector('input[name=card_name]').value,
          _token: csrf
      };

      $.ajax({
          type: 'POST',
          url: urlProccess,
          data: data,
          dataType: 'json',
          success: function (res) {
              toastr.success(res.data.message, 'Sucesso');
              window.location.href = `${urlThanks}?order=${res.data.order}`;
          },
          error: function (err) {
              buttonTarget.disabled = false;
              buttonTarget.innerHTML = "Efetuar Pagamento";

              let message = JSON.parse(err.responseText);
              document.querySelector('div.msg').innerHTML =
                  showErrorMessages(message.data.message.error.message);
          }
      });
  }

  // getInstallments
  function getInstallments(amount, brand) {
      PagSeguroDirectPayment.getInstallments({
          amount: amount,
          brand: brand,
          maxInstallmentNoInterest: 0,
          success: function (res) {
              let selectInstallments = drawSelectInstallments(res.installments[brand]);
              document.querySelector('div.installments').innerHTML = selectInstallments;
          },
          error: function (err) {},
          complete: function (res) {}
      })
  }

  function drawSelectInstallments(installments) {
      let select = '<label>Opções de Parcelamento</label>';

      select += '<select class="form-control select_installments">';
      for (const l of installments) {
          select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
      }
      select += '</select>';

      return select;
  }

  function showErrorMessages(message) {

      return `
        <div class="alert alert-danger">${message}</div>
    `;
  }

  function errorsMapPagseguroJS(code) {
      switch (code) {
          case "10000":
              return 'Bandeira do cartão inválido';

          case "10001":
              return 'Número do cartão inválido';

          case "10002":
          case "30405":
              return 'Data com formato inváldo';

          case "10003":
              return 'Código de seguraça inválido';

          case "10004":
              return 'Código de segurança é obrigatório';

          case "10006":
              return 'Tamanho do código de segurança inváido';

          default:
              return 'Houve um erro na validação do seu cartão de credito';
      }
  }
