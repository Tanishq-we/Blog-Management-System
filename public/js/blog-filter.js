/* =============================================
   BlogHub - AJAX Blog Filter (blog-filter.js)
   ============================================= */

const BlogFilter = (function ($) {

    // Current filter state
    let state = {
        search: '',
        category: 'all',
        date_from: '',
        date_to: '',
        sort: 'latest',
        page: 1,
    };

    let searchTimer = null;
    let liveSearchTimer = null;
    let isLoading = false;

    // ==========================================
    // CORE: Fetch blogs via AJAX
    // ==========================================
    function fetch(resetPage) {
        if (resetPage) state.page = 1;
        if (isLoading) return;

        isLoading = true;
        showSpinner(true);

        $.ajax({
            url: '/ajax/blogs',
            method: 'GET',
            data: state,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (res) {
                if (res.success) {
                    updateGrid(res.html, res.total);
                    updatePagination(res.pagination);
                    scrollToBlogs();
                }
            },
            error: function (xhr) {
                showError('Failed to load blogs. Please try again.');
                console.error('AJAX Error:', xhr);
            },
            complete: function () {
                isLoading = false;
                showSpinner(false);
            }
        });
    }

    // ==========================================
    // LIVE SEARCH DROPDOWN
    // ==========================================
    function liveSearch(query) {
        clearTimeout(liveSearchTimer);

        if (query.length < 2) {
            $('#searchDropdown').hide().empty();
            return;
        }

        liveSearchTimer = setTimeout(function () {
            $.ajax({
                url: '/ajax/search',
                method: 'GET',
                data: { q: query },
                success: function (res) {
                    renderSearchDropdown(res.results);
                }
            });
        }, 300);
    }

    function renderSearchDropdown(results) {
        const $dropdown = $('#searchDropdown');
        $dropdown.empty();

        if (results.length === 0) {
            $dropdown.html('<div class="search-no-results"><i class="bi bi-search me-2"></i>No results found</div>');
        } else {
            results.forEach(function (blog) {
                const imgHtml = blog.image_url
                    ? `<img src="${blog.image_url}" class="search-drop-img" style="width:44px;height:44px;object-fit:cover;border-radius:8px;" alt="">`
                    : `<div class="search-drop-img" style="width:44px;height:44px;background:#e8f0fe;border-radius:8px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-journal-richtext" style="color:#2d5499;"></i></div>`;

                const item = `
                    <a href="${blog.url}" class="search-dropdown-item">
                        ${imgHtml}
                        <div class="search-drop-info">
                            <h6>${escapeHtml(blog.title)}</h6>
                            <small><span class="badge bg-primary bg-opacity-10 text-primary me-1">${escapeHtml(blog.category)}</span>${escapeHtml(blog.publish_date)}</small>
                        </div>
                    </a>`;
                $dropdown.append(item);
            });
        }

        $dropdown.slideDown(150);
    }

    // ==========================================
    // UI HELPERS
    // ==========================================
    function showSpinner(show) {
        if (show) {
            $('#loadingSpinner').fadeIn(200);
            $('#blogGrid').css('opacity', '0.4');
        } else {
            $('#loadingSpinner').fadeOut(200);
            $('#blogGrid').css('opacity', '1');
        }
    }

    function updateGrid(html, total) {
        if (html.trim() === '') {
            $('#blogGrid').html(`
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-journal-x"></i>
                        <h4>No blogs found</h4>
                        <p>Try adjusting your search or filter criteria.</p>
                        <button class="btn btn-outline-primary mt-2" id="clearAllFilters">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>Clear Filters
                        </button>
                    </div>
                </div>`);
        } else {
            $('#blogGrid').html(html);
        }

        // Update results count
        $('#resultsCount').html(`Showing <strong>${total}</strong> article${total !== 1 ? 's' : ''}`);
    }

    function updatePagination(paginationHtml) {
        $('#paginationWrapper').html(paginationHtml);
        bindPaginationClicks();
    }

    function bindPaginationClicks() {
        $(document).off('click', '.ajax-page').on('click', '.ajax-page', function (e) {
            e.preventDefault();
            state.page = parseInt($(this).data('page'));
            fetch(false);
        });
    }

    function scrollToBlogs() {
        if ($(window).scrollTop() > $('#blogGrid').offset().top - 100) {
            $('html, body').animate({
                scrollTop: $('#blogGrid').offset().top - 120
            }, 300);
        }
    }

    function showError(msg) {
        $('#blogGrid').html(`
            <div class="col-12 text-center py-5">
                <div class="alert alert-danger d-inline-block">
                    <i class="bi bi-exclamation-triangle me-2"></i>${msg}
                </div>
            </div>`);
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    // ==========================================
    // SYNC CATEGORY PILLS <-> SELECT
    // ==========================================
    function syncCategoryPill(catId) {
        $('.category-pill').removeClass('active');
        $(`.category-pill[data-category="${catId}"]`).addClass('active');
    }

    // ==========================================
    // EVENT BINDINGS
    // ==========================================
    function bindEvents() {

        // --- Search input (debounced) ---
        $('#blogSearch').on('input', function () {
            const query = $(this).val().trim();
            state.search = query;

            // Live dropdown
            liveSearch(query);

            // Filter debounce
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function () {
                fetch(true);
            }, 500);
        });

        // Hide search dropdown on outside click
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.search-box').length) {
                $('#searchDropdown').slideUp(150);
            }
        });

        // Show dropdown again when search focused with existing value
        $('#blogSearch').on('focus', function () {
            if ($(this).val().length >= 2 && $('#searchDropdown').children().length) {
                $('#searchDropdown').slideDown(150);
            }
        });

        // --- Category filter (select) ---
        $('#categoryFilter').on('change', function () {
            state.category = $(this).val();
            syncCategoryPill(state.category);
            fetch(true);
        });

        // --- Category pills ---
        $(document).on('click', '.category-pill', function () {
            state.category = $(this).data('category');
            $('#categoryFilter').val(state.category);
            syncCategoryPill(state.category);
            fetch(true);
        });

        // --- Date filters ---
        $('#dateFrom').on('change', function () {
            state.date_from = $(this).val();
            fetch(true);
        });
        $('#dateTo').on('change', function () {
            state.date_to = $(this).val();
            fetch(true);
        });

        // --- Sort ---
        $('#sortOrder').on('change', function () {
            state.sort = $(this).val();
            fetch(true);
        });

        // --- Reset filters ---
        $('#resetFilters').on('click', resetFilters);
        $(document).on('click', '#clearAllFilters', resetFilters);

        // Initial pagination binding
        bindPaginationClicks();
    }

    function resetFilters() {
        state = { search: '', category: 'all', date_from: '', date_to: '', sort: 'latest', page: 1 };
        $('#blogSearch').val('');
        $('#categoryFilter').val('all');
        $('#dateFrom').val('');
        $('#dateTo').val('');
        $('#sortOrder').val('latest');
        $('#searchDropdown').hide().empty();
        syncCategoryPill('all');
        fetch(true);
    }

    // ==========================================
    // PUBLIC API
    // ==========================================
    return {
        init: function () { bindEvents(); },
        fetch: function () { fetch(true); },
        reset: resetFilters,
    };

})(jQuery);

// Initialize on DOM ready
$(document).ready(function () {
    BlogFilter.init();
});
