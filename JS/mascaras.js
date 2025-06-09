const tipoContato = document.getElementById('tipoContato');
let informacaoInput = document.getElementById('informacaoContato');

function formatarTelefone(value) {
  value = value.replace(/\D/g, '');
  if (value.length > 11) value = value.slice(0, 11);

  let formatted = '';

  if (value.length > 0) {
    formatted += '(' + value.substring(0, Math.min(2, value.length));
  }
  if (value.length >= 3) {
    formatted += ') ';
    if (value.length <= 10) {
      formatted += value.substring(2, 6);
      if (value.length >= 7) {
        formatted += '-' + value.substring(6, 10);
      } else {
        formatted += value.substring(6);
      }
    } else {
      formatted += value.substring(2, 3) + ' ' + value.substring(3, 7) + '-' + value.substring(7, 11);
    }
  } else if (value.length > 2) {
    formatted += ') ';
  }

  return formatted;
}

function aplicarMascaraTelefone(input) {
  input.value = formatarTelefone(input.value);

  input.addEventListener('input', function () {
    input.value = formatarTelefone(input.value);
  });
}

function verificaTipoEAplicaMascara() {
  const tipo = tipoContato.value;

  // Remove a classe telefone e event listeners anteriores
  informacaoInput.classList.remove('telefone');

  // Clonar e substituir para remover event listeners antigos
  const novoInput = informacaoInput.cloneNode(true);
  informacaoInput.parentNode.replaceChild(novoInput, informacaoInput);

  // Atualiza referência
  informacaoInput = document.getElementById('informacaoContato');

  if (tipo === 'Telefone' || tipo === 'Celular' || tipo === 'WhatsApp') {
    informacaoInput.setAttribute('type', 'text');
    informacaoInput.classList.add('telefone');
    aplicarMascaraTelefone(informacaoInput);
    informacaoInput.placeholder = '(00) 00000-0000';
  } else if (tipo === 'E-mail') {
    informacaoInput.setAttribute('type', 'email');
    informacaoInput.placeholder = 'Digite o e-mail';
  } else {
    informacaoInput.setAttribute('type', 'text');
    informacaoInput.placeholder = 'Digite a informação';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  verificaTipoEAplicaMascara();
});

tipoContato.addEventListener('change', verificaTipoEAplicaMascara);
