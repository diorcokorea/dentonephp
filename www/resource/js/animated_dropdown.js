/*************************************
 * @LUCAS 애니메이션 드랍다운
 *************************************/

;(function ($) {
    const defaults = {
        ulWidth: "100%",
        ulMinWidth: "auto",
        ulMaxHeight: "500px",
        ulOverflowY: "auto",
        ulRight: "auto",
        ulLeft: 0,
        selectedValue: null,
        wrapperClassName: null,
        disabled: null,
    };

    let animatedDropdownSeq = 1;

    const getLabelText = $selectedOption => {
        return $selectedOption.data("selectedLabel") || $selectedOption.text().trim();
    }

    const initState = (dropdown, $aLink, currentStateIsActive, isPlaceholderTextHolder) => {
        const label = currentStateIsActive ? (isPlaceholderTextHolder.value || dropdown.find('select').attr('placeholder')): getLabelText($aLink);

        dropdown.find("select").val("");
        dropdown.find('option').prop('selected', false);
        dropdown.find('ul li').removeClass('active');

        dropdown.toggleClass('filled', !currentStateIsActive);
        dropdown.children('span.label').text(label);
    }

    const addUnselect = ($dropdown, $aLink, isPlaceholderTextHolder) => {
        // 삭제 아이콘을 넣는다. 클릭하면 없어진다.
        const $unselect = $("<span class='unselect'></span>");
        $unselect.on("click", function () {
            initState($dropdown, $aLink, true, isPlaceholderTextHolder);
            $unselect.remove();
            $dropdown.removeClass('open');
        });
        $aLink.append($unselect);
    }


    const setSelectedOption = ($this, $label, $list, isPlaceholderTextHolder) => {
        if ($this.find('option:selected').length) {
            const $selectedOption = $this.find('option:selected');
            const selectedOptionValue = $selectedOption.val();
            const selectedText = getLabelText($selectedOption);
            $label.text(selectedText); // data-selected-label

            let $li = $list.find(`li:contains('${selectedText}')`);

            $li.each((index, item) => {
                const $item = $(item);
                const value = $item.data("value");
                if (selectedOptionValue == value) {
                    $li = $item;
                }
            });

            $li.addClass('active');
            const $dropdown = $this.parent();
            $dropdown.addClass('filled');

            const $aLink = $li.find("a");
            addUnselect($dropdown, $aLink, isPlaceholderTextHolder);
        }
    }

    $.fn.animatedDropdown = function (options = {}) {

        let isPlaceholderTextHolder = {
            value: null,
        };
        const $selectBox = $(this);
        const $parent = $selectBox.parent();

        const isDisabled = $selectBox.prop("disabled");
        $parent.prop("disabled", isDisabled);

        if ($parent.hasClass("selectDropdown")) {
            const $list = $parent.find("ul");
            const $label = $parent.find("span.label");

            if (options.selectedValue) {
                $parent.find('ul li').removeClass('active');
                setSelectedOption($selectBox, $label, $list, isPlaceholderTextHolder);
                return this;
            }

            const $selectDropdownSeq = $selectBox.data("selectDropdownSeq");
            if ($selectDropdownSeq) {
                $parent.find("> ul").remove();
                $parent.find("> span.label").remove();
                $selectBox.unwrap();
            }
        }

        const seq = animatedDropdownSeq++;

        const el = this;

        const settings = $.extend({}, defaults, options);

        var dropdownWrapper = $('<div />').addClass(`animated_dropdown selectDropdown selectDropdown-${seq} ${settings.wrapperClassName ? settings.wrapperClassName : ""} ${$(this).hasClass("animated_dropdown--up") ? "animated_dropdown--up" : ""}`);

        $selectBox.wrap(dropdownWrapper);
        $selectBox.data("selectDropdownSeq", seq);

        dropdownWrapper.prop("tabindex", -1);

        var $label = $('<span class="label"/>').text($selectBox.attr('placeholder')).insertAfter($(this));
        if (isDisabled) {
            $label.addClass("disabled");
        } else {
            $label.removeClass("disabled");
        }

        var $list = $('<ul />');
        $list.css("width", settings.ulWidth);
        $list.css("minWidth", settings.ulMinWidth);
        $list.css("maxHeight", settings.ulMaxHeight);
        $list.css("overflowY", settings.ulOverflowY);
        $list.css("right", settings.ulRight);
        $list.css("left", settings.ulLeft);

        $(this).find('option').each(function () {
            const $option = $(this);

            if ($option.data("isPlaceholder")) {
                isPlaceholderTextHolder.value = $option.text();
                $label.text(isPlaceholderTextHolder.value);
                return;
            }

            const $anchor = $('<a />');
            const optionValue = $option.val();
            $anchor.text($option.text());
            if ($option.data("selectedLabel")) {
                $anchor.data("selectedLabel", $option.data("selectedLabel"));
            }
            $list.append($('<li data-value="' + optionValue + '" />').append($anchor));
        });

        $list.insertAfter($(this));

        setSelectedOption($(this), $label, $list);

        $label.on('click touch', function (e) {
            if ($(this).hasClass("disabled")) {
                return false;
            }
            var self = $(this).parent();
            var hasOpenClass = self.hasClass("open");

            $('.selectDropdown.open').removeClass("open");
            if (!hasOpenClass) {
                setTimeout(() => {
                    self.addClass('open');
                }, 0);
            }
        });

        $(document).on('click touch', `.selectDropdown.selectDropdown-${seq}.open ul li a`, function (e) {
            e.preventDefault();

            var $aLink = $(this);
            var dropdown = $aLink.parent().parent().parent();
            var li = $aLink.parent();
            var active = li.hasClass('active');

            if (active) {
                e.preventDefault();
                return;
            }

            initState(dropdown, $aLink, active, isPlaceholderTextHolder);

            if (!active) {

                const targetText = getLabelText($aLink).trim();
                // const targetText = $(this).text().trim();
                const $selectedOptions = dropdown.find('option:contains(' + targetText + ')');

                const value = li.data("value");
                $selectedOptions.each((index, item) => {
                    const $item = $(item);
                    if (value == $item.val()) {
                        $item.prop('selected', true);
                    }
                });

                dropdown.find("select").trigger("change");
                li.addClass('active');

                addUnselect(dropdown, $aLink, isPlaceholderTextHolder);
            }

            dropdown.removeClass('open');
        });

        $(document).on('click touch', function (e) {
            var dropdown = $('.animated_dropdown');
            if (dropdown !== e.target && !dropdown.has(e.target).length) {
                dropdown.removeClass('open');
            }
        });

        return this;
    }


})(jQuery);
