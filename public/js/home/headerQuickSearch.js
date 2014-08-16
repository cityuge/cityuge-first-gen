var headerQuickSearch = (function () {
    var typeahead = null;
    var $input = null;
    var courses = new Bloodhound({
        datumTokenizer: function (d) {
            return d.tokens;
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 5,
        prefetch: {
            url: APP_BASE_URL + '/web-api/courses/typeahead'
        }
    });
    var template = '<span class="course-code"><%- value %></span>'
        + '<span class="course-title"><%- title %></span>'
        + '<span class="course-category label label-category-<%- category.toLowerCase() %>"><%- lang.get("category." + category) %></span>';

    return {
        init: function () {
            courses.initialize();

            $input = $('#header-quick-search input[type="text"]');

            if ($(window).width() >= config.grid.smMin) {
                this.enableTypeahead();
            }

            // Disable the typeahead if the navbar is collapsed, reenable it when the navbar does not collasped
            var that = this;
            $(window).resize(_.throttle(function () {
                if ($(window).width() >= config.grid.smMin) {
                    if (typeahead === null) {
                        that.enableTypeahead();
                    }
                } else {
                    if (that.typeahead !== null) {
                        that.disableTypeahead();
                    }
                }
            }, 800));
        },
        enableTypeahead: function () {
            typeahead = $input.typeahead({
                    hint: true,
                    minLength: 1
                },
                {
                    name: 'quick-search-courses',
                    displayKey: 'value',
                    source: courses.ttAdapter(),
                    templates: {
                        suggestion: _.template(template)
                    }
                });

            // Navigate to the course info page directly when user selected an item in typeahead
            typeahead.on('typeahead:selected', function (event, data) {
                var courseCode = data.value.toLowerCase();
                window.location = APP_BASE_URL + '/' + lang.getLocaleUrl('courses/' + courseCode);
            });
        },
        disableTypeahead: function () {
            $input.typeahead('destroy');
            typeahead = null;
        }
    }
})();