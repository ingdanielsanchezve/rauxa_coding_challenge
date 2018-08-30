module.exports = function (config) {
    config.set({
        basePath: './',
        files: [
            'bower_components/angular/angular.min.js',
            'bower_components/angular-perfect-scrollbar/src/angular-perfect-scrollbar.min.js',
            'bower_components/angular-tooltips/dist/angular-tooltips.min.js',
            'bower_components//angular-mocks/angular-mocks.js',
            'app/*.js',
            'tests/*.js'
        ],
        autoWatch: false,
        frameworks: ['jasmine'],
        browsers: ['Chrome', 'Firefox'],
        singleRun: true,
        plugins: [
            'karma-chrome-launcher',
            'karma-firefox-launcher',
            'karma-jasmine'
        ]
    });
};