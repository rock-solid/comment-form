const toggleVisibility = (snazzyAdmin) => {
    jQuery(document).ready(function ($) {
      const toggleSwitchWrapper = snazzyAdmin.find('.toggle-switch');

      toggleSwitchWrapper.each(function() {
        const thisSwitchWrapper = $(this);

        thisSwitchWrapper.find('input[type="checkbox"]').on('change', function() {
          const _this = $(this);

          const showHideElements = _this.data('show-hide-elements');

          if (showHideElements && snazzyAdmin.find(showHideElements).length) {
            if (_this.is(':checked')) {
              // Show the elements
              snazzyAdmin.find(showHideElements).show();
            } else {
              // Hide the elements
              snazzyAdmin.find(showHideElements).hide();
            }
          }
        });
      });
    });
};

export default toggleVisibility;