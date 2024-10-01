function InputListeDeroulante(container, options) {
    // Create the HTML structure
    const inputContainer = document.createElement('div');
    inputContainer.classList.add('InputListeDeroulante-container');
    if (options.customClass) {
        inputContainer.classList.add(options.customClass);
    }

    const input = document.createElement('input');
    input.type = 'text';
    input.classList.add('input-text');
    input.readOnly = true;
    input.id = options.id || 'element-input';
    input.name = options.name || '';
    input.placeholder = options.placeholder || '';
    if (options.disabled) {
        input.disabled = true;
    }

    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = options.name || '';
    if (options.required || options.requiredMax || options.requiredMin) {
        hiddenInput.required = true;
    }

    const button = document.createElement('button');
    button.classList.add('dropdown-button');
    button.type = 'button';
    button.textContent = options.customButtonLabel || '▼';

    const elementList = document.createElement('ul');
    elementList.classList.add('element-list');
    if (options.maxHeight) {
        elementList.style.maxHeight = options.maxHeight + 'px';
        elementList.style.overflowY = 'auto';
    }

    const elementList2Wrapper = document.createElement('div');
    elementList2Wrapper.classList.add('element-list2-wrapper');

    const elementList2 = document.createElement('div');
    elementList2.classList.add('element-list2');

    // Search bar inside the dropdown
    let searchInput, clearButton;
    if (options.searchable) {
        const searchContainer = document.createElement('div');
        searchContainer.classList.add('search-container');

        searchInput = document.createElement('input');
        searchInput.type = 'search';
        searchInput.classList.add('input-search');
        searchInput.placeholder = 'Rechercher...';
        searchContainer.appendChild(searchInput);

        // Clear button
        clearButton = document.createElement('button');
        clearButton.type = 'button';
        clearButton.textContent = 'Clear';
        clearButton.classList.add('clear-button');
        searchContainer.appendChild(clearButton);

        elementList.appendChild(searchContainer);

        searchInput.addEventListener('input', function() {
            const searchValue = searchInput.value.toLowerCase();
            let hasResults = false;
            elementItems.forEach(item => {
                if (item.textContent.toLowerCase().includes(searchValue)) {
                    item.style.display = '';
                    hasResults = true;
                } else {
                    item.style.display = 'none';
                }
            });
            noResults.style.display = hasResults ? 'none' : 'block';
        });

        clearButton.addEventListener('click', function() {
            searchInput.value = '';
            elementItems.forEach(item => {
                item.style.display = '';
            });
            noResults.style.display = 'none';
            selectedElements = [];
            elementItems.forEach(item => item.classList.remove('selected'));
            updateSelectedElementsInput();
        });
    }

    // No results message
    const noResults = document.createElement('div');
    noResults.classList.add('no-results');
    noResults.textContent = options.noResultsText || 'Aucun résultat trouvé';
    noResults.style.display = 'none';

    // Populate the element list with options
    options.liste.forEach(option => {
        const listItem = document.createElement('li');
        listItem.classList.add('element-item');
        listItem.dataset.value = option.toLowerCase();
        listItem.textContent = option;
        elementList2.appendChild(listItem);
    });

    elementList2Wrapper.appendChild(elementList2);
    elementList.appendChild(noResults);
    elementList.appendChild(elementList2Wrapper);
    inputContainer.appendChild(input);
    inputContainer.appendChild(hiddenInput);
    inputContainer.appendChild(button);
    inputContainer.appendChild(elementList);
    container.appendChild(inputContainer);

    // Add event listeners
    const elementItems = elementList.querySelectorAll('.element-item');
    let selectedElements = options.defaultValues || [];

    // Pre-select default values
    if (options.defaultValues) {
        options.defaultValues.forEach(value => {
            const item = Array.from(elementItems).find(el => el.dataset.value === value.toLowerCase());
            if (item) {
                item.classList.add('selected');
                selectedElements.push(value.toLowerCase());
            }
        });
        updateSelectedElementsInput();
    }

    // Pre-select elements from the preselect option
    if (options.preselect) {
        options.preselect.forEach(value => {
            const item = Array.from(elementItems).find(el => el.dataset.value === value.toLowerCase());
            if (item && !selectedElements.includes(value.toLowerCase())) {
                item.classList.add('selected');
                selectedElements.push(value.toLowerCase());
            }
        });
        updateSelectedElementsInput();
    }

    button.addEventListener('click', function() {
        if (elementList.style.maxHeight && elementList.style.maxHeight !== '0px') {
            elementList.style.maxHeight = null;
        } else {
            elementList.style.maxHeight = elementList.scrollHeight + "px";
        }
    });

    elementItems.forEach(item => {
        item.addEventListener('click', function() {
            const value = item.getAttribute('data-value');
            if (item.classList.contains('selected')) {
                item.classList.remove('selected');
                selectedElements = selectedElements.filter(element => element !== value);
            } else {
                item.classList.add('selected');
                selectedElements.push(value);
            }
            updateSelectedElementsInput();
        });
    });

    function updateSelectedElementsInput() {
        input.value = selectedElements.join(', ');
        hiddenInput.value = selectedElements.join(', ');
    }

    document.addEventListener('click', function(event) {
        if (!button.contains(event.target) && !elementList.contains(event.target) && !input.contains(event.target)) {
            elementList.style.maxHeight = null;
        }
    });

    // Add form submit event listener
    const form = container.closest('form');
    if (form) {
        form.addEventListener('submit', function(event) {
            const selectedCount = selectedElements.length;
            if ((options.required || options.requiredMax || options.requiredMin) && hiddenInput.value === '') {
                event.preventDefault();
                alert('Veuillez sélectionner au moins un élément.');
                return;
            }
            if (options.requiredMin && selectedCount < options.requiredMin) {
                event.preventDefault();
                alert(`Veuillez sélectionner au moins ${options.requiredMin} élément(s).`);
                return;
            }
            if (options.requiredMax && selectedCount > options.requiredMax) {
                event.preventDefault();
                alert(`Veuillez sélectionner au maximum ${options.requiredMax} élément(s).`);
                return;
            }
        });
    }

    // Add scroll event listeners for gradients
    elementList2.addEventListener('scroll', updateGradientVisibility);

    function updateGradientVisibility() {
        const scrollLeft = elementList2.scrollLeft;
        const maxScrollLeft = elementList2.scrollWidth - elementList2.clientWidth;

        if (scrollLeft === 0) {
            elementList2.classList.add('hide-before');
        } else {
            elementList2.classList.remove('hide-before');
        }

        if (scrollLeft >= maxScrollLeft - 1) {
            elementList2.classList.add('hide-after');
        } else {
            elementList2.classList.remove('hide-after');
        }
    }

    // Initial check for gradient visibility
    if (elementList2.scrollLeft === 0) {
        elementList2.classList.add('hide-before');
    } else {
        elementList2.classList.remove('hide-before');
    }

    elementList2.classList.remove('hide-after');
}
