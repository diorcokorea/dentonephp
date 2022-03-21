/*************************************
 * @LUCAS 애니메이션 드랍다운 메뉴
 *************************************/

;(function ($) {
    const defaults = {
        anchorClassName: ".dropdown__anchor",
        dropdownContentClassName: ".dropdown-content",
        dropdownContentListContainerClassName: ".dropdown-content__list",
        dropdownRootClassName: "dropdown--outside-handler",
    };

    $.fn.dropdownMenu = function (options = {}) {
        const settings = $.extend({}, defaults, options);

        const $this = $(this);
        $this.addClass(settings.dropdownRootClassName);

        $(settings.anchorClassName).on("click", function () {
            const $dropdownAnchor = $(this);
            if ($dropdownAnchor.hasClass("selected")) {
                $this.find(settings.dropdownContentClassName).height(0);
                $dropdownAnchor.removeClass("selected");
            } else {
                $dropdownAnchor.addClass("selected");
                const listHeight = $this.find(settings.dropdownContentListContainerClassName).outerHeight();
                $this.find(settings.dropdownContentClassName).height(`${listHeight}px`);
            }
        });
        const closed = function() {
            $this.find(settings.anchorClassName).removeClass("selected");
            $this.find(settings.dropdownContentClassName).height(0);
        }
        window.addEventListener('click', function(e){
            if (!$.contains($this[0], e.target)) {
                closed();
            }
        });
        return { 
            _this : this,
            _close : closed
        };
    }
})(jQuery);
