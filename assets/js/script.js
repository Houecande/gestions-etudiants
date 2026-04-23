document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        form.addEventListener('submit', (event) => {
            const nom = form.querySelector('#nom');
            const prenom = form.querySelector('#prenom');
            const filiere = form.querySelector('#filiere');
            
            let errorMessage = "";

            if (!nom.value.trim()) {
                errorMessage += "Le nom est obligatoire.\n";
            }

            if (!prenom.value.trim()) {
                errorMessage += "Le prénom est obligatoire.\n";
            }

            if (filiere && !filiere.value) {
                errorMessage += "Veuillez choisir une filière.\n";
            }

            if (errorMessage) {
                event.preventDefault();
                alert(errorMessage);
            }
        });
    });
});
