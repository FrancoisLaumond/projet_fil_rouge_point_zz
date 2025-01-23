document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.camera').forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const currentStatus = this.getAttribute('data-status');
            const newStatus = currentStatus === 'true' ? 'false' : 'true';
            fetch(`update_article.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}&status=${newStatus}`
            })
            .then(response => response.text())
            .then(data => {
                location.reload();
            });
        });
    });

    document.querySelectorAll('.delete').forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            fetch(`delete_article.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}`
            })
            .then(response => response.text())
            .then(data => {
                location.reload();
            });
        });
    });

    document.querySelectorAll('.edit').forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const content = this.getAttribute('data-content');
            const author = this.getAttribute('data-author');
            const text = this.getAttribute('data-text');
            const category = this.getAttribute('data-category');
            const tags = this.getAttribute('data-tags');
            const status = this.getAttribute('data-status');

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-content').value = content;
            document.getElementById('edit-author').value = author;
            document.getElementById('edit-text').value = text;
            document.getElementById('edit-category').value = category;
            document.getElementById('edit-tags').value = tags;
            document.getElementById('edit-status').value = status;

            document.getElementById('edit-popup').style.display = 'block';
        });
    });

    document.getElementById('edit-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const id = document.getElementById('edit-id').value;
        const title = document.getElementById('edit-title').value;
        const content = document.getElementById('edit-content').value;
        const author = document.getElementById('edit-author').value;
        const text = document.getElementById('edit-text').value;
        const category = document.getElementById('edit-category').value;
        const tags = document.getElementById('edit-tags').value;
        const status = document.getElementById('edit-status').value;

        fetch(`edit_article.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}&title=${title}&content=${content}&author=${author}&text=${text}&category=${category}&tags=${tags}&status=${status}`
        })
        .then(response => response.text())
        .then(data => {
            location.reload();
        });
    });

    document.getElementById('edit-close').addEventListener('click', function() {
        document.getElementById('edit-popup').style.display = 'none';
    });
});