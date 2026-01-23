function adicionarAoCarrinho(idProduto) {
    fetch('adicionar_carrinho.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${idProduto}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Produto adicionado!',
                text: 'O produto foi adicionado ao seu carrinho',
                showConfirmButton: false,
                timer: 1500
            });
            // Atualiza o contador do carrinho
            document.querySelector('.nav-icons a[href="#"]:last-child').innerHTML = 
                `<img src="../img/icon-carrinho-fundo-branco.png" alt="Ícone de carrinho de compras">Sacola (${data.totalItens})`;
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: data.message
            });
        }
    });
}

//Estilo para o alerta
fetch('adicionar_carrinho.php', {
    method: 'POST',
    body: formData
})
.then(response => response.json())
.then(data => {
    if(data.success) {
        Swal.fire({
            title: 'Produto adicionado!',
            text: 'O produto foi adicionado ao seu carrinho.',
            icon: 'success',
            background: '#ffeff1',
            color: '#551c1c',
            confirmButtonColor: '#551c1c'
        });
        // Atualiza o contador do carrinho
        document.querySelector('.carrinho-count').textContent = data.totalItens;
    } else {
        Swal.fire({
            title: 'Erro!',
            text: data.message,
            icon: 'error',
            background: '#ffeff1',
            color: '#551c1c',
            confirmButtonColor: '#551c1c'
        });
    }
});