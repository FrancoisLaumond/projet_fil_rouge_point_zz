document.addEventListener('DOMContentLoaded', function() {
    // Mise à jour du statut (Afficher/Masquer)
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
                console.log('Server response:', data); // Debugging
                if (data === 'success') {
                    this.setAttribute('data-status', newStatus);
                    this.innerHTML = newStatus === 'true' ? '📷' : '📵';
                } else {
                    console.error('Erreur lors de la mise à jour :', data);
                }
            })
            .catch(error => console.error('Fetch error:', error));
        });
    });

    // Suppression d'un article
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
                console.log('Server response:', data); // Debugging
                if (data === 'success') {
                    this.closest('tr').remove();
                } else {
                    console.error('Erreur lors de la suppression :', data);
                }
            })
            .catch(error => console.error('Fetch error:', error));
        });
    });

    // Modification d'un article
    document.querySelectorAll('.edit').forEach(function (element) {
        element.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const content = this.getAttribute('data-content');
            const author = this.getAttribute('data-author');
            const text = this.getAttribute('data-text');
            const category = this.getAttribute('data-category');
            const tags = this.getAttribute('data-tags');
            const status = this.getAttribute('data-status');

            // Remplir les champs du formulaire avec les données de l'article
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-content').value = content;
            document.getElementById('edit-author').value = author;
            document.getElementById('edit-text').value = text;
            document.getElementById('edit-category').value = category;
            document.getElementById('edit-tags').value = tags;
            document.getElementById('edit-status').value = status;

            // Afficher le pop-up
            document.getElementById('edit-popup').style.display = 'block';
        });
    });

    // Gestion de la fermeture du pop-up
    document.getElementById('edit-close').addEventListener('click', function () {
        document.getElementById('edit-popup').style.display = 'none';
    });

    // Soumission du formulaire de modification
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
            console.log('Server response:', data); // Debugging
            if (data === 'success') {
                location.reload();
            } else {
                console.error('Erreur lors de la mise à jour :', data);
            }
        })
        .catch(error => console.error('Fetch error:', error));
    });
});