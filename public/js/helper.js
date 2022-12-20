function renderPagination(links) {
    links.forEach(function (link) {
        $('#pagination').append(`
                    <li class="page-item ${link.active ? 'active' : ''} ${link.disabled ? 'disable' : ''}">
                        <a class="page-link" href="${link.url}">${link.label}</a>
                    </li>
                `);
    });
}
