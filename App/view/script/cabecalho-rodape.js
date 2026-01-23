// Função para abrir/fechar o menu lateral
const abrirMenu = document.getElementById('abrir-menu');
const fecharMenu = document.getElementById('fechar-menu');
const menuLateral = document.getElementById('menu-lateral');
const submenuLateral = document.getElementById('submenu-lateral');
const fecharSubmenu = document.getElementById('fechar-submenu');
const submenuConteudo = document.getElementById('submenu-conteudo');

abrirMenu.addEventListener('click', () => {
  menuLateral.classList.add('aberto');
});

fecharMenu.addEventListener('click', () => {
  menuLateral.classList.remove('aberto');
  submenuLateral.classList.remove('aberto'); // Fecha o submenu ao fechar o menu principal
  removerDestaqueCategoria(); // Remove o destaque da categoria
});

// Função para abrir o submenu lateral
const linksCategorias = document.querySelectorAll('.menu-lateral ul li a');

// Dados dos submenus
const submenus = {
  coloracoes: ['Colorações para cabelo', 'Tonalizantes', 'Oxidantes', 'Descolorantes', 'Colorações para sobrancelha', 'Retoques corretivos para raiz', 'Colorações temporárias', 'Acessórios', 'Reveladores'],
  maquiagem: ['Esponjas', 'Batom/Gloss', 'Máscara para cílios', 'Bases/Pancakes', 'Pós', 'Blush', 'Iluminadores', 'Corretivos', 'Bronzers/Contornos', 'Lápis para os olhos', 'Primers', 'Acessórios'],
  'maos-e-pes': ['Unhas Postiças', 'Lixas/Polidores', 'Acetonas/Removedores', 'Esmaltes', 'Decorações para unhas', 'Kit Manicure/Pedicure', 'Spray secante para unhas', 'Alongamento de unhas', 'Acessórios'],
  cabelos: ['Shampoos', 'Condicionadores', 'Cremes', 'Óleos', 'Máscaras capilares', 'Finalizadores', 'Gel/Pomada/Cera', 'Spray fixador', 'Kit de finalização'],
  higiene: ['Algodão', 'Sabonetes', 'Álcool em gel', 'Desodorantes', 'Lenço de papel', 'Escovas dentais', 'Hastes flexíveis', 'Hidratante corporal/Loção', 'Esponjas e buchas para banho'],
  skincare: ['Hidratantes', 'Bronzeadores', 'Esfoliantes', 'Protetor solar', 'Óleos', 'Máscaras', 'Tratamento facial', 'Repelentes', 'Talcos', 'Acessórios'],
  depilacao: ['Ceras', 'Ceras roll on', 'Cremes', 'Pré/Pós depilação', 'Papel para depilação', 'Folhas depilatórias prontas', 'Acessórios'],
  eletricos: ['Máquinas de acabamento', 'Máquinas de corte', 'Pranchas', 'Secadores', 'Modeladores', 'Difusores', 'Aparadores de pelos', 'Autoclaves/Estufas', 'Cabines de unhas'],
  acessorios: ['Maletas', 'Borrifadores/Pulverizadores', 'Navalhas/Navalhetes', 'Espelhos', 'Lenço descartável', 'Nécessaire', 'Aventais', 'Kit de viagem', 'Capas para corte'],
  homens: ['Shampoos', 'Condicionadores', 'Tonalizantes', 'Perfumes', 'Gel/Pomada/Cera', 'Cuidados para barba', 'Pincel para barba', 'Kit de tratamento capilar', 'Finalizadores']
};

linksCategorias.forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    const submenu = link.getAttribute('data-submenu');
    if (submenus[submenu]) {
      submenuConteudo.innerHTML = submenus[submenu].map(item => `<li><a href="${getCorrectPath()}subcategoria.php?subcategoria=${encodeURIComponent(item)}">${item}</a></li>`).join('');
      submenuLateral.classList.add('aberto');
      destacarCategoria(link); // Destaca a categoria selecionada
    }
  });
});

// Função para determinar o caminho correto dos links baseado na localização atual
function getCorrectPath() {
  const path = window.location.pathname;
  
  // Se estiver na página index (raiz)
  if (path.endsWith('index.php') || path.endsWith('/')) {
    return 'view/pages/';
  }
  
  // Se já estiver dentro de view/pages/
  if (path.includes('view/pages/')) {
    return '';
  }
  
  // Para outras situações (como categorias)
  return '../view/pages/';
}

fecharSubmenu.addEventListener('click', () => {
  submenuLateral.classList.remove('aberto');
  removerDestaqueCategoria(); // Remove o destaque da categoria
});

// Função para destacar a categoria selecionada
function destacarCategoria(link) {
  linksCategorias.forEach(link => link.classList.remove('ativa')); // Remove o destaque de todas as categorias
  link.classList.add('ativa'); // Adiciona o destaque à categoria selecionada
}

// Função para remover o destaque da categoria
function removerDestaqueCategoria() {
  linksCategorias.forEach(link => link.classList.remove('ativa')); // Remove o destaque de todas as categorias
}

document.addEventListener('DOMContentLoaded', function () {
  const categories = document.querySelectorAll('.category-item');

  categories.forEach(category => {
    category.addEventListener('click', function (e) {
      e.preventDefault();

      // Fecha outros submenus
      categories.forEach(other => {
        if (other !== this) other.classList.remove('active');
      });

      // Alterna o submenu atual
      this.classList.toggle('active');
    });
  });

  // Fecha submenus ao clicar fora
  document.addEventListener('click', function (e) {
    if (!e.target.closest('.category-item')) {
      categories.forEach(category => {
        category.classList.remove('active');
      });
    }
  });
});