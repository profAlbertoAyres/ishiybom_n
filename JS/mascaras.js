const tipoContato = document.getElementById('tipoContato');
    const informacaoInput = document.getElementById('informacaoContato');

    function verificaTipoEAplicaMascara() {
        const tipo = tipoContato.value;

        // Remove classe telefone, se existir
        informacaoInput.classList.remove('telefone');

        if (tipo === 'Telefone' || tipo === 'Celular' || tipo === 'WhatsApp') {
            informacaoInput.setAttribute('type','text'); 
            // Adiciona a classe telefone
            informacaoInput.classList.add('telefone');
            // Aplica a máscara
            aplicarMascaraTelefone(informacaoInput);
            // Placeholder sugestivo
            informacaoInput.placeholder = '(00) 00000-0000';
        }else if (tipo === 'E-mail' ) {
            informacaoInput.setAttribute('type','email'); 
            informacaoInput.value = '';
            informacaoInput.placeholder = 'Digite a informação';
        } 
        
        else {
            // Limpa a máscara e placeholder se não for telefone
            informacaoInput.setAttribute('type','text'); 
            informacaoInput.value = '';
            informacaoInput.placeholder = 'Digite a informação';
        }
    }

    // Quando a página carregar, já verifica se precisa aplicar a máscara (para casos de edição)
    document.addEventListener('DOMContentLoaded', verificaTipoEAplicaMascara);

    // Quando mudar o select, verifica e aplica
    tipoContato.addEventListener('change', verificaTipoEAplicaMascara);


function aplicarMascaraTelefone(input) {
    input.addEventListener('input', function (e) {
        let value = input.value.replace(/\D/g, ''); // Remove tudo que não for número

        if (value.length > 11) {
            value = value.slice(0, 11); // Limita no máximo a 11 dígitos
        }

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
                // Com 11 dígitos, formato (XX) X XXXX-XXXX
                formatted += value.substring(2, 3) + ' ' + value.substring(3, 7) + '-' + value.substring(7, 11);
            }
        } else if (value.length > 2) {
            formatted += ') ';
        }

        input.value = formatted;
    });
}


function aplicarMascaraTelefoneTodos(selector = '.telefone') {
    const inputs = document.querySelectorAll(selector);
    inputs.forEach(input => aplicarMascaraTelefone(input));
}
