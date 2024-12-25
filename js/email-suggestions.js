document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.querySelector('input[type="email"]');
    if (!emailInput) return;

    const suggestionsList = document.createElement('ul');
    suggestionsList.id = 'email-suggestions';
    suggestionsList.classList.add('email-suggestions'); // Add class
    document.body.appendChild(suggestionsList);

    emailInput.addEventListener('input', function () {
        const value = emailInput.value;
        const atIndex = value.indexOf('@');
        if (atIndex === -1) {
            suggestionsList.style.display = 'none';
            return;
        }

        const domainPart = value.slice(atIndex + 1);
        const localPart = value.slice(0, atIndex);
        const domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];

        const filteredDomains = domains.filter(domain => domain.startsWith(domainPart));
        suggestionsList.innerHTML = '';

        filteredDomains.forEach(domain => {
            const suggestionItem = document.createElement('li');
            suggestionItem.textContent = `${localPart}@${domain}`;
            suggestionItem.classList.add('email-suggestion-item'); // Add class
            suggestionItem.addEventListener('click', function () {
                emailInput.value = suggestionItem.textContent;
                suggestionsList.style.display = 'none';
            });
            suggestionsList.appendChild(suggestionItem);
        });

        if (filteredDomains.length > 0) {
            const rect = emailInput.getBoundingClientRect();
            suggestionsList.style.display = 'block';
            suggestionsList.style.top = `${rect.bottom + window.scrollY}px`;
            suggestionsList.style.left = `${rect.left + window.scrollX}px`;
            suggestionsList.style.width = `${rect.width}px`;
        } else {
            suggestionsList.style.display = 'none';
        }
    });

    document.addEventListener('click', function (e) {
        if (!emailInput.contains(e.target) && !suggestionsList.contains(e.target)) {
            suggestionsList.style.display = 'none';
        }
    });
});
