var lang = (function () {
    var zhHK = {
        'category.AREA1': 'Area 1',
        'category.AREA2': 'Area 2',
        'category.AREA3': 'Area 3',
        'category.UNIREQ': '大學必修',
        'category.E': '補底班'
    };

    var zhCN = {
        'category.AREA1': 'Area 1',
        'category.AREA2': 'Area 2',
        'category.AREA3': 'Area 3',
        'category.UNIREQ': '大学必修',
        'category.E': '补底班'
    };


    var en = {
        'category.AREA1': 'Area 1',
        'category.AREA2': 'Area 2',
        'category.AREA3': 'Area 3',
        'category.UNIREQ': 'Uni. Req.',
        'category.E': 'Foundation'
    };

    return {
        get: function (key) {
            var locale = $('html').attr('lang');
            if (locale === 'zh-HK') {
                return zhHK[key];
            } else if (locale === 'en') {
                return en[key];
            } else {
                return zhCN[key];
            }
        },
        getLocale: function () {
            return $('html').attr('lang');
        },
        getLocaleUrl: function (path) {
            var locale = $('html').attr('lang');
            var localePath = '';
            if (locale === 'en') {
                localePath = 'en';
            } else if (locale === 'zh-CN') {
                localePath = 'cn';
            }
            if (path !== undefined) {
                if (locale == 'zh-HK') {
                    return localePath + path;
                } else {
                    return localePath + '/' + path;
                }
            } else {
                return localePath;
            }
        }
    }
})();