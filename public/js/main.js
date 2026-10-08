document.addEventListener('DOMContentLoaded', () => {
    // Bootstrap client-side form validation
    document.querySelectorAll('.needs-validation, form[novalidate]').forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Password Exchange real-time confirmation matching
    const passwordForm = document.getElementById('passwordForm');
    if (passwordForm) {
        const newPassword = document.getElementById('newPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        
        const validatePasswords = () => {
            if (confirmPassword && newPassword) {
                if (confirmPassword.value && newPassword.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity('Passwords do not match');
                } else {
                    confirmPassword.setCustomValidity('');
                }
            }
        };

        if (newPassword && confirmPassword) {
            newPassword.addEventListener('input', validatePasswords);
            confirmPassword.addEventListener('input', validatePasswords);
        }
    }

    // Confirmation prompt before permanent deletion (Part 2 DELETE)
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', event => {
            const confirmed = window.confirm('Are you sure you want to permanently delete this student record? This action cannot be undone.');
            if (!confirmed) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    });
});

