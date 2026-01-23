document.addEventListener('DOMContentLoaded', function() {
    // Aumentar quantidade
    document.querySelectorAll('.aumentar').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantidade');
            input.value = parseInt(input.value) + 1;
            atualizarItem(input);
        });
    });
    
    // Diminuir quantidade
    document.querySelectorAll('.diminuir').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantidade');
            if(parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                atualizarItem(input);
            }
        });
    });
    
    // Alteração manual da quantidade
    document.querySelectorAll('.quantidade').forEach(input => {
        input.addEventListener('change', function() {
            if(this.value < 1) this.value = 1;
            atualizarItem(this);
        });
    });
    
    // Remover item
    document.querySelectorAll('.remover-item').forEach(btn => {
        btn.addEventListener('click', function() {
            if(confirm('Deseja realmente remover este item do carrinho?')) {
                const id = this.getAttribute('data-id');
                removerItem(id, this.closest('tr'));
            }
        });
    });
    
    // Aplicar cupom
    const aplicarCupomBtn = document.getElementById('aplicar-cupom');
    if(aplicarCupomBtn) {
        aplicarCupomBtn.addEventListener('click', aplicarCupom);
    }
});

function atualizarItem(input) {
    const id = input.getAttribute('data-id');
    const quantidade = input.value;
    
    fetch('atualizar_carrinho.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}&quantidade=${quantidade}`
    })
    .then(response => {
        if(!response.ok) {
            throw new Error('Erro na rede');
        }
        return response.json();
    })
    .then(data => {
        if(data.success) {
            // Atualiza o preço do item
            const tr = input.closest('tr');
            tr.querySelector('.preco-item').textContent = 'R$ ' + data.precoItem.toFixed(2).replace('.', ',');
            
            // Atualiza o resumo
            atualizarResumo(data.total);
        } else {
            alert('Erro ao atualizar item: ' + (data.message || 'Erro desconhecido'));
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao atualizar quantidade. Por favor, tente novamente.');
    });
}

function removerItem(id, linha) {
    fetch('remover_carrinho.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            linha.remove();
            atualizarResumo(data.total);
            
            // Atualiza o contador do carrinho no cabeçalho
            const sacolaBtn = document.querySelector('.nav-icons a[href="#"]:last-child');
            if(sacolaBtn) {
                sacolaBtn.innerHTML = 
                    `<img src="../img/icon-carrinho-fundo-branco.png" alt="Ícone de carrinho de compras">Sacola (${data.totalItens || 0})`;
            }
        } else {
            alert(data.message || 'Erro ao remover item');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao remover item. Por favor, tente novamente.');
    });
}

function aplicarCupom() {
    const codigo = document.getElementById('cupom').value;
    
    if(!codigo) {
        alert('Por favor, digite um código de cupom');
        return;
    }
    
    fetch('aplicar_cupom.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `cupom=${codigo}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            atualizarResumo(data.total, data.desconto);
            alert('Cupom aplicado com sucesso!');
        } else {
            alert(data.message || 'Erro ao aplicar cupom');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao aplicar cupom. Por favor, tente novamente.');
    });
}

function atualizarResumo(total, desconto = 0) {
    const subtotalElement = document.getElementById('subtotal');
    const descontosElement = document.getElementById('descontos');
    const cupomDescontoElement = document.getElementById('cupom-desconto');
    const totalPedidoElement = document.getElementById('total-pedido');
    
    if(subtotalElement) subtotalElement.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
    
    if(desconto > 0) {
        if(descontosElement) descontosElement.textContent = '- R$ ' + desconto.toFixed(2).replace('.', ',');
        if(cupomDescontoElement) cupomDescontoElement.textContent = '- R$ ' + desconto.toFixed(2).replace('.', ',');
        total -= desconto;
    }
    
    if(totalPedidoElement) totalPedidoElement.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
}