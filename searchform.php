<?php
/**
 * Search form template
 *
 * @package AuntieMap
 * @since 1.0.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="search-field" class="screen-reader-text">
        <?php esc_html_e('Search for:', 'auntie-map'); ?>
    </label>
    <div class="search-form-wrapper">
        <input
            type="search"
            id="search-field"
            class="search-field"
            placeholder="<?php esc_attr_e('Search recovery resources, stories, products...', 'auntie-map'); ?>"
            value="<?php echo get_search_query(); ?>"
            name="s"
            required
        />
        <button type="submit" class="search-submit">
            <span class="screen-reader-text"><?php esc_html_e('Search', 'auntie-map'); ?></span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    <div class="search-suggestions">
        <p class="suggestions-label"><?php esc_html_e('Popular searches:', 'auntie-map'); ?></p>
        <div class="suggestion-links">
            <a href="<?php echo esc_url(home_url('/?s=recovery')); ?>" class="suggestion-link">
                <?php esc_html_e('Recovery', 'auntie-map'); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/?s=sobriety')); ?>" class="suggestion-link">
                <?php esc_html_e('Sobriety', 'auntie-map'); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/?s=support')); ?>" class="suggestion-link">
                <?php esc_html_e('Support', 'auntie-map'); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/?s=meetings')); ?>" class="suggestion-link">
                <?php esc_html_e('Meetings', 'auntie-map'); ?>
            </a>
        </div>
    </div>
</form>

<style>
.search-form {
    max-width: 500px;
    margin: 0 auto;
}

.search-form-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    background: var(--white);
    border: 2px solid var(--border-gray);
    border-radius: 2rem;
    overflow: hidden;
    transition: border-color 0.3s ease;
}

.search-form-wrapper:focus-within {
    border-color: var(--primary-purple);
    box-shadow: 0 0 0 3px rgba(107, 70, 193, 0.1);
}

.search-field {
    flex: 1;
    padding: 1rem 1.5rem;
    border: none;
    background: transparent;
    font-size: 1rem;
    color: var(--text-dark);
}

.search-field:focus {
    outline: none;
}

.search-field::placeholder {
    color: var(--text-light);
}

.search-submit {
    background: var(--primary-purple);
    border: none;
    padding: 1rem 1.5rem;
    color: var(--white);
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-submit:hover {
    background: var(--dark-purple);
}

.search-submit:focus {
    outline: 2px solid var(--primary-purple);
    outline-offset: 2px;
}

.search-suggestions {
    margin-top: 1rem;
    text-align: center;
}

.suggestions-label {
    font-size: 0.875rem;
    color: var(--text-light);
    margin-bottom: 0.5rem;
}

.suggestion-links {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.suggestion-link {
    background: var(--light-purple);
    color: var(--primary-purple);
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.875rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.suggestion-link:hover {
    background: var(--primary-purple);
    color: var(--white);
}

/* Responsive design */
@media (max-width: 480px) {
    .search-form-wrapper {
        border-radius: 0.5rem;
    }

    .search-field {
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
    }

    .search-submit {
        padding: 0.75rem 1rem;
    }

    .suggestion-links {
        justify-content: center;
    }
}
</style>
