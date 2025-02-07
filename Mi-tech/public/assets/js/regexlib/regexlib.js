function regexlib(input) {
    let isValid = true;
    let validation;
    let divMessageReturn = input.nextElementSibling;

    const errorMessages = {
        name: "Le nom doit commencer par une lettre majuscule et ne contenir que des caractères alphabétiques.",
        lastname: "Le nom de famille doit commencer par une lettre majuscule et ne contenir que des caractères alphabétiques.",
        firstname: "Le prénom doit commencer par une lettre majuscule et ne contenir que des caractères alphabétiques.",
        tutor: "Le nom du tuteur doit être au format valide.",
        age: "L'âge doit être compris entre 1 et 120.",
        major: "Vous devez avoir au moins 18 ans.",
        email: "L'adresse email doit être au format valide (ex : exemple@domaine.com).",
        password: "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.",
        phoneNumber: "Le numéro de téléphone doit être au format valide.",
        moreInfo: "Utilisez uniquement des caractères alphabétiques, des espaces et des tirets.",
        comments: "Les commentaires ne doivent contenir que du texte alphabétique.",
    };

    const regexPatterns = {
        name: /^[A-ZÀ-ÖØ-Ý][a-zà-öø-ÿ]+(?:[-\s][A-ZÀ-ÖØ-Ý][a-zà-öø-ÿ]+)*$/,
        lastname: /^[A-ZÀ-ÖØ-Ý][a-zà-öø-ÿ]+(?:[-\s][A-ZÀ-ÖØ-Ý][a-zà-öø-ÿ]+)*$/,
        firstname: /^[A-ZÀ-ÖØ-Ý][a-zà-öø-ÿ]+(?:[-\s][A-ZÀ-ÖØ-Ý][a-zà-öø-ÿ]+)*$/,
        tutor: /^[A-ZÀ-ÖØ-Ý][a-zà-öø-ÿ]+(?:[-\s][A-ZÀ-ÖØ-Ý][a-zà-öø-ÿ]+)*$/,
        age: /^(?:[1-9][0-9]?|1[01][0-9]|120)$/,
        major: /^(?:1[89]|[2-9][0-9]|1[01][0-9]|120)$/,
        email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
        phoneNumber: /^(?:\+?(\d{1,3})[-.\s]?)?((\d{2}|\d{3}))?[-.\s]?\d{2}[-.\s]?\d{2}[-.\s]?\d{2}[-.\s]?\d{2}$/,
        moreInfo: /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/,
        comments: /^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s.,!?;:'"()\-]+$/,
    };

    validation = regexPatterns[input.name];
    const errorMessage = errorMessages[input.name];

    if (validation) {
        if (!validation.test(input.value)) {
            input.classList.add("is-invalid");
            divMessageReturn.textContent = errorMessage;
            divMessageReturn.style.color = "red";
            divMessageReturn.style.fontSize = "12px";
            isValid = false;
        } else {
            input.classList.remove("is-invalid");
            divMessageReturn.textContent = "";
            
        }
    }

    return isValid;
}

document.querySelectorAll('.form-with-regexlib').forEach(form => {
    form.addEventListener('submit', (e) => {
        const inputs = form.querySelectorAll('input[name], textarea[name]');
        let allValid = true;

        // Vérification dynamique du mot de passe et de la confirmation
        const password = form.querySelector('#password');
        const confirmPassword = form.querySelector('#confirm');

        if (password && confirmPassword) { // Effectuer la validation uniquement si les champs existent
            if (password.value.trim() !== "" && confirmPassword.value.trim() !== "") {
                const confirmDivMessageReturn = confirmPassword.nextElementSibling;

                if (password.value !== confirmPassword.value) {
                    confirmPassword.classList.add("is-invalid");
                    confirmDivMessageReturn.textContent = "Les mots de passe ne correspondent pas.";
                    confirmDivMessageReturn.style.color = "red";
                    confirmDivMessageReturn.style.fontSize = "12px";
                    allValid = false;
                } else {
                    confirmPassword.classList.remove("is-invalid");
                    confirmDivMessageReturn.textContent = "";
                }
            }
        }

        // Vérification des autres champs avec regexlib
        inputs.forEach(input => {
            const isFieldValid = regexlib(input);
            if (!isFieldValid) {
                allValid = false;
            }
        });

        if (!allValid) {
            e.preventDefault(); // Empêche la soumission si le formulaire est invalide
        } else {
            console.log("Formulaire valide, prêt à être soumis !");
        }
    });
});

