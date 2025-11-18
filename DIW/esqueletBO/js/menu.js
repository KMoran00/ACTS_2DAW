document.addEventListener('DOMContentLoaded', function() {
    const iconoMenu = document.querySelector('.iconoMenu');
    const menuLateral = document.querySelector('.menuLateral');
    const formulari = document.querySelector('.formulari');

    //Clickar al menú hamburguesa
    iconoMenu.addEventListener('click', function() {
        if (menuLateral.style.display === 'none' || menuLateral.style.display === '') {
            menuLateral.style.display = 'block';
            formulari.style.display = 'none';
        } else {
            menuLateral.style.display = 'none';
            formulari.style.display = 'block';
        }
    });
});
