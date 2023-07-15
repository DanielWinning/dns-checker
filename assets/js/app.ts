import '../scss/app.scss';
import Searcher from './Searcher';

document.addEventListener('DOMContentLoaded', () => {
    new Searcher(
        document.querySelector('#dns-search-button'),
        document.querySelector('#domain-input')
    );
});