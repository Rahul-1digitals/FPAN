(function () {
    'use strict';

    var input        = document.getElementById('home-provider-search');
    var form         = document.getElementById('home-provider-search-form');
    var suggestionsEl = document.getElementById('home-provider-suggestions');

    if (!input || !form || !suggestionsEl) return;

    var restUrl      = (typeof fpanHomeSearch !== 'undefined' && fpanHomeSearch.restUrl)      ? fpanHomeSearch.restUrl      : '/wp-json/wp/v2/providers';
    var directoryUrl = (typeof fpanHomeSearch !== 'undefined' && fpanHomeSearch.directoryUrl) ? fpanHomeSearch.directoryUrl : '/provider-directory/';

    var debounceTimer;
    var activeIndex = -1;

    function escapeHtml(str) {
        return String(str)
            .replace(/&/g,  '&amp;')
            .replace(/</g,  '&lt;')
            .replace(/>/g,  '&gt;')
            .replace(/"/g,  '&quot;');
    }

    function hideSuggestions() {
        suggestionsEl.setAttribute('hidden', '');
        suggestionsEl.innerHTML = '';
        activeIndex = -1;
    }

    function renderSuggestions(items) {
        suggestionsEl.innerHTML = items.map(function (item) {
            var name = item.title ? item.title.rendered : '';
            var meta = item.fpan_autocomplete || {};
            var sub  = [meta.specialty, meta.location].filter(Boolean).join(' · ');
            return '<div class="provider-suggestion" role="option" tabindex="-1" data-href="' + escapeHtml(item.link) + '">'
                + '<span class="provider-suggestion__name">' + escapeHtml(name) + '</span>'
                + (sub ? '<span class="provider-suggestion__meta">' + escapeHtml(sub) + '</span>' : '')
                + '</div>';
        }).join('');
        suggestionsEl.removeAttribute('hidden');
        activeIndex = -1;

        suggestionsEl.querySelectorAll('.provider-suggestion').forEach(function (el) {
            el.addEventListener('mousedown', function (e) {
                e.preventDefault();
                var href = el.getAttribute('data-href');
                if (href) window.location.href = href;
            });
            el.addEventListener('keydown', function (e) {
                var all = suggestionsEl.querySelectorAll('.provider-suggestion');
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    activeIndex = Math.min(activeIndex + 1, all.length - 1);
                    all[activeIndex].focus();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    activeIndex = Math.max(activeIndex - 1, 0);
                    all[activeIndex].focus();
                } else if (e.key === 'Escape') {
                    hideSuggestions();
                    input.focus();
                } else if (e.key === 'Enter') {
                    e.preventDefault();
                    var href = el.getAttribute('data-href');
                    if (href) window.location.href = href;
                }
            });
        });
    }

    function fetchSuggestions(query) {
        var url = restUrl + '?search=' + encodeURIComponent(query) + '&per_page=6&_fields=id,title,link,fpan_autocomplete';
        fetch(url)
            .then(function (res) { return res.json(); })
            .then(function (items) {
                if (input.value.trim().length < 2) { hideSuggestions(); return; }
                if (!items || !items.length)        { hideSuggestions(); return; }
                renderSuggestions(items);
            })
            .catch(function () { hideSuggestions(); });
    }

    input.addEventListener('input', function () {
        var query = input.value.trim();
        clearTimeout(debounceTimer);
        if (query.length < 2) { hideSuggestions(); return; }
        debounceTimer = setTimeout(function () { fetchSuggestions(query); }, 280);
    });

    input.addEventListener('keydown', function (e) {
        var items = suggestionsEl.querySelectorAll('.provider-suggestion');
        if (!items.length) return;
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            activeIndex = Math.min(activeIndex + 1, items.length - 1);
            items[activeIndex].focus();
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            if (activeIndex > 0) { activeIndex--; items[activeIndex].focus(); }
        } else if (e.key === 'Escape') {
            hideSuggestions();
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var query = input.value.trim();
        if (query) {
            window.location.href = directoryUrl + '?pd_search=' + encodeURIComponent(query);
        }
    });

    document.addEventListener('click', function (e) {
        if (!form.contains(e.target)) hideSuggestions();
    });
}());
