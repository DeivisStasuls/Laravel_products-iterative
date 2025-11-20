document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const autocompleteInput = document.getElementById('autocomplete-tag');
    const tagList = document.getElementById('tag-list');
    const productId = document.getElementById('tags-form').dataset.productId;

    /**
     * Pievieno tagu sarakstam kā badge
     */
    function addTag(tagIdOrName, tagName) {
        // Neļauj pievienot divreiz
        if ([...tagList.children].some(el => el.dataset.tagId == tagIdOrName)) return;

        const span = document.createElement('span');
        span.classList.add('badge', 'badge-primary', 'mr-1');
        span.dataset.tagId = tagIdOrName;
        span.innerHTML = `${tagName} <button type="button" class="remove-tag-btn text-white">X</button>`;
        tagList.appendChild(span);

        // Pievieno click listener X pogai
        span.querySelector('.remove-tag-btn').addEventListener('click', () => removeTag(tagIdOrName, span));
    }

    /**
     * Nosūta pievienoto tagu uz serveri
     */
    function sendTagToServer(tagNameOrId) {
        fetch(`/products/${productId}/add-tags`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ tags: [tagNameOrId] })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) alert(data.error || 'Error adding tag');
        })
        .catch(err => console.error(err));
    }

    /**
     * Noņem tagu gan vizuāli, gan serverī
     */
    function removeTag(tagId, element) {
        fetch(`/products/${productId}/remove-tag/${tagId}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrfToken }
        })
        .then(res => res.json())
        .then(() => element.remove())
        .catch(err => console.error(err));
    }

    /**
     * Pievieno click listener visiem sākotnējiem tagiem
     */
    document.querySelectorAll('#tag-list .remove-tag-btn').forEach(btn => {
        const span = btn.closest('span[data-tag-id]');
        const tagId = span.dataset.tagId;
        btn.addEventListener('click', () => removeTag(tagId, span));
    });

    /**
     * Autocomplete funkcionalitāte
     */
    autocompleteInput.addEventListener('input', function () {
        const query = this.value;
        if (query.length < 2) return;

        fetch(`/tags/search?query=${query}`)
            .then(res => res.json())
            .then(data => {
                let suggestionBox = document.getElementById('suggestion-box');
                if (!suggestionBox) {
                    suggestionBox = document.createElement('div');
                    suggestionBox.id = 'suggestion-box';
                    suggestionBox.classList.add('autocomplete-suggestions');
                    autocompleteInput.parentNode.appendChild(suggestionBox);
                }
                suggestionBox.innerHTML = '';
                data.suggestions.forEach(tag => {
                    const div = document.createElement('div');
                    div.classList.add('suggestion');
                    div.dataset.tagId = tag.id;
                    div.textContent = tag.name;
                    suggestionBox.appendChild(div);
                });
            });
    });

    /**
     * Klikšķi uz ieteikumiem autocomplete
     */
    document.addEventListener('click', function (e) {
        const suggestionBox = document.getElementById('suggestion-box');
        if (e.target.classList.contains('suggestion')) {
            const tagId = e.target.dataset.tagId;
            const tagName = e.target.textContent;
            addTag(tagId, tagName);
            sendTagToServer(tagId);
            suggestionBox?.remove();
            autocompleteInput.value = '';
        } else {
            suggestionBox?.remove();
        }
    });

    /**
     * Jauni tagi ar Enter
     */
    autocompleteInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && this.value.trim() !== '') {
            e.preventDefault();
            const newTagName = this.value.trim();
            addTag(newTagName, newTagName);
            sendTagToServer(newTagName);
            this.value = '';
        }
    });
});
