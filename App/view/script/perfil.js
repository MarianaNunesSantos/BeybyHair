// Função global para confirmação de exclusão
function confirmarExclusao(idUsuario) {
    if(idUsuario === 0) {
        alert('Erro: ID do usuário não encontrado!');
        return;
    }
    
    if(confirm('Tem certeza que deseja excluir sua conta permanentemente?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '../../controller/processaUsuario.php';
        
        const opField = document.createElement('input');
        opField.type = 'hidden';
        opField.name = 'op';
        opField.value = 'Excluir';
        
        const idField = document.createElement('input');
        idField.type = 'hidden';
        idField.name = 'idUsuario';
        idField.value = idUsuario;
        
        form.appendChild(opField);
        form.appendChild(idField);
        document.body.appendChild(form);
        form.submit();
    }
}

// Função para limpar campos do endereço
function limparCamposEndereco() {
    $('#logradouro, #bairro, #cidade, #uf').text('');
    $('#enderecoCompleto').val('');
}

// Quando o DOM estiver pronto
$(document).ready(function() {
    // Verifica se os plugins necessários estão carregados
    if(typeof $.fn.mask !== 'function') {
        console.error('jQuery Mask plugin não carregado!');
        return;
    }

    // Aplica máscara aos campos de CEP
    $('.cep-input').mask('00000-000');

    // Busca endereço via API ViaCEP
    $('#cep').on('blur', function() {
        const cep = $(this).val().replace(/\D/g, '');
        
        if (cep.length === 8) {
            $('#logradouro, #bairro, #cidade, #uf').text('Buscando...');
            
            $.getJSON(`https://viacep.com.br/ws/${cep}/json/`)
                .done(function(data) {
                    if (!data.erro) {
                        // Atualiza os campos
                        $('#logradouro').text(data.logradouro || '');
                        $('#bairro').text(data.bairro || '');
                        $('#cidade').text(data.localidade || '');
                        $('#uf').text(data.uf || '');
                        
                        // Monta o endereço completo
                        $('#enderecoCompleto').val(
                            `${data.logradouro || ''}, ${data.bairro || ''}, ${data.localidade || ''}-${data.uf || ''}`
                        );
                    } else {
                        throw new Error('CEP não encontrado');
                    }
                })
                .fail(function(error) {
                    alert(error.responseJSON?.message || 'Erro ao buscar CEP');
                    limparCamposEndereco();
                });
        }
    });

    // Adicionar novo endereço
    $('#btnNovoEndereco').click(function(e) {
        e.preventDefault();
        const totalEnderecos = $('table tbody tr').length;
        
        if (totalEnderecos >= 3) {
            alert('Limite máximo de 3 endereços atingido.');
            return;
        }
        
        const novoNumero = totalEnderecos + 1;
        const novoEndereco = `
            <tr>
                <td>
                    <select name="tipoEndereco${novoNumero}" class="form-control">
                        <option value="Casa">Casa</option>
                        <option value="Trabalho">Trabalho</option>
                        <option value="Outro">Outro</option>
                    </select>
                </td>
                <td><input type="text" name="cep${novoNumero}" class="form-control cep-input"></td>
                <td><input type="text" name="logradouro${novoNumero}" class="form-control"></td>
                <td><input type="text" name="numero${novoNumero}" class="form-control"></td>
                <td><input type="text" name="bairro${novoNumero}" class="form-control"></td>
                <td><input type="text" name="cidade${novoNumero}" class="form-control"></td>
                <td><input type="text" name="uf${novoNumero}" class="form-control" maxlength="2"></td>
                <td>
                    <button type="button" class="btn btn-link btn-remover-endereco" data-endereco="${novoNumero}">
                        <i class="bi bi-trash"></i>
                    </button>
                    <input type="checkbox" name="principal${novoNumero}">
                </td>
            </tr>
        `;
        
        $('table tbody').append(novoEndereco);
        $('.cep-input').mask('00000-000');
    });
    
    // Remover endereço
    $(document).on('click', '.btn-remover-endereco', function() {
        const enderecoNum = $(this).data('endereco');
        $(this).closest('tr').remove();
    });
    
    // Marcar endereço como principal
    $(document).on('change', 'input[name^="principal"]', function() {
        $('input[name^="principal"]').not(this).prop('checked', false);
    });
});