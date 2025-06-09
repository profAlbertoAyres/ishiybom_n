// Pega os elementos do DOM
const tipoContato = document.getElementById('tipoContato');
const informacaoInput = document.getElementById('informacaoContato');

// Função para formatar um número como telefone
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

// Função para aplicar máscara de telefone
function aplicarMascaraTelefone(input) {
  // Formata valor inicial (caso tenha vindo do banco)
  input.value = formatarTelefone(input.value);

  // Remove event listeners antigos (se houver) — boa prática
  input.removeEventListener('input', onTelefoneInput);

  // Função que será chamada no evento input
  function onTelefoneInput() {
    input.value = formatarTelefone(input.value);
  }

  // Adiciona o event listener
  input.addEventListener('input', onTelefoneInput);

  // Guarda referência da função para permitir remoção no futuro, se precisar
  input._onTelefoneInput = onTelefoneInput;
}

// Função principal que verifica o tipo e aplica as máscaras
function verificaTipoEAplicaMascara() {
  const tipo = tipoContato.value;

  // Remove classe de telefone sempre que muda o tipo
  informacaoInput.classList.remove('telefone');

  // Se já tinha um event listener de telefone, remove
  if (informacaoInput._onTelefoneInput) {
    informacaoInput.removeEventListener('input', informacaoInput._onTelefoneInput);
    delete informacaoInput._onTelefoneInput;
  }

  // Configura o campo conforme o tipo selecionado
  if (tipo === 'Telefone' || tipo === 'Celular' || tipo === 'WhatsApp') {
    informacaoInput.setAttribute('type', 'text');
    informacaoInput.classList.add('telefone');
    aplicarMascaraTelefone(informacaoInput);
    informacaoInput.placeholder = '(00) 00000-0000';
  } else if (tipo === 'E-mail') {
    informacaoInput.setAttribute('type', 'email');
    informacaoInput.placeholder = 'Digite o e-mail';
    // O valor vindo do banco continua visível
  } else {
    informacaoInput.setAttribute('type', 'text');
    informacaoInput.placeholder = 'Digite a informação';
    // O valor vindo do banco continua visível
  }
}

// Quando a página carregar, já configura o campo corretamente (para casos de edição)
document.addEventListener('DOMContentLoaded', () => {
  verificaTipoEAplicaMascara();
});

// Quando o usuário trocar o tipo, atualiza o campo
tipoContato.addEventListener('change', verificaTipoEAplicaMascara);
