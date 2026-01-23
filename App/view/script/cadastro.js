// ---> FUNÇÃO PARA CEP <---
function consultarCEP(cep) {
    // Remove caracteres não numéricos
    cep = cep.replace(/\D/g, '');
    
    // Verifica se o CEP tem 8 dígitos
    if (cep.length !== 8) {
        alert('CEP inválido! Deve conter 8 dígitos.');
        return;
    }

    // Mostra um loading (opcional)
    document.getElementById('cep').classList.add('loading');
    
    // Faz a requisição para a API ViaCEP
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {
            if (data.erro) {
                throw new Error('CEP não encontrado');
            }
            
            // Preenche os campos automaticamente
            document.getElementById('logradouro').value = data.logradouro || '';
            document.getElementById('bairro').value = data.bairro || '';
            document.getElementById('cidade').value = data.localidade || '';
            document.getElementById('uf').value = data.uf || '';
            
            // Foca automaticamente no campo número
            document.getElementById('numero').focus();
        })
        .catch(error => {
            console.error('Erro ao consultar CEP:', error);
            alert(error.message || 'Erro ao consultar CEP. Tente novamente.');
        })
        .finally(() => {
            // Remove o loading
            document.getElementById('cep').classList.remove('loading');
        });
}

// ---> FUNÇÃO PARA MÁSCARAS <---
function aplicarMascaraCPF(cpf) {
    cpf = cpf.replace(/\D/g, ""); // Remove tudo que não é número
    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2"); // Adiciona o ponto
    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2"); // Adiciona o ponto
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); // Adiciona o traço
    return cpf;
}

function aplicarMascaraTelefone(tel) {
    tel = tel.replace(/\D/g, ""); // Remove tudo que não é número
    tel = tel.replace(/^(\d{2})(\d)/, "($1) $2"); // Formata o DDD
    tel = tel.replace(/(\d{5})(\d{4})$/, "$1-$2"); // Formata o número
    return tel;
}

// ---> INICIALIZAÇÃO QUANDO O DOM ESTIVER PRONTO <---
document.addEventListener('DOMContentLoaded', function() {
    // Formatação automática do CEP
    const cepInput = document.getElementById('cep');
    if (cepInput) {
        cepInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 5) {
                value = value.substring(0, 5) + '-' + value.substring(5, 8);
            }
            e.target.value = value;
            
            // Consulta automática quando o CEP estiver completo
            if (value.replace(/\D/g, '').length === 8) {
                consultarCEP(value);
            }
        });

        cepInput.addEventListener('blur', function() {
            consultarCEP(this.value);
        });
    }

    // Máscaras para CPF e Telefone
    const cpfInput = document.getElementById('cpf');
    if (cpfInput) {
        cpfInput.addEventListener('input', function() {
            this.value = aplicarMascaraCPF(this.value);
        });
    }

    const telefoneInput = document.getElementById('telefone');
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function() {
            this.value = aplicarMascaraTelefone(this.value);
        });
    }
});
// ---> FIM FUNÇÃO PARA MÁSCARAS <---