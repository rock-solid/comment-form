import '../styles/main.scss';

// COMPONENTS
import toggleVisiblity from './components/toggleVisiblity';
import inputWrapper from './components/inputWrapper';

const main = () => {
  jQuery(document).ready(function ($) {
    const snazzyAdmin = $(`#${window.SNAZZYWP['pluginSlug']}-admin`);
    // COMPONENTS
    toggleVisiblity(snazzyAdmin);
    inputWrapper(snazzyAdmin);
  });
};

main();
// export default main; --- when we have pro features already.
