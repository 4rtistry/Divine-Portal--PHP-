const rowsPerPage = 5;
    const table = document.getElementById('data-table').getElementsByTagName('tbody')[0];
    const rows = table.getElementsByTagName('tr');
    const pagination = document.getElementById('pagination');
    let currentPage = 1;

    function displayRows(page) {
        let start = (page - 1) * rowsPerPage;
        let end = start + rowsPerPage;

        // Hide all rows first
        for (let i = 0; i < rows.length; i++) {
            rows[i].style.display = 'none';
        }

        // Display the rows for the current page
        for (let i = start; i < end && i < rows.length; i++) {
            rows[i].style.display = '';
        }
    }

    function setupPagination() {
        let pageCount = Math.ceil(rows.length / rowsPerPage);
        pagination.innerHTML = '';

        for (let i = 1; i <= pageCount; i++) {
            let pageLink = document.createElement('a');
            pageLink.innerHTML = i;
            pageLink.href = '#';
            pageLink.addEventListener('click', function(event) {
                event.preventDefault();
                currentPage = i;
                displayRows(currentPage);
                updatePagination();
            });
            pagination.appendChild(pageLink);
        }
    }

    function updatePagination() {
        let links = pagination.getElementsByTagName('a');
        for (let i = 0; i < links.length; i++) {
            if (i + 1 === currentPage) {
                links[i].style.fontWeight = 'bold';
            } else {
                links[i].style.fontWeight = 'normal';
            }
        }
    }

    // Initialize
    displayRows(currentPage);
    setupPagination();
    updatePagination();