const inputWrapper = (snazzyAdmin) => {
  jQuery(document).ready(function ($) {
    const inputWrappers = snazzyAdmin.find('.input-wrapper');

    if (inputWrappers.length) {
      inputWrappers.each(function () {
        const thisInputWrapper = $(this);

        const input = thisInputWrapper.find('input[type="text"]');
        const inputDOM = input.get(0);
        const copyButton = thisInputWrapper.find('.copy-button');

        copyButton.on('click', function () {
          inputDOM.focus();
          inputDOM.select();
          inputDOM.setSelectionRange(0, 99999); // For mobile devices

          if (navigator.clipboard) {
            navigator.clipboard.writeText(inputDOM.value);
          } else {
            // Fallback
            document.execCommand('copy');
          }
        });
      });
    }
  });
};

export default inputWrapper;
