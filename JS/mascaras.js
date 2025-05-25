function aplicarMascaraTelefone(input) {
    input.addEventListener('input', function () {
        let value = input.value.replace(/\D/g, '');

        if (value.length > 11) {
            value = value.slice(0, 11);
        }

        if (value.length <= 10) {
            value = value.replace(/^(\d{0,2})(\d{0,4})(\d{0,4}).*/, function(_, p1, p2, p3){
                let result = '';
                if (p1) result += '(' + p1;
                if (p1.length == 2) result += ') ';
                if (p2) result += p2;
                if (p3) result += '-' + p3;
                return result;
            });
        } else {
            value = value.replace(/^(\d{0,2})(\d{0,1})(\d{0,4})(\d{0,4}).*/, function(_, p1, p2, p3, p4){
                let result = '';
                if (p1) result += '(' + p1;
                if (p1.length == 2) result += ') ';
                if (p2) result += p2 + ' ';
                if (p3) result += p3;
                if (p4) result += '-' + p4;
                return result;
            });
        }

        input.value = value;
    });
}

function aplicarMascaraTelefoneTodos(selector = '.telefone') {
    const inputs = document.querySelectorAll(selector);
    inputs.forEach(input => aplicarMascaraTelefone(input));
}
