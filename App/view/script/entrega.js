// entrega.js
$(document).ready(function() {
    console.log("Sistema de CEP iniciado");

    // Armazena os valores originais do endereço
    const enderecoOriginal = {
        logradouro: $('#logradouro').text().trim(),
        bairro: $('#bairro').text().trim(),
        cidade: $('#cidade').text().trim(),
        uf: $('#uf').text().trim(),
        cep: $('#cep').val().trim()
    };

    // Máscara do CEP
    $('#cep').mask('00000-000');

    // Função para atualizar campos
    const atualizarCampo = (id, valor) => {
        document.getElementById(id).textContent = valor || '';
        console.log(`Campo ${id} atualizado para:`, valor);
    };

    // Busca CEP
    $('#cep').on('blur', function() {
        const cep = $(this).val().replace(/\D/g, '');
        console.log("CEP para consulta:", cep);
        
        if (cep.length === 8) {
            console.log("Iniciando consulta ViaCEP...");
            
            $('#logradouro, #bairro, #cidade, #uf').html('<span class="text-muted">Carregando...</span>');

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => {
                    if (!response.ok) throw new Error("Erro na rede");
                    return response.json();
                })
                .then(data => {
                    console.log("Dados recebidos:", data);
                    
                    if (data.erro) {
                        throw new Error("CEP não encontrado");
                    }

                    // Atualiza campos
                    atualizarCampo('logradouro', data.logradouro);
                    atualizarCampo('bairro', data.bairro);
                    atualizarCampo('cidade', data.localidade);
                    atualizarCampo('uf', data.uf);
                    
                    $('#numero, #complemento').prop('disabled', false);
                })
                .catch(error => {
                    console.error("Erro:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: error.message,
                        confirmButtonColor: '#6f42c1'
                    });
                    
                    // Limpa campos em caso de erro
                    atualizarCampo('logradouro', '');
                    atualizarCampo('bairro', '');
                    atualizarCampo('cidade', '');
                    atualizarCampo('uf', '');
                });
        }
    });

    // Botão "Usar endereço original"
    $('#redefinir-endereco').on('click', function() {
        console.log("Restaurando endereço original");
        
        // Restaura valores originais
        atualizarCampo('logradouro', enderecoOriginal.logradouro);
        atualizarCampo('bairro', enderecoOriginal.bairro);
        atualizarCampo('cidade', enderecoOriginal.cidade);
        atualizarCampo('uf', enderecoOriginal.uf);
        $('#cep').val(enderecoOriginal.cep);
    });
});